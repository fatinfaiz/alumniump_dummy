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
        
        $password = md5($_POST["password"]);

       
        $position = $_POST["position"];
        $companyname = $_POST["companyname"];
        $companyaddress = $_POST["companyaddress"];
        
        $queryProfile = "INSERT INTO alumni_main (AM_FULL_NAME, AM_PHONE, AM_EMAIL_ADDRESS, AM_IC_NO, AM_POSITION, AM_COMPANY_NAME, AM_COMPANY_ADDRESS) VALUES( '".$name."', '".$contactno."', '".$email."', '".$ic."', '".$position."', '".$companyname."', '".$companyaddress."')";

        $resProfile = mysqli_query($connection, $queryProfile);
        $last_id = mysqli_insert_id($connection);

        $queryRole = "INSERT INTO role_main (RM_USER_ID, RM_EXCO) VALUES(".$last_id.", '1')";
        $resRole = mysqli_query($connection, $queryRole);

  
      $query  = "INSERT INTO login_main (";
      $query .= "LM_USERNAME, LM_USER_ID, LM_PASSWORD";
      $query .= ") VALUES (";
      $query .= "  '{$ic}','{$last_id}','{$password}'";
      $query .= ")";

      $result = mysqli_query($connection, $query)or die(mysqli_error());

   

  if ($result) {
    // Success
    // redirect_to("somepage.php");
    echo "<script>alert('Exco is successfully registered.');</script> ";
        echo "<script>  window.opener.location.reload('updateemployee.php');window.close();</script>";
  } else {
    // Failure
    // $message = "Subject creation failed";
      echo "<script>alert('Exco is failed to be created.');</script> ";
            die("Database query failed. " . mysqli_error($connection));
  }
}
    ?>
     
    <section class="content-header">
          <h1>
            Register New Exco
            <small>Register New Exco</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="updateemployee.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Register new exco</li>
          </ol>
        </section>

      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
  <div class="panel-body">
      <div class="form">
   <form action="registeremployee.php" method="post">
       
       
       <div class="form-group">
      <div class="col-xs-12">
        <label for="exampleInputEmail1">Exco's Identification Number</label>
   <input type="text" name="ic" class="form-control" placeholder="" required>
        </div>

        <div class="form-group">
    <label for="exampleInputPassword1">Current Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
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

        
  </div>
       <div class="form-group text-center">
           <button type="submit" name="member" style="margin-top: 15px" class="btn btn-info">Register</button>
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