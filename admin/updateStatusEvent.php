<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php

$id=$_GET["id"];
$status = $_GET['status'];
$updateStatus = "UPDATE ads_main SET ADS_STATUS = '".$status."' WHERE ADS_ID = ".$id;
$resUpdate = mysqli_query($connection, $updateStatus);
if($resUpdate){
echo "<script>alert('Update status successful.');window.close();</script>";
}
else{
echo "<script>alert('Update failed.');window.close();</script>";
}
?>