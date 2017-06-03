<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include_once 'header.php';?>

<?php

$queryViewReport ="SELECT * FROM progress WHERE progress_id='".$_GET['id']."'";
$result = mysqli_query($connection, $queryViewReport);

if ($result) {
		// Success
		// redirect_to("somepage.php");
		//echo "<script>alert('The event is successfully created.');</script> ";
	} else {
		// Failure
		// $message = "Subject creation failed";
			echo "<script>alert('Databsae query failed');</script> ";
	}

while($row = mysqli_fetch_assoc($result)) {
    $reportView = $row['progress_report'];

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
                    <label class="col-sm-4 control-label">Progress Report:</label>
                        <div class="col-sm-8">
                            <textarea name="report" class="form-control-static" cols="50" rows="20" disabled><?php echo $reportView; ?></textarea>
                            <input type="hidden" name="event_id" value="<?php echo $_GET['id']; ?>">
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