<?php require_once("../includes/db_connection.php"); ?>

<?php
set_time_limit(10000);
$data = fopen('../file/dbAlumni.csv', 'r');

while($row = fgetcsv($data, 1000)){

 	$ic = mysqli_real_escape_string($connection, $row[0]);
 	$matric = mysqli_real_escape_string($connection, $row[1]);
 	$name = mysqli_real_escape_string($connection, $row[2]);
 	$email = mysqli_real_escape_string($connection, $row[3]);
 	$phone = mysqli_real_escape_string($connection, $row[4]);
 	$course = mysqli_real_escape_string($connection, $row[5]);
 	$faculty = mysqli_real_escape_string($connection, $row[6]);
 	$employment = mysqli_real_escape_string($connection, $row[7]);
 	$program = mysqli_real_escape_string($connection, $row[8]);

    $queryAM = "INSERT INTO alumni_main (AM_FULL_NAME, AM_PHONE, AM_EMAIL_ADDRESS, AM_IC_NO, AM_EMPLOYMENT_STATUS)VALUES('".$name."', '".$phone."', '".$email."', '".$ic."', '".$employment."')";
    $result = mysqli_query($connection, $queryAM);
    strtoupper("$result");

	if ($result) {
		echo "Done".$name."<br/>";

    $last_id = $connection->insert_id;
    //insert into academic main
    $queryAC = "INSERT INTO academic_main (AC_STUDENT_ID, AC_COURSE_CODE, AC_FAC_CODE, AC_PROGRAM_CODE, AC_REF_NO) VALUES('".$matric."', '".$course."', '".$faculty."', '".$program."', '".$last_id."')";
    $resultAC = mysqli_query($connection, $queryAC);
    strtoupper("$resultAC");

	if ($resultAC) {
		echo "Done".$matric;
	} else {
            die("Database query failed2. " . mysqli_error($connection));
	}

	//insert into role main
	$queryRole = "INSERT INTO role_main (RM_USER_ID, RM_MEMBER) VALUES(".$last_id.", 1)";
	$resultRole = mysqli_query($connection, $queryRole);

	}
	else {
    	echo "Error: " . $queryAM . "<br>" . $conn->error;
	}
 	
}
?>