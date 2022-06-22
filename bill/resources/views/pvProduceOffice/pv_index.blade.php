<style>
    .container{
        font-family: 'Sarabun', sans-serif;
    }
    .container-fluid{
        margin: 0 0;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        justify-content: center;
        background:rgb(rgb(28, 28, 28));
        overflow: hidden;
        position: relative;
        font-family: 'Sarabun', sans-serif;
        /* color: rgb(255, 255, 255); */
    }
    .Texth2{
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: 'Sarabun', sans-serif;
        font-size: 25px;
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
                    <img style="max-width:70px; margin-top: -7px; margin-left: 15px;"
                         src=" {{ URL::asset('../assets/img/cmu_logo.png') }} ">
                </a>  CMU SMARTCITY
            </a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="#">
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
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('http://10.110.56.12/bill/public/index.php/pv_produce_office_index&'.$fk_fac) }}">
                        <i class="material-icons">content_paste</i>
                        <p>PV produce office</p>
                    </a>
                </li>
                <li class="nav-item">
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
                <div class="navbar-wrapper">

{{--                    <a class="navbar-brand" href="javascript:;">Welcome :</a>--}}
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
                            <a class="nav-link" href="#"></i>Welcome : {{session('name')}}</a>
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
        <div class="content">

                <div class="container-fluid">
                <div class="row">
                <div class="col-lg-12">
        				<font color="black"><h4><b><?php echo $name_fac;?> มหาวิทยาลัยเชียงใหม่</b> วันที่ <?php echo DateThai($TimeNow); ?></h4></font>
                </div>
                </div>
                </div>

                <br>

                <div class="col-lg-12">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-sort-by-attributes-alt fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <h2><b><?php echo number_format($total_production_month,2)?></b></h2>
                                    </div>
                                    <div><h4>พลังงานไฟฟ้าในเดือนนี้<br>(kWh)</h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bolt fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <h2><b><?php echo number_format($max_kw,2) ?></b></h2>
                                    </div>
                                    <div><h4>กำลังไฟฟ้าสูงสุดในเดือนนี้<br>(kW)</h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-sort-by-attributes-alt fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <h2><b><?php echo number_format($total_production_day,2) ?></b></h2>
                                    </div>
                                    <div><h4>พลังงานไฟฟ้าในวันนี้<br>(kWh)</h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bolt fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <h2><b><?php echo number_format($kw_day,2) ?></b></h2>
                                    </div>
                                    <div><h4>กำลังไฟฟ้าสูงสุดในวันนี้<br>(kW)</h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ///////////////////////////////////////////////////////ััััั-->

            <div class="container-fluid"> <!-- container-fluid A -->
            <div class="row"><!-- row A -->
            <div class="col-12"><!-- col-12 A -->

                    <div class="row">
                    <div class="col-12">
                         &nbsp;
                    </div>
                    </div>


                    <div class="row">

                    <div class="col-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟแสดงข้อมูลการผลิต (kWh) รวม แต่ละอาคารในเดือนนี้
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                        <iframe name="chart_demo1" src=" {{ url('/pv_chart1&'.$fk_fac) }} " ></iframe>
                        </div>
                    </div>
                    </div>
                    <!-- ==================== -->
                    <div class="col-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟแสดงกำลังไฟฟ้า (Kw) สูงสุด แต่ละอาคารในเดือนนี้
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                        <iframe name="chart_demo2" src=" {{ url('/pv_chart4&'.$fk_fac) }} " ></iframe>
                        </div>
                    </div>
                    </div>

                    </div>


                    <div class="row">

                    <div class="col-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟแสดงข้อมูลการผลิต (kWh) 30วัน ย้อนหลัง
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                        <iframe name="chart_demo1" src=" {{ url('/pv_chart3&'.$fk_fac) }} " ></iframe>
                        </div>
                    </div>
                    </div>
                    <!-- ==================== -->
                    <div class="col-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟแสดงข้อมูลการผลิต (kWh) ในปีนี้
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                        <iframe name="chart_demo2" src=" {{ url('/pv_chart2&'.$fk_fac) }} " ></iframe>
                        </div>
                    </div>
                    </div>

                    </div><!-- end row -->


            </div><!-- end col-12 A -->


            </div><!-- end row A -->
            </div><!-- end container-fluid A -->


    </div>

<!-- =============================================================================== -->
























<!-- =============================================================================== -->









<!-- ======================================================================================================================== -->



<!-- ======================================================================================================================== -->
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
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
                        </li>
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

