<?php

  $nav_selected = "SCANNER";
  $left_buttons = "YES";
  $left_selected = "RELEASESGANTT";

  include("./nav.php");
  global $db;

  ?>


<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Scanner -> System Releases Gantt</h3>

 
<html>  
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <?php

        $sql = "SELECT * from releases ORDER BY open_date ASC;";
        $result = $db->query($sql);
        $cout = 0;

        $i = $result->num_rows;
        echo $i;

        

        if ($result->num_rows > 0) {
          // output data of each row
          echo 'data.addRows([';
          while($row = $result->fetch_assoc()) {
            $cout++;
            $open = new DateTime($row["open_date"]);
            $close = new DateTime($row["freeze_date"]);

            // $days = $close - $open;
            $days = $open->diff($close)->format("%d");

            // echo $days;
            $id = $row["id"];
            $name = $row["name"];
            $openDate = $row["open_date"];


            echo '['.$id.','.$name.',new Date('.$openDate.'), new Date('.$row["open_date"].', daysToMilliseconds('.$days.'), 0, null]';

            if ($cout < $i) {
              echo ',     ';
            }

          }//end while

          echo ']);';

      }//end if

      else {
          echo "0 results";
      }//end else

        if (2 > 1) {
          echo "Equality baby";
        }
        $result->close();

      ?>

  <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
    //   data.addColumn('string', 'id');
    //   data.addColumn('string', 'Name');
    //  // data.addColumn('date', 'open_date');
    //  // data.addColumn('date', 'rtm_date');

    //   // data.addColumn('string', 'Type');
    //   data.addColumn('date', 'Start Date');
    //   data.addColumn('date', 'End Date');
    //   data.addColumn('number', 'Duration');
    //   data.addColumn('number', 'Percent Complete');
    //   data.addColumn('string', 'Dependencies');
      
      

      // if ($result->num_rows > 0) {
      //     // output data of each row
      //     echo 'data.addRows([';
      //     while($row = $result->fetch_assoc()) {
      //       $cout++;
      //       $open = new DateTime($row["open_date"]);
      //       $close = new DateTime($row["freeze_date"]);

      //       // $days = $close - $open;
      //       $days = $open->diff($close)->format("%d");

      //       // echo $days;
      //       $id = $row["id"];
      //       $name = $row["name"];
      //       $openDate = $row["open_date"];


      //       echo '['.$id.','.$name.','.$openDate.',daysToMilliseconds('.$days.'), 0, null]';

      //       if ($cout < $i) {
      //         echo ',     ';
      //       }

      //     }//end while

      //     echo ']);';

      // }//end if

      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('string', 'Resource');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
        ['ICS-201684', 'SAFe Project V.5.6.8', 'Releases',
         new Date(2019, 08, 23), new Date(2019, 08, 23), null, 100, null],
        ['ICS-201685', 'SAFe Project V.5.6.9', 'Releases',
         new Date(2014, 5, 21), new Date(2014, 8, 20), null, 100, null],
        ['ICS-201689', 'SAFe Project V.5.6.7', 'Releases',
         new Date(2014, 8, 21), new Date(2014, 11, 20), null, 100, null],
        ['ICS-201812', 'QuizMaster 1.1', 'Releases',
         new Date(2014, 11, 21), new Date(2015, 2, 21), null, 100, null],
        ['ICS-201814', 'QuizMaster 1.2', 'Releases',
         new Date(2015, 2, 22), new Date(2015, 5, 20), null, 50, null],
        ['ICS-201815', 'QuizMaster', 'Releases',
         new Date(2015, 5, 21), new Date(2015, 8, 20), null, 0, null],
        ['ICS-201944', 'Bingo 2.4', 'Releases',
         new Date(2015, 8, 21), new Date(2015, 11, 20), null, 0, null],
        ['ICS-201945', 'Bingo 2.3', 'Releases',
         new Date(2015, 11, 21), new Date(2016, 2, 21), null, 0, null],
        ['ICS-201955', 'Bingo 2.5', 'Releases',
         new Date(2014, 8, 4), new Date(2015, 1, 1), null, 100, null],
        ['ICS-789084', 'Registration System V.2020', 'Releases',
         new Date(2015, 2, 31), new Date(2015, 9, 20), null, 14, null],
        ['ICS-789085', 'Registration System V.2020.1', 'Releases',
         new Date(2014, 9, 28), new Date(2015, 5, 20), null, 86, null],
        ['ICS-789089', 'Registration System V.2019', 'Releases',
         new Date(2014, 9, 8), new Date(2015, 5, 21), null, 89, null],
         ['ICS-898984', 'Word Explorer 2021', 'Releases',
         new Date(2014, 9, 28), new Date(2015, 5, 20), null, 86, null],
         ['ICS-898985', 'Word Explorer 2022', 'Releases',
         new Date(2014, 9, 28), new Date(2015, 5, 20), null, 86, null],
         ['ICS-898989', 'Word Explorer 2020', 'Releases',
         new Date(2014, 9, 28), new Date(2015, 5, 20), null, 86, null]
      ]);
      
      

      // data.addRows([
      //   ['ICS-201684', 'SAFe Project V.5.6.8',
      //    new Date(2020, 10, 1), new Date(2020, 12, 6), null, 100, null],

      //   ['ICS-201685', 'SAFe Project V.5.6.9', 
      //    null, new Date(2021, 12, 6), daysToMilliseconds(1), 100, null],


      //   ['ICS-201689', 'SAFe Project V.5.6.7', 
      //   null, new Date(2019, 12, 6), daysToMilliseconds(1), 100, null],


      //   ['ICS-201812', 'QuizMaster 1.1', 
      //   null, new Date(2019, 8, 23), daysToMilliseconds(1), 100, null],

      //   ['ICS-201814', 'QuizMaster 1.2', 
      //   null, new Date(2020, 8, 14), daysToMilliseconds(1), 50, null],

      //   ['ICS-201815', 'QuizMaster', 
      //   null, new Date(2021, 8, 14), daysToMilliseconds(1), 0, null],

      //   ['ICS-201944', 'Bingo 2.4', 
      //   null, new Date(2020, 9, 5), daysToMilliseconds(1), 0, null],

      //   ['ICS-201945', 'Bingo 2.3', 
      //   null, new Date(2019, 9, 5), daysToMilliseconds(1), 0, null]

        // ['ICS-201955', 'Bingo 2.5', 'Releases',
        //  new Date(2021, 10, 18), new Date(2021, 9, 5), null, 100, null],

        // ['ICS-789084', 'Registration System V.2020', 'Releases',
        //  new Date(2020, 10, 1), new Date(2020, 12, 6), null, 14, null],

        // ['ICS-789085', 'Registration System V.2020.1', 'Releases',
        //  new Date(2019, 10, 1), new Date(2021, 12, 6), null, 86, null],

        // ['ICS-789089', 'Registration System V.2019', 'Releases',
        //  new Date(2021, 10, 1), new Date(2019, 12, 6), null, 0, null],

        // ['ICS-898984', 'Word Explorer 2021', 'Releases',
        //  new Date(2020, 10, 1), new Date(2020, 12, 6), null, 0, null],

        // ['ICS-898985', 'Word Explorer 2022', 'Releases',
        //  new Date(2019, 10, 1), new Date(2021, 12, 6), null, 100, null],

        // ['ICS-898989', 'Word Explorer 2020', 'Releases',
        //  new Date(2021, 10, 1), new Date(2019, 12, 6), null, 89, null]
      // ]);

      var options = {
        height: 600,
        gantt: {
          trackHeight: 30
        }
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
  </script>





</head>
<body>
  <div id="chart_div"></div>
</body>
</html>

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>