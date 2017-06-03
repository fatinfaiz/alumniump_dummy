<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include_once 'header.php'?>
<?php confirm_logged_in();?>
<?php
if (isset($_POST['event'])) {
  // Process the form
		
        $id = $_GET["id"];
        $event_location = $_POST["Location"];
        $event_start = $_POST["Start_date"];
        $event_end = $_POST["End_date"];
        $event_title = $_POST["title"];
		    $event_desc = $_POST["Description"];
        $event_userid = $_POST["employee"];
        $event_time_start = $_POST["start_time"];
        $event_time_end = $_POST["end_time"];
		
		
        $query  = "UPDATE event SET ";
	      $query .= " event_location = '{$event_location}', event_start = '{$event_start}', event_end = '{$event_end}', event_title = '{$event_title}', event_desc = '{$event_desc}', event_time_start = '{$start_time}', event_time_end = '{$end_time}', event_userid = '{$event_userid}' ";
	    $query .= " WHERE event_id='{$id}'";
		
		//var_dump($query);die;

	$result = mysqli_query($connection, $query);

	if ($result) {
		// Success
		// redirect_to("somepage.php");
		echo "<script>alert('The event detail is successfully updated.');</script> ";
	} else {
		// Failure
		// $message = "Subject creation failed";
			echo "<script>alert('Failed to update event details.');</script> ";
	}
}
    ?>

      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
      <?php
    $id = $_GET["id"];
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM event ";
	$query .= "WHERE event_id = '{$id}'";
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>  <div class="form">
      <form action="eventdetail.php?id=<?php echo $id = $_GET["id"];?>" method="post">
      <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
				
			$staffSelected = $row["event_userid"];
		?>
    
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Title</label>
              <input type="text" name="title" class="form-control" value="<?php echo $row["event_title"];?>">
        </div>
  </div>
       
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Location</label>
             <input type="text" name="Location" class="form-control" value="<?php echo $row["event_location"];?>">
        </div>
  </div>
    <div class="form-group">
    <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Duration</label>
        </div>
        <div class="col-xs-6">
            <label>Start</label>
            <input type="date" name="Start_date" class="form-control" value="<?php echo $row["event_start"];?>">
        </div>
        <div class="col-xs-6">
            <label>End</label>
            <input type="date" name="End_date" class="form-control" value="<?php echo $row["event_end"];?>">
        </div>
        <div class="col-xs-6">
            <label>Time Start</label>
            <input type="time" name="start_time" class="form-control" value="<?php echo $row["event_time_start"];?>">
        </div>
        <div class="col-xs-6">
            <label>Time End</label>
            <input type="time" name="end_time" class="form-control" value="<?php echo $row["event_time_end"];?>">
        </div>
  </div>
       <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Description</label>
          <input type="text" name="Description" class="form-control" value="<?php echo $row["event_desc"];?>">
        </div>
  </div>
               
               
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
        
       <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Event PIC Employee</label>
   <select class="form-control" name="employee">
       
  <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
				if($row['user_id'] == $staffSelected){
                    $check = 'selected';
                }
                else{
                    $check = '';
                }
		?>
   
        <option value="<?php echo $row['user_id']; ?>" <?php echo $check; ?>><?php echo $row['name']; ?></option>
		   
       <?php } ?>
               
</select>
        </div>
          
       </div>
	   
     <div class="form-group">
       <button type="submit" name="event" class="btn btn-default btn-danger pull-right">Update</button>
  </div>   
          <?php } ?>
</form>
          
  </div>
</div>
                </div>
            </div>
          </div>
      </section>
	  <?php include_once 'footer.php'; ?>
    