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
                <br>
                <div class="panel-body">
                <center>
                    <h3>เอกสารรายงานการเปรียบเทียบประสิทธิภาพก่อนและหลังล้างเครื่องปรับอากาศ</h3>
                </center>     
                <br>
                <center> <a href="{{ url('/home') }}"> หน้าแรก </a> | <a href="{{ url('/home') }}"> ก่อนหน้า </a> </center>
                <br>
                <br>
                <center>
                    <?php
                    $year_c  = date("Y")+543;
                    $cus_id = request()->route()->id;
                    ?>

                    <center>
                    <table border="1" width="60%">
                    @foreach (DB::SELECT(DB::raw("SELECT *
                                    FROM smart_wash_air_con.customer
                                    JOIN smart_wash_air_con.report_year
                                    ON smart_wash_air_con.customer.id = smart_wash_air_con.report_year.cus_id
                                    WHERE smart_wash_air_con.report_year.cus_id = $cus_id
                            ")); as $dataq)
                    <tr>
                        <td width="30%">ชื่อลูกค้า</td>
                        <td><?php echo($dataq->customer_name); ?> </td>
                    </tr>
                    <tr>
                        <td width="30%">ที่อยู่</td>
                        <td><?php echo ($dataq->address); ?></td>
                    </tr>
                    <tr>
                        <td width="30%">โทรศัพท์</td>
                        <td><?php echo ($dataq->tel1); ?></td>
                    </tr>
                    <tr>
                        <td width="30%">โทรสาร</td>
                        <td><?php echo ($dataq->tel2); ?></td>
                    </tr>
                    <tr>
                        <td width="30%">อีเมล</td>
                        <td><?php echo ($dataq->email); ?></td>
                    </tr>
                    @endforeach
                    </table>  
                    </center>  
                    <br>

                    <form action="{{ url('/customer_report_new') }}" method="post">    
                    {!! csrf_field() !!}
                    
                    <table border="0"> 
                        <tr>
                            <td valign="bottom">ข้อมูลปี&nbsp;</td>
                            <td valign="bottom">
                                &nbsp;
                                <select name="year_info" id="year_info">
                                <option value=" <?PHP echo $year_c;?> "><?PHP echo $year_c; ?></option>

                                @for($i=0; $i<=100; $i++)
                                <option value="<?PHP echo date("Y")-$i+543; ?>">
                                    <?PHP echo date("Y")-$i+543; ?></option>
                                @endfor
                                </select>
                                &nbsp;
                            </td>
                            <td valign="bottom">
                                &nbsp;
                                <center><input type="submit" value="สร้างรายงานใหม่|New report"></center>
                                <input type="hidden" name="cus_id" value="<?php echo $cus_id ?>" >
                            </td>
                        </tr>
                    </table>
                    <br>
                    
                    </form>

                    <br>

                    <table border="1" width="80%" > 
                        <tr>
                            <td style="background-color: #EAFAF1;"><center>ลำดับที่</center></td>
                            <td style="background-color: #EAFAF1;"><center>รายการ</center></td>
                        </tr>
                        
                        <?php $k=0; ?>  
	                    @foreach (DB::SELECT(DB::raw("SELECT * 
	                                    FROM smart_wash_air_con.report_year 
	                                    WHERE cus_id = $cus_id ORDER BY year_info")); as $re)
                        <tr>
                            <td ><center><?php $k=$k+1; echo $k; ?></center></td>
                            <td ><center><a href="{{ url('customer_report_year_detail'.'&'.$re->cus_id.'&'.$re->year_info) }}">รายงานประจำปี {{ $re->year_info }}</a></center></td>
                        </tr>

						@endforeach

                    </table>
                    </center>   


                </center>

                @endif
                </div>
            </div>
        </div>  
    </div>
</div>             
@endsection
