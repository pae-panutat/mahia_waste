<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<title>AUDIT CMU</title>

		<!--Favicon -->
		<link rel="icon" href="{{ asset('p/favicon.ico" type="image/x-icon') }}"/>

		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="{{ asset('p/assets/plugins/bootstrap/css/bootstrap.min.css') }}">

		<!--Icons css-->
		<link rel="stylesheet" href="{{ asset('p/assets/css/icons.css') }}">

		<!--mCustomScrollbar css-->
		<link rel="stylesheet" href="{{ asset('p/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css') }}">

		<!--Style css-->
		<link rel="stylesheet" href="{{ asset('p/assets/css/style.css') }}">

		<!--Sidemenu css-->
		<link rel="stylesheet" href="{{ asset('p/assets/plugins/toggle-menu/sidemenu.css') }}">
       
        

	</head>

	<body class="app">

	<div id="spinner"></div>

		<div id="app" class="page">
			<div class="main-wrapper page-main" >
				<nav class="navbar navbar-expand-lg main-navbar">
					<a class="header-brand" href="index.html">
						<img src="{{ asset('p/assets/img/brand/logo.png') }}" class="header-brand-img" alt="  Asta-Admin  logo">
					</a>
					<form class="form-inline mr-auto">
						<ul class="navbar-nav">
							<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-navicon"></i></a></li>
							<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none navsearch"><i class="ion ion-search"></i></a></li>
						</ul>
                        
					</form>
					<ul class="navbar-nav navbar-right">

						<li class="dropdown dropdown-list-toggle">
							<a href="#" class="nav-link nav-link-lg full-screen-link">
								<i class="fa fa-expand"  id="fullscreen-button"></i>
							</a>
						</li>
						<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
							<img src="{{ asset('p/assets/img/avatar/avatar-1.jpg') }}" alt="profile-user" class="rounded-circle w-32">
							<div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="dropdown-item has-icon">
									<i class="ion-ios-redo"></i> Logout
								</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
							</div>
						</li>
					</ul>
				</nav>

				<aside class="app-sidebar">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a class="navbar-brand" href="{{ route('login') }}">เข้าสู่ระบบ|Login</a></li>
                        <!-- <li><a class="navbar-brand" href="{{ route('register') }}">ลงทะเบียน|Register</a></li>  -->
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                    @else  
                        <div class="app-sidebar__user">
                            <div class="dropdown">
                                <a class="nav-link pl-2 pr-2 leading-none d-flex" data-toggle="dropdown" href="#">
                                    <img alt="image" src="{{ asset('p/assets/img/avatar/avatar-1.jpg') }}" class=" avatar-md rounded-circle">
                                    <span class="ml-2 d-lg-block">
                                        <span class="text-dark app-sidebar__user-name mt-5">{{ Auth::user()->name }}</span><br>
                                        <span class="text-muted app-sidebar__user-name text-sm"> CMU Data Dashboard</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        @endif
                
                        <ul class="side-menu">
                            @if ( Auth::user()->permission_ID == 1 or Auth::user()->email == 'admin_audit@cmu.ac.th')
                            <li class="slide">
                               <a class="side-menu__item"  href="{{ url('/alldatacmu') }}"><i class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">ภาพรวมทั้งมหาลัยฯ</span><i class="angle fa fa-angle-right"></i></a>
                               </li>
                            @endif
                           <li class="slide">
                               <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-bar-chart"></i><span class="side-menu__label">Charts</span><i class="angle fa fa-angle-right"></i></a>
                               <ul class="slide-menu">
                                @foreach (DB::SELECT(DB::raw("SELECT * FROM audit_cmu.audit_db WHERE off_id = $off_id ")); as $db)
                                   <li><a href="#" class="slide-item"><?php  echo $db->location; ?></a></li>
                                @endforeach
                               </ul>
                           </li>
                       </ul>
                    </aside>



				@yield('content')



				

				<footer class="main-footer">
					<div class="text-center">
						Copyright &copy;  CMU 2022. Design By<a href="#"> CMU Data Dashboard</a>
					</div>
				</footer>

			</div>
		</div>

		<!--Jquery.min js-->
		<script src="{{ asset('p/assets/js/jquery.min.js') }}"></script>

		<!--popper js-->
		<script src="{{ asset('p/assets/js/popper.js') }}"></script>

		<!--Tooltip js-->
		<script src="{{ asset('p/assets/js/tooltip.js') }}"></script>

		<!--Bootstrap.min js-->
		<script src="{{ asset('p/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!--Jquery.nicescroll.min js-->
		<script src="{{ asset('p/assets/plugins/nicescroll/jquery.nicescroll.min.js') }}"></script>

		<!--Scroll-up-bar.min js-->
		<script src="{{ asset('p/assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js') }}"></script>

		<!--Sidemenu js-->
		<script src="{{ asset('p/assets/plugins/toggle-menu/sidemenu.js') }}"></script>

		<!--Othercharts js-->
		<script src="{{ asset('p/assets/plugins/othercharts/jquery.knob.js') }}"></script>
		<script src="{{ asset('p/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

		<!--mCustomScrollbar js-->
		<script src="{{ asset('p/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

		{{-- <!--Chart js-->
		<script src="{{ asset('p/assets/js/chart.min.js') }}"></script> --}}
       
        {{-- <script src="{{ asset('p/assets/js/ChartJs/Chart.bundle.js') }}"></script>
        <script src="{{ asset('p/assets/js/ChartJs/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('p/assets/js/ChartJs/Chart.js') }}"></script>
        <script src="{{ asset('p/assets/js/ChartJs/Chart.min.js') }}"></script> --}}

        <!-- ECharts -->
		{{-- <script src="{{ asset('p/assets/js/echart/js/echarts.js') }}"></script>
		<script src="{{ asset('p/assets/js/echart/echarts.js') }}"></script> --}}

		<!--Scripts js-->
		<script src="{{ asset('p/assets/js/scripts.js') }}"></script>

		{{-- <!--Chartjs js-->
		<script src="{{ asset('p/assets/js/chartjs.js') }}"></script> --}}



	</body>
</html>