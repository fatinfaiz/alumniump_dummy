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
                <div class="col-md-offset-1 col-md-8">
                <div class="col-md-offset-1 col-md-8">
                    <div class="panel panel-default">
  <div class="panel-body">
      <?php
 
	// 2. Perform database query
	$query  = "SELECT m.*, p.*, pf.* ";
	$query .= "FROM assignmember m,event p,profile pf, role r ";
	$query .= "WHERE p.employee_userid = '{$_SESSION["user_id"]}' and m.event_id=p.event_id and pf.user_id=m.member_userid  and pf.staff_id=r.staff_id and p.event_id='{$_GET['id']}' and r.role = 'member'";
     // echo $query; die;
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
  <h3>List of member</h3>
      <table class="table table-striped">
        <thead>
            <th>Member's name</th>
            <br><th>Action</th>
          </thead>
        <tbody>
            
            
  <h3>List of member</h3>
      <table class="table table-striped">
        <thead>
            <th>Member's name</th>
            <br><th>Action</th>
          </thead>
        <tbody>
            <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
            

                    <?php

            // 2. Perform database query
            $queryE  = "SELECT * ";
            $queryE .= "FROM evaluation_mark ";
            $queryE .= "WHERE staff_id='{$row['user_id']}' and event_id='{$row['event_id']}'";

             // echo $query; die;
            $resultE = mysqli_query($connection, $queryE);
            // Test if there was a query error
            if (!$resultE) {
                die("Database query failed.");
            }

           $countEva= mysqli_num_rows($resultE);

            //echo $countEva ."<br>";

        ?>
            
            
            <tr>
                <td><p class="form-control-static"><?php echo $row["name"];?></p></class></td>
                <td> <a class="glyphicon glyphicon-folder-open" title="Profile" onclick="PopupCenterDual('memberprofile.php?id=<?php echo $row['id'];?>','memberprofile','500','600'); " href="javascript:void(0);"></a>&nbsp;&nbsp;
                    
                    <a class="glyphicon glyphicon-book" title="Progress History" onclick="PopupCenterDual('progresshistory.php?id=<?php echo $row['id'];?>&value=<?php echo $_GET['id'];?>','progresshistory','500','600'); " href="javascript:void(0);"></a>&nbsp;&nbsp;
                    
                    <a class="glyphicon glyphicon-file" title="Evaluation form" 
                       <?php
                            if($countEva == 0)
                            {
                                ?>
                                onclick="PopupCenterDual('evaluate.php?id=<?php echo $row['user_id'];?>&eventid=<?php echo $row['event_id'];?>','evaluate','500','600'); "
                                <?php
                            }
                            else
                            {
                            ?>
                                 onclick="PopupCenterDual('updateevaluation.php?id=<?php echo $row['user_id'];?>&eventid=<?php echo $row['event_id'];?>','evaluate','500','600'); "
                            <?php                                
                            }                
                            ?>
                       href="javascript:void(0);"></a></a> 
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
	   </body>
</html>