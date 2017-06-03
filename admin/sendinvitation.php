<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
<?php

$id=$_GET["id"]; 
$FAC_CODE = $_GET["FAC_CODE"];

  $query1 = "SELECT a.AM_REF_NO, a.AM_EMAIL_ADDRESS, a.AM_FULL_NAME";
  $query1 .= " FROM alumni_main a  left join academic_main ac ON a.AM_REF_NO = ac.AC_REF_NO";
  $query1 .= " WHERE ac.AC_FAC_CODE = '{$FAC_CODE}'";

  //echo $query1;die;
  $result = mysqli_query($connection, $query1);

  if (!$result) {
    die("Database query failed.");
  }
  else{
    $sqlUpdateEvent = "UPDATE event_main SET EM_SEND_EMAIL = 1 WHERE EM_ID = ".$id;
    mysqli_query($connection, $sqlUpdateEvent);
  }
  //echo mysqli_num_rows($result);
  $resultInvite = false;
  while($row = mysqli_fetch_assoc($result)){
    
        $query  = "INSERT INTO attendance_main (AT_REF_NO,AT_EVENT_ID)";
        $query .= " VALUES (".$row['AM_REF_NO'].",".$id.")";
        //echo $query;
        $Insertresult = mysqli_query($connection, $query) or die(mysqli_error());
//echo "<br>";
  if ($Insertresult) {
    echo 'DONE!-'.$row['AM_FULL_NAME'].'<br/>';
    $resultInvite = true;
  } else {
      echo 'FAILED!<br/>';
  }
}

if($resultInvite){
  echo "<script>alert('Succesfully invite members!!!');";
  echo "window.location.href = 'eventList.php'; </script>"; 
}
else{
  echo "<script>alert('Failed to invite. Please contact administration for further investigation.');";
  echo "window.location.href = 'eventList.php'; </script>";
}
    ?>