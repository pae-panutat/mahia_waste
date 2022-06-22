<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200;400;600&display=swap');
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>

    .container-fluid{   
        margin: 0 0;
        box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
        justify-content: center;
        background:rgb(rgb(28, 28, 28));
        overflow: hidden;
        position: relative;
        font-family: 'Kanit', sans-serif;
        /* color: rgb(255, 255, 255); */
    }
    .pae {
        padding-left: 40px;
        padding-right: 40px;
    }
    .Texth2{
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: 'Sarabun', sans-serif;
        font-size: 25px;
        padding: 10px;

    }
    .Texth3{
        justify-content: center;
        align-items: center;
        text-align: left;
        font-family: 'Sarabun', sans-serif;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;

    }
    td{
        text-align: center;
    }
    .tablerow {
        background-color: aliceblue;
    }
    .table [scope=col]{
        font-weight: bold;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: 'Sarabun', sans-serif;
        font-size: 16px;
        padding: 10px;
    }
    .banner{
            overflow: hidden;
            background: url(https://enis.cmu.ac.th/payment/img/header.jpg);
            width: 100%; /* Width of new image */
            height: 113px; /* Height of new image */
            position: relative;
            top: 0px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);

        }

</style>

<!doctype html>
<html lang="en">
<head>
    <title>CMU SMART CITY</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- Material Dashboard CSS -->
    <link rel="stylesheet" href="{{ URL::asset('../assets/css/material-dashboard.min.css') }} ">

    <!-- CSS Files -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- only for this page -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- end only for this page -->

</head>


<?php
    
        $original_date = date("d");
        $original_wday = date("l");
        $original_month = date("F");
        $original_year = date("Y");

        echo("$original_wday    $original_date    $original_month    $original_year");

        $TH_Day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
        $TH_Month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

        $nDay = date("w");
        $nMonth = date("n")-1;
        $date = date("j");
        $year = date("Y")+543;

        // echo("วันนี้เป็นวัน  $TH_Day[$nDay]  ที่  $date  เดือน  $TH_Month[$nMonth]  ปี พ.ศ.  $year");


        if(!empty($month_c) and !empty($year_c)){
	        $month_c = $month_c;
	        $year_c  = $year_c;
	        $strMtodayNum = $month_c;
	        //echo "month_c :".$strMtodayNum."<br> year_c : ".$year_c;
	        $yd = $year_c-543;
	        $yd_date = $month_c+1;
        }else{
	        //$today = date('Y-m-d H:i:s');
	        if(date("m")=='01'){
                $month_c = date('12');
                $year_c  = (date("Y")+543)-1;
	    	}else{
                $month_c = date('m')+1;
                $year_c  = (date("Y")+543);
	    	}
	        $strMtodayNum = $month_c;
	        $yd = $year_c-543;
	        $yd_date = $month_c+1;
        }


		date_default_timezone_set("Asia/Bangkok");
		$TimeNow = date("Y-m-d H:i:s");
		$DateTimeNow = date("Y-m-d 00:00:00");

        if ($strMtodayNum == 1) {
            $strM = "มกราคม" ;
        }elseif ($strMtodayNum==2) {
            $strM = "กุมภาพันธ์" ;
        }elseif ($strMtodayNum==3) {
            $strM = "มีนาคม" ;
        }elseif ($strMtodayNum==4) {
            $strM = "เมษายน" ;
        }elseif ($strMtodayNum==5) {
            $strM = "พฤษภาคม" ;
        }elseif ($strMtodayNum==6) {
            $strM = "มิถุนายน" ;
        }elseif ($strMtodayNum==7) {
            $strM = "กรกฎาคม" ;
        }elseif ($strMtodayNum==8) {
            $strM = "สิงหาคม" ;
        }elseif ($strMtodayNum==9) {
            $strM = "กันยายน" ;
        }elseif ($strMtodayNum==10) {
            $strM = "ตุลาคม" ;
        }elseif ($strMtodayNum==11) {
            $strM = "พฤศจิกายน" ;
        }elseif ($strMtodayNum==12) {
           $strM = "ธันวาคม" ;
        }


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
        function DayEng($strDate)
        {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("w",strtotime($strDate));
        $strDayCut = Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
        $strDayEng=$strDayCut[$strDay];
        return "$strDayEng";
        }
