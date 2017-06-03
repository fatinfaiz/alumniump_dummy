<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
<?php
if (isset($_POST['assignmem_id'])) {
  // Process the form

		 $member_userid = $_POST["assignmem"];
        $event_id = $_GET["id"];
  
        $query  = "INSERT INTO assignmember (";
	   $query .= "member_userid, event_id";
	    $query .= ") VALUES (";
	   $query .= " '{$member_userid}', '{$event_id}'";
	    $query .= ")";

	$result = mysqli_query($connection, $query);

	if ($result) {
		// Success
		// redirect_to("somepage.php");
		echo "<script>alert('One member is successfully assigned.');</script> ";
             echo "<script>  window.opener.location.reload();</script>";
	} else {
		// Failure
		// $message = "Subject creation failed";
			echo "<script>alert('Failed to assign member.');</script> ";
        echo "<script>  window.opener.location.reload();</script>";
	}
}


$queryListMember  = "SELECT m.*, p.*, pf.* ";
	$queryListMember .= "FROM assignmember m,event p,profile pf, role r ";
	$queryListMember .= "WHERE m.event_id=p.event_id and pf.user_id=m.member_userid  and pf.staff_id=r.staff_id and p.event_id='{$_GET['id']}' and r.role = 'member'";
     //echo $query; die;
	$resultListMember = mysqli_query($connection, $queryListMember);

    ?>


      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
      <div>
        <div class="form">
              <form action="assignmember.php?id=<?php echo $id = $_GET["id"];?>" method="post">

                  <div class="form-group">
                       <div class="col-xs-12">
                            <label for="exampleInputEmail1">Assign Member</label>
                           <?php
                           
                                // select current members
                                // 2. Perform database query
                                $query  = "SELECT p.* ";
                                $query .= "FROM profile p join role r ON p.staff_id = r.staff_id ";
                                $query .= "WHERE r.role = 'member' AND p.user_id NOT IN 
                                (SELECT member_userid FROM assignmember WHERE event_id = ".$_GET['id'].")";
                                //echo $query; die();

                                $result = mysqli_query($connection, $query);
                                // Test if there was a query error
                                if (!$result) {
                                    die("Database query failed.");
                                }
                            ?>
                                <select class="form-control" name="assignmem" required>
                                    <option value="">--Please select --</option>
                                   <?php while($row = mysqli_fetch_assoc($result)) {
                                    // output data from each row
                                    ?>

                              <option value="<?php echo $row["user_id"];?>"><?php echo $row["name"];?></option>
                            <?php } ?>
                            </select>
                        </div>
                </div>
                <div class="form-group">
                        <button type="submit" name="assignmem_id" class="btn btn-default btn-danger pull-right">Assign</button>
                </div> 
            </form>
        </div>
      </div>         

        
                       
       <div >
         <h4>Lists of Assigned Member</h4>
              <table class="table table-striped">
                <thead>
                    <th>Member</th>
                    <br><th>Action</th>
                </thead>
                  
                <tbody>
                    <?php
                    // 3. Use returned data (if any)
                    while($row = mysqli_fetch_assoc($resultListMember)) {
                        // output data from each row
                    ?>

                    <tr>
                        <td><p class="form-control-static"><?php echo $row["member_userid"];?> <?php echo $row["name"];?></p></class></td>
                        <td> <a class="glyphicon glyphicon-eye-open" title="Profile" onclick="PopupCenterDual('memberprofile.php?id=<?php echo $row['id'];?>','eventdetail','500','600'); " href="javascript:void(0);"></a>&nbsp;&nbsp;
                            <a href="removeassignedmember.php?id=<?php echo $row['member_userid'];?>&projid=<?php echo $_GET['id'];?>" onclick="return confirm('Are you sure you want to remove member from the list?');"><span class="glyphicon glyphicon-trash" title="Remove"></span></a> 
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
          </div>
      </section>
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
      <script src="../js/script.js"></script>
 <?php include_once 'footer.php';?>