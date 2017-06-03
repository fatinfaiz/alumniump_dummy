<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
<?php

if (isset ($_GET['id'])){
$id=$_GET["id"];  

}

//var_dump($_SESSION);die;
if (isset($_POST['radio'])) {
        $id = $_POST['id'];
        $status = $_POST["status"];
        
        $query  = "UPDATE attendance_main SET AT_STATUS = '".$status."' WHERE AT_EVENT_ID = ".$id." AND AT_REF_NO = ".$_SESSION["idUser"];
        //echo $query;
        $result = mysqli_query($connection, $query);

  if ($result) {
    // Success
    // redirect_to("somepage.php");
    echo "<script>alert('The event is successfully updated!');</script> ";
  } else {
    // Failure
    // $message = "Subject creation failed";
      echo "<script>alert('The event is failed to be updated!');</script> ";
  }
}
    ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
  
  <?php
  // 2. Perform database query
  $query  = "SELECT * ";
  $query .= "FROM event_main WHERE EM_ID ='{$id}'" ;
  
  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if (!$result) {
    die("Database query failed.");
  }
?>
  
  <div class="form">
   <form action="updateevent.php" method="post">
   <?php
   while($row = mysqli_fetch_assoc($result)) {
  ?>
  <div class="form-group">
      <div class="col-xs-12">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="exampleInputEmail1">Event Title</label>
   <input type="text" name="EM_TITLE" class="form-control" value="<?php echo $row["EM_TITLE"];?>" readonly>
        </div>
  </div>
       
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Location</label>
   <input type="text" name="LC" class="form-control" value="<?php echo $row["EM_LOCATION"];?>" readonly>
        </div>
  </div>
    <div class="form-group">
    <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Duration</label>
        </div>
        <div class="col-xs-6">
            <label>Start</label>
            <input type="date" name="DS" class="form-control" value="<?php echo $row["EM_DATE_START"];?>" readonly>
        </div>
        <div class="col-xs-6">
            <label>End</label>
            <input type="date" name="DE" class="form-control" value="<?php echo $row["EM_DATE_END"];?>" readonly>
        </div>
        <div class="col-xs-6">
            <label>Time Start</label>
            <input type="time" name="TS" class="form-control" value="<?php echo $row["EM_TIME_START"];?>" readonLy>
        </div>
        <div class="col-xs-6">
            <label>Time End</label>
            <input type="time" name="TE" class="form-control" value="<?php echo $row["EM_TIME_END"];?>" readOnly>
        </div>
  </div>
        <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Event Description</label>
   <input type="text" name="DES" class="form-control" value="<?php echo $row["EM_DESC"];?>" readonly>
        </div>
  </div>
       <div class="form-group">
      <div class="col-xs-12">
         <label for="exampleInputEmail1">Event employee</label>
              <?php
  // 2. Perform database query
  
    $queryEvent  = "SELECT AM_REF_NO, AM_FULL_NAME ";
  $queryEvent .= "FROM alumni_main ";
    $queryEvent .= "WHERE AM_REF_NO = '{$row['EM_PIC']}'";
      
  $resultEvent = mysqli_query($connection, $queryEvent);
  // Test if there was a query error
  if (!$resultEvent) {
    die(mysqli_error());
    //die("Database query failed.");
  }
  
  $picName = '';
  while($pic = mysqli_fetch_assoc($resultEvent))
  {
    $picName= $pic['AM_FULL_NAME'];
  }
?>
  <input type="text" name="DES" class="form-control" value="<?php echo  $picName; ?>" readonly>
</div>
  </div>
  
  <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Faculty Involved</label>
               <?php
  // 2. Perform database query
  
      $getAllFaculty  = "SELECT FM_FAC_CODE, FM_FAC_DESC ";
      $getAllFaculty .= "FROM faculty_main ";
      $getAllFaculty .= "WHERE FM_FAC_CODE = '{$row['EM_FAC_CODE']}' ";

  
  $faculty = mysqli_query($connection, $getAllFaculty);
  // Test if there was a query error
  if (!$faculty) {
    die("Database query failed.");
  }

  $showFacDesc = '';
       while($showFac = mysqli_fetch_assoc($faculty)) {
        // output data from each row
                    $showFacDesc = $showFac['FM_FAC_DESC'];
      }
    ?>
    <input type="text" name="FAC" class="form-control" value="<?php echo  $showFacDesc; ?>" readonly>
 
        </div>
  </div>
<?php
  //check if already has status
  $queryCheck = "SELECT * FROM attendance_main  WHERE AT_EVENT_ID = {$id} AND AT_REF_NO = {$_SESSION['idUser']}";
  $selectCheck = mysqli_query($connection, $queryCheck);
  $checkRow = mysqli_num_rows($selectCheck);
  if($checkRow != 0){
    $fetchData = mysqli_fetch_assoc($selectCheck);
    echo "<div class='form-group text-center'>";
    echo "<div class='col-md-12'>";
    echo "<br><label>Attendance Status Confirmation</label><br/>";
    echo $fetchData['AT_STATUS'];
    echo "</div>";
    echo "</div>";
  }
?>

  <div class="form-group">

  <div class="col-xs-12">
      <label>Please Select Your Attendance Status</label><br/>
  <label><input type="radio" name="status" value="Yes">Yes, I would love to attend this event</label><br>
  <label><input type="radio" name="status" value="Maybe">Maybe, I'm not sure yet</label><br>
  <label><input type="radio" name="status" value="No">Sorry, I can't attend this event</label>
</div>

</div>

<div class="form-group text-center">
<div class="col-md-12">
<input type="submit" class="btn btn-sm btn-info" style="margin-top: 15px" name="radio" value="Submit"/>
</div>
</div>  

</form>
<?php } ?>
   </div>
  </div>
</div>
                </div>
            </div>
          </div>
      </section>
    <?php include_once 'footer.php'; ?>