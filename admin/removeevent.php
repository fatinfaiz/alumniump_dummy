<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php

  $id = $_GET["id"];
  $query = "DELETE FROM event_main WHERE EM_ID = '{$id}' LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    echo "<script>alert('The event has been removed successfully.');window.location.href = 'eventlist.php';</script> ";

  } else {
   echo "<script>alert('Failed to remove event.');window.location.href = 'eventlist.php';</script> ";
   
   
  }
?>
