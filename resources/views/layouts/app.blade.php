<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AUDIT CMU</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200;400;600&display=swap');
        div * {
            font-family: 'Kanit', sans-serif;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <!-- <div class="container"> -->
                <!-- <div class="navbar-header"> -->
                    


                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
               <!--  </div> -->
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    <!-- Branding Image -->
                   <a class="navbar-brand" href="{{ url('/home') }}">
                         <img src="{{ asset('/uploads/img_web/icon_cmu.png') }}" height="50" width="50" >
                   </a>
                    <a class="navbar-brand" href="{{ url('/public') }}">
                         <img src="{{ asset('/uploads/img_web/icon_pub.png') }}" height="50" width="50" >
                   </a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a class="navbar-brand" href="{{ route('login') }}">เข้าสู่ระบบ|Login</a></li>
                            <!-- <li><a class="navbar-brand" href="{{ route('register') }}">ลงทะเบียน|Register</a></li>  -->
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                        @else
                            <li class="dropdown">
                                <a class="navbar-brand" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"> </span>&nbsp;&nbsp;
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            ออจจากระบบ|Logout&nbsp;&nbsp;
                                        </a>
                                        <center>
                                        <h6>version 0.1
                                        <br>last update 
                                        <br>15-10-2019</h6>
                                        </center>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                </div>
            <!-- </div> -->
         <div class="col-md-offset " id="non-printable">
        <img src="{{ asset('/uploads/img_web/header.jpg') }}" width="100%" class="img-responsive" style="" />
        </div>
        </nav>


        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>



</body>
</html>
