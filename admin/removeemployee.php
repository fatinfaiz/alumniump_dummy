<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php

  $id = $_GET["id"];
  $query1 = "DELETE FROM login_main WHERE LM_USER_ID = '{$id}'";
  $query2 = "DELETE FROM alumni_main WHERE AM_REF_NO = '{$id}'";
  $query3 = "DELETE FROM role_main WHERE RM_USER_ID = '{$id}'";
  

  $result1 = mysqli_query($connection, $query1);
  $result2 = mysqli_query($connection, $query2);
  $result3 = mysqli_query($connection, $query3);
  
  //$result4 = mysqli_query($connection, $query4);
  
  if ($result1 && $result2 && $result3) {
      
    // Success
    echo "<script>alert('Member has been removed successfully.');window.location.href = 'updateemployee.php';</script> ";

  } else {
   echo "<script>alert('Failed to remove member.');window.location.href = 'updateemployee.php';</script> ";
   
   
  }
?>