<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>

     <section class="content-header">
          <h1>
            Events
            <small>Events Lists</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>
 
      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-default">
  <div class="panel-body">

<?php
    //var_dump($_SESSION);
    $id=$_SESSION["idUser"];
  // 2. Perform database query
  $query1  = "SELECT em.* ";
  $query1 .= "FROM event_main em LEFT JOIN attendance_main am ON em.EM_ID = am.AT_EVENT_ID ";
  $query1 .= "WHERE am.AT_REF_NO = '{$id}'";
  
  //var_dump($query1);die;
  $result1 = mysqli_query($connection, $query1);
  // Test if there was a query error
  if (!$result1) {
    die("Database query failed1.");
  }
  
  ?>


<h3>Lists of event invited</h3>
      <table class="table table-striped">
        <thead>
            <th>Events Title</th>
            <br><th>Action</th>
          </thead>
        <tbody>
           
          <?php
      // 3. Use returned data (if any)
      $invitedEvent = array();
      while($row1 = mysqli_fetch_assoc($result1)) {
        // output data from each row
    ?>
            <tr>
                <td><p class="form-control-static"><?php echo $row1["EM_TITLE"];?></p></class></td>
                <td> 
                    
                    <a class="btn btn-info" title="Update" href="updateevent.php?id=<?php echo $row1['EM_ID'];?>">Reply Invitation</a>&nbsp;&nbsp;

                </td>
            </tr>
            <?php 
            if(!in_array($row1['EM_ID'], $invitedEvent)){
              array_push($invitedEvent, $row1['EM_ID']);
            }
            } 
            ?>
      
          </tbody>
      </table>



  
  </div>
</div>
                </div>
            </div>
          </div>
      </section>
<?php include_once 'footer.php'; ?>