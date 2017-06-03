<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php';?>
<?php 
 
if (isset($_POST['update'])) {
  // Process the form
      $password = $_POST["LM_PASSWORD"];
        $password_encrypt = md5($password);
        $newpassword = $_POST["newPassword"];
        $confirmnewpassword = $_POST["confirmnewPassword"];
        $password_newencrypt = md5($newpassword);
         $query  = "SELECT * ";
     $query .= "FROM login_main ";
     $query .= "WHERE LM_USER_ID = '{$_SESSION["idUser"]}' && LM_PASSWORD = '{$password_encrypt}' ";
     $query .= "LIMIT 1";
    $login_set = mysqli_query($connection, $query);
    confirm_query($login_set);
    if($login = mysqli_fetch_assoc($login_set)) {
    
         if ($confirmnewpassword == $newpassword){
             
        $query  = "UPDATE login_main SET ";
      $query .= "LM_PASSWORD = '{$password_newencrypt}' ";
      $query .= "WHERE LM_USER_ID ='{$_SESSION['idUser']}'";
        $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    // redirect_to("somepage.php");
     echo "<script>alert('Your password successfully has been changed.');</script> ";
        echo "<script>  window.opener.location.reload();window.close();</script>";
        
  } else {
    // Failure
    // $message = "Subject update failed";
    die("Database query failed. " . mysqli_error($connection));
  }
         }  else {
             echo "<script>alert('The new password does not match with the confirm new password.');</script> ";
            
         } 
            
       
    } else {
      echo "<script>alert('Wrong password! Please insert correct password.');</script> ";
    }
   
   
}
?>
      <section class="content-header">
          <h1>
            My Account
            <small>Change Password</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Change Password</li>
          </ol>
        </section>

      <section class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-4">
                    <div class="panel panel-default">
  <div class="panel-body">
  <div class="box box-primary">
                <div class="box-header with-border">
     
   <form action="changepassword.php" method="post">

    <div class="form-group">
    <label for="exampleInputPassword1">Current Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="LM_PASSWORD" placeholder="Current Password" required>
  </div>
       
    <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="newPassword" placeholder="New Password" required>
  </div>
       
     <div class="form-group">
    <label for="exampleInputPassword1">Confirm New Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="confirmnewPassword" placeholder="Confirm New Password" required>
  </div>
        <div class="form-group text-center">
       <button class="btn btn-info" name="update" type="submit" onclick="return confirm('Confirm change you password?');">Change Password</button>
     </div>
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