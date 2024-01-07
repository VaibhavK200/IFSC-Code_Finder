<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


  $bankname=$_POST['bankname'];
 $shortname=$_POST['shortname'];
  $eid=$_GET['editid'];

$sql="update tblbank set BankName=:bankname,ShortName=:shortname where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':bankname',$bankname,PDO::PARAM_STR);
$query->bindParam(':shortname',$shortname,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();
         echo '<script>alert("Bank name has been updated")</script>';
   echo "<script>window.location.href ='manage-bank.php'</script>";
}


?>
<!doctype html>
<html lang="en">

    <head>
       
        <title>IFSC Finder :: Update Bank Name</title>

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
                           
                            <h4 class="page-title">Update Bank Name</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">

                                    <h4 class="header-title m-t-0">Update Bank Name</h4>
                                    
                                    <div class="p-20">
                                        <form action="#" method="post">
                                           <?php
                   $eid=$_GET['editid'];
$sql="SELECT * from tblbank  where ID=:eid";
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
                                                <label for="userName">Bank Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required="true" name="bankname" value="<?php  echo htmlentities($row->BankName);?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress">Short Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Short Name" required="true" name="shortname" value="<?php  echo htmlentities($row->ShortName);?>">
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