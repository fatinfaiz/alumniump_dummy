<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
<?php
if (isset ($_GET['id'])){
$id=$_GET["id"];	
}

if (isset($_POST['event'])) {
		    $id = $_POST['id'];
        $EM_LOCATION = $_POST["LC"];
        $event_start = $_POST["DS"];
        $event_end = $_POST["DE"];
        $event_title = $_POST["EM_TITLE"];
		    $event_desc = $_POST["DES"];
		    $event_userid = $_POST["UID"];
		    $event_fac_code = $_POST["FC"];
        $EM_TIME_START = $_POST["TS"];
        $EM_TIME_END = $_POST["TE"];
 
	      $query  = "UPDATE event_main SET ";
	      $query .= "EM_LOCATION = '{$EM_LOCATION}', ";
        $query .= "EM_DATE_START = '{$event_start}', ";
	      $query .= "EM_TITLE = '{$event_title}', ";
        $query .= "EM_DESC = '{$event_desc}', ";
	      $query .= "EM_PIC = '{$event_userid}', ";
	      $query .= "EM_DATE_END = '{$event_end}', ";
	      $query .= "EM_FAC_CODE = '{$event_fac_code}',  ";
        $query .= "EM_TIME_START = '{$EM_TIME_START}', ";
        $query .= "EM_TIME_END = '{$EM_TIME_END}' ";
	
	      $query .= "WHERE EM_ID = '{$id}'";

	$result = mysqli_query($connection, $query);

	if ($result) {
		// Success
		// redirect_to("somepage.php");
		echo "Success!";echo "<script>alert('The event detail is successfully updated.');</script> ";
	} else {
		// Failure
		// $message = "Subject creation failed";
			echo "<script>alert('Failed to update event details.');</script> ";
			var_dump($query);die;
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
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM event_main WHERE EM_ID ='{$id}'" ;
	
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
  
      <div class="form">
   <form action="updateevent.php" method="post">
   <?php
   while($row = mysqli_fetch_assoc($result)) {
	?>
  <div class="form-group">
      <div class="col-xs-12">
	  <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="exampleInputEmail1">Event Title</label>
   <input type="text" name="EM_TITLE" class="form-control" value="<?php echo $row["EM_TITLE"];?>">
        </div>
  </div>
       
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Location</label>
   <input type="text" name="LC" class="form-control" value="<?php echo $row["EM_LOCATION"];?>">
        </div>
  </div>
    <div class="form-group">
    <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Duration</label>
        </div>
        <div class="col-xs-6">
            <label>Date Start</label>
            <input type="date" name="DS" class="form-control" value="<?php echo $row["EM_DATE_START"];?>">
        </div>
        <div class="col-xs-6">
            <label>Date End</label>
            <input type="date" name="DE" class="form-control" value="<?php echo $row["EM_DATE_END"];?>">
        </div>
        <div class="col-xs-6">
            <label>Time Start</label>
            <input type="time" name="TS" class="form-control" value="<?php echo $row["EM_TIME_START"];?>">
        </div>
        <div class="col-xs-6">
            <label>Time End</label>
            <input type="time" name="TE" class="form-control" value="<?php echo $row["EM_TIME_END"];?>">
        </div>
  </div>
        <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Description</label>
   
    <textarea name="DES" class="form-control" rows="5"><?php echo $row["EM_DESC"];?></textarea>
  </div> 
        </div>
  </div>
       <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Event employee</label>
               <?php
	// 2. Perform database query
	
    $queryEvent  = "SELECT am.AM_REF_NO, am.AM_FULL_NAME ";
	$queryEvent .= "FROM role_main r join alumni_main am ON r.RM_USER_ID = am.AM_REF_NO ";
    $queryEvent .= "WHERE r.RM_EXCO = '1'";
      
	$resultEvent = mysqli_query($connection, $queryEvent);
	// Test if there was a query error
	if (!$resultEvent) {
		die(mysqli_error());
		//die("Database query failed.");
	}
?>
    <select class="form-control" name="UID">
       <?php while($showEvent = mysqli_fetch_assoc($resultEvent)) {
        // output data from each row
		if($showEvent['AM_REF_NO'] == $row['EM_PIC']){
                    $checkPIC = 'selected';
                }
                else{
                    $checkPIC = '';
                }
		?>

  <option value="<?php echo $showEvent["AM_REF_NO"];?>"<?php echo $checkPIC;?> > <?php echo $showEvent["AM_FULL_NAME"];?></option>
<?php } ?>
</select>
        </div>
  </div>
  
  <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Faculty Involved</label>
               <?php
	// 2. Perform database query
	
    $getAllFaculty  = "SELECT *  ";
	$getAllFaculty .= "FROM faculty_main ";
	
	$faculty = mysqli_query($connection, $getAllFaculty);
	// Test if there was a query error
	if (!$faculty) {
		//die("Database query failed.");
		var_dump($showFac);die;
	}
?>
    <select class="form-control" name="FC">
	<option value="">All</option>
       <?php while($showFac = mysqli_fetch_assoc($faculty)) {
        // output data from each row
		if($showFac['FM_FAC_CODE'] == $row["EM_FAC_CODE"]){
                    $checkFac = 'selected';
                }
                else{
                    $checkFac = '';
                }
		?>
 
  <option value="<?php echo $showFac["FM_FAC_CODE"];?>"<?php echo $checkFac;?>><?php echo $showFac["FM_FAC_DESC"];?></option>
<?php } ?>
</select>
        </div>
  </div>
  
       <div class="form-group text-center">
       <button type="submit" name="event" style="margin-top: 15px" class="btn btn-info">Update</button>
  </div>                    
</form>

   <?php } ?>
          </div>
  </div>
</div>
                </div>
            </div>
          </div>
      </section>
	  <?php include_once 'footer.php'; ?>