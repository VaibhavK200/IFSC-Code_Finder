<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $state=$_POST['state'];
 $city=$_POST['city'];
  $eid=$_GET['editid'];

$sql="update tblcity set StateID=:state,City=:city where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();
         echo '<script>alert("City has been updated")</script>';
   echo "<script>window.location.href ='manage-city.php'</script>";
}


?>
<!doctype html>
<html lang="en">

    <head>
       
        <title>Coworking Space Management System :: Update City</title>

        <!-- Switchery css -->
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
       
    </head>


    <body>

<?php include_once('includes/header.php');?>
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Update City</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">

                                    <h4 class="header-title m-t-0">Update City</h4>
                                    
                                    <div class="p-20">
                                        <form action="#" method="post">
                                           <?php
                   $eid=$_GET['editid'];
$sql="SELECT tblstate.State ,tblcity.StateID as sid,tblcity.ID as cid,tblcity.City,tblcity.CreationDate from tblcity 
inner join tblstate on tblstate.ID=tblcity.StateID  where tblcity.ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                            <div class="form-group">
                                                <label for="userName">State Name<span class="text-danger">*</span></label>
                                                <select type="text" name="state" id="state" value="" required="true" 
                                 class="form-control" />
                                   <option value="<?php  echo $row->sid;?>"><?php  echo $row->State;?></option>
                                   <?php 

$sql2 = "SELECT * from    tblstate ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->State);?></option>
 <?php } ?> 

                                 </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="userName">City<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"  required="true" name="city" value="<?php  echo htmlentities($row->City);?>">
                                            </div>
                                        <?php $cnt=$cnt+1;}} ?>
                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">
                                                    Update
                                                </button>
                                                
                                            </div>

                                        </form>
                                    </div>

                                </div>
                             
                            </div>
                            <!-- end row -->


                        </div>
                    </div><!-- end col-->

                </div>
                <!-- end row -->

            </div> <!-- container -->

<?php include_once('includes/footer.php');?>

        </div> <!-- End wrapper -->

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- Validation js (Parsleyjs) -->
        <script src="../plugins/parsleyjs/parsley.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>

    </body>
</html><?php }  ?>