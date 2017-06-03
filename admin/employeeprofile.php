<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php 
$id=$_GET["id"];
if (isset($_POST['update'])) {
  // Process the form
    $AM_FULL_NAME = $_POST["AM_FULL_NAME"]; 
    $AM_HOME_ADDRESS = $_POST["AM_HOME_ADDRESS"];
    $AM_EMAIL_ADDRESS = $_POST["AM_EMAIL_ADDRESS"];
	$AM_PHONE= $_POST["AM_PHONE"];
	
	$AM_POSITION = $_POST["AM_POSITION"];
	$AM_COMPANY_ADDRESS = $_POST["AM_COMPANY_ADDRESS"];
    
    $query  = "UPDATE alumni_main SET ";
	$query .= "AM_FULL_NAME = '{$AM_FULL_NAME}', ";
   
	$query .= "AM_EMAIL_ADDRESS = '{$AM_EMAIL_ADDRESS}', ";
    $query .= "AM_PHONE = '{$AM_PHONE}', ";
	$query .= "AM_POSITION = '{$AM_POSITION}', ";
	$query .= "AM_COMPANY_ADDRESS = '{$AM_COMPANY_ADDRESS}' ";
	
	$query .= "WHERE id = '{$id}'";

	$result = mysqli_query($connection, $query);

	if ($result) {
        echo "<script>  window.opener.location.reload();window.close();</script>";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}
}
?>
<section class="content-header">
          <h1>
            Exco
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
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM alumni_main ";
	$query .= "WHERE AM_REF_NO = '{$id}' ";
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
   <form action="profile.php?id=<?php echo $_GET["id"];?>" method="post"> 
       <?php
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
    <label>Email Address</label>
    <input type="text" name="AM_EMAIL_ADDRESS" class="form-control" value="<?php echo $row["AM_EMAIL_ADDRESS"];?>">
  </div>  
   <div class="form-group">
    <label>Phone Number</label>
    <input type="text" name="AM_PHONE" class="form-control" value="<?php echo $row["AM_PHONE"];?>">
  </div> 
  
  <div class="form-group">
    <label>Position Title</label>
    <input type="text" name="AM_POSITION" class="form-control" value="<?php echo $row["AM_POSITION"];?>">
  </div>
        <div class="form-group">
    <label>Office Address</label>
    
    <textarea name="AM_COMPANY_ADDRESS" class="form-control" rows="5"><?php echo $row["AM_COMPANY_ADDRESS"];?></textarea>
  </div> 
   <?php } ?>
       <div class="form-group">
       <button type="submit" name="update" class="btn btn-primary btn-danger pull-right" >Update</button>
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