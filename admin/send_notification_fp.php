<?php
require_once 'dbConnect.php';
require_once 'header.php';

$data = explode('/', $_GET['data']);
$psRef = $data[0];
$pubId = explode('-',$data[1]);
if($conn){
	$dataPaper = "SELECT
						b.AS_REF,
						b.AS_USER_ID,
						b.AS_PUB_ID,
						b.AS_TITLE,
						a.FP_INT_REF,
						a.FP_INT_SCA,
						a.FP_INT_ASC,
						ul.UL_EMAIL_ADDRESS,
						sm.SM_DESC,
						ap.AP_FIRST_NAME,
						ap.AP_LAST_NAME
						FROM
						full_paper a JOIN application_submit b ON b.AS_REF = a.FP_INT_PID 
						LEFT JOIN applicant_profile ap ON b.AS_USER_ID = ap.AP_USER_ID
						LEFT JOIN countries cm ON ap.AP_COUNTRY = cm.CM_ID
						LEFT JOIN salutation_main sm ON ap.AP_SALUTATION = sm.SM_REF
						LEFT JOIN user_login ul ON ap.AP_USER_ID = ul.UL_USER_ID
						WHERE
						a.FP_INT_REF = ".$_GET['fpREF'];
						// echo $dataPaper;die;
	$resQuery = mysqli_query($conn, $dataPaper);		
	$details = mysqli_fetch_array($resQuery);	
	// die($details['FP_INT_SCA']);
	
	if($details['FP_INT_SCA'] == 1){
	$emailSubject = "IAHR WORLD CONGRESS 2017: FULL PAPER NOTIFICATION - ACCEPTED WITHOUT CORRECTION (".$details['AS_PUB_ID'].")";
	$emailBody = "<div style='margin: 0 auto;padding: 5px 10px; text-align: justify; background-color: #ebf8ff'>
					<div style='font-weight: bold; font-family: arial black; font-size: 18px;text-align:center'><img src='cid:logo_2u'></div><br><br>
					
					Dear <b>".$details['SM_DESC']." ".$details['AP_FIRST_NAME']." ".$details['AP_LAST_NAME'].",</b><br/><br/>
					
					The peer review of paper submitted for oral presentation at the IAHR World Congress 2017 is now completed and we are pleased to inform that your paper has been <b>ACCEPTED WITHOUT CORRECTION</b> for presentation.<br/><br/>
					
					<table style='background-color:#63bef3;'>
					<tr style='background-color:#00a1de;'><th colspan=2>Paper information</th></tr>
					<tr><td width='30%'>Paper ID</td> <td><b>".$details['AS_PUB_ID']."</b></td></tr>
					<tr><td>Title: </td><td><b>".$details['AS_TITLE']."</b></td></tr>
					</table>
					<br/>
					
					Registration and online payment for the congress can be made via congress website <a href ='http://www.iahrworldcongress.org/'>http://www.iahrworldcongress.org/</a>  from April 20, 2017 onward. 
					The deadline for early bird registration has been extended to May 15, 2017 (Malaysian Time). You may refer to the countdown timer displayed in the congress website.<br/><br/>
					
					<b>Please be informed ONLY corresponding author is allowed to register as a presenter for oral presentation.</b>
					For submissions to be included in the congress proceedings, the corresponding author of an accepted paper is expected to <b>register and pay registration fee before May 31, 2017.</b> 
					If there are any changes on the corresponding author/presenter, please contact secretariat at
					<a href='iahr2017sec@usainsgroup.com' target='_top'>iahr2017sec@usainsgroup.com</a><br/><br/>
					
					Thank you.<br/><br/>
					
					<i>Scientific Committee</i><br/>
					<b><font color='grey'>IAHR WORLD CONGRESS 2017</color></b>
					</div>
					";
					
	}
	elseif($details['FP_INT_SCA'] == 2){
	$emailSubject = "IAHR WORLD CONGRESS 2017: FULL PAPER NOTIFICATION-ACCEPTED WITH MAJOR CORRECTION (".$details['AS_PUB_ID'].")";
	$emailBody = "<div style='margin: 0 auto;padding: 5px 10px; text-align: justify; background-color: #ebf8ff'>
					<div style='font-weight: bold; font-family: arial black; font-size: 18px;text-align:center'><img src='cid:logo_2u'></div><br><br>
					
					Dear <b>".$details['SM_DESC']." ".$details['AP_FIRST_NAME']." ".$details['AP_LAST_NAME'].",</b><br/><br/>
					
					The peer review of paper submitted for oral presentation at the IAHR World Congress 2017 is now completed and there is some <b>MAJOR CORRECTION</b> need to be done before May 7, 2017.<br/><br/>
					
					<table style='background-color:#63bef3;'>
					<tr style='background-color:#00a1de;'><th colspan=2>Paper information</th></tr>
					<tr><td width='30%'>Paper ID</td> <td><b>".$details['AS_PUB_ID']."</b></td></tr>
					<tr><td>Title: </td><td><b>".$details['AS_TITLE']."</b></td></tr>
					</table>
					<br/>
					In revising your paper, the Committee expects that you make a serious attempt to address all the issues and comments raised by the reviewers and editor. 
					Please revise your paper according to the comments given by reviewers and editor and resubmit your revised full paper via our system before May 7, 2017. 
					It is also the author's responsibility to proofread the revised paper and ensure that it conforms to the formatting requirements. 
					With the link below, you can log into our website to check the detail comments by the reviewer <a href='http://www.iahrworldcongress.org/index.php?id=176'>IAHR WORLD CONGRESS 2017 Conference Management System.</a><br/><br/>
					
					Registration and online payment for the congress can be made via congress website <a href ='http://www.iahrworldcongress.org/'>http://www.iahrworldcongress.org/</a> from April 20, 2017 onward. 
					The deadline for early bird registration has been extended to May 15, 2017 (Malaysian Time). 
					You may refer to the countdown timer displayed in the congress website.<br/><br/>
					
					<b>Please be informed ONLY corresponding author is allowed to register as a presenter for oral presentation.</b> 
					For submissions to be included in the congress proceedings, the corresponding author of an accepted paper is expected to 
					<b>register and pay registration fee before May 31, 2017.</b>
					If there are any changes on the corresponding author/presenter, please contact secretariat at
					<a href='iahr2017sec@usainsgroup.com' target='_top'>iahr2017sec@usainsgroup.com</a><br/><br/>
					
					Thank you.<br/><br/>
					
					<i>Scientific Committee</i><br/>
					<b><font color='grey'>IAHR WORLD CONGRESS 2017</color></b>
					</div>
					";
					
	}
	if($details['FP_INT_SCA'] == 3){
	$emailSubject = "IAHR WORLD CONGRESS 2017: FULL PAPER NOTIFICATION-ACCEPTED WITH MINOR CORRECTION (".$details['AS_PUB_ID'].")";
	$emailBody = "<div style='margin: 0 auto;padding: 5px 10px; text-align: justify; background-color: #ebf8ff;'>
					<div style='font-weight: bold; font-family: arial black; font-size: 18px;text-align:center'><img src='cid:logo_2u'></div><br><br>
					
					Dear <b>".$details['SM_DESC']." ".$details['AP_FIRST_NAME']." ".$details['AP_LAST_NAME'].",</b><br/><br/>
					
					The peer review of paper submitted for oral presentation at the IAHR World Congress 2017 is now completed and there is some <b>MINOR CORRECTION</b> need to be done before May 7, 2017.<br/><br/>
					
					<table style='background-color:#63bef3;'>
					<tr style='background-color:#00a1de;'><th colspan=2>Paper information</th></tr>
					<tr><td width='30%'>Paper ID</td> <td><b>".$details['AS_PUB_ID']."</b></td></tr>
					<tr><td>Title: </td><td><b>".$details['AS_TITLE']."</b></td></tr>
					</table>
					<br/>
					
					In revising your paper, the Committee expects that you make a serious attempt to address all the issues and comments raised by the reviewers and editor. 
					Please revise your paper according to the comments given by reviewers and editor and resubmit your revised full paper via our system before May 7, 2017. 
					It is also the author's responsibility to proofread the revised paper and ensure that it conforms to the formatting requirements. 
					With the link below, you can log into our website to check the detail comments by the reviewer <a href='http://www.iahrworldcongress.org/index.php?id=176'>IAHR WORLD CONGRESS 2017 Conference Management System.</a><br/><br/>
					
					Registration and online payment for the congress can be made via congress website <a href ='http://www.iahrworldcongress.org/'>http://www.iahrworldcongress.org/</a> from April 20, 2017 onward. 
					The deadline for early bird registration has been extended to May 15, 2017 (Malaysian Time). 
					You may refer to the countdown timer displayed in the congress website.<br/><br/>
					
					<b>Please be informed ONLY corresponding author is allowed to register as a presenter for oral presentation.</b> 
					For submissions to be included in the congress proceedings, the corresponding author of an accepted paper is expected to 
					<b>register and pay registration fee before May 31, 2017.</b>
					If there are any changes on the corresponding author/presenter, please contact secretariat at
					<a href='iahr2017sec@usainsgroup.com' target='_top'>iahr2017sec@usainsgroup.com</a><br/><br/>
					
					Thank you.<br/><br/>
					
					<i>Scientific Committee</i><br/>
					<b><font color='grey'>IAHR WORLD CONGRESS 2017</color></b></div>
					";
					
	}
	if($details['FP_INT_SCA'] == 4){
	$emailSubject = "IAHR WORLD CONGRESS 2017: FULL PAPER NOTIFICATION-REJECTED (".$details['AS_PUB_ID'].")";
	$emailBody = "<div style='margin: 0 auto;padding: 5px 10px; text-align: justify; background-color: #ebf8ff;'>
					<div style='font-weight: bold; font-family: arial black; font-size: 18px;text-align:center'><img src='cid:logo_2u'></div><br><br>
					
					Dear <b>".$details['SM_DESC']." ".$details['AP_FIRST_NAME']." ".$details['AP_LAST_NAME'].",</b><br/><br/>
					
					
					The peer review of paper submitted for oral presentation at the IAHR World Congress 2017 is now completed. 
					We would like to inform you that your full paper submitted to the IAHR World Congress 2017 has been <b>rejected</b> by the Scientific Committee:<br/><br/>
					
					<table style='background-color:#63bef3;'>
					<tr style='background-color:#00a1de;'><th colspan=2>Paper information</th></tr>
					<tr><td width='30%'>Paper ID</td> <td><b>".$details['AS_PUB_ID']."</b></td></tr>
					<tr><td>Title: </td><td><b>".$details['AS_TITLE']."</b></td></tr>
					</table>
					<br/>
					
					Should you have any question or request regarding your application, please contact secretariat at
					<a href='iahr2017sec@usainsgroup.com' target='_top'>iahr2017sec@usainsgroup.com</a> or 
					Chief Editor at <a href='redac02@usm.my' target='_top'>redac02@usm.my</a><br/><br/>
					
					Thank you.<br/><br/>
					
					<i>Scientific Committee</i><br/>
					<b><font color='grey'>IAHR WORLD CONGRESS 2017</color></b></div>
					";
					
	}

	
	// Commits db transaction
	$yearNow = date("Y");
	$sql_checkServer = "SELECT * FROM server_detail " .
					  "WHERE SD_STATUS = '1'";
	$server_stmt = mysqli_query($conn,$sql_checkServer);
	$server=mysqli_fetch_array($server_stmt);
	// Send generated password to applicant email
	require 'include/phpmailer/class.phpmailer.php';
	
	$mail = new PHPMailer;
	$mail->IsSMTP();                                      	// Set mailer to use SMTP
	$mail->SMTPAuth = $server['SD_AUTH'];
	$mail->SMTPSecure = $server['SD_ENCRYPT'];								// Enable encryption, 'ssl' also accepted
	$mail->Host = $server['SD_HOST_NAME'];						// Specify main and backup server
	$mail->Port = $server['SD_PORT'];   
	$mail->Username = $server['SD_USERNAME'];
	$mail->Password = $server['SD_PASSWORD'];                       		// SMTP password
	$mail->SMTPDebug = 1; 
	//$mail->SetFrom('iahr2017sec@usainsgroup.com', '37th IAHR WORLD CONGRESS 2017');
	$mail->SetFrom($server['SD_USERNAME'],$server['SD_CONFERENCE']);
	$mail->AddAddress($details['UL_EMAIL_ADDRESS']);  							// Add a recipient
	// $mail->AddAddress('double_7s@yahoo.com');  							// Add a recipient
	$mail->AddCC('kusairay@yahoo.com', 'IAHR 2017');                 // Add CC
	$mail->AddCC('athirahrahim123@gmail.com', '37th IAHR WORLD CONGRESS 2017');
	$mail->AddCC('iahr2017kl@gmail.com', '37th IAHR WORLD CONGRESS 2017');
	//$mail->AddBCC($server['SD_USERNAME'],$server['SD_CONFERENCE']);    // Add BCC
	//$mail->AddBCC('iahr2017kl@gmail.com', 'IAHR2017');                 // Add BCC
	//$mail->AddReplyTo($server['SD_USERNAME'],$server['SD_CONFERENCE']);	
	$mail->AddReplyTo('iahr2017sec@usainsgroup.com', '37th IAHR WORLD CONGRESS 2017');
	
	$mail->WordWrap = 50;                                	// Set word wrap to 50 characters
	$mail->IsHTML(true);                                  	// Set email format to HTML
	$mail->AddEmbeddedImage('../image/emailBannerFP.png', 'logo_2u');
	$mail->Subject = $emailSubject;
	$mail->Body    = $emailBody;
	$mail->AltBody = $emailBody;
	
	if(!$mail->Send()) 
	{
		$flagMsg = 1;
		//echo $mail->ErrorInfo; die;
		$msg = "Unable to send email....".$mail->ErrorInfo;
	}
	else
	{
		// $queryUpdate = "UPDATE paper_submit SET PS_ACCEPTANCE_EMAIL = 1 WHERE PS_REF = ".$psRef;
		// mysqli_query($conn, $queryUpdate);
		//check if alraedy exist or not
		$checkNotiFP = "SELECT * FROM notification_fp WHERE NFP_INT_PID = ".$details['AS_REF']." AND NFP_INT_FP = ".$_GET['fpREF'];
		$resCheck = mysqli_query($conn, $checkNotiFP);
		if(mysqli_num_rows($resCheck) == 0){
			$sqlNotiFp = "INSERT INTO notification_fp (NFP_INT_FP, NFP_INT_PID, NFP_INT_ASC) VALUES(".$_GET['fpREF'].", ".$details['AS_REF'].", ".$details['FP_INT_ASC'].")";
			mysqli_query($conn, $sqlNotiFp);
		}
		$flagMsg = 1;
		$msg = "Invitation has been sent to the reviewer mailbox.";
		echo "<script>alert('Successfully send notification.')</script>";
		echo "<script>window.close();</script>";
	}
}
else
{
	echo "<div align='center'><img src='image/under_construction.jpg' /></div>";
	echo "<div align='center'>Sorry, we are having technical issues. Please contact your administrator.<br>Thank you </div>";
}

?>