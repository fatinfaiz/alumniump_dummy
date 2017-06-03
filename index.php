<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (isset($_POST['login'])) {
  // Process the form

		$LM_USERNAME = $_POST["LM_USERNAME"];
		$LM_PASSWORD = $_POST["LM_PASSWORD"];
        $LM_PASSWORD_encrypt = md5($LM_PASSWORD);
        $query  = "SELECT l.* ";
		$query .= "FROM login_main l ";
		$query .= "WHERE l.LM_USERNAME = '{$LM_USERNAME}' AND l.LM_PASSWORD = '{$LM_PASSWORD_encrypt}' ";
		$query .= "LIMIT 1";
		
		$check_login = mysqli_query($connection, $query);
		confirm_query($check_login);
		
		if($login_data = mysqli_fetch_assoc($check_login)) {
            
            $qRole = 'SELECT * FROM role_main WHERE RM_USER_ID ='.$login_data["LM_USER_ID"].' LIMIT 1';
            $queryRole = mysqli_query($connection, $qRole);
            $rowRole = mysqli_fetch_assoc($queryRole);
				
				
			$_SESSION["idUser"]= $login_data["LM_USER_ID"];
			
			if ( $rowRole["RM_ADMIN"] == 1){
				redirect_to("admin/index.php");	
			}
			else if ( $rowRole["RM_EXCO"] == 1){
				//echo 'y'; die;
				redirect_to("exco/index.php");	
			}
			else if ( $rowRole["RM_MEMBER"] == 1){
				redirect_to("member/index.php");				
			}
           
		} else {
			echo "<script>alert('Wrong ID & PASSWORD! Please insert correct password.');</script> ";
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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="css/animate.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="ionicons-2.0.1/css/ionicons.min.css" />
    <link rel="stylesheet" href="css/styles.css" /><!-- fullcalendar -->
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
    <style type="text/css">
        .fc-widget-content{
            height: 80px !important;
        }
        .fc td{
            background: #6a6767;
        }
    </style>
  </head>
  <body>
    <nav id="topNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
				<a class="navbar-brand page-scroll" href="#first"><i class="ion-ios-analytics-outline"></i>Alumni UMP Portal</a>
            </div>
            <div class="navbar-collapse collapse" id="bs-navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#one">Intro</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#two">Highlights</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#three">Gallery</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#last">Connect With Us</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#footer">Alumni Links</a>
                    </li>
                </ul>
                
				<ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" data-toggle="modal" title="A platform that connects all UMPians" href="#aboutModal">Login</a>
                    </li>
                </ul>
				
            </div>
        </div>
    </nav>
    <header id="first">
        <div class="header-content">
            <div class="inner">
			     <img src="image/alumni.gif" class="img-responsive" >
                <h1 class="cursive">We Are Proud To Be UMPians </h1>
                <h4>A platform that connects all alumni of UMP</h4>
                <hr>
                <!-- <a href="#video-background" id="toggleVideo" data-toggle="collapse" class="btn btn-primary btn-xl">Toggle Video</a> &nbsp;  -->
                <a href="registermember.php" class="btn btn-primary btn-xl page-scroll">Get Started</a>
            </div>
        </div>
        <!--video autoplay="" loop="" class="fillSWidth fadeIn wow collapse in" data-wow-delay="0.5s" poster="https://s3-us-west-2.amazonaws.com/coverr/poster/Traffic-blurred2.jpg" id="video-background">
            <source src="https://s3-us-west-2.amazonaws.com/coverr/mp4/Traffic-blurred2.mp4" type="video/mp4">Your browser does not support the video tag. I suggest you upgrade your browser.
        </video-->
    </header>
    <section class="bg-primary" id="one">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                    <h2 class="margin-top-0 text-primary">A Slight Peek Into Our Community</h2>
                    <br>
                    <p class="text-faded">
The Universiti Malaysia Pahang Alumni Portal provides UMP alumni with a formal communication channel to connect with their alma mater as well as with their fellow alumni. It is the primary communications link between the University and our alumni.
At Universiti Malaysia Pahang, it is our goal to encourage and foster lifelong alumni participation, involvement, and commitment towards the advancement of the University. 
We also encourage our alumni  to be ambassadors for UMP in their respective professions and communities by assisting with the recruitment of students and by supporting programmes via time, talent, and finances.
Alumni Relations at Universiti Malaysia Pahang (UMP) is under the purview of the Management and Alumni Relations Division of the Student Affairs and Alumni Department.
                    </p>
                    <a href="#three" class="btn btn-default btn-xl page-scroll">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content" id="two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="margin-top-0 text-primary">Events Calendar</h2>
                    <hr class="primary">
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
              <!-- THE CALENDAR -->
                    <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

            </div>
        </div>

    </section>

    <section id="three" class="no-padding">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-4 col-sm-6">
                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="image/1.jpg">
                        <img src="image/1.jpg" class="img-responsive" alt="Image 1">
                        <div class="gallery-box-caption">
                            <div class="gallery-box-content">
                                <div>
                                    <i class="icon-lg ion-ios-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="image/2.jpg">
                        <img src="image/2.jpg" class="img-responsive" alt="Image 2">
                        <div class="gallery-box-caption">
                            <div class="gallery-box-content">
                                <div>
                                    <i class="icon-lg ion-ios-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="image/3.jpg">
                        <img src="image/3.jpg" class="img-responsive" alt="Image 3">
                        <div class="gallery-box-caption">
                            <div class="gallery-box-content">
                                <div>
                                    <i class="icon-lg ion-ios-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="image/4.jpg">
                        <img src="image/4.jpg" class="img-responsive" alt="Image 4">
                        <div class="gallery-box-caption">
                            <div class="gallery-box-content">
                                <div>
                                    <i class="icon-lg ion-ios-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="image/5.jpg">
                        <img src="image/5.jpg" class="img-responsive" alt="Image 5">
                        <div class="gallery-box-caption">
                            <div class="gallery-box-content">
                                <div>
                                    <i class="icon-lg ion-ios-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="image/6.jpg">
                        <img src="image/6.jpg" class="img-responsive" alt="Image 6">
                        <div class="gallery-box-caption">
                            <div class="gallery-box-content">
                                <div>
                                    <i class="icon-lg ion-ios-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
   
    
    <section id="last">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="text-primary">Connect With Us</h2>
                    <hr class="primary">
                    <p>We love fresh and crazy ideas. Share your ideas with us or propose your own events, feel free to contact us anytime.</p>
                </div>
               <!--  <div class="col-lg-10 col-lg-offset-1 text-center">


                    <form class="contact-form row">
                        <div class="col-md-4">
                            <label></label>
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-md-4">
                            <label></label>
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-md-4">
                            <label></label>
                            <input type="text" class="form-control" placeholder="Phone">
                        </div>
                        <div class="col-md-12">
                            <label></label>
                            <textarea class="form-control" rows="9" placeholder="Your ideas here.."></textarea>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <label></label>
                            <button type="button" data-toggle="modal" data-target="#alertModal" class="btn btn-primary btn-block btn-lg">Send <i class="ion-android-arrow-forward"></i></button>
                        </div>
                    </form>
                </div> -->
                 <div class="col-lg-10 col-lg-offset-1 text-center text-primary">
                    <h4>Universiti Malaysia Pahang Alumni Association</h4>
                    <h4>Student Affairs & Alumni Department, Universiti Malaysia Pahang</h4>
                    <h4>Lebuhraya Tun Razak, 26300 Kuantan, Pahang Darul Makmur</h4>
                    <br>
                    <h4>Email:  alumni@ump.edu.my</h4> 
                    <h4>Tel:(+609) 549 2545</h4>
                    <h4>Fax:(+609) 549 2535</h4>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 col-sm-9 column">
                    <h4>Alumni Links</h4>
					<ul class="list-inline">
					<li><a rel="nofollow" href="https://twitter.com/alumniump"><i class="icon-lg ion-ios-cloud-download-outline"></i></a>&nbsp;</li>
                      <li><a rel="nofollow" href="https://www.facebook.com/persatuan.alumniump"><i class="icon-lg ion-ios-locked"></i></a>&nbsp;</li>
					  <li><a rel="nofollow" href="http://std-comm.ump.edu.my/ecommstudent/respon.jsp"><i class="icon-lg ion-university"></i></a></li>
                    </ul>
                </div>
               
                
                <div class="col-xs-4 col-sm-3 text-right">
                    <h4>Follow</h4>
                    <ul class="list-inline">
                      <li><a rel="nofollow" href="https://twitter.com/alumniump" title="Twitter"><i class="icon-lg ion-social-twitter-outline"></i></a>&nbsp;</li>
                      <li><a rel="nofollow" href="https://www.facebook.com/persatuan.alumniump" title="Facebook"><i class="icon-lg ion-social-facebook-outline"></i></a>&nbsp;</li>
                      <li><a rel="nofollow" href="https://www.instagram.com/alumniump/" title="Instagram"><i class="icon-lg ion-social-instagram-outline"></i></a></li>
                    </ul>
                </div>
            </div>
            <br/>
            <span class="pull-right text-muted small"><a href="http://alumni.ump.edu.my/">Alumni UMP Portal by Alumni Association UMP</a> ©2017 Universiti Malaysia Pahang All Right Reserved</span>
        </div>
    </footer>
    <div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-body">
        		<img src="//placehold.it/1200x700/222?text=..." id="galleryImage" class="img-responsive" style="margin:   0 auto;"/>
        		<p>
        		    <br/>
        		    <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Close <i class="ion-android-close"></i></button>
        		</p>
        	</div>
        </div>
        </div>
    </div>
   
   
    
	
	 <div id="aboutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-body">
        		<div class="modal-body">
			     <h2 class="text-center text-primary">Login Session</h2>
        		
        		<h5 class="text-center">
        		    Welcome to all Alumni of Universiti Malaysia Pahang!
        		</h5>
        	
				<div class="col-lg-12 col-lg-offset-1 text-center">
				  <form action="index.php" method="post" class="contact-form row">
					<div class="col-md-10">
							<label></label>
                            <input type="text" name="LM_USERNAME" class="form-control" placeholder="Username" required>
                        </div>
                    <div class="col-md-10">
                            <label></label>
                            <input type="password" name="LM_PASSWORD" class="form-control" placeholder="Password" required>
                        </div>
					</div>
					<label></label>
					<p class="text-center">You can <a href="registermember.php">register here</a> or do you
                    <a href="forgetpassword.php">forget your password?</a></p>
						<label></label>
                        
						<br/>
						<button type="submit" name="login" class="btn btn-primary btn-lg center-block">Login</button>
					</form>
        		</div>
        	</div>
        </div>
        </div>
    </div>
	
	
    <div id="alertModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<div class="modal-body">
        		<h2 class="text-center">Nice Job!</h2>
        		<p class="text-center">You clicked the button, but it doesn't actually go anywhere because this is only a demo.</p>
				<a rel="nofollow" href="http://std-comm.ump.edu.my/ecommstudent/respon.jsp" title="Graduation"><i class="<i class="fa fa-graduation-cap"></i>"></i></a></li>
        		<p class="text-center"><a href="http://www.bootstrapzero.com">Learn more at BootstrapZero</a></p>
        		<br/>
        		<button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">OK <i class="ion-android-close"></i></button>
        	</div>
        </div>
        </div>
    </div>
    <!--scripts loaded here from cdn for performance -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!--script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script-->
    <script src="js/scripts.js"></script>
    <!-- Moment -->
    <script src="plugins/daterangepicker/moment.min.js"></script>
    <!-- fullcalendar -->
    <script src="plugins/fullcalendar/fullcalendar.min.js"></script>
    <script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
        theme:true,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
  
        <?php
          $color = array('#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de');
          $arrayEvent = '';
          $selectEvent = "SELECT * FROM event_main";
          $resultEvent = mysqli_query($connection, $selectEvent);
          $count = mysqli_num_rows($resultEvent);
          $h = 0;
          $countColor = 0;
          while($row = mysqli_fetch_assoc($resultEvent)){
            $dateStart = explode('-', $row['EM_DATE_START']);
            $dateEnd = explode('-', $row['EM_DATE_END']);
            $arrayEvent .= "
            {";
            $arrayEvent .= "title: '".$row['EM_TITLE']."',
            ";
            $arrayEvent .= "start: new Date(".$dateStart[0].",".($dateStart[1] - 1).",".$dateStart[2]."),
            ";
            $arrayEvent .= "end: new Date(".$dateEnd[0].",".($dateEnd[1] - 1).",".($dateEnd[2] + 1)."),
            ";
            $arrayEvent .= "backgroundColor: '".$color[$countColor]."',
            ";
            $arrayEvent .= "borderColor: '".$color[$countColor]."'";
            $arrayEvent .= "}
            ";
            if($h < $count){
              $arrayEvent .= ",";
            }
            //define color
            if($countColor == 5){
              $countColor = 0;
            }
            $h++;
            $countColor++;
        }
        echo $arrayEvent;
        ?>
      ],
     
    });
  });
</script>
  </body>
</html>