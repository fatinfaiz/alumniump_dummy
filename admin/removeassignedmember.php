<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php

  $id = $_GET["id"];
  $event_id = $_GET["projid"];
  $query1 = "DELETE FROM assignmember WHERE member_userid = '{$id}'";
 
  $result1 = mysqli_query($connection, $query1);
 
  //$result4 = mysqli_query($connection, $query4);
  
  if ($result1) {
      
    // Success
    echo "<script>alert('Member has been removed successfully.');window.location.href = 'assignmember.php?id=".$event_id."';</script> ";

  } else {
   echo "<script>alert('Failed to remove member.');window.location.href = 'assignmember.php?id=".$event_id."';</script> ";
   
   
  }
?>