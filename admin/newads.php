<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php



if (isset($_POST['new_ads'])) {
		 //var_dump($_SESSION);die;
        
        $id=$_SESSION["idUser"];
        $ADS_LOCATION= $_POST["ADS_LOCATION"];
        $ADS_TITLE= $_POST["ADS_TITLE"];
		    $ADS_DESC = $_POST["ADS_DESC"];
		    //$ADS_STATUS = $_POST["ADS_STATUS"];
		    $ADS_CATEGORY = $_POST["ADS_CATEGORY"];
        
  
        $query  = "INSERT INTO ads_main (";
	      $query .= "ADS_TITLE, ADS_DESC, ADS_LOCATION, ADS_STATUS, ADS_CATEGORY, ADS_REF_NO ";
	      $query .= ") VALUES (";
	      $query .= "  '{$ADS_TITLE}','{$ADS_DESC}','{$ADS_LOCATION}', 'Requested','{$ADS_CATEGORY}', '{$id}' ";
       
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
            Job Advertisement
            <small>Create job ads</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Create job Ads</li>
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

   <form action="newads.php" method="post">
   
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Job Advertisement Title</label>
   <input type="text" name="ADS_TITLE" class="form-control" placeholder="">
        </div>
  </div>
       
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Job Location</label>
   <input type="text" name="ADS_LOCATION" class="form-control" placeholder="">
        </div>
  </div>


        <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Job Description</label>
   <textarea name="ADS_DESC" rows="6" class="form-control"></textarea> 
        </div>
  </div>

   <div class="form-group">
           <div class="col-xs-12">
         <label for="exampleInputEmail1">Job Category</label>
               <?php
  // 2. Perform database query
  
    $getAllCategory  = "SELECT *  ";
  $getAllCategory .= "FROM category_main ";
  
  $category = mysqli_query($connection, $getAllCategory);
  // Test if there was a query error
  if (!$category) {
    die("Database query failed.");
    //var_dump($showCategory);die;
  }
?>
    <select class="form-control" name="ADS_CATEGORY">
  <option value="">All</option>
       <?php while($showCategory = mysqli_fetch_assoc($category)) {
        // output data from each row
    ?>
 
  <option value="<?php echo $showCategory["CY_ID"];?>"><?php echo $showCategory["CY_DESC"];?></option>
<?php } ?>
</select>
        </div>
  </div>

  <!-- <div class="form-group">
  <div class="col-xs-12">
      <label>Status</label><br/>

  <select class="form-control" name="ADS_STATUS">
  <option value="Requested">Requested</option>
  <option value="Approved">Approved</option>
  <option value="Not Approved">Not Approved</option>
</select>
</div>
</div> -->
       
  
       <div class="form-group text-center">
       <button type="submit" name="new_ads" class="btn btn-primary" style="margin-top: 15px" onclick="return confirm('Are you sure you want to create new event?');">Create Job Ads</button>
       
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