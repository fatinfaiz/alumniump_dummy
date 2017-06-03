<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include_once 'header.php';?>
<?php
if (isset($_POST['submit'])) {
  // Process the form
    
        $report = $_POST["report"];
        $event_id = $_POST['event_id'];
        $date = date('Y-m-d h:i:s');
  
        $query  = "INSERT INTO progress (";
	    $query .= "member_userid, event_id, submit_date, progress_report";
	    $query .= ") VALUES (";
	    $query .= "  '{$_SESSION['user_id']}','{$event_id}', '{$date}', '{$report}'";
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
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-default">
  <div class="panel-body">
   <form class="form-horizontal" method="post">
       <?php
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM event p ";
	$query .= "WHERE p.event_id = '{$_GET["id"]}'";
     // echo $query; die();
      
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
  
       <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
		// output data from each row
            
		?>
       
       <div class="form-group">
    <label class="col-sm-4 control-label">event Title</label>
    <div class="col-sm-4">
      <input type="text" class="form-control-static" value="<?php echo $row["event_title"];?>" disabled>
    </div>
  </div> <?php } ?>
       
       <table class="table table-striped">
        
        <tbody>
           <div class="form-group">
                    <label class="col-sm-4 control-label">Please write your progress:</label>
                        <div class="col-sm-8">
                            <textarea name="report" class="form-control-static" cols="50" rows="20"></textarea>
                            <input type="hidden" name="event_id" value="<?php echo $_GET['id']; ?>">
                            </div>
                        </div>
      
       <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <input type="submit" name="submit" value="submit">
        <a class="btn btn-submit btn-danger" href="eventlist.php">Cancel</a>
           </div>
            </div>
             </tbody>
           </table>
  </div>
       </div>
                        </form>
                
                        </div>
  </div>
</div>
                </div>
            </div>
      </div>
      </section>
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
      <script src="../js/script.js"></script>
  </body>
</html>