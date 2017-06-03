<?php require_once("../includes/session.php"); 
 require_once("../includes/db_connection.php"); 
 require_once("../includes/functions.php"); 
 confirm_logged_in();
 include_once 'header.php'; ?>

<?php

  //$id=$_GET["id"];

  if (isset($_POST['Search'])) {
  //2. Perform database query

  $checkFaculty = $_POST['FM_FAC_CODE'];
  $checkEmployment = $_POST['ET_DESC'];
  $query  = "SELECT a.*, ac.*, fm.FM_FAC_DESC, fm.FM_FAC_CODE ";
  $query .= "FROM alumni_main a left join academic_main ac ON a.AM_REF_NO = ac.AC_REF_NO ";
  $query .= "left join faculty_main fm ON ac.AC_FAC_CODE = fm.FM_FAC_CODE ";
  $query .= "WHERE ac.AC_FAC_CODE = '{$checkFaculty}' AND AM_EMPLOYMENT_STATUS = '{$checkEmployment}'";
  
  //echo $query;
  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if (!$result) {
    die("Database query failed.");
  }
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
            Employment Status
            <small>Search Employment Status</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Employment Status</li>
          </ol>
        </section>
      <section>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post">
                      <div class="col-md-5 form-group">
                        <select class="form-control" name="FM_FAC_CODE">
                         <option value="">Please select faculty...</option>
                           <?php while($showFaculty = mysqli_fetch_assoc($faculty)) {
                        ?>
                        <option value="<?php echo $showFaculty["FM_FAC_CODE"];?>"> <?php echo $showFaculty["FM_FAC_DESC"];?> </option>
                      <?php } ?>
                      </select>
                      </div>

                    <div class="col-md-5 form-group">
                        <?php
                      // 2. Perform database query
                      
                        $getEmployment  = "SELECT *  ";
                        $getEmployment.= "FROM employment_main ";

                      $employment = mysqli_query($connection, $getEmployment);
                      // Test if there was a query error
                      if (!$employment) {
                        die("Database query failed.");
                        //var_dump($showFaculty);die;
                      }
                    ?>
                        <select class="form-control" name="ET_DESC">
                        <option value="">Please select employment status...</option>
                           <?php while($showEmployment = mysqli_fetch_assoc($employment)) {
                              
                        ?>
                        <option value="<?php echo $showEmployment["ET_DESC"];?>" > <?php echo $showEmployment["ET_DESC"];?> </option>
                      <?php } ?>
                      </select>
                      </div>

                      <div class="col-md-2 form-group">
                          <button input type="submit" class="btn btn-info pull-right" style='width: 150px;' name="Search"><span class="fa fa-search"></span> Search</button>

                        </div>

                      </div> 
                    </form>
                  <div class="clearfix"></div>

                <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lists of Employment Status</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
              <div class="col-sm-12">
               <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-8">
                  
                    <a class="btn btn-danger pull-right" style='width: 150px;' onclick="window.open('printemploymentstatus.php?emploStatus=<?php echo $_POST['ET_DESC']; ?>&fac=<?php echo $_POST['FM_FAC_CODE']; ?>','print','500','600'); " href="javascript:void(0);"><span class="glyphicon glyphicon-print"></span> Print Result </a>
                    
                  </div>
                </div>
                     <table id="searchemployment" class="table table-bordered table-striped">

                        <?php
                          if(isset($_POST)){
                          ?>
                          
                            <a colspan=5>Search found: <?php echo mysqli_num_rows($result); ?> </a>
                         
                          <?php
                            }
                          ?>
                      <thead>
                          <th>No.</th>
                          <th>Name</th>
                          <th>IC Number</th>
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
                              <td style="width: 1%"><p class="form-control-static"><?php echo $i; ?></p></td>
                              <td>
                              <p class="form-control-static"><?php echo $row["AM_FULL_NAME"];?></p></class>
                              </td>
                              <td><p class="form-control-static"><?php echo $row["AM_IC_NO"];?></p></class></td>
                              <td><p class="form-control-static"><?php echo $row["FM_FAC_DESC"];?></p></class></td>
                              <td><p class="form-control-static"><?php echo $row["AM_EMPLOYMENT_STATUS"];?></p></class></td>
                             
                          </tr>
                       
                          <?php 
                          $i++;
                          } ?>
                        </tbody>
                                 
                    </table>               
                </div></div>
                </div>
                </div>
              </div>      
                          
                        </div>
                    </section>

    <!-- DataTable -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $("#searchemployment").DataTable();
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