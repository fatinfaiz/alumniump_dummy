<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php 
$id=$_GET["id"];

?>
<section class="content-header">
          <h1>
           Member
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
      <?php
  
  $query  = "SELECT am.*, ac.*  ";
  $query .= "FROM alumni_main am join academic_main ac ON am.AM_REF_NO = ac.AC_REF_NO ";
  $query .= "WHERE am.AM_REF_NO = '{$id}'";
  $result = mysqli_query($connection, $query);
  //Test if there was a query error
  if (!$result) {
    die("Database query failed.");
  } 
  $row = mysqli_fetch_assoc($result);
?>
   
    
  <div class="form-group">
    <label>Full Name</label>
    <input type="text" name="AM_FULL_NAME" class="form-control" value="<?php echo $row["AM_FULL_NAME"];?>" readonly>
  </div>
  
    <div class="form-group">
    <label>Email Address</label>
    <input type="text" name="AM_EMAIL_ADDRESS" class="form-control" value="<?php echo $row["AM_EMAIL_ADDRESS"];?>" readonly>
  </div>  
   <div class="form-group">
    <label>Phone Number</label>
    <input type="text" name="AM_PHONE" class="form-control" value="<?php echo $row["AM_PHONE"];?>" readonly>
  </div> 

 <div class="form-group">
    <label>Employment Status</label>
    <input type="text" name="AM_EMPLOYMENT_STATUS" class="form-control" value="<?php echo $row["AM_EMPLOYMENT_STATUS"];?>" readonly>
  </div>


  <div class="form-group">
    <label>Course</label><br/>
    <?php
  // 2. Perform database query
   $getAllCourse  = "SELECT CM_COURSE_DESC ";
   $getAllCourse.= "FROM course_main c WHERE c.CM_COURSE_CODE = '".$row['AC_COURSE_CODE']."'";
  
  $course = mysqli_query($connection, $getAllCourse);
  $cDesc = mysqli_fetch_assoc($course);
  // Test if there was a query error
  if (!$course) {
    die("Database query failed.");
  }
  echo  $cDesc['CM_COURSE_DESC']; 
?>
</div>

  <div class="form-group">
    <label>Program</label><br/>
    <?php
  // 2. Perform database query
   $getProgram  = "SELECT PM_PROGRAM_DESC ";
   $getProgram.= "FROM program_main c WHERE c.PM_PROGRAM_CODE = '".$row['AC_PROGRAM_CODE']."'";
  
  $program = mysqli_query($connection, $getProgram);
  $cDesc = mysqli_fetch_assoc($program);
  // Test if there was a query error
  if (!$program) {
    die("Database query failed.");
  }
  echo  $cDesc['PM_PROGRAM_DESC']; 
?>
</div>

<div class="form-group">
    <label>Faculty</label><br/>
    <?php
  // 2. Perform database query
   $getfaculty  = "SELECT FM_FAC_DESC ";
   $getfaculty.= "FROM faculty_main c WHERE c.FM_FAC_CODE = '".$row['AC_FAC_CODE']."'";
  
  $faculty = mysqli_query($connection, $getfaculty);
  $cDesc = mysqli_fetch_assoc($faculty);
  // Test if there was a query error
  if (!$faculty) {
    die("Database query failed.");
  }
  echo  $cDesc['FM_FAC_DESC']; 
?>
</div>






  <div class="form-group">
    <label>Position Title</label>
    <input type="text" name="AM_POSITION" class="form-control" value="<?php echo $row["AM_POSITION"];?>" readonly>
  </div>
  <div class="form-group">
    <label>Company Name</label>
    <input type="text" name="AM_COMPANY_NAME" class="form-control" value="<?php echo $row["AM_COMPANY_NAME"];?>" readonly>
  </div>
        <div class="form-group">
    <label>Company Address</label>
   
    <textarea name="AM_COMPANY_ADDRESS" class="form-control" rows="5"><?php echo $row["AM_COMPANY_ADDRESS"];?></textarea>
  </div> 
       <!-- <div class="form-group">
       <button type="submit" name="update" class="btn btn-primary btn-danger pull-right" >Update</button>
  </div>     -->                

  </div>
</div>
</div>
</div><!-- /.box -->
                </div>
            </div>
          </div>
      
      </section>
    <?php include_once 'footer.php'; ?>