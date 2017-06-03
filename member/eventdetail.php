<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'headerPopup.php';?>

      <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
					<div class="panel panel-header" style="padding:15px;background: #514F5D;color: white;">
						<h4>Add Member</h4>
					  </div>
  <div class="panel-body">
    <?php
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM event e ";
	$query .= "WHERE e.event_id = '{$_GET["id"]}'";
     // echo $query; die();
      
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}

        $status = $_POST['AT_STATUS'];

        $query  = "INSERT INTO attendance_main (";
        $query .= "AT_STATUS, AT_EVENT_ID";
        $query .= ") VALUES (";
        $query .= "  '$status','{$AT_EVENT_ID}' ";
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


?>
       <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
  <div class="form-group">
    <label for="exampleInputEmail1">Event Title</label>
    <p class="form-control-static" ><?php echo $row["event_title"];?></p>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Location of Event</label>
    <?php echo $row["event_location"];?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Start Date</label>
    <?php echo $row["event_start"];?>
  </div> 
        <div class="form-group">
    <label for="exampleInputEmail1">End Date</label>
    <?php echo $row["event_end"];?>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Event Description</label>
    <?php echo $row["event_desc"];?>
  </div>

  <form action="POST">
  <input type="radio" name="yes" value="1">Yes<br>
  <input type="radio" name="maybe" value="2">Maybe<br>
  <input type="radio" name="no" value="3">No
</form>

       <?php } ?>
  </div>
</div>
                </div>
            </div>
          </div>
      </section>
	  
	  <?php include_once 'footer.php'; ?>