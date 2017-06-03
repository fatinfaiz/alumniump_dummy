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
            <li class="active">Profile</li>
          </ol>
        </section>
 
      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-default">
  <div class="panel-body">

<?php
    //var_dump($_SESSION);
    $id=$_SESSION["idUser"];
  // 2. Perform database query
  $query1  = "SELECT * ";
  $query1 .= "FROM event_main ";
  $query1 .= "WHERE EM_PIC = '{$id}'";
  
  $result1 = mysqli_query($connection, $query1);
  // Test if there was a query error
  if (!$result1) {
    die("Database query failed.");
  }
  ?>


<h3>Lists of event assigned</h3>
      <table class="table table-striped">
        <thead>
            <th>Events Title</th>
            <br><th>Action</th>
          </thead>
        <tbody>
           
          <?php
      // 3. Use returned data (if any)
      while($row1 = mysqli_fetch_assoc($result1)) {
        // output data from each row
    ?>
            <tr>
                <td><p class="form-control-static"><?php echo $row1["EM_TITLE"];?></p></class></td>
                <td> 
                    <!--<a class="glyphicon glyphicon-eye-open" title="Individual Score" onclick="PopupCenterDual('score.php?id=<?php echo $row1['EM_ID'];?>','score','500','600'); " href="javascript:void(0);"></a>&nbsp;&nbsp;-->
                    
                    <a class="btn btn-info" title="Update" href="updateevent.php?id=<?php echo $row1['EM_ID'];?>">View</a>&nbsp;&nbsp;
                    
                    <!-- <a href="removeevent.php?id=<?php echo $row1['EM_ID'];?>" onclick="return confirm('Are you sure you want to remove event from the list?');"><span class="glyphicon glyphicon-trash" title="Remove"></span></a>  -->
                 
                </td>
            </tr>
            <?php } ?>
      
          </tbody>
      </table>

<?php
  // 2. Perform database query
  $query  = "SELECT * ";
  $query .= "FROM event_main ";
  $query .= "WHERE EM_PIC != '{$id}'";
  
  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if (!$result) {
    die("Database query failed.");
  }
?>

  <h3>Lists of event</h3>

      <table id="listevent" class="table table-bordered table-striped">
      <?php
        if(isset($_POST)){
        ?>
        
          <a colspan=5>Search found: <?php echo mysqli_num_rows($result); ?> </a>
       
        <?php
          }
        ?>
      
        <thead>
            <th>Events Title</th>
            
          </thead>
        <tbody>
           
          <?php
			// 3. Use returned data (if any)
           $i = 1;
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
            <tr>
                <td><p class="form-control-static"><?php echo $row["EM_TITLE"];?></p></class></td>
               
            </tr>
            <?php 
            $i++;

            } ?>
      
          </tbody>
      </table>
  </div>
</div>
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
<?php include_once 'footer.php'; ?>