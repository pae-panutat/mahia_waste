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

                @if(empty(DB::connection($db->db_name)->select("SELECT * FROM equipment_t2 WHERE off_id = $off_id AND year = $year"))) 

                <div class="panel-body">
                    <br>
                    <center><h3>ยังไม่มีข้อมูล<h3><center>

                </div>

                @else 
                <div class="panel-body">

                <center>    
                <table border="0" width="80%" >
                <tr>
                <td align="left"> 
                    &nbsp;
                </td>

                <td align="right">   
                    <a href="{{ url('/public_equipment_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางอุปกรณ์ไฟฟ้า</a>
                    <a href="{{ url('/public_equipment_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางสรุปอุปกรณ์ไฟฟ้า</a> 
                    <!-- <a href="{{ url('/export_file_equipment_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>  -->          
                </td>
                </tr>
                <tr>
                <td  colspan="2">

                    <center>       
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="5" style="background-color: #EAFAF1;"><center><h3>ตารางสรุปอุปกรณ์ไฟฟ้า</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%"><center>ลำดับที่</center></td>
                            <td width="20%"><center>ชนิดอุปกรณ์</center></td>
                            <td width="20%"><center>วัตต์</center></td>
                            <td width="20%"><center>จำนวน</center></td>
                            <td width="20%"><center>รวม<br>(วัตต์)</center></td>
                        </tr>
                        <?php $k=0; ?> 
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.equipment_t2 
                                WHERE off_id = $off_id AND year = $year ")); as $data)
                        <tr>        
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->id }}" value="{{ $data->id }}" />
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->off_id }}" value="{{ $data->off_id }}" />
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->year }}" value="{{ $data->year }}" />
                            <td ><center><?php echo $k+1; ?> </center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="equiptment_type" value="{{ $data->equiptment_type }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="watt" value="{{ $data->watt }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="amount" value="{{ $data->amount }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="total_watt" value="{{ $data->total_watt }}" ></center></td>
                        </tr>
                        <?php $k=$k+1; ?>
                        @endforeach
                        
                    </table>
                </center>


                </div>                    
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
