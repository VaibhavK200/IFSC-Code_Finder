<?php
session_start();
//error_reporting(0);
include('admin/includes/dbconnection.php');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <!--====== Title ======-->
    <title>IFSC Code Finder Portal | Home</title>
    
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="assets/css/slick.css">
        
    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">
        
    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="assets/css/animate.css">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.css">
<script type="text/javascript">
function copyText(){
 document.getElementById("txt_copy").select();
 document.execCommand('copy');
}
</script>
</head>

<body>
    
    
    <!--====== HEADER PART START ======-->
    
    <header class="header-area">
        <div class="navbar-area headroom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <h3 style="color: red;padding-right: 50px;">IFSC Code Finder Portal</h3>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav m-auto">
                                    
                                   <li class="nav-item" style="color:red">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin/login.php">Admin</a>
                                    </li>
                                   
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
        
   
    </header>
    
    <!--====== HEADER PART ENDS ======-->
   
 
    
    <!--====== PRICING PART START ======-->
    
    <section data-scroll-index="0" id="pricing" class="pricing-area pt-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-8 col-sm-9">
                    <div class="section-title text-center pb-20 wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s">
                       
                        
                         <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchifsccode'];
  ?>
  <h4 align="center" class="title">Result of "<?php echo $sdata;?>" Bank Detail </h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row no-gutters justify-content-center">
                <div class="col-lg-12 col-md-7 col-sm-9">
                      


                            <div class="card-body">
                                <table class="table " border="1">
                                    <thead>
                                        <tr>
                                            <tr>
                  <th>S.No.</th>
                  <th>Bank Name</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Branch</th>
                  <th>IFSC Code</th>
                  <th>MICR Code</th>
                  <th>Address</th>
                  <th>Zip Code</th>
                  <th>Contact Number</th>
                </tr>
                                  
                                        </thead>
                                    <?php

$sql="SELECT tblbank.BankName as bn,tblbank.ID as bid,tblbank.ShortName,tblstate.State,tblcity.ID as cid,tblcity.StateID,tblcity.City,tblbankdetail.IFSCCode,tblbankdetail.StateID,tblbankdetail.ID as bdid,tblbankdetail.CityID,tblbankdetail.BankName,tblbankdetail.MICRCode,tblbankdetail.BankName,tblbankdetail.Address,tblbankdetail.Branch,tblbankdetail.PhoneNumber,tblbankdetail.BranchCode,tblbankdetail.ZipCode,tblbankdetail.CreationDate from tblbankdetail inner join tblstate on tblbankdetail.StateID=tblstate.ID join tblcity on tblbankdetail.CityID=tblcity.ID join tblbank on tblbankdetail.BankName=tblbank.ID where (tblbank.BankName like  '%$sdata%' || tblbankdetail.ZipCode like  '%$sdata%' || tblbankdetail.Branch like '%$sdata%')";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>   
              
                <tr>
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php  echo htmlentities($row->bn);?><br />
                    (<?php  echo htmlentities($row->ShortName);?>)
                  </td>
                  <td><?php  echo htmlentities($row->State);?></td>
                  <td><?php  echo htmlentities($row->City);?></td>
                  <td><?php  echo htmlentities($row->Branch);?></td>
                  <td style="color:blue;" >
                    <?php  echo htmlentities($row->IFSCCode);?>
                  </td>
                  <td><?php  echo htmlentities($row->MICRCode);?></td>
                  <td><?php  echo htmlentities($row->Address);?></td>
                  <td><?php  echo htmlentities($row->ZipCode);?></td>
                  <td><?php  echo htmlentities($row->PhoneNumber);?></td>
                </tr>
                 <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="10" style="color:red; text-align:center"> No record found against this search</td>

  </tr>
   
<?php } }?>

                                </table>
                            </div>
                </div>
               
               
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PRICING PART ENDS ======-->
    
  
    <!--====== BRAND PART START ======-->
    
    
   
    <!--====== FOOTER PART START ======-->
    
    <footer id="footer" class="footer-area bg_cover" style="background-image: url(assets/images/footer-bg.jpg)">
        <div class="container">
            <div class="footer-copyright text-center">
                 <p class="text">© <?php echo date('Y');?> IFSC Code finder Portal</p>
            </div>
        </div> <!-- container -->
    </footer>
    
    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->  
<script type="text/javascript">
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>



    <!--====== Jquery js ======-->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>
    
    <!--====== Isotope js ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    
    <!--====== Counter Up js ======-->
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    
    <!--====== Circles js ======-->
    <script src="assets/js/circles.min.js"></script>
    
    <!--====== Appear js ======-->
    <script src="assets/js/jquery.appear.min.js"></script>
    
    <!--====== WOW js ======-->
    <script src="assets/js/wow.min.js"></script>
    
    <!--====== Headroom js ======-->
    <script src="assets/js/headroom.min.js"></script>
    
    <!--====== Jquery Nav js ======-->
    <script src="assets/js/jquery.nav.js"></script>
    
    <!--====== Scroll It js ======-->
    <script src="assets/js/scrollIt.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    
    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>
    
</body>

</html>
