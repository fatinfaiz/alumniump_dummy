<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php
if (isset($_POST['new_event'])) {
  // Process the form

		$event_userid = $_POST["employeename"];
		
        $event_location = $_POST["Location"];
        $event_start = $_POST["Start_date"];
        $event_end = $_POST["End_date"];
        $event_title = $_POST["title"];
		$event_desc = $_POST["Description"];
		$fac_id = $_POST["faculty"];
  
        $query  = "INSERT INTO event (";
	    $query .= "event_userid, event_location, event_start, event_end, event_title, event_desc, fac_id";
	    $query .= ") VALUES (";
	    $query .= "  '{$event_userid}','{$event_location}', '{$event_start}', '{$event_end}','{$event_title}', '{$event_desc}', '{$fac_id}'";
	    $query .= ")";
        
		
	$result = mysqli_query($connection, $query);

	if ($result) {
		// Success
		// redirect_to("somepage.php");
		echo "<script>alert('The event is successfully created.');</script> ";
	} else {
		// Failure
		// $message = "Subject creation failed";
			echo "<script>alert('The event is failed to be created.');</script> ";
	}
}
    ?>
  <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
      
      <div class="form">
   <form action="newevent.php" method="post">
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Title</label>
   <input type="text" name="title" class="form-control" placeholder="">
        </div>
  </div>
       
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Location</label>
   <input type="text" name="Location" class="form-control" placeholder="">
        </div>
  </div>
    <div class="form-group">
    <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Duration</label>
        </div>
        <div class="col-xs-6">
            <label>Start</label>
            <input type="date" name="Start_date" class="form-control" placeholder="example@example.com">
        </div>
        <div class="col-xs-6">
            <label>End</label>
            <input type="date" name="End_date" class="form-control" placeholder="example@example.com">
        </div>
  </div>
        <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Description</label>
   <input type="text" name="Description" class="form-control" placeholder="">
        </div>
  </div>
       <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Event employee</label>
               <?php
	// 2. Perform database query
	
    $query  = "SELECT p.* ";
	$query .= "FROM profile p join role r ON p.staff_id = r.staff_id ";
    $query .= "WHERE r.role = 'employee'";
      
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
    <select class="form-control" name="employeename">
       <?php while($row = mysqli_fetch_assoc($result)) {
        // output data from each row
		?>
 
  <option value="<?php echo $row["user_id"];?>"><?php echo $row["name"];?></option>
<?php } ?>
</select>
        </div>
  </div>
  
  <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Faculty Involved</label>
               <?php
	// 2. Perform database query
	
    $query  = "SELECT f.* ";
	$query .= "FROM faculty_main f";
    //$query .= "WHERE r.role = 'employee'";
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.".mysql_error());
	}
?>
    <select class="form-control" name="faculty">
	<option value="">All</option>
       <?php while($row = mysqli_fetch_assoc($result)) {
        // output data from each row
		?>
 
  <option value="<?php echo $row["FM_FAC_CODE"];?>"><?php echo $row["FM_FAC_DESC"];?></option>
<?php } ?>
</select>
        </div>
  </div>
  
       <div class="form-group">
       <button type="submit" name="new_event" class="btn btn-default btn-danger pull-right">Create</button>
  </div>                    
</form>
          </div>
  </div>
</div>
                </div>
            </div>
          </div>
      </section>
	  <?php include_once 'footer.php'; ?>