<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php

$id=$_GET["id"];

    // 2. Perform database query
  $query  = "SELECT att.AT_REF_NO, att.AT_EVENT_ID, att.AT_STATUS, a.AM_REF_NO, a.AM_FULL_NAME, a.AM_IC_NO ";
  $query .= "FROM alumni_main a left join attendance_main att on a.AM_REF_NO = att.AT_REF_NO ";
  $query .= "WHERE att.AT_EVENT_ID = '{$id}'";
  //echo $query;
  $status = '';
  if(isset($_GET['AT_STATUS'])){
    $status = $_GET['AT_STATUS'];
    if($_GET['AT_STATUS'] != 'all'){
      $query .= " AND att.AT_STATUS = '".$_GET['AT_STATUS']."'";
    }
  }

  $result = mysqli_query($connection, $query);
  
    if ($result) {
    //echo "<script>alert('The invitation status');</script> ";
  } else {
      //echo "<script>alert('Databse query failed!');</script> ";
  } 

?>

  <section class="content-header">
          <h1>
            Events
            <small>Attendance Status</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Attendance Status</li>
          </ol>
        </section>
      <section>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                <div class="panel-body">
                    <form action="invitationstatus.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="col-md-5 form-group">
                        <select class="form-control" name="AT_STATUS">
                        <option value="">Please select attendance status</option>
                        <option value="all">All</option>
                        <option value="Yes">Confirm attend</option>
                        <option value="No">Not attend</option>
                        <option value="Maybe">Maybe attend</option>
                      </select>
                      </div>

                      <div class="col-md-1 form-group">
                          <input type="submit" class="btn btn-primary pull-left" name="status" value="Submit"> 
                      </div>
                      <div class="col-md-1 form-group">
                        <a href="printAttendance.php?id=<?php echo $id; ?>&AT_STATUS=<?php echo $status; ?>" target="_blank" class="btn btn-success pull-left">Print</a>
                      </div>

                      </div> 
                    </form>
                  <div class="clearfix"></div>


<div class="box">
<div class="box-header">
<h3>Lists of Participants</h3>
      <table id="example1" class="table table-bordered table-striped">
       <?php
        if(isset($_POST)){
        ?>
        
          <a colspan=5>Search found: <?php echo mysqli_num_rows($result); ?> </a>
       
        <?php
          }
        ?>
         <thead>
          <tr>
            <th>No.</th>
            <th>Identification No</th>
            <th>Name</th>
            <th>Status</th>
          </tr>
        </thead>
      
           <?php
      // 3. Use returned data (if any)
      $i =1;
      while($row = mysqli_fetch_assoc($result)) {
        // output data from each row
    ?>
                    <tr>
                <td style="width: 1%"><p class="form-control-static"><?php echo $i; ?></p></td>
                <td><p class="form-control-static"><?php echo $row["AM_IC_NO"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["AM_FULL_NAME"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["AT_STATUS"];?></p></class></td>
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
  $("#example1").DataTable();
</script>
<?php include_once 'footer.php'; ?>
                        