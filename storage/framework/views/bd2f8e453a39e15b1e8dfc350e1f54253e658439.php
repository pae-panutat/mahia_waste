<!doctype html>
<html>
  <head>
    <title>Line Chart</title>
    <script src="<?php echo e(asset('HorizontalChart/Chart.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('HorizontalChart/utils.js')); ?>"></script>

    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    }
  </style>
  </head>
  <body>

    <?php
    //thai date time
                        $TimeNow = date("Y-m-d H:i:s");
                        $DateTimeNow = date("Y-m-d 00:00:00");
                        
                        function DateThai($strDate)
                        {
                        $strYear = date("Y",strtotime($strDate))+543;
                        $strMonth= date("n",strtotime($strDate));
                        $strDay= date("j",strtotime($strDate));
                        $strHour= date("H",strtotime($strDate));
                        $strMinute= date("i",strtotime($strDate));
                        $strSeconds= date("s",strtotime($strDate));
                        $strMonthCut = Array("","มกราคม","กุมภาพันธ์.","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                        $strMonthThai=$strMonthCut[$strMonth];
                        return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
                        }
                        function MonthThai($strDate)
                        {
                        $strYear = date("Y",strtotime($strDate))+543;
                        $strMonth= date("n",strtotime($strDate));
                        $strMonthCut = Array("","มกราคม","กุมภาพันธ์.","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                        $strMonthThai=$strMonthCut[$strMonth];
                        return "$strMonthThai $strYear";
                        }

?>

        <center><canvas id="canvas" style="width:100%;"></canvas></center>


  <script>
    var color = Chart.helpers.color;  
    var label_me = <?php echo $site_name ?>;
    var data_me = <?php echo $kwh_yearAVG ?>;  


    var horizontalBarChartData = {
        labels: label_me,
        datasets: [{
                label: 'kWh/ปี ต่อพื้นที่ใช้งาน ตร.ม.',
        backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
        borderColor: window.chartColors.green,
        borderWidth: 1,
                data: data_me
            }]
    };

    window.onload = function() {
      var ctx = document.getElementById('canvas').getContext('2d');
      window.myHorizontalBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBarChartData,
        options: {
          elements: {
            rectangle: {
              borderWidth: 2,
            }
          },
          responsive: true,
          legend: {
            position: 'right',
          },
          title: {
            display: true,
            text: 'พลังงานไฟฟ้าใช้ต่อพื้นที่ (kWh/ปี ต่อพื้นที่ใช้งาน ตร.ม.) ปี <?php echo $year; ?>'
          },
          scales: {
                      xAxes: [{
                        ticks: {
                          beginAtZero: true} }],
                  }
        }
      });

    };

    var colorNames = Object.keys(window.chartColors);


  </script>


  </body>
</html>
