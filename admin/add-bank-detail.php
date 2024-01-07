<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$ifscaid=$_SESSION['ifscaid'];
 $ifsccode=$_POST['ifsccode'];
 $micrcode=$_POST['micrcode'];
 $bankname=$_POST['bankname'];
 $address=$_POST['address'];
 $stateid=$_POST['stateid'];
 $city=$_POST['city'];
 $branch=$_POST['branch'];
 $phonenum=$_POST['phonenum'];
 $branchcode=$_POST['branchcode'];
 $zipcode=$_POST['zipcode'];
$sql="insert into tblbankdetail(IFSCCode,MICRCode,BankName,Address,StateID,CityID,Branch,PhoneNumber,BranchCode,ZipCode)values(:ifsccode,:micrcode,:bankname,:address,:stateid,:city,:branch,:phonenum,:branchcode,:zipcode)";
$query=$dbh->prepare($sql);
$query->bindParam(':ifsccode',$ifsccode,PDO::PARAM_STR);
$query->bindParam(':micrcode',$micrcode,PDO::PARAM_STR);
$query->bindParam(':bankname',$bankname,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':stateid',$stateid,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':branch',$branch,PDO::PARAM_STR);
$query->bindParam(':phonenum',$phonenum,PDO::PARAM_STR);
$query->bindParam(':branchcode',$branchcode,PDO::PARAM_STR);
$query->bindParam(':zipcode',$zipcode,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Bank has been added.")</script>';
echo "<script>window.location.href ='add-bank-detail.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!doctype html>
<html lang="en">

    <head>
       
        <title>IFSC Finder :: Add Bank Detail</title>

        <!-- Switchery css -->
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
      <script>
function getcity(val) {
  $.ajax({
type:"POST",
url:"get-city.php",
data:'stateid='+val,
success:function(data){
$("#city").html(data);
}

  });


}
  
  
  </script> 
    </head>


    <body>

<?php include_once('includes/header.php');?>
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Add Bank Detail</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">

                                    <h4 class="header-title m-t-0">Add Bank Detail</h4>
                                    
                                    <div class="p-20">
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <label for="userName">Bank<span class="text-danger">*</span></label>
                                                <select type="text" name="bankname" id="bankname" value="" class="form-control" required="true">
<option value="">Choose Bank</option>
                                                        <?php 

$sql2 = "SELECT * from   tblbank ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->ID);?>"><?php echo htmlentities($row->BankName);?></option>
 <?php } ?></select>
                                            </div>
                                            <div class="form-group">
                                                <label for="userName">State<span class="text-danger">*</span></label>
                                                <select  class="form-control" required="true" name="stateid" id="stateid" onChange="getcity(this.value)">
                                                    <option value="opt1">Select State</option>
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
                                                <label for="city">City<span class="text-danger">*</span></label>
                                                <select  class="form-control"  name="city" id="city">
                                                    <option value="opt1">Select City</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="userName">IFSC Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Bank IFSC Code" required="true" name="ifsccode">
                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress">MICR Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter MICR Code" required="true" name="micrcode">
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="emailAddress">Address<span class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control" placeholder="Address" required="true" name="address"></textarea>
                                            </div>
                                            
                                    
        



                                            <div class="form-group">
                                                <label for="branch">Branch<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" placeholder="Branch Name"  name="branch" >
                                            </div>

    <div class="form-group">
                                                <label for="userName">Branch Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Branch Code" required="true" name="branchcode">
                                            </div>

                                            <div class="form-group">
                                                <label for="emailAddress">Phone Number<span class="text-danger"></span></label>
                                                <input type="text" class="form-control" placeholder="Phone Number"  name="phonenum" pattern="[0-9]+" maxlength="10">
                                            </div>
                                         
                                            <div class="form-group">
                                                <label for="emailAddress">Zip Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Zip Code" required="true" name="zipcode">
                                            </div>
                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">
                                                    Add
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