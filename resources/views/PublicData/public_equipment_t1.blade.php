@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                    <?php 
                    $off_id = request()->route()->off_id; 
                    $year = request()->route()->year;
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
                <br>  
                ||&nbsp;<a href="{{ url('/public_general'.'&'.$off_id.'&'.$year) }}">ข้อมูลทั่วไป</a>
                ||&nbsp;<a href="{{ url('/public_expenses_t1'.'&'.$off_id.'&'.$year) }} ">ข้อมูลการใช้พลังงานไฟฟ้าของอาคาร</a>
                ||&nbsp;<a href="{{ url('/public_building'.'&'.$off_id.'&'.$year) }}">ข้อมูลลักษณะอาคาร</a>
                ||&nbsp;<a href="{{ url('/public_equipment_t1'.'&'.$off_id.'&'.$year) }}">ข้อมูลอุปกรณ์ไฟฟ้า</a>
                ||&nbsp;<a href="{{ url('/public_airconditioner_t1'.'&'.$off_id.'&'.$year) }}"> ข้อมูลเครื่องปรับอากาศ</a>
                ||&nbsp;<a href="{{ url('/public_airchiller_t1'.'&'.$off_id.'&'.$year) }}"> ข้อมูลเครื่องปรับอากาศแบบAirchiller</a>
                ||&nbsp;<a href="{{ url('/public_elamp_t1'.'&'.$off_id.'&'.$year) }}"> ข้อมูลระบบแสงสว่าง</a>
                ||&nbsp;<a href="{{ url('/public_water_t1'.'&'.$off_id.'&'.$year) }}"> ข้อมูลระบบน้ำ</a>
                ||&nbsp;<a href="{{ url('/public_oil_t1b'.'&'.$off_id.'&'.$year) }}"> ข้อมูลระบบน้ำมัน</a>
                ||&nbsp;<a href="{{ url('/public_generator_t1'.'&'.$off_id.'&'.$year) }}"> ข้อมูลเครื่องปั่นไฟ</a>                 
                </p>
                </div>
            </div>
            <!-- ========================================================= -->
                <br>
                @if(empty(DB::connection($db->db_name)->select("SELECT * FROM equipment_t1 WHERE off_id = $off_id AND year = $year"))) 

                <div class="panel-body">
                    <br>
                    <center><h3>ยังไม่มีข้อมูล<h3><center>

                </div>

                @else 

                <center>    
                <table border="0" width="100%" >
                <tr>
                <td align="left"> 
                    &nbsp; 
                </td>

                <td align="right"> 
                    <a href="{{ url('/public_equipment_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางอุปกรณ์ไฟฟ้า</a>
                    <a href="{{ url('/public_equipment_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางสรุปอุปกรณ์ไฟฟ้า</a>  
                    <!-- <a href="{{ url('/export_file_equipment_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>  -->              
                </td>
                </tr>
                <tr>
                <td  colspan="2">

                    <center>   
                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="14" style="background-color: #EAFAF1;"><center><h3>ตารางอุปกรณ์ไฟฟ้า</h3></center></td>
                        </tr>
                        <tr>
                            <td ><center>ลำดับ</center></td>
                            <td ><center>อาคาร</center></td>
                            <td ><center>ชื่อห้อง</center></td>
                            <td ><center>หมาย<br>เลข<br>มิเตอร์</center></td>
                            <td ><center>ประเภท<br>ห้อง</center></td>
                            <td ><center>ชั้น</center></td>
                            <td ><center>ชื่อ<br>อุปกรณ์</center></td>
                            <td ><center>ขนาด<br>วัตต์</center></td>
                            <td ><center>จำนวน</center></td>
                            <td ><center>ชั่วโมงใช้งาน<br>(ชม/วัน)</center></td>
                            <td ><center>วันใช้งาน<br>(วัน/ปี)</center></td>
                            <td ><center>Factor<br>การ<br>ทำงาน</center></td>
                            <td ><center>ปริมาณ<br>การใช้<br>พลังงาน<br>ไฟฟ้า<br>(kWh/ปี)</center></td>
                            <td ><center>ปริมาณ<br>ค่าไฟฟ้า<br>(บาท/ปี)</center></td>
                        </tr>  
                        <?php $k=0;  ?> 
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.equipment_t1 
                                WHERE off_id = $off_id AND year = $year ")); as $data)
                        <tr>        

                            <td ><center><?php echo $k+1; ?></center></td>
                            <td ><center>{{ $data->location }}</center></td>
                            <td ><center>{{ $data->room_name }}</center></td>
                            <td ><center>{{ $data->id_meter }}</center></td>
                            <td ><center>{{ $data->room_type }}</center></td>
                            <td ><center>{{ $data->floor }}</center></td>
                            <td ><center>{{ $data->equipment_name }}</center></td>
                            <td ><center>{{ $data->watt }}</center></td>
                            <td ><center>{{ $data->amount }}</center></td>
                            <td ><center>{{ $data->work_hours_per_day }}</center></td>
                            <td ><center>{{ $data->work_days_per_year }}</center></td>
                            <td ><center>{{ $data->factor }}</center></td>
                            <td ><center>{{ $data->kwh_per_year }}</center></td>
                            <td ><center>{{ $data->expenses_per_year }}</center></td>

                        </tr>
                        <?php $k=$k+1; ?>
                        @endforeach
                        
                    </table>
                </center>
     
                                   
                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                @endif
                @endforeach
            <!-- ========================================================= -->















            
        </div>
    </div>
</div>

@endsection