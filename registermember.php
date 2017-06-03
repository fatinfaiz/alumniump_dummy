<?php require_once("includes/db_connection.php"); ?>
<?php
if (isset($_POST['member'])) {
  // Process the form

          //$user_id = $_POST["AM_REF_NO"];
          $password = md5($_POST["password"]);
          $ic = $_POST["ic"];
          $last_id = mysqli_insert_id($connection);

          //check exist in login
          $queryLogin = "SELECT LM_USERNAME FROM login_main WHERE LM_USERNAME = '".$ic."'";
          $resCheck = mysqli_query($connection, $queryLogin);
          if(mysqli_num_rows($resCheck) == 0){
            $queryIC = "SELECT AM_IC_NO, AM_REF_NO FROM ALUMNI_MAIN WHERE AM_IC_NO='$ic'";
            $resIC = mysqli_query($connection, $queryIC);

            if (mysqli_num_rows($resIC) > 0) {
              $row = mysqli_fetch_assoc($resIC);
              $query  = "INSERT INTO login_main (";
              $query .= "LM_USER_ID, LM_USERNAME, LM_PASSWORD";
              $query .= ") VALUES (";
              $query .= "  '{$row['AM_REF_NO']}','{$ic}','{$password}'";
              $query .= ")";

              $result = mysqli_query($connection, $query)or die(mysqli_error());

              if ($result) {
              echo "<script>alert('Member is successfully registered.');</script> ";
              echo "<script>window.close();</script>";
              } 
              else {
              echo "<script>alert('Member is failed to be created.');</script> ";
              die("Database query failed. " . mysqli_error($connection));
              }
            }
            else{
              echo "<script>alert('You are not an official Alumni UMP graduate');</script> ";
            }
          }
          else{
              echo "<script>alert('Your account already been created in this system!');</script> ";
          }
        }
    ?>
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Alumni UMP Portal System</title>
    <meta name="description" content="This is a free Bootstrap landing page theme created for BootstrapZero. Feature video background and one page design." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.1/animate.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
  
 <div id="aboutModal" class="container" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
           <h2 class="text-center text-primary">Account Registration</h2>
            
            <h5 class="text-center">
                Welcome to all Alumni of Universiti Malaysia Pahang!
            </h5>

  <div class="col-lg-12 text-center" style="margin-bottom: 15px;">
   <form action="registermember.php" method="post" class="contact-form row">
    
       <div class="col-md-6 col-md-offset-3">
         <label>IC/Passport Number</label>
   <input type="text" name="ic" class="form-control" placeholder="" required>
        </div>
    
       <div class="col-md-6 col-md-offset-3" style="margin-top: 5px;">
        <label>Default password</label>
   <input type="password" name="password" class="form-control" placeholder="" required>
        </div>
        <div class="col-md-12" style="margin-top: 5px;">
        </div>
  </div>
    <!--p class="text-center" style="color: red;">Please filled all the above field.</p-->
    <button type="submit" name="member" class="btn btn-primary btn-lg center-block" d aria-hidden="true">Register</button>
<br/>
  
</form>
          </div>
  </div>
</div>
                </div>
            </div>
          </div>
     
</body>

<!--scripts loaded here from cdn for performance -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>