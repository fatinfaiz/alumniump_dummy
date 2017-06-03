<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

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
    <nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Scoreboard Evaluation System</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
          
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">event <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="eventlist.php">event List</a></li>
          </ul>
        </li>
          <li><a href="../logout.php">Log out </a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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