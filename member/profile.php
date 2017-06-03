<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php 
if (isset($_POST['update'])) 
{

    $AM_FULL_NAME = $_POST["AM_FULL_NAME"]; 
    $AM_HOME_ADDRESS = $_POST["AM_HOME_ADDRESS"];
    $AM_EMAIL_ADDRESS = $_POST["AM_EMAIL_ADDRESS"];
	  $AM_PHONE= $_POST["AM_PHONE"];
	  $AM_EMPLOYMENT_STATUS = $_POST["ET_DESC"];
	  $AM_POSITION = $_POST["AM_POSITION"];
    $AM_COMPANY_NAME = $_POST["AM_COMPANY_NAME"];
	  $AM_COMPANY_ADDRESS = $_POST["AM_COMPANY_ADDRESS"];
	  $AC_FAC_CODE = $_POST["FM_FAC_CODE"];
    $AC_COURSE_CODE = $_POST["CM_COURSE_CODE"];
	  $AC_PROGRAM_CODE = $_POST["PM_PROGRAM_CODE"];
	  $AC_STUDENT_ID = $_POST["AC_STUDENT_ID"];
	
    $query  = "UPDATE alumni_main SET ";
	  $query .= "AM_FULL_NAME = '{$AM_FULL_NAME}', ";
    $query .= "AM_HOME_ADDRESS = '{$AM_HOME_ADDRESS}', ";
	  $query .= "AM_EMAIL_ADDRESS = '{$AM_EMAIL_ADDRESS}', ";
    $query .= "AM_PHONE = '{$AM_PHONE}', ";
	  $query .= "AM_EMPLOYMENT_STATUS = '{$AM_EMPLOYMENT_STATUS}', ";
	  $query .= "AM_POSITION = '{$AM_POSITION}', ";
	  $query .= "AM_COMPANY_NAME = '{$AM_COMPANY_NAME}', ";
	  $query .= "AM_COMPANY_ADDRESS = '{$AM_COMPANY_ADDRESS}'";
	
	  $query .= "WHERE AM_REF_NO = '{$_SESSION["idUser"]}'";
	  $result = mysqli_query($connection, $query);
	
	if ($result) {
        echo "<script>window.opener.location.reload();window.close();</script>";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}
	
	$query2  = "UPDATE academic_main SET ";
	$query2 .= "AC_FAC_CODE = '{$AC_FAC_CODE}', ";
	$query2 .= "AC_COURSE_CODE = '{$AC_COURSE_CODE}', ";
	$query2 .= "AC_PROGRAM_CODE = '{$AC_PROGRAM_CODE}', ";
	$query2 .= "AC_STUDENT_ID = '{$AC_STUDENT_ID}' ";
	
	$query2 .= "WHERE AC_REF_NO = '{$_SESSION["idUser"]}'";
	$result2 = mysqli_query($connection, $query2);
	
	if ($result2) {
        echo "<script>window.opener.location.reload();window.close();</script>";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}
}
?>

<section class="content-header">
          <h1>
            My Account
            <small>Profile</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>

      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
  <div class="box box-primary">
                <div class="box-header with-border">
           
     

   <form action="profile.php?id=<?php echo $_SESSION["idUser"];?>" method="post"> 
   
       <?php

       $query  = "SELECT am.*, ac.*  ";
      $query .= "FROM alumni_main am LEFT JOIN academic_main ac ON am.AM_REF_NO = ac.AC_REF_NO ";
      $query .= "WHERE am.AM_REF_NO = '".$_SESSION["idUser"]."'";
      $result = mysqli_query($connection, $query);
      //Test if there was a query error
      if (!$result) {
        die("Database query failed.");
      } 
			// 3. Use returned data (if any)
			while($row = mysqli_fetch_assoc($result)) {
				// output data from each row
		?>
		
    <div class="form-group">
    <label>Passport/IC Number</label>
    <class="form-control-static" ><?php echo $row["AM_IC_NO"];?>
  </div>
  <div class="form-group">
    <label>Full Name</label>
    <input type="text" name="AM_FULL_NAME" class="form-control" value="<?php echo $row["AM_FULL_NAME"];?>">
  </div>

  <div class="form-group">
    <label>Student ID</label>
    <input type="text" name="AC_STUDENT_ID" class="form-control" value="<?php echo $row["AC_STUDENT_ID"];?>">
  </div>
  <div class="form-group">
    <label>Course</label>
    <?php
	// 2. Perform database query
	
   $getAllCourse  = "SELECT *  ";
	$getAllCourse.= "FROM course_main ";

	$course = mysqli_query($connection, $getAllCourse);
	// Test if there was a query error
	if (!$course) {
		die("Database query failed.");
	}
?>
    <select class="form-control" name="CM_COURSE_CODE">
       <?php while($showCourse = mysqli_fetch_assoc($course)) {
        if($showCourse['CM_COURSE_CODE'] == $row["AC_COURSE_CODE"]){
                    $checkCourse = 'selected';
                }
                else{
                    $checkCourse = '';
                }
		?>
		<option value="<?php echo $showCourse["CM_COURSE_CODE"];?>" <?php echo $checkCourse;?> > <?php echo $showCourse["CM_COURSE_DESC"];?> </option>
	<?php } ?>
	</select>
	
  </div>
  
  <div class="form-group">
    <label>Program</label>
    <?php
	// 2. Perform database query
	
    $getAllProgram  = "SELECT *  ";
	$getAllProgram.= "FROM program_main ";

	$program = mysqli_query($connection, $getAllProgram);
	// Test if there was a query error
	if (!$program) {
		die("Database query failed.");
	}
?>
    <select class="form-control" name="PM_PROGRAM_CODE">
       <?php while($showProgram = mysqli_fetch_assoc($program)) {
        if($showProgram['PM_PROGRAM_CODE'] == $row["AC_PROGRAM_CODE"]){
                    $checkProgram = 'selected';
                }
                else{
                    $checkProgram = '';
                }
		?>
		<option value="<?php echo $showProgram["PM_PROGRAM_CODE"];?>" <?php echo $checkProgram;?> > <?php echo $showProgram["PM_PROGRAM_DESC"];?> </option>
	<?php } ?>
	</select>
  </div>
  
  <div class="form-group">
    <label>Faculty</label>
    <?php
	// 2. Perform database query
	
    $getAllFaculty  = "SELECT *  ";
	$getAllFaculty.= "FROM faculty_main ";

	$faculty = mysqli_query($connection, $getAllFaculty);
	// Test if there was a query error
	if (!$faculty) {
		die("Database query failed.");
		//var_dump($showFaculty);die;
	}
?>
    <select class="form-control" name="FM_FAC_CODE">
       <?php while($showFaculty = mysqli_fetch_assoc($faculty)) {
        if($showFaculty['FM_FAC_CODE'] == $row["AC_FAC_CODE"]){
                    $checkFaculty = 'selected';
                }
                else{
                    $checkFaculty = '';
                }
				
		?>
		<option value="<?php echo $showFaculty["FM_FAC_CODE"];?>" <?php echo $checkFaculty;?> > <?php echo $showFaculty["FM_FAC_DESC"];?> </option>
	<?php } ?>
	</select>
	
  </div>

   <div class="form-group">
    <label>Home Address</label>
    <textarea name="AM_HOME_ADDRESS" class="form-control" rows="5"><?php echo $row["AM_HOME_ADDRESS"];?></textarea>
  </div>
    <div class="form-group">
    <label>Email Address</label>
    <input type="text" name="AM_EMAIL_ADDRESS" class="form-control" value="<?php echo $row["AM_EMAIL_ADDRESS"];?>">
  </div>  
   <div class="form-group">
    <label>Phone Number</label>
    <input type="text" name="AM_PHONE" class="form-control" value="<?php echo $row["AM_PHONE"];?>">
  </div> 
  
   <div class="form-group">
    <label>Employment Status</label>
	<?php
	// 2. Perform database query
	
    $getAllEmploymentStatus  = "SELECT *  ";
	$getAllEmploymentStatus.= "FROM employment_main ";

	$employment = mysqli_query($connection, $getAllEmploymentStatus);
	// Test if there was a query error
	if (!$employment) {
		die("Database query failed.");
	}
?>
    <select class="form-control" name="ET_DESC">
	<?php 
	while($showEmployment = mysqli_fetch_assoc($employment)) {
        if($showEmployment['ET_DESC'] == $row["AM_EMPLOYMENT_STATUS"]){
                    $checkEmployment = 'selected';
                }
                else{
                    $checkEmployment = '';
                }
		?>
		<option value="<?php echo $showEmployment["ET_DESC"];?>" <?php echo $checkEmployment;?> > <?php echo $showEmployment["ET_DESC"];?> </option>
	<?php } ?>
    
	</select>
  </div>
  <div class="form-group">
    <label>Position Title / Education Level</label>
    <input type="text" name="AM_POSITION" class="form-control" value="<?php echo $row["AM_POSITION"];?>">
  </div>
    <div class="form-group">
    <label>Company Name / University Name</label>
    <input type="text" name="AM_COMPANY_NAME" class="form-control" value="<?php echo $row["AM_COMPANY_NAME"];?>">
  </div>
        <div class="form-group">
    <label>Company Address / University Address</label>
    <textarea name="AM_COMPANY_ADDRESS" class="form-control" rows="5"><?php echo $row["AM_COMPANY_ADDRESS"];?></textarea>
  </div> 
   <?php } ?>
       <div class="form-group text-center">
       <button type="submit" name="update" class="btn btn-info" onclick="return confirm('Are you sure you want to update your profile?');">Update</button>
  </div>                    
</form>
  </div>
</div>
</div>
</div><!-- /.box -->
                </div>
            </div>
          </div>
		  
      </section>
	  <?php include_once 'footer.php'; ?>