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
               
                <br>
                <div class="panel-body">
                <center>
                    <table border="0" width="80%" >
                    <tr>
                    <td width="50%">  
                        <a href="{{ url('/public_analyticChart') }}" class="btn" style="background-color:#8533ff; color:white;">กราฟภาพรวมมหาวิทยาลัยเชียงใหม่</a>  
                        <a href="{{ url('/pub') }}" class="btn" style="background-color:#8533ff; color:white;">แต่ละส่วนงาน</a> 
                        &nbsp;  
                    </td>
                    <td width="50%"> 
                        <br>
                        year
                    </td>
                    </tr>
                    </table>
                    <br>


                </center>
                </div>
          


















            </div>
        </div>
    </div>
</div>
@endsection
