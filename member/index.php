<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php include_once 'header.php'; ?>
<?php?>
      <body>
     <section class="content-header">
          <h1>
            Homepage
            <small>Dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
         <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-7">
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
      <!-- /.row -->
      <div class="col-md-5">
       <!-- DONUT CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Alumni UMP Employment Status Chart</h3>
                  <div class="box-tools pull-left">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                    <table class="table table-condensed table-hover">
                      <tr class='danger'>
                        <th>Employment Status</th>
                        <th>Total</th>
                      </tr>
                      <?php
                        $i=0;
                        $color = array('#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de');
                        $queryWork = "SELECT `AM_EMPLOYMENT_STATUS`, count(*) as num FROM `alumni_main` WHERE `AM_EMPLOYMENT_STATUS` != '' GROUP BY `AM_EMPLOYMENT_STATUS` ORDER BY num ASC";
                        $resQuery = mysqli_query($connection, $queryWork);
                        $resQueryData = mysqli_query($connection, $queryWork);
                        $numRows = mysqli_num_rows($resQuery);
                        while($rowData = mysqli_fetch_assoc($resQueryData)){
                          echo "<tr style='background: ".$color[$i]."; color: white;'>";
                          echo "<td>".$rowData['AM_EMPLOYMENT_STATUS']."</td>";
                          echo "<td>".$rowData['num']."</td>";
                          echo "<tr>";
                          $i++;
                        }
                      ?>
                    </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->      
      </div>
    </div><!--/.row-->

    </section>
    <!-- /.content -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  <!--modal example-->
  <div id="alertModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center" id="header" style="background: darkturquoise; color: white;">
        </div>
        <div class="modal-body" id="bodyIndex">
        </div>
        <div class="modal-footer info">
          <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i> Close</button>
        </div>
      </div>
      </div>
  </div>

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
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      height: 475,
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
            $arrayEvent .= "title: '".$row['EM_ID'].". ".$row['EM_TITLE']."',
            ";
            $arrayEvent .= "start: new Date(".$dateStart[0].",".($dateStart[1] - 1).",".$dateStart[2]."),
            ";
            $arrayEvent .= "end: new Date(".$dateEnd[0].",".($dateEnd[1] - 1).",".($dateEnd[2] + 1)."),
            ";
            $arrayEvent .= "backgroundColor: '".$color[$countColor]."',
            ";
            $arrayEvent .= "url: 'updateevent.php?id=".$row['EM_ID']."',
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
     eventClick: function(event) {
        if (event.title) {
            openModal(event.title);
            return false;
        }
    }
    });
  });


  function openModal(eventName){
    $('#alertModal').modal('show');
    var idEvent = eventName;
    var res = idEvent.split('.');
    $('#bodyIndex').html(res[1]);
    $('#header').html(res[1]);
    var infoEvent = getEventInfo(res[0]);
  }
  //get event information
  function getEventInfo(evId){
    $.ajax({
      data: {'eventId': evId},
      url: "getEventInfo.php", 
      method: "POST",
      dataType : 'json',
      success: function(result){
        console.log(result);
        $('#bodyIndex').html(result);
      }
    });

  }
</script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js"></script>
    <!-- page script -->
    <?php  
      $i = 0;
      $donutValue = '';
      while($row = mysqli_fetch_assoc($resQuery)){
        $donutValue .= "{";
        $donutValue .= "color: '".$color[$i]."',";
        $donutValue .= "value: ".$row['num'].",";
        $donutValue .= "highlight: '".$color[$i]."',";
        $donutValue .= "label: '".$row['AM_EMPLOYMENT_STATUS']."',";
        $donutValue .= "}";
        if($i<($numRows-1)){
          $donutValue .= ",";
        }
          $i++;

      }
    ?>
    <script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */
     var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
     var PieData = [
          <?php echo $donutValue; ?>
        ];
     var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
     
     });
    </script>
    
</body>
<?php include_once 'footer.php'; ?>