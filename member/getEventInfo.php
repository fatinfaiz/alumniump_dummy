<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php
	$selectEventInfo = "SELECT * FROM event_main WHERE EM_ID = ".$_POST['eventId'];
	$res = mysqli_query($connection, $selectEventInfo);
	$dataFetch = mysqli_fetch_assoc($res);
	$dataEvent = "<table class='table table-condensed table-hover'>";
	$dataEvent .= "<tr><td>Event Description</td><td>".$dataFetch['EM_DESC']."</td><tr>";
	$dataEvent .= "<tr><td>Date Start</td><td>".$dataFetch['EM_DATE_END']."</td><tr>";
	$dataEvent .= "<tr><td>Date End</td><td>".$dataFetch['EM_DATE_START']."</td><tr>";
	$dataEvent .= "<tr><td>Time Start</td><td>".$dataFetch['EM_TIME_START']."</td><tr>";
	$dataEvent .= "<tr><td>Time End</td><td>".$dataFetch['EM_TIME_END']."</td><tr>";
	$dataEvent .= "<tr><td>Location</td><td>".$dataFetch['EM_LOCATION']."</td><tr>";
	$dataEvent .= "</table>";

	echo json_encode($dataEvent);
?>
