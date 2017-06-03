<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php  //echo $id=$_GET["id"];
       //echo  $event_id=$_GET["eventid"];
if (isset($_POST['update'])) {
    
    function getData($question, $val){
        $data = array();
        $data = explode('/', $val);
        $data['val'] = $data[0];
        $data['ques'] = $data[1];
        $data['category'] = $data[2];
        return $data;
    }
    
    /*total score*/
    $total_score = 0;
    $total_question = 0;
    
    /*open basic*/
    $check_basic = array();
    for($i = 0;$i<$_POST['total_basic'];$i++){
        
        $check_basic[$i] = getData($i, $_POST['basic'][$i]);
    }
    $k = 1;
    foreach($check_basic as $basic){
        $query3  = "UPDATE evaluation_mark ";
	    $query3 .= " SET mark = ".$basic['val'];
	    $query3 .= " WHERE event_id = ".$_GET['eventid']." AND staff_id ='".$_GET['id']."' AND category = '".$basic['category']."' AND question_id = ".$basic['ques'];
        //echo $query3;die;
        $result3 = mysqli_query($connection, $query3);
        
        $total_score += $basic['val'];
        $total_question++;
        
        $k++;
    }
    /*close basic*/
    
    /*open adv*/
    if($_POST['totalAdv'] > 0){    
        $query3 .= ", ";
    }
    
    $check_adv = array();
    for($g = 0;$g<$_POST['totalAdv'];$g++){
        $check_adv[$g] = getData($i, $_POST['adv'][$g]);
    }
    
    $l = 1;
    foreach($check_adv as $adv){
        $query3  = "UPDATE evaluation_mark ";
	    $query3 .= " SET mark = ".$adv['val'];
	    $query3 .= " WHERE event_id = ".$_GET['eventid']." AND staff_id ='".$_GET['id']."' AND category = '".$adv['category']."' AND question_id = ".$adv['ques'];
        
        $result3 = mysqli_query($connection, $query3);
        
        $total_score += $adv['val'];
        $total_question++;
        $l++;
    }
    /*close adv*/
    
    //echo $total_score."/".$total_question;
    $percentScore = ($total_score/($total_question*10))*100;
    $percentScore = number_format($percentScore, 2);
    //echo "//".$percentScore;
    $queryPercent = "UPDATE assignmember SET total_score = ".$percentScore." WHERE member_userid = '".$_GET['id']."' AND event_id =".$_GET['eventid'];
    
    $resultPercent = mysqli_query($connection, $queryPercent);

		// Success
		// redirect_to("somepage.php");
		echo "<div class=\"alert alert-success\">Success!</div>";
    
  // Process the form
    $id=$_GET["id"];
    $event_id=$_GET["eventid"]; 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scoreboard Evaluation System</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/style.css" rel="stylesheet"
  </head>
  <body>

      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-default">
  <div class="panel-body">
        
         <div class="col-md-12">
                    <h2>Evaluation Criteria</h2>
                    <ol>
<form action="updateevaluation.php?id=<?php echo $_GET["id"];?>&eventid=<?php echo $_GET["eventid"];?>" method="post" class="form-horizontal">
                            <?php
	// 2. Perform database query
	
    $queryEditBasic  = "SELECT * ";
	$queryEditBasic .= "FROM question a, evaluation_mark b where a.question_id=b.question_id and b.category='basic' and staff_id='{$_GET["id"]}' and event_id='{$_GET["eventid"]}'
						ORDER BY b.question_id asc";
    
	$result1 = mysqli_query($connection, $queryEditBasic);
	// Test if there was a query error
	if (!$result1) {
		die("Database query failed.");
	}
    $basic_total = mysqli_num_rows($result1);
?>
    <input type="hidden" name="total_basic" value="<?php echo $basic_total; ?>">
    <h3 class="col-md-12">Basic Criteria</h3><br/ style="border: 1px solid black">
                        <?php
			// 3. Use returned data (if any)
            
			while($row = mysqli_fetch_assoc($result1)) {
				
               $queryEditBasic  = "SELECT * FROM evaluation_mark a where a.question_id={$row["question_id"]} and a.category='basic' AND staff_id = '{$_GET["id"]}'";
                
               $resultEditBasic = mysqli_query($connection, $queryEditBasic);
                
               $rowEditBasic = mysqli_fetch_assoc($resultEditBasic);
                
                $selectedEdit = $rowEditBasic['mark'];
				// output data from each row
		?>    
    
    <li class="col-md-10"><?php echo $row["question_title"]; $questionid=$row["question_id"];?></li>
<div class="form-group col-md-2">
    <select name="basic[]" class="form-control">
    <?php 
    $checked = '';
    for($i=1;$i<=10;$i++){
        
        echo "<option value='".$i."/".$row['question_id']."/basic'";
        if($i == $selectedEdit)
        {
            echo "selected";
        }
        echo ">".$i."</option>";
    ?>
  <!--input type="radio" name="<?php //echo $questionid;?>" id="inlineRadio1" value="<?php //echo $questionid."/".$i."/basic"; ?>" required --> <?php //echo $i; ?>
    <?php 
    } ?>
    </select>
</div>
                  
                     <?php 
            } ?>  
        
    <h3 class="col-md-12">Spesific Criteria</h3><br/>
        <?php
        $queryAdvance  = "SELECT * ";
        $queryAdvance .= "FROM question_advance WHERE event_id = ".$_GET['eventid'];


        $resultAdv = mysqli_query($connection, $queryAdvance);
        // Test if there was a query error
        if (!$resultAdv) {
            die("Database query failed.");
        }
        $totalAdv = mysqli_num_rows($resultAdv);
        echo "<input type='hidden' name='totalAdv' value='".$totalAdv."'>";
        while($data = mysqli_fetch_assoc($resultAdv)){
            
            $queryEditAdv  = "SELECT * FROM evaluation_mark a where a.question_id={$data["id"]} and a.category='advance'  AND staff_id = '{$_GET["id"]}'";;
                
               $resultEditAdv = mysqli_query($connection, $queryEditAdv);
                
               $rowEditAdv = mysqli_fetch_assoc($resultEditAdv);
                
                $selectedAdv = $rowEditAdv['mark'];
        ?>
        
    <li class="col-md-10"><?php echo $data["question"]; $questionid=$row["id"];?></li>
    <div class="form-group col-md-2">
    <select name="adv[]" class="form-control">
        <?php
            
            for($c=1;$c<=10;$c++){
                echo "<option value='".$c."/".$data['id']."/advance'";
                 if( $selectedAdv == $c)
                    {
                        echo "selected";
                    }
                    echo ">".$c."</option>";
            
            }
            ?>
        
    </select>
        </div>
        
        <?php
            
            }
        ?>
                    </  ol>
       </div>
                        
            <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        
      <button type="submit" name="update" class="btn btn-default btn-danger" href="javascript:void(0);">Update</button>
       <a class="btn btn-default btn-danger" href="javascript:void(0);">Cancel</a>
    </div>
  </div>         

      
  </div>
</div>
                </div>
            </div>
          </div>

            </form>
      </section>
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
      <script src="../js/script.js"></script>
  </body>
</html>