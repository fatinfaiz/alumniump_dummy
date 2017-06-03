<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-8">
                    <div class="panel panel-default">
  <div class="panel-body">
      <?php
 
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM event ";
	$query .= "WHERE employee_userid = '{$_SESSION["user_id"]}'";
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
  <h3>Lists of event</h3>
      <table class="table table-striped">
        <thead>
            <th>event Title</th>
            <br><th>Action</th>
          </thead>
        <tbody>
            <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
            <tr>
                <td><p class="form-control-static"><?php echo $row["event_title"];?></p></class></td>
      <td> <a class="glyphicon glyphicon-folder-open" title="Information detail" onclick="window.open('eventdetail.php?id=<?php echo $row['event_id'];?>','eventdetail','500','600'); " href="javascript:void(0);"></a>&nbsp;&nbsp;
                    <a class="glyphicon glyphicon-briefcase" title="Member list" onclick="window.open('listmember.php?id=<?php echo $row['event_id'];?>','eventdetail','500','600'); " href="javascript:void(0);"></a>&nbsp;&nbsp;
                
                     
                </td>
            </tr>
            <?php } ?>
          </tbody>
      </table>   
  </div>
</div>
                </div>
            </div>
          </div>
      </section>

    <script src="../js/jquery-1.11.3.min.js"></script>
   
    <script src="../js/bootstrap.min.js"></script>
      <script src="../js/script.js"></script>
  <?php include_once 'footer.php';