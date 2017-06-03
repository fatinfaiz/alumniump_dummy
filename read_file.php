<?php
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/
 include 'dbase.php';
/************************ YOUR DATABASE CONNECTION END HERE  ****************************/
 
 
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/Classes/PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'uploaded.xlsx';
 
try {
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
 
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


$msg=0;
$error='';
for($i=1;$i<=$arrayCount;$i++){
$icNo = trim($allDataInSheet[$i]["B"]);
$full_name = trim($allDataInSheet[$i]["A"]);
$phone1 = trim($allDataInSheet[$i]["E"]);
$phone2 = trim($allDataInSheet[$i]["G"]);
$emailAdd = trim($allDataInSheet[$i]["H"]);
//$facCode = trim($allDataInSheet[$i]["J"]);
$courseCode = trim($allDataInSheet[$i]["I"]);
$companyAdd = trim($allDataInSheet[$i]["N"]);
$homeAdd = trim($allDataInSheet[$i]["D"]);
 
$query = "SELECT AM_FULL_NAME FROM alumni_main WHERE AM_IC_NO = '".$icNo."' and AM_COURSE_CODE = '".$courseCode."'";
$sql = mysqli_query($conn,$query);
$recResult = mysqli_fetch_array($sql);
$existName = $recResult["AM_FULL_NAME"];
if($existName=="") {
$sql_insertTable="INSERT INTO alumni_main (AM_IC_NO, AM_FULL_NAME,AM_PHONE1,AM_PHONE2,AM_HOME_ADDRESS, AM_EMAIL_ADDRESS,AM_FACULTY_CODE,AM_COURSE_CODE,AM_COMPANY_ADDRESS) values('".
							$icNo."', '".$full_name."', '".$phone1."', '".$phone2."', '".$homeAdd."', '".$emailAdd."', '".$facCode."', '".$courseCode."', '".$companyAdd."')";
 
 //echo "<br>".$sql_insertTable;
 
//$insertData = ;

if(mysqli_query($conn,$sql_insertTable))
{
$msg++; 
}
else
{
 $error .= $sql_insertTable."<br>";
}
}
else
{
	$duplicate = "<br>Duplicate data for ".$existName.". Skipped";
	echo $duplicate;
}

}
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0;'><center>".$msg." Records has been added</center></div>";
echo "<div style='font: bold 10px arial,verdana;padding: 45px 0 0;'><center>".$error."</center></div>";
echo "<div style='font: bold 10px arial,verdana;'><center><a href='upload_file.php'>Upload other file</a></center></div>";
  
?>
