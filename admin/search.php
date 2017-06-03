<?php require_once("../includes/session.php"); 
 require_once("../includes/db_connection.php"); 
 require_once("../includes/functions.php"); 
 confirm_logged_in();
 include_once 'header.php'; ?>

<?php

  $checkFaculty = '';
  $checkNameOrID = '';
  if (isset($_POST['Search'])) {
  //2. Perform database query
  $checkFaculty = $_POST['FM_FAC_CODE'];
  $checkNameOrID = $_POST['AM_FULL_NAME'];
  
  $query  = "SELECT a.*, ac.*, fm.FM_FAC_DESC, fm.FM_FAC_CODE ";
  $query .= "FROM alumni_main a left join academic_main ac ON a.AM_REF_NO = ac.AC_REF_NO ";
  $query .= "left join faculty_main fm ON ac.AC_FAC_CODE = fm.FM_FAC_CODE ";
  $query .= "left join role_main rm ON a.AM_REF_NO = rm.RM_USER_ID ";
  $query .= "WHERE ac.AC_FAC_CODE = '{$checkFaculty}' AND (a.AM_FULL_NAME like '%{$checkNameOrID}%' or ";
  $query .= "ac.AC_STUDENT_ID like '%{$checkNameOrID}%') AND rm.RM_MEMBER = 1 AND ac.AC_STUDENT_ID != '' ";
  $query .= "GROUP BY ac.AC_STUDENT_ID asc";

  //var_dump($query);
  
  }
  else{
  $query  = "SELECT a.*, ac.*, fm.FM_FAC_DESC, fm.FM_FAC_CODE ";
  $query .= "FROM alumni_main a left join academic_main ac ON a.AM_REF_NO = ac.AC_REF_NO ";
  $query .= "left join faculty_main fm ON ac.AC_FAC_CODE = fm.FM_FAC_CODE ";
  $query .= "left join role_main rm ON a.AM_REF_NO = rm.RM_USER_ID ";
  $query .= "WHERE rm.RM_MEMBER = 1 AND ac.AC_STUDENT_ID != '' ";
  $query .= "GROUP BY ac.AC_STUDENT_ID asc"; 
  }
  //echo $query;
  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if (!$result) {
    die("Database query failed.");
  }

    $getAllFaculty  = "SELECT *  ";
    $getAllFaculty.= "FROM faculty_main ";

    $faculty = mysqli_query($connection, $getAllFaculty);
  // Test if there was a query error
  if (!$faculty) {
    die("Database query failed.");
}
?> 

<section class="content-header">
          <h1>
            Alumni Member Report
            <small>Alumni Member Report</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Alumni Member Report</li>
          </ol>
        </section>


 <section>
        <div class="box">
            <div class="box-header">
                
  <div class="panel-body">

  <form method="post">

  <div class="form-group col-md-4">
    <input type="text" name="AM_FULL_NAME" class="form-control" placeholder="Enter alumni name or Student ID">
    </div>
  
    <div class="form-group col-md-6">
    <select class="form-control" name="FM_FAC_CODE" required>
     <option value="">Select faculty</option>
       <?php while($showFaculty = mysqli_fetch_assoc($faculty)) {
    ?>
    <option value="<?php echo $showFaculty["FM_FAC_CODE"];?>"> <?php echo $showFaculty["FM_FAC_DESC"];?> </option>
  <?php } ?>
  </select>
  </div>

  
  <div class="col-md-2 form-group">
    <button input type="submit" class="btn btn-info pull-right" style='width: 150px;' name="Search"><span class="glyphicon glyphicon-search"></span>Search Alumni</button>
    </div>




</form>

<div class="box-body">
<div class="col-sm-12">

<!-- <div class="form-group">
 <div class="col-sm-offset-4 col-sm-8">
                  
  <a class="btn btn-danger pull-right" style='width: 150px;' onclick="window.open('printemploymentstatus.php?emploStatus=<?php echo $_POST['ET_DESC']; ?>&fac=<?php echo $_POST['FM_FAC_CODE']; ?>','print','500','600'); " href="javascript:void(0);"><span class="glyphicon glyphicon-print"></span> Print Result </a>
                  </div>
                  </div> -->

       <table id="searchmember" class="table table-bordered table-striped">

      <?php
        if(isset($_POST)){
        ?>
        
          <a colspan=5>Search found: <?php echo mysqli_num_rows($result); ?> </a>
       
        <?php
          }
        ?>
          <thead>
          <h4>Search Result</h4>
            <th>No.</th>
            <th>Name</th>
            <th>Student ID</th>
            <th>Faculty</th>
            <th>Employment Status</th>
            <br>
          </thead>
        <tbody>
           <?php
      // 3. Use returned data (if any)
      $i = 1;
      while($row = mysqli_fetch_assoc($result)) {
        // output data from each row
    ?>
                <tr>
                <td><p class="form-control-static"><?php echo $i; ?></p></td>
                <td>
                <p class="form-control-static"><?php echo $row["AM_FULL_NAME"];?></p>
                </td>
                <td><p class="form-control-static"><?php echo $row["AC_STUDENT_ID"];?></p></td>
                <td><p class="form-control-static"><?php echo $row["FM_FAC_DESC"];?></p></td>
                <td><p class="form-control-static"><?php echo $row["AM_EMPLOYMENT_STATUS"];?></p></td>
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
  </div>
  </div> 
        
        
      </section>

<!-- DataTable -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $("#searchmember").DataTable();
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