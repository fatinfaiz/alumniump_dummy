<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php
if (isset($_POST['new_event'])) {
    // var_dump($_POST);die;
        $EM_LOCATION = $_POST["LC"];
        $EM_DATE_START = $_POST["DS"];
        $EM_DATE_END = $_POST["DE"];
        $EM_TITLE= $_POST["EM_TITLE"];
        $EM_DESC = $_POST["DES"];
        $EM_PIC = $_POST["UID"];
        $EM_FAC_CODE = $_POST["FC"];
        $EM_TIME_START = $_POST["TS"];
        $EM_TIME_END = $_POST["TE"];
  
        $query  = "INSERT INTO event_main (";
        $query .= "EM_LOCATION, EM_DATE_START, EM_TITLE, EM_DESC, EM_PIC, EM_DATE_END, EM_FAC_CODE, EM_TIME_START, EM_TIME_END ";
        $query .= ") VALUES (";
        $query .= "  '{$EM_LOCATION}','{$EM_DATE_START}', '{$EM_TITLE}','{$EM_DESC}', '{$EM_PIC}', '{$EM_DATE_END}', '{$EM_FAC_CODE}', '{$EM_TIME_START}', '{$EM_TIME_END}' ";
        $query .= ")";
     
        $result = mysqli_query($connection, $query);

  if ($result) {
    // Success
    // redirect_to("somepage.php");
    echo "<script>alert('The event is successfully created.');</script> ";
  } else {
    // Failure
    // $message = "Subject creation failed";
      echo "<script>alert('The event is failed to be created.');</script> ";
  }
}
    ?>


    <section class="content-header">
          <h1>
            Event
            <small>Create New Event</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Create new event</li>
          </ol>
        </section>



        <section class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
  <div class="box box-primary">
  <div class="box-header with-border">
      
   <form action="newevent.php" method="post">
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Title</label>
   <input type="text" name="EM_TITLE" class="form-control" placeholder="">
        </div>
  </div>
       
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Location</label>
   <input type="text" name="LC" class="form-control" placeholder="">
        </div>
  </div>
    <div class="form-group">
    <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Duration</label>
        </div>
        <div class="col-xs-6">
            <label>Date Start</label>
            <input type="date" name="DS" class="form-control">
        </div>
        <div class="col-xs-6">
            <label>Date End</label>
            <input type="date" name="DE" class="form-control">
        </div>
        <div class="col-xs-6">
            <label>Time Start</label>
            <input type="time" name="TS" class="form-control">
        </div>
        <div class="col-xs-6">
            <label>Time End</label>
            <input type="time" name="TE" class="form-control">
        </div>
  </div>


        <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Description</label>
   
    <textarea name="DES" class="form-control" rows="5"></textarea>
  </div> 
        </div>
  </div>
       <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Event employee</label>
               <?php
  // 2. Perform database query
  
    $queryEvent  = "SELECT am.AM_REF_NO, am.AM_FULL_NAME ";
    $queryEvent .= "FROM role_main r join alumni_main am ON r.RM_USER_ID = am.AM_REF_NO ";
    $queryEvent .= "WHERE r.RM_EXCO = '1'";
      
  $resultEvent = mysqli_query($connection, $queryEvent);
  // Test if there was a query error
  if (!$resultEvent) {
    die(mysqli_error());
    //die("Database query failed.");
  }
?>
    <select class="form-control" name="UID">
       <?php while($row = mysqli_fetch_assoc($resultEvent)) {
        // output data from each row
    ?>
 
  <option value="<?php echo $row["AM_REF_NO"];?>"><?php echo $row["AM_FULL_NAME"];?></option>
<?php } ?>
</select>
        </div>
  </div>
  
  <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Faculty Involved</label>
               <?php
  // 2. Perform database query
  
    $getAllFaculty  = "SELECT *  ";
  $getAllFaculty .= "FROM faculty_main ";
  
  $faculty = mysqli_query($connection, $getAllFaculty);
  // Test if there was a query error
  if (!$faculty) {
    die("Database query failed.");
    //var_dump($showFaculty);die;
  }
?>
    <select class="form-control" name="FC">
  <option value="">All</option>
       <?php while($showFaculty = mysqli_fetch_assoc($faculty)) {
        // output data from each row
    ?>
 
  <option value="<?php echo $showFaculty["FM_FAC_CODE"];?>"><?php echo $showFaculty["FM_FAC_DESC"];?></option>
<?php } ?>
</select>
        </div>
  </div>
  
       <div class="form-group text-center">
       <button type="submit" name="new_event" style="margin-top: 15px" class="btn btn-info">Create</button>
  </div>
                   
</form>
          </div>
  </div>
</div>
                </div>
            </div>
          </div>
          </div>

      </section>
    <?php include_once 'footer.php'; ?>