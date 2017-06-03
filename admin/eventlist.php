<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
  
     <section class="content-header">
          <h1>
            Events
            <small>Events Lists</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List of events</li>
          </ol>
        </section>
 
      <section>
        <div class="box">
            <div class="box-header">
                
  <div class="panel-body">
      <?php
 
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM event_main ";
	
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>

  <h3>List of Alumni Events</h3>
      <table id="listevent" class="table table-bordered table-striped">
        <thead>
            <th>Events Title</th>
            <br><th>Action</th>
          </thead>
        <tbody>
           
          <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
            <tr>
                <td><p class="form-control-static"><?php echo $row["EM_TITLE"];?></p></class></td>
                <td style="width:32%"> 

                    <a class="btn btn-sm btn-warning pull-left" style='margin-right: 5px;' href="removeevent.php?id=<?php echo $row['EM_ID'];?>" onclick="return confirm('Are you sure you want to remove event from the list?');" data-toggle="modal" rel="tooltip" data-original-title='Hello' role="button"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;

                    <a class="btn btn-sm btn-info pull-left" style='margin-right: 5px;' target="_blank" href="updateevent.php?id=<?php echo $row['EM_ID'];?>">Update</a>&nbsp;&nbsp;

                    <a class="btn btn-sm btn-primary pull-left" style='margin-right: 5px;' target="_blank" href="invitationstatus.php?id=<?php echo $row['EM_ID'];?>">Attendance</a>&nbsp;&nbsp;

                    <?php
                      if($row['EM_SEND_EMAIL'] != 1){
                    ?>
                    <a class="btn btn-sm btn-danger pull-left style='width: 100px;'" href="sendinvitation.php?id=<?php echo $row['EM_ID'];?>&FAC_CODE=<?php echo $row['EM_FAC_CODE'];?>" onclick="return confirm('Are you sure you want to send invitation to all selected alumni member?');"><span class="glyphicon glyphicon-send"></span> Invite</a>
                    <?php
                      }
                    ?>
                    
                </td>
            </tr>
            <?php } ?>
      
          </tbody>
      </table>
  </div>
</div>
              
          </div>
      </section>

<!-- DataTable -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $("#listevent").DataTable();
</script>
<script type="text/javascript">
  function change_status(id, status){
        var cfm = confirm('Are you sure?');
        if(cfm == true){
            window.open('updateStatusEvent.php?id='+id+'&status='+status,'_blank');
            window.location.reload();
         }
  }
</script>
<?php include_once 'footer.php'; ?>