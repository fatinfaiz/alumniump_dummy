<?php
require '../phpmailer/class.phpmailer.php';
require_once("../includes/db_connection.php");
set_time_limit (5000);
$id=$_GET["AT_REF_NO"];

if($connection){
	$data = "SELECT
						b.AT_EVENT_ID,
						a.AM_EMAIL_ADDRESS,
						a.AM_FULL_NAME,
						em.* 
						FROM
						alumni_main a JOIN attendance_main b ON a.AM_REF_NO = b.AT_REF_NO
						LEFT JOIN event_main em ON b.AT_EVENT_ID = em.EM_ID 
						WHERE
						b.AT_REF_NO = ".$id;
						// echo $data;die;
	$resQuery = mysqli_query($connection, $data);		
	$details = mysqli_fetch_array($resQuery);

	}
	$mail = new PHPMailer;
	$mail->IsSMTP();                                      	// Set mailer to use SMTP
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = "tls";								// Enable encryption, 'ssl' also accepted
	$mail->Host = "smtp.gmail.com";						// Specify main and backup server
	$mail->Port = 587;   
	$mail->Username = 'alumniump.noti@gmail.com';
	$mail->Password = 'alumniump123';                       		// SMTP password
	$mail->SMTPDebug = 1; 
	$mail->SetFrom('alumniump.noti@gmail.com', 'Gmail Test');
	
	$mail->AddAddress('fatteinn@gmail.com', 'Norfatinfaizah Binti Abd.Rahim');  						// Add a recipient
	
	$mail->WordWrap = 50;                                	// Set word wrap to 50 characters
	$mail->IsHTML(true);                                  	// Set email format to HTML
	$mail->AddEmbeddedImage('../image/login.jpg','logo');
	$mail->Subject = "You are invited to our event (".$details['EM_TITLE'].")";
	$mail->Body    = "<div style='margin: 0 auto;padding: 5px 10px; text-align: justify; background-color: #ebf8ff'>
					<div style='font-weight: bold; font-family: arial black; font-size: 18px;text-align:center'><img src='cid:logo_2u'></div><br><br>
					
					Dear <b>".$details['AM_FULL_NAME'].",</b><br/><br/>
					
					<table style='background-color:#63bef3;'>
					<tr style='background-color:#00a1de;'><th colspan=2>Event information</th></tr>
					<tr><td width='30%'>Event Name:</td> <td><b>".$details['EM_TITLE']."</b></td></tr>
					<tr><td>Event Details: </td><td><b>".$details['EM_DESC']."</b></td></tr>
					<tr><td>Event Location: </td><td><b>".$details['EM_LOCATION']."</b></td></tr>
					<tr><td>Date Start: </td><td><b>".$details['EM_DATE_START']."</b></td></tr>
					<tr><td>Date End: </td><td><b>".$details['EM_DATE_END']."</b></td></tr>
					<tr><td>Time Start: </td><td><b>".$details['EM_TIME_START']."</b></td></tr>
					<tr><td>Time End: </td><td><b>".$details['EM_TIME_END']."</b></td></tr>
					</table>
					<br/>
					
					Registration and attendance status for the event can be made via congress website <a href ='http://www.alumniump.com/'>http://www.alumniump.com/</a> from April 20, 2017 onward. 
					The deadline for early bird registration has been extended to May 15, 2017 (Malaysian Time). 
					You may refer to the countdown timer displayed in the congress website.<br/><br/>
					
					<b>Please be informed ONLY corresponding graduated UMP students is allowed to register as an alumni member.</b> 
					For submissions to be included in the congress proceedings, the corresponding author of an accepted paper is expected to 
					<b>Confirm attendance status before May 31, 2017.</b>
					If there are any changes on the corresponding author/presenter, please contact secretariat at
					<a href='alumniump.noti@gmail.com' target='_top'>alumniump.noti@gmail.com</a><br/><br/>
					
					Thank you.<br/><br/>
					
					<i>Alumni UMP Committee</i><br/>
					<b><font color='grey'>Alumni UMP Club</color></b>
					</div>
					";
	$mail->AltBody = '';
	$mail->Send();

	if(!$mail->Send()) 
	{
		$flagMsg = 1;
		//echo $mail->ErrorInfo; die;
		echo "Unable to send email....".$mail->ErrorInfo;
	}
	else
	{
		echo "Success!! Email sent.";
	}

	?>