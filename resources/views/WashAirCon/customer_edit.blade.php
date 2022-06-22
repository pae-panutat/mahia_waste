@extends('layouts.app')

@section('content')

@if ( Auth::user()->permission_ID == 4)
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
                    <h3>เอกสารรายงานการเปรียบเทียบประสิทธิภาพก่อนและหลังล้างเครื่องปรับอากาศ</h3>
                </center>     
                <br>
                <center> <a href="{{ url('/home') }}"> กลับ </a> </center>
                <br>
                <br>

                <center>
                <table border="1" width="80%" > 
                <tr><td>   

                <center> 
                <br>
                <br>   
                <form action="{{ route('customer_update') }}" method="post">
                    {!! csrf_field() !!}
                <table border="0" width="80%" >
                    <tr>
                        <td width="20%">ชื่อลูกค้า</td>
                        <td width="80%"><input type="text" size="50" name="customer_name" value="{{ $data['customer_name'] }}"></td>
                    </tr>
                    <tr>
                        <td width="20%"> &nbsp; <input type="hidden" name="id" value="{{ ($data['id']) }}"></td>
                        <td width="80%"><br><input type="submit" value="แก้ไข|Edit"></td>
                    </tr>
                </table>   
                </form>
                <br>
                <br>
                </center>

                </td></tr>
                </table>
                </center>

                
                </div>
            </div>
        </div>  
    </div>
</div>    
@endif         
@endsection
