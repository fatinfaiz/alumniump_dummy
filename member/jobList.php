<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
  
     <section class="content-header">
          <h1>
            Job Advertisement
            <small>List of Job Advertisement</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List of job advertisement</li>
          </ol>
        </section>
 
      <section>
        <div class="box">
            <div class="box-header">
                
  <div class="panel-body">
      <?php
 
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM ads_main am join category_main cm on am.ADS_CATEGORY=cm.CY_ID";
	
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>

  <h3>List of Alumni Job Advertisements</h3>
      <table id="listjobads" class="table table-bordered table-striped">
      <?php
        if(isset($_POST)){
        ?>
        
          <a colspan=5>Search found: <?php echo mysqli_num_rows($result); ?> </a>
       
        <?php
          }
        ?>
        <thead>

            <th>No.</th>
            <th>Ads Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
          </thead>
        <tbody>
           
          <?php
			// 3. Use returned data (if any)
          $i=1;
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
            <tr>
                <td style="width: 1%"><p class="form-control-static"><?php echo $i; ?></p></td>
                <td><p class="form-control-static"><?php echo $row["ADS_TITLE"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["CY_DESC"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["ADS_STATUS"];?></p></class></td>
                <td style="width: 25%"> 
                    <a class="btn btn-sm btn-info pull-left" style='margin-right: 5px;' href="adsdetail.php?id=<?php echo $row['ADS_ID'];?>">Update</a>&nbsp;&nbsp;
                    
                    
                </td>
            </tr>
            <?php 
            $i++;
            } ?>
      
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
  $("#listjobads").DataTable();
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