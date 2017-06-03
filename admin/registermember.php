<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php
if (isset($_POST['member'])) {
  // Process the form

		    //$username = $_POST["ic"];
        $name = $_POST["name"];
        $ic = $_POST["ic"];
        $contactno = $_POST["contactno"];
        $email = $_POST["email"];
        $home = $_POST["home"];
        $employment = $_POST["employment"];
        $position = $_POST["position"];
        $companyname = $_POST["companyname"];
        $companyaddress = $_POST["companyaddress"];
        $studentid = $_POST["studentid"];
        $course = $_POST["course"];
        $program = $_POST["program"];
        $fac = $_POST["fac"];

        
        
        $queryProfile = "INSERT INTO alumni_main (AM_FULL_NAME, AM_PHONE, AM_EMAIL_ADDRESS, AM_IC_NO, AM_HOME_ADDRESS, AM_EMPLOYMENT_STATUS, AM_POSITION, AM_COMPANY_NAME, AM_COMPANY_ADDRESS) VALUES( '".$name."', '".$contactno."', '".$email."', '".$ic."', '".$home."', '".$employment."', '".$position."', '".$companyname."', '".$companyaddress."')";

        $resProfile = mysqli_query($connection, $queryProfile);
        $last_id = mysqli_insert_id($connection);

        $queryRole = "INSERT INTO role_main (RM_USER_ID, RM_MEMBER) VALUES(".$last_id.", '1')";
    $resRole = mysqli_query($connection, $queryRole);

         $queryAcademic = "INSERT INTO academic_main (AC_REF_NO, AC_STUDENT_ID, AC_COURSE_CODE, AC_PROGRAM_CODE, AC_FAC_CODE) VALUES( '".$last_id."','".$studentid."', '".$course."', '".$program."', '".$fac."')";

        $resAcademic = mysqli_query($connection, $queryAcademic);
        

     //  $query  = "INSERT INTO login_main (";
	    // $query .= "LM_USERNAME, LM_USER_ID, LM_PASSWORD";
	    // $query .= ") VALUES (";
	    // $query .= "  '{$username}','{$last_id}','{$password}'";
	    // $query .= ")";

	    // $result = mysqli_query($connection, $query)or die(mysqli_error());

   

	if ($result) {
		// Success
		// redirect_to("somepage.php");
		echo "<script>alert('Member is successfully registered.');</script> ";
        echo "<script>  window.opener.location.href = 'updatemember.php';.reload();window.close();</script>";
	} else {
		// Failure
		// $message = "Subject creation failed";
			echo "<script>alert('Member is failed to be created.');</script> ";
            die("Database query failed. " . mysqli_error($connection));
	}
}
    ?>
     
	  <section class="content-header">
          <h1>
            Register New Member
            <small>Register New Member</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="updatemember.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Register new member</li>
          </ol>
        </section>

      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
      <div class="form">
   <form action="registermember.php" method="post">
       
       
       <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Member's IC/Passport Number</label>
   <input type="text" name="ic" class="form-control" placeholder="" required>
        </div>
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Name</label>
   <input type="text" name="name" class="form-control" placeholder="" required>
        </div>
     
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Email Address</label>
   <input type="text" name="email" class="form-control" placeholder="" required>
        </div>
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Contact Number</label>
   <input type="text" name="contactno" class="form-control" placeholder="" required>
        </div>

        <div class="col-xs-12">
        <label for="exampleInputEmail1">Home Address</label>
   <input type="text" name="home" class="form-control" placeholder="" required>
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
    <select class="form-control" name="employment">
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
        
        <div class="col-xs-12">
        <label for="exampleInputEmail1">Job Position/ Education Level</label>
   <input type="text" name="position" class="form-control" placeholder="" required>
        </div>
        <div class="col-xs-12">
        <label for="exampleInputEmail1">Company Name</label>
   <input type="text" name="companyname" class="form-control" placeholder="" required>
        </div>
        <div class="col-xs-12">
        <label for="exampleInputEmail1">Company Address</label>
   <input type="text" name="companyaddress" class="form-control" placeholder="" required>
        </div>

        <div class="col-xs-12">
        <label for="exampleInputEmail1">Student ID</label>
   <input type="text" name="studentid" class="form-control" placeholder="" required>
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
    <select class="form-control" name="course">
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
    <select class="form-control" name="program">
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
    <select class="form-control" name="fac">
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

  </div>
       <div class="form-group text-center">
           <button type="submit" name="member" class="btn btn-info">Register</button>
  </div>                     
</form>
          </div>
  </div>
</div>
                </div>
            </div>
          </div>
      </section>
	  <?php include_once 'footer.php'; ?>