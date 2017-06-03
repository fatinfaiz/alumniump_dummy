<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
<?php
if (isset ($_GET['id'])){
$id=$_GET["id"];  
}

if (isset($_POST['event'])) {
    $id = $_POST['id'];
        $EM_LOCATION = $_POST["LC"];
        $event_start = $_POST["DS"];
        $event_end = $_POST["DE"];
        $event_title = $_POST["EM_TITLE"];
    $event_desc = $_POST["DES"];
    $event_userid = $_POST["UID"];
    $event_fac_code = $_POST["FC"];
    $EM_TIME_START = $_POST["TS"];
    $EM_TIME_END = $_POST["TE"];
 
    
  // $query  = "UPDATE event_main ";
  // $query .= "EM_LOCATION = '{$EM_LOCATION}', ";
  //   $query .= "EM_DATE_START = '{$event_start}', ";
  // $query .= "EM_TITLE = '{$event_title}', ";
  //   $query .= "EM_DESC = '{$event_desc}', ";
  // $query .= "EM_PIC = '{$event_userid}', ";
  // $query .= "EM_DATE_END = '{$event_end}', ";
  // $query .= "EM_FAC_CODE = '{$event_fac_code}' ";
  
  // $query .= "WHERE EM_ID = '{$id}'";
  
  

  // $result = mysqli_query($connection, $query);

  // if ($result) {
  //   // Success
  //   // redirect_to("somepage.php");
  //   echo "Success!";echo "<script>alert('The event detail is successfully updated.');</script> ";
  // } else {
  //   // Failure
  //   // $message = "Subject creation failed";
  //     echo "<script>alert('Failed to update event details.');</script> ";
  //     var_dump($query);die;
  // }
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
  
       <!-- <div class="form-group">
       <button type="submit" name="event" class="btn btn-default btn-danger pull-right">Update</button>
  </div>    -->                 
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