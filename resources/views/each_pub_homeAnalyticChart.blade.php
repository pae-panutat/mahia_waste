@extends('layouts.app')

@section('content')
<script type="text/javascript" src="js/jscharts.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                        <h4>ระบบสำรวจการใช้พลังงานมหาวิทยาลัยเชียงใหม่</h4>
                    </center>
                </div>
                <!-- @if ( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th') -->
                <!-- @endif -->
                <br>
                <div class="panel-body">
                <center>

                

                <table border="0" width="80%" >
                <tr>
                <td width="50%">    
                    <a href="{{ url('/indexDash') }}" class="btn" style="background-color:#8533ff; color:white;">Home</a> 
                    <a href="{{ url('/analyticDash') }}" class="btn" style="background-color:#8533ff; color:white;">AnalyticDash</a> 
                    <!-- <a href="{{ url('/public') }}" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a>  -->
                    <!-- <a href="{{ url('/analyticChart') }}" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a>  -->
                </td>
                <td width="50%"> 
                    &nbsp;
                </td>
                </tr>
                </table>



                <iframe name="chart1_demo" src="{{url('/analyticChart_chart1')}}" width="80%" height="360" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                <br>

                <center>
                <p>
                <!-- <a href="{{url('/chart1_year_pre')}}" target="tablesum_demo">สรุปข้อมูลระบบคัดแยกขยะในปี<?php //echo $ypv+543; ?></a>&nbsp;&nbsp;&nbsp;    
                <a href="{{url('/tableChart_year_thisyear')}}" target="tablesum_demo">สรุปข้อมูลระบบคัดแยกขยะในปี<?php //echo $yc+543; ?></a>&nbsp;&nbsp;&nbsp; -->
                </p>
                </center>
                <hr>



















            </div>
        </div>
    </div>
</div>
@endsection
