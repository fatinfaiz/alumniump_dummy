<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>

<?php

  //2. Perform database query

  $checkFaculty = $_GET['fac'];
  $checkEmployment = $_GET['emploStatus'];

  $query  = "SELECT a.*, ac.*, fm.FM_FAC_DESC, fm.FM_FAC_CODE ";
  $query .= "FROM alumni_main a left join academic_main ac ON a.AM_REF_NO = ac.AC_REF_NO ";
  $query .= "left join faculty_main fm ON ac.AC_FAC_CODE = fm.FM_FAC_CODE ";
  $query .= "WHERE ac.AC_FAC_CODE = '{$checkFaculty}' AND AM_EMPLOYMENT_STATUS = '{$checkEmployment}'";
  
  $result = mysqli_query($connection, $query);
 
  if (!$result) {
    die("Database query failed.");
  }

  $getAllFaculty  = "SELECT *  ";
  $getAllFaculty.= "FROM faculty_main ";

  $faculty = mysqli_query($connection, $getAllFaculty);
  
  if (!$faculty) {
    die("Database query failed.");
}
?>
      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-default">
  <div class="panel-body">
  <h3>Lists of Employment Status</h3>
      <table class="table table-striped">
        <thead>
            <th>Name</th>
            <th>IC Number</th>
            <th>Faculty</th>
            <th>Employment Status</th>
            <br>
          </thead>
        <tbody>
      
           <?php
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
                <tr>
                <td>
                <p class="form-control-static"><?php echo $row["AM_FULL_NAME"];?></p></class>
                </td>
                <td><p class="form-control-static"><?php echo $row["AM_IC_NO"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["FM_FAC_DESC"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["AM_EMPLOYMENT_STATUS"];?></p></class></td>
               
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
	  <?php include_once 'footer.php'; ?>