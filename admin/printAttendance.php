<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	$id=$_GET["id"];
	$queryTitle = "SELECT EM_TITLE FROM event_main WHERE EM_ID = ".$id;
	$resTitle = mysqli_query($connection, $queryTitle);
	$fetch = mysqli_fetch_assoc($resTitle);
    // 2. Perform database query
  	$query  = "SELECT att.AT_REF_NO, att.AT_EVENT_ID, att.AT_STATUS, a.AM_REF_NO, a.AM_FULL_NAME, a.AM_IC_NO ";
  	$query .= "FROM alumni_main a left join attendance_main att on a.AM_REF_NO = att.AT_REF_NO ";
  	$query .= "WHERE att.AT_EVENT_ID = '{$id}'";
  	//echo $query;
  	$status = '';
  	if(isset($_GET['AT_STATUS'])){
    	$status = $_GET['AT_STATUS'];
    	if($_GET['AT_STATUS'] != 'all'){
      	$query .= " AND att.AT_STATUS = '".$_GET['AT_STATUS']."'";
    }
  }

  $result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $fetch['EM_TITLE']; ?></title>
	<!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<table class="table table-striped table-bordered">
		<tr><th class="text-center" colspan=3><?php echo $fetch['EM_TITLE']; ?></th></tr>
        <tr>
            <th>Identification No</th>
            <th>Name</th>
            <th>Attendance Status</th>
          </tr>
           <?php
      // 3. Use returned data (if any)
      while($row = mysqli_fetch_assoc($result)) {
        // output data from each row
    ?>
                    <tr>
                <td><p class="form-control-static"><?php echo $row["AM_IC_NO"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["AM_FULL_NAME"];?></p></class></td>
                <td><p class="form-control-static"><?php echo $row["AT_STATUS"];?></p></class></td>
            </tr>
            <?php } ?>
            
      </table>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>