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
       
       $member_user_id= $_SESSION['staff_id'];
       $eventID = $_GET['id'];
       
	$query  = "SELECT * FROM profile p, progress pr, event pj
               WHERE pr.member_userid = p.user_id AND pr.event_id = pj.event_id AND pj.event_id = '".$eventID."' AND p.id = ' ".$member_user_id."'";
   
	//echo $query;
    //   die;
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
     
       <table class="table table-striped">
        
        <tbody>
            
            <thead>
            <th>No.</th>
            <th>Date Submit</th>
           </thead>
           
       <?php
			// 3. Use returned data (if any)
            $count = 1;
			while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$count."</td>";
                echo "<td><a href='viewProgress.php?id=".$row['progress_id']."'>".$row['submit_date']."</a></td>";
                echo "</tr>";
              
		// output data from each row
                $count++;
            }
            
		?>
    
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