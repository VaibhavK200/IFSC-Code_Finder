<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid']==0)) {
  header('location:logout.php');
  } else{

 if(isset($_POST['stateid'])){
$stateid=$_POST['stateid'];

  $sql3="select * from  tblcity where StateID=:stateid";
  $query3 = $dbh -> prepare($sql3);
  $query3->bindParam(':stateid',$stateid,PDO::PARAM_STR);
  $query3->execute();
  $result3=$query3->fetchAll(PDO::FETCH_OBJ);
    foreach($result3 as $row3)
{          
    ?>  
<option value="<?php echo htmlentities($row3->ID);?>"><?php echo htmlentities($row3->City);?></option>
                  

<?php }}} ?>
