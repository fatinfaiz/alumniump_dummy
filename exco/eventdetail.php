<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scoreboard Evaluation System</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/style.css" rel="stylesheet"
  </head>
  <body>
      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
  <div class="panel-body">
    <?php
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM event ";
	$query .= "WHERE event_id = '{$_GET["id"]}'";
      
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
    <label for="exampleInputEmail1">event Title</label>
    <p class="form-control-static" ><?php echo $row["event_title"];?></p>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">event Location</label>
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
    <label for="exampleInputEmail1">event Description</label>
    <?php echo $row["event_desc"];?>
  </div>
         
       <?php } ?>
       
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