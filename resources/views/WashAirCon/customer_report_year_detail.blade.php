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
                //echo $year;
                ?>

                <br>
                <div class="panel-body">
                <center>
                    <h3>เอกสารรายงานการเปรียบเทียบประสิทธิภาพก่อนและหลังล้างเครื่องปรับอากาศ</h3>
                </center>     
                <br>
                <center> <a href="{{ url('/home') }}"> หน้าแรก </a> | <a href="{{ url('customer_report_year'.'&'.$cus_id) }}"> ก่อนหน้า </a> </center>
                <br>
<!-- ======================================================================================================================== -->
@if(empty(DB::SELECT(DB::raw("SELECT *
                                FROM smart_wash_air_con.customer
                                JOIN smart_wash_air_con.report_year_detail
                                ON smart_wash_air_con.customer.id = smart_wash_air_con.report_year_detail.cus_id
                                WHERE smart_wash_air_con.report_year_detail.cus_id = '$cus_id'
                                AND smart_wash_air_con.report_year_detail.year_info = '$year'
                                ")))) 
                    <center>
                    <table border="1" width="60%">
                    @foreach (DB::SELECT(DB::raw("SELECT *
                                    FROM smart_wash_air_con.customer
                                    WHERE smart_wash_air_con.customer.id = $cus_id
                            ")); as $dataqq)
                    <tr>
                        <td width="30%">ชื่อลูกค้า</td>
                        <td><?php echo($dataqq->customer_name); ?> </td>
                    </tr>
                    <tr>
                        <td width="30%">ที่อยู่</td>
                        <td><?php echo ($dataqq->address); ?></td>
                    </tr>
                    <tr>
                        <td width="30%">โทรศัพท์</td>
                        <td><?php echo ($dataqq->tel1); ?></td>
                    </tr>
                    <tr>
                        <td width="30%">โทรสาร</td>
                        <td><?php echo ($dataqq->tel2); ?></td>
                    </tr>
                    <tr>
                        <td width="30%">อีเมล</td>
                        <td><?php echo ($dataqq->email); ?></td>
                    </tr>
                    @endforeach
                    </table>  
                    </center>  
                    <br>
                    <br>
                    <center><p><a href="{{ url('customer_report_form'.'&'.$cus_id.'&'.$year) }}">เพิ่มข้อมูลวันทำการ|New operation day</a></p></center>
                    <center><h3>ยังไม่มีข้อมูล</h3></center>
                    <br><br><br><br><br>

@else                 
                    <center>
                    <table border="1" width="60%">
                    @foreach (DB::SELECT(DB::raw("SELECT *
                                    FROM smart_wash_air_con.customer
                                    JOIN smart_wash_air_con.report_year_detail
                                    ON smart_wash_air_con.customer.id = smart_wash_air_con.report_year_detail.cus_id
                                    WHERE smart_wash_air_con.report_year_detail.cus_id = $cus_id LIMIT 1
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
                    <br>
                    <center><p><a href="{{ url('customer_report_form'.'&'.$cus_id.'&'.$year) }}"> เพิ่มข้อมูลวันทำการ|New operation day</a></p></center>
                    <center>
                    <table border="1" width="40%">
                    <tr>
                        <td><center><b>ลำดับที่</b></center></td>
                        <td><center><b>ข้อมูลประจำปี <?php echo $year; ?> </b></center></td> 
                    </tr>
                    <?php $k=0; ?> 
                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                    FROM smart_wash_air_con.report_year_detail
                                    WHERE cus_id ='$cus_id' and year_info ='$year' group by operation_date
                            ")); as $data)
                    <tr>
                        <?php 
                        $id = $cus_id;
                        ?>
                        <td width="10%"><center><?php $k=$k+1; echo $k; ?></center></td>
                        <td><center><a href="{{ url('customer_operation_date'.'&'.$id.'&'.$data->operation_date) }}">วันที่เข้าดำเนินการ {{ $data->operation_date }}</a></center></td>
                    </tr>
                    @endforeach
                    </table>  
                    <br><br><br><br><br>
                    </center>

@endif     


                
                </div>
            </div>
        </div>  
    </div>
</div>  
@endif

@endsection
