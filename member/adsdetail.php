<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
<?php
if (isset ($_GET['id'])){
$id=$_GET["id"];  
}

if (isset($_POST['adsdetail'])) {
        $id = $_POST['id'];
        $ADS_LOCATION= $_POST["ADS_LOCATION"];
        $ADS_TITLE= $_POST["ADS_TITLE"];
        $ADS_DESC = $_POST["ADS_DESC"];
        $ADS_STATUS = $_POST["ADS_STATUS"];
        $ADS_CATEGORY = $_POST["ads"];
 
        $query  = "UPDATE ads_main SET ";
        $query .= "ADS_LOCATION = '{$ADS_LOCATION}', ";
        $query .= "ADS_TITLE = '{$ADS_TITLE}', ";
        $query .= "ADS_DESC = '{$ADS_DESC}', ";
        $query .= "ADS_STATUS = '{$ADS_STATUS}', ";
        $query .= "ADS_CATEGORY = '{$ADS_CATEGORY}' ";
  
        $query .= "WHERE ADS_ID = '{$id}'";

  $result = mysqli_query($connection, $query);

  if ($result) {
    // Success
    // redirect_to("somepage.php");
                 echo "<script>alert('The ads detail is successfully updated.');</script> ";
  } else {
    // Failure
    // $message = "Subject creation failed";
      echo "<script>alert('Failed to update ads details.');</script> ";
      var_dump($query);die;
  }
}

    ?>

    
  <section class="content-header">
          <h1>
            Job Advertisement
            <small>Job Ads Detail</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Job Ads Detail</li>
          </ol>
        </section>

  
      <section class="content-header">
      <div class="panel panel-default">
  <div class="panel-body">
  <div class="box box-primary">
                <div class="box-header with-border">
  
  <?php
  // 2. Perform database query
  $query  = "SELECT * ";
  $query .= "FROM ads_main WHERE ADS_ID ='{$id}'" ;
  
  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if (!$result) {
    die("Database query failed.");
  }
?>
  
      <div class="form">
   <form action="adsdetail.php" method="post">
   <input type='hidden' name='id' value="<?php echo $id; ?>">
   <?php
   while($row = mysqli_fetch_assoc($result)) {
  ?>
   
   <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Job Advertisement Title</label>
   <input type="text" name="ADS_TITLE" class="form-control" placeholder="" value="<?php echo $row["ADS_TITLE"];?>">
        </div>
  </div>
       
  <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Job Location</label>
   <input type="text" name="ADS_LOCATION" class="form-control" placeholder="" value="<?php echo $row["ADS_LOCATION"];?>">
        </div>
  </div>


        <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Job Description</label>
   <textarea name="ADS_DESC" class="form-control"><?php echo $row["ADS_DESC"];?></textarea> 
        </div>
  </div>

   <div class="form-group">
           <div class="col-xs-12">
         <label>Job Category</label>
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
    <select class="form-control" name="ads">
  <option value="">All</option>
       <?php 
       while($showCategory = mysqli_fetch_assoc($category)) {
        if($showCategory['CY_ID'] == $row['ADS_CATEGORY']){
            $checkCategory = 'selected';
        }
        else{
            $checkCategory = '';
        }
        // output data from each row
    ?>
 
  <option value="<?php echo $showCategory["CY_ID"];?>" <?php echo $checkCategory;?>><?php echo $showCategory["CY_DESC"]; ?></option>
<?php } ?>
</select>
        </div>
  </div>
  <div class="form-group">
  <div class="col-xs-12">
      <label>Status</label><br/>

  <select class="form-control" name="ADS_STATUS">
  <option value="Requested">Requested</option>
  <option value="Approved">Approved</option>
  <option value="Not Approved">Not Approved</option>
</select>
</div>
</div>

  
       <div class="form-group text-center">
       <button type="submit" name="adsdetail" class="btn btn-success" style="margin-top: 15px;">Update</button>
  </div>                    
</form>

   <?php } ?>
</div>
</div>
</div>
</div>
</div>
</section>
    <?php include_once 'footer.php'; ?>