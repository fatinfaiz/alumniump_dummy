<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>

<?php include_once 'header.php'; ?>
      
      <section class="content-header">
      <h1>
            Member
            <small>List of all alumni member</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Alumni Member</li>
          </ol>
        </section>
        <div class="box">
            <div class="box-header">
                
  <div class="panel-body">

      <?php
 
  // 2. Perform database query
      
    $query  = "SELECT a.*, r.* ";
  $query .= "FROM alumni_main a join role_main r ON a.AM_REF_NO = r.RM_USER_ID ";
    $query .= "WHERE r.RM_MEMBER = '1'";
      
  
  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if (!$result) {
    die("Database query failed.");
  }
?>
  <h3>Lists of Alumni UMP Member</h3>
   
      <table id="listmember" class="table table-bordered table-striped">
      <?php
        if(isset($_POST)){
        ?>
        
          <a colspan=5>Search found: <?php echo mysqli_num_rows($result); ?> </a>
       
        <?php
          }
        ?>
        <thead>
            <th>No.</th>
            <th>Alumni Member</th>
            <br><th>Action</th>
          </thead>

        <tbody>
      
           <?php
      // 3. Use returned data (if any)
            $i = 1;
      while($row = mysqli_fetch_assoc($result)) {
        // output data from each row
    ?>
                    <tr>

                <td style="width: 1%"><p class="form-control-static"><?php echo $i; ?></p></td>
                <td><p class="form-control-static"><?php echo $row["AM_IC_NO"]." ".$row["AM_FULL_NAME"];?></p></class></td>
                <td style="width: 20%"> <a class="btn btn-sm btn-info pull-left" style='margin-right: 5px;' href="memberprofile.php?id=<?php echo $row['RM_USER_ID'];?>" target="_new">View</a>&nbsp;&nbsp;

                   
                </td>
            </tr>
            <?php 
            $i++; 
            } 
            ?>
            
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
  $("#listmember").DataTable();
</script>
<?php include_once 'footer.php'; ?>