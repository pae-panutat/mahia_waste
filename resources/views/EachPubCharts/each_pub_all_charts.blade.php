@extends('layouts.app')



@section('content')
@if ( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                    <?php 
                    $off_id = request()->route()->off_id; 
                    $year = request()->route()->year;
                    $pyear = $year-1;
                    ?>
                        <h4>ระบบสำรวจการใช้พลังงานมหาวิทยาลัยเชียงใหม่</h4>
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                    FROM audit_cmu.audit_db 
                                    WHERE off_id = $off_id ")); as $db)

                        <h3><?php  echo $db->location; ?></h3>
                    </center>
                </div>
                
                <div class="panel-body">
                <p>
                <a href="{{ url('/public') }}" class="btn" style="background-color:#3CBC8D; color:white;">หน้าหลัก</a>
                <a href="{{ url('/public_menu'.'&'.$off_id) }}" class="btn" style="background-color:#3CBC8D; color:white;">รายงานประจำปี</a>
                <a href="{{ url('/each_pub_all_charts'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">สรุปการใช้พลังงาน</a>
                <br><br>
<!--                 <a href="{{ url('/import_excel_view_general'.'&'.$off_id.'&'.$year) }}" class="btn">ข้อมูลทั่วไป</a>
                <a href="{{ url('/import_excel_view_person'.'&'.$off_id.'&'.$year) }}" class="btn">ข้อมูลบุคลากร</a>
                <a href="{{ url('/import_excel_view_expenses_t1'.'&'.$off_id.'&'.$year) }}" class="btn">ข้อมูลการใช้พลังงานไฟฟ้าของอาคาร</a>
                <a href="{{ url('/import_excel_view_building'.'&'.$off_id.'&'.$year) }}" class="btn">ข้อมูลลักษณะอาคาร</a>
                <a href="{{ url('/import_excel_view_equipment_t1'.'&'.$off_id.'&'.$year) }}" class="btn">ข้อมูลอุปกรณ์ไฟฟ้า</a>
                <a href="{{ url('/import_excel_view_airconditioner_t1'.'&'.$off_id.'&'.$year) }}" class="btn"> ข้อมูลเครื่องปรับอากาศ</a>
                <a href="{{ url('/import_excel_view_airchiller_t1'.'&'.$off_id.'&'.$year) }}" class="btn"> ข้อมูลเครื่องปรับอากาศแบบAirchiller</a>
                <a href="{{ url('/import_excel_view_elamp_t1'.'&'.$off_id.'&'.$year) }}" class="btn"> ข้อมูลระบบแสงสว่าง</a>
                <a href="{{ url('/import_excel_view_water_t1'.'&'.$off_id.'&'.$year) }}" class="btn"> ข้อมูลระบบน้ำ</a>
                <br>
                <a href="{{ url('/import_excel_view_oil_t1b'.'&'.$off_id.'&'.$year) }}" class="btn"> ข้อมูลระบบน้ำมัน</a>
                <a href="{{ url('/import_excel_view_generator_t1'.'&'.$off_id.'&'.$year) }}" class="btn"> ข้อมูลเครื่องปั่นไฟ</a>   -->    
                </p>
                </div>
            </div>
            <!-- ========================================================= -->
            @endforeach
                <br>
                    <iframe name="each_pub_table_demo1" src="{{url('/each_pub_table1&'.$off_id.'&'.$year)}}" width="100%" height="200" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                    <br>
                    <center>
                    <p>
                    <!-- <a href="{{url('/table1&'.$off_id.'&'.$year)}}" target="demo1">สรุปข้อมูลในปี<?php //echo $year; ?></a>&nbsp;&nbsp;&nbsp;     -->
                    </p>
                    </center>
                    <hr>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <center>
                    <iframe name="each_pub_chart_demo1" src="{{url('/each_pub_chart1&'.$off_id.'&'.$year)}}" width="50%" height="460" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                    <br>
                    <p>
                    <a href="{{url('/each_pub_chart1&'.$off_id.'&'.$year)}}" target="each_pub_chart_demo1">ปริมาณการใช้พลังงานไฟฟ้าปี <?php echo $year; ?></a>&nbsp;&nbsp;&nbsp;    
                    <a href="{{url('/each_pub_chart2&'.$off_id.'&'.$year)}}" target="each_pub_chart_demo1">ค่าใช้จ่ายพลังงานไฟฟ้าปี <?php echo $year; ?></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{url('/each_pub_chart3&'.$off_id.'&'.$year)}}" target="each_pub_chart_demo1">ปริมาณการใช้พลังงานไฟฟ้าเปรียบเทียบปี <?php echo $year; ?></a>&nbsp;&nbsp;&nbsp;
                    </p>
                    </center>
                    <hr>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <br>
                    <center>
                    <table border="1" width="80%">
                    <tr>
                        <td colspan="5" bgcolor="#CEB1FC"><center><b>ข้อมูลอาคาร ปี <?php echo $year; ?><br><font size="1">&nbsp;</font> </b></center></td>
                    </tr>  
                    <tr>
                        <td width="10%" bgcolor="#CEB1FC"><center><b>ลำดับที่</b></center></td>
                        <td width="20%" bgcolor="#CEB1FC"><center><b>หมายเลขมิเตอร์</b></center></td>
                        <td width="50%" bgcolor="#CEB1FC"><center><b>ชื่ออาคาร</b></center></td>
                        <td width="10%" bgcolor="#CEB1FC"><center><b>ชั้น</b></center></td>
                        <td width="10%" bgcolor="#CEB1FC"><center><b>จำนวนชั้น</b></center></td>
                    </tr>
                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM audit_cmu.audit_db 
                                WHERE off_id = $off_id ")); as $db)                
                    <?php $k=0;  ?> 
                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                    FROM $db->db_name.building_info
                                    WHERE off_id = $off_id AND year = $year order by building_name")); as $data)  
                       
                    <tr>
                        <td><center><?php echo $k+1; ?></center></td>
                        <td><?php echo $data->id_meter; ?></td>
                        <td><?php echo $data->building_name; ?></td>
                        <td><center>&nbsp;</center></td>
                        <td><center>&nbsp;</center></td>
                    </tr>
                    <?php $k=$k+1; ?>
                    @endforeach
                    @endforeach 
                    </table>
                    </center>
                    <hr>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <center>
                    <iframe name="each_pub_table_demo3" src="{{url('/each_pub_table3&'.$off_id.'&'.$year)}}" width="50%" height="300" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                    <br>
                    <p>
                    <a href="{{url('/each_pub_table3&'.$off_id.'&'.$year)}}" target="each_pub_table_demo3">รวม</a>&nbsp;&nbsp;&nbsp;    
                    <a href="{{url('/each_pub_table4&'.$off_id.'&'.$year)}}" target="each_pub_table_demo3">ตามอาคาร</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{url('/each_pub_table5&'.$off_id.'&'.$year)}}" target="each_pub_table_demo3">ตามมีเตอร์</a>&nbsp;&nbsp;&nbsp;
                    
                    </p>
                    </center>
                    <hr>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <center>
                    <iframe name="each_pub_chart_demo2" src="{{url('/chart4&'.$off_id.'&'.$year)}}" width="50%" height="450" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                    <br>
                    <p>
                    <a href="{{url('/each_pub_chart4&'.$off_id.'&'.$year)}}" target="each_pub_chart_demo2">รวม</a>&nbsp;&nbsp;&nbsp;    
                    <a href="{{url('/each_pub_chart5&'.$off_id.'&'.$year)}}" target="each_pub_chart_demo2">ตามอาคาร</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{url('/each_pub_chart6&'.$off_id.'&'.$year)}}" target="each_pub_chart_demo2">ตามมีเตอร์</a>&nbsp;&nbsp;&nbsp;
                    
                    </p>
                    </center>
                    <hr>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--                     <center>
                    <iframe name="chart_demo3" src="{{url('/chart7&'.$off_id.'&'.$year)}}" width="50%" height="550" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                    <br>
                    </center>
                    <hr> -->
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

























            <!-- ========================================================= -->
        </div>
    </div>
</div>
@endif
@endsection
