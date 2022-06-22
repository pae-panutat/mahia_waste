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
                @if ( Auth::user()->permission_ID == 4)

                <?php
                $year = request()->route()->year;
                $cus_id = request()->route()->id;

                ?>

                <br>
                <div class="panel-body">
                <center>
                    <h3>เอกสารรายงานการเปรียบเทียบประสิทธิภาพก่อนและหลังล้างเครื่องปรับอากาศ</h3>
                </center>     
                <br>
                <center> <a href="{{ url('customer_report_year_detail'.'&'.$cus_id.'&'.$year) }}"> กลับ </a> </center>
                <br>
                <br>

                <form name="form" action="{{ url('customer_report_form_insert') }}" method="post" >
                {!! csrf_field() !!}

                <table border="0" width="100%" >
                    <tr>
                        <td width="30%" align="right">ข้อมูลวันที่<br>Date</td>
                        <td width="5%">&nbsp;</td>
                        <td><br>
                            <input type="hidden" name="cus_id" value="{{ $cus_id }}">
                            <input type="hidden" name="year_info" value="{{ $year }}">        
                            <input type="date" name="operation_date" class="form-control" required>
                            <br>
                        </td>
                    </tr>      
                </table>
                    <br>
                <center> 
                    <input type="hidden" name="user_ID" value="{{ Auth::user()->id }}">
                    <input type="submit" value="บันทึก|Submit">
                </center>
                    </form>                 



                @endif
                </div>
            </div>
        </div>  
    </div>
</div>  
@endsection