?>





<body>

<div class="wrapper ">
<div class="banner"></div>
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="URL::asset('../assets/img/sidebar-1.jpg') }} ">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
          Tip 2: you can also add an image using data-image tag
        -->
        <div class="logo"><a href="" class="simple-text logo-normal">
                <a class="navbar-brand" rel="home" href="#" title="CMU SMART CITY">
                    <img style="max-width:70px; margin-top: -25px; margin-left: 15px;"
                         src=" {{ URL::asset('../assets/img/cmu_logo.png') }} ">
                </a>  <b>CMU SMARTCITY</b>
            </a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="./user.html">
                        <i class="material-icons">person</i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('https://enis.erdi.cmu.ac.th/bill/public/index.php/esm_consume_office_index&'.$fk_fac) }}">
                        <i class="material-icons">content_paste</i>
                        <p>ESM consume office</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('https://enis.erdi.cmu.ac.th/bill/public/index.php/pv_produce_office_index&'.$fk_fac) }}">
                        <i class="material-icons">content_paste</i>
                        <p>PV produce office</p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('https://enis.erdi.cmu.ac.th/bill/public/index.php/water&'.$fk_fac) }}">
                        <i class="material-icons">content_paste</i>
                        <p>Water Using</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper text-center">

                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="material-icons">person</i></a>
                        </li>
                        <li class="nav-item dropdown">
                        <!-- <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a> -->
                            {{-- <a class="nav-link" href="#"></i>Welcome : {{session('name')}}</a> --}}
                            <a class="nav-link" href="{{ url('water&'.$fk_fac) }}"></i>หน้าหลัก : {{ $gname }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" 
                            href="#"
                            target="blank">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard </a>
                        </li>

                        <li class="nav-item">
                            {{-- {{ $gname }} --}}
                            <!-- <a class="nav-link" href="http://10.110.56.12/bill/public/index.php/logout"><i class="fa -->
                            @foreach (DB::SELECT(DB::raw("SELECT faculty_id FROM payment.db WHERE faculty_id = $fk_fac")); as $t)
                                <?php $dblink = $t->faculty_id; ?>
                                <a class="nav-link"
                                   href="{{ url('https://enis.erdi.cmu.ac.th/mainmonitor/monitor_water/index2.php?database='.$dblink) }}"
                                   target="blank">
                                <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                                วิเคราะห์มิเตอร์ (Monitoring)
                                </a>
                            @endforeach

                        </li>
                        

                        <li class="nav-item">
                            <a class="nav-link" 
                            href="{{ url('https://enis.erdi.cmu.ac.th/mainmonitor/monitor_water/map.php') }}"
                            target="blank">
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Map Meter</a>
                        </li>

                        <li class="nav-item">
                                <!-- <a class="nav-link" href="http://10.110.56.12/bill/public/index.php/logout"><i class="fa -->
                                <a class="nav-link" href="{{ url('logout') }}"><i class="fa -->
                                    fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </li>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

<!--container-->        
<br><br><br><br>
<div class="container-fluid">

    <div class="row pae">
        <div class="col-sm-6 my-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">การใช้ปริมาณน้ำประปา รายวัน (Volumeflow m3/h) ล่าสุดของแต่ละคณะ/ส่วนงาน</h4>
              <hr>
              <canvas id="myChart" height="180px"></canvas>
              <script>
                  let barChartData = {
                      labels: <?php echo $get_name; ?>,
                      datasets: [{
                          label: 'Volume Flow (m3/h)',
                          backgroundColor: 'rgba(54, 162, 235, 0.2)',
                          borderColor: 'rgba(54, 162, 235, 1)',
                          borderWidth: 1,
                          data: <?php echo $get_value; ?>
                      }
                    ]
                  }

                  var ctx = document.getElementById('myChart').getContext('2d');
                  var myChart = new Chart(ctx, {
                      type: 'line',
                      data: barChartData,
                      options: {
                          
                            tooltips: {
                            mode: 'index',
                            yAlign: 'bottom',
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                    },
                                },
                            backgroundColor: '#000000'
                            },
                          scales: {
                              xAxes:[{
                                  ticks: {
                                      autoSkip: false
                                  }
                              }],
                              yAxes: [{
                                  ticks: {
                                      beginAtZero: true
                                  }
                              }]
                          }
                      }
                  })

              </script>

            </div>
          </div>
        </div>

        <div class="col-sm-6 my-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">การใช้ปริมาณน้ำประปา เดือน <?php echo $TH_Month[$nMonth]; ?> (Volumeflow m3/h) ของแต่ละส่วนงาน</h4>
              <hr>
              <canvas id="myChart2" height="180px"></canvas>

              <script>
                  let barChartData2 = {
                      labels: <?php echo $get_MaxVal_Name; ?>,
                      datasets: [{
                          label: 'Volume Flow (m3/h) / Month',
                          data: <?php echo $get_MaxVal_month; ?>,
                          backgroundColor: 'rgba(255, 99, 132, 0.2)',
                          borderColor: 'rgb(255, 99, 132)',
                          borderWidth: 1
                      }
                    ]
                  }

                  var ctx = document.getElementById('myChart2').getContext('2d');
                  var myChart2 = new Chart(ctx, {
                      type: 'line',
                      data: barChartData2,
                      options: {
                            tooltips: {
                            mode: 'index',
                            yAlign: 'bottom',
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                    },
                                },
                            backgroundColor: '#000000'
                            },
                          scales: {
                              xAxes:[{
                                  ticks: {
                                      autoSkip: false
                                  }
                              }],
                              yAxes: [{
                                  ticks: {
                                      beginAtZero: true,
                                  }
                              }]
                          }
                      }
                  })

              </script>

              {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
          </div>
        </div>
      </div>
   
     <div class="row pae">
        <div class="col-sm-12  my-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">ภาพรวมการใช้ปริมาณน้ำประปา เดือน <?php echo $TH_Month[$nMonth]; ?> (TotalUsing/หน่วย) ของแต่ละคณะ/ส่วนงาน</h4>
              <hr>
              <canvas id="myChart3" height="100px"></canvas>
                
                <script>
                    let barChartData3 = {
                        labels: <?php echo $get_Water_Month_Name; ?>,
                        datasets: [{
                            label: 'TotalUsing/หน่วย',
                            data: <?php echo $get_Water_Month_Val; ?>,
                            backgroundColor: 'rgba(255, 64, 26, 0.45)',
                            borderColor: 'rgba(255, 64, 26, 1)',
                            borderWidth: 1
                        }
                    ]
                    }

                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var myChart3 = new Chart(ctx, {
                        type: 'line',
                        data: barChartData3,
                        options: {
                            tooltips: {
                            mode: 'index',
                            yAlign: 'bottom',
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                    },
                                },
                            backgroundColor: '#000000'
                            },
                            scales: {
                                xAxes:[{
                                    ticks: {
                                        autoSkip: false
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    })

                </script>


              {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
          </div>
        </div>
     
     <br>
</div>
<!-- End Container -->
<br><br>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        {{-- <li>
                            <a href="https://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="https://creative-tim.com/presentation">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="material-icons">favorite</i> by
                    <a href="https://erdi.cmu.ac.th" target="_blank">ERDI CMU</a> for CMU Smart City.
                </div>
            </div>
        </footer>
    </div>
</div>

</body>

</html>

