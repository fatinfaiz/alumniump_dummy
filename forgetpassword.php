<?php require_once("includes/db_connection.php"); ?>
<?php

if (isset($_POST['forget'])) {
  // Process the form

          $ic = $_POST["ic"];
          $email = $_POST['email'];
          $last_id = mysqli_insert_id($connection);
          //Create random password
          $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
           $string = '';
           $max = strlen($characters) - 1;
           $random_string_length = 6;
           //closed create random password
           for ($i = 0; $i < $random_string_length; $i++) {
                $string .= $characters[mt_rand(0, $max)];
           }
           $password = md5($string);
          //check exist in login
          $queryLogin = "SELECT lm.LM_USERNAME, am.AM_EMAIL_ADDRESS FROM login_main lm JOIN alumni_main am ON lm.lm_user_id = am.AM_REF_NO WHERE lm.LM_USERNAME = '".$ic."' AND am.AM_EMAIL_ADDRESS = '".$email."'";
          $resCheck = mysqli_query($connection, $queryLogin);
          if(mysqli_num_rows($resCheck) == 1){
              $query  = "UPDATE login_main SET ";
              $query .= "LM_PASSWORD = '{$password}' WHERE LM_USERNAME = '".$ic."'";
              //echo $query;
              $result = mysqli_query($connection, $query)or die(mysqli_error());

              if ($result) {
              sendEmail($email, $string);
              echo "<script>alert('Password is successfully changed.');</script> ";
              echo "<script>window.location.href = 'index.php';</script>";
              } 
              else {
              echo "<script>alert('Password is failed to be changed.');</script> ";
              //die("Database query failed. " . mysqli_error($connection));
              }
          }
          else{
              echo "<script>alert('Please make sure IC/Passport or email address were same as in the system registered.');</script> ";
              //echo "<script>window.close();</script>";
          }
        }

        function sendEmail($email, $string){
          require 'phpmailer/class.phpmailer.php';
          $mail = new PHPMailer;
          $mail->IsSMTP();                                        // Set mailer to use SMTP
          $mail->SMTPAuth = TRUE;
          $mail->SMTPSecure = "tls";                // Enable encryption, 'ssl' also accepted
          $mail->Host = "smtp.gmail.com";           // Specify main and backup server
          $mail->Port = 587;   
          $mail->Username = 'alumniump.noti@gmail.com';
          $mail->Password = 'alumniump123';                           // SMTP password
          $mail->SMTPDebug = 1; 
          $mail->SetFrom('alumniump.noti@gmail.com', 'Gmail Test');
          
          $mail->AddAddress($email);              // Add a recipient
          //$mail->AddAddress($email);              // Add a recipient
          
          $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
          $mail->IsHTML(true);                                    // Set email format to HTML
          $mail->AddEmbeddedImage('image/login.jpg','logo');
          $mail->Subject = "AUMS:- Reset password request";
          $mail->Body    = "<div style='margin: 0 auto;padding: 5px 10px; text-align: justify; background-color: #ebf8ff'>
          <div style='font-weight: bold; font-family: arial black; font-size: 18px;text-align:center'><img src='cid:logo_2u'></div><br><br>
          
          Dear <b>".$email.",</b><br/><br/>
          
          You has been request to reset your password through forgot password features. Here is the details:-<br/>
          New Pass = ".$string."
          <br/>
          <br/>
          Please login to the system using the new pass given.<br/>
          If there are any changes on the corresponding author/presenter, please contact secretariat at
          <a href='alumniump.noti@gmail.com' target='_top'>alumniump.noti@gmail.com</a><br/><br/>
          
          Thank you.<br/><br/>
          
          <i>Alumni UMP Committee</i><br/>
          <b><font color='grey'>Alumni UMP Club</color></b>
          </div>
          ";
          $mail->AltBody = '';
          $mail->Send();

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
           <h2 class="text-center text-primary">Change Password</h2>
            
            <h5 class="text-center">
                Welcome to all Alumni of Universiti Malaysia Pahang!
            </h5>

  <div class="col-lg-12 text-center" style="margin-bottom: 15px;">
   <form action="forgetpassword.php" method="post" class="contact-form row">
    
       <div class="col-md-12">
         <label>IC/Passport Number</label>
   <input type="text" name="ic" class="form-control" placeholder="IC/Passport" required>
        </div>
    <div class="col-md-12" style="margin-top: 5px;">
        <label>Email</label>
   <input type="email" name="email" class="form-control" placeholder="Email according to the system email." required>
        </div>
        <div class="col-md-12" style="margin-top: 5px;">
        </div>
  </div>
    <!--p class="text-center" style="color: red;">Please filled all the above field.</p-->
    <button type="submit" name="forget" class="btn btn-primary btn-lg center-block" d aria-hidden="true">Confirm change password</button>
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