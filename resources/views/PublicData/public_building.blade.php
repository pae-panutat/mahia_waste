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
                @if(empty(DB::connection($db->db_name)->select("SELECT * FROM building_info WHERE off_id = $off_id AND year = $year"))) 

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
                    <!-- <a href="{{ url('/import_excel_del_building'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a>  -->  
                </td>

                <td align="right"> 
                    <!-- <a href="{{ url('/export_file_building'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a> -->                
                </td>
                </tr>
                <tr>
                <td  colspan="2">

                    <center>   
                    <!-- <form method="POST" action="{{ url('/import_excel_edit_building'.'&'.$off_id.'&'.$year) }}" enctype="multipart/form-data">
                    {{ csrf_field() }} -->
                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="10" style="background-color: #EAFAF1;"><center><h3>ข้อมูลลักษณะอาคาร</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%"><center>ชื่ออาคาร</center></td>
                            <td width="10%"><center>ชั้น</center></td>
                            <td width="10%"><center>หมายเลขมีเตอร์</center></td>
                            <td width="5%"><center>จำนวนชั้น</center></td>
                            <td width="8%"><center>ความสูง<br>แต่ละชั้น<br>(ม.)</center></td>
                            <td width="10%"><center>พื้นที่จอดรถ<br>(ตรม.)</center></td>
                            <td width="10%"><center>พื้นที่ใช้สอยรวม<br>(ตรม.)</center></td>
                            <td width="10%"><center>พื้นที่ปรับอากาศ<br>(ตรม.)</center></td>
                            <td width="10%"><center>พื้นที่ปรับอากาศ<br>ชั้นบนสุด<br>(ตรม.)</center></td> 
                            <td width="7%"><center>อาคารเริ่มใช้งานปี</center></td> 
                        </tr>
                        <?php 
                            $k=0; 
                            $parking_area=0; 
                            $used_area=0; 
                            $air_area=0; 
                            $air_area_on_top=0;
                        ?>
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.building_info 
                                WHERE off_id = $off_id AND year = $year ")); as $data)
                        <tr>        
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->id }}" value="{{ $data->id }}" />
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->off_id }}" value="{{ $data->off_id }}" />
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->year }}" value="{{ $data->year }}" />
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="building_name" value="{{ $data->building_name }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="floor" value="{{ $data->floor }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="id_meter" value="{{ $data->id_meter }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="total_floor" value="{{ $data->total_floor }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="floor_hieght" value="{{ $data->floor_hieght }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="parking_area" value="{{ $data->parking_area }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="used_area" value="{{ $data->used_area }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="air_area" value="{{ $data->air_area }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="air_area_on_top" value="{{ $data->air_area_on_top }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="year_begin" value="{{ $data->year_begin }}" ></center></td>                            
                        </tr>
                        <?php $k=$k+1; 
                              $parking_area     =$parking_area + $data->parking_area; 
                              $used_area        =$used_area + $data->used_area;
                              $air_area         =$air_area + $data->air_area;
                              $air_area_on_top  =$air_area_on_top+$data->air_area_on_top;
                        ?>
                        @endforeach
                        <tr>
                            <td style="background-color: #EAFAF1;">
                                <center>จำนวนอาคาร</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่จอดรถ<br>ทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่ใช้สอยรวม<br>ทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่ปรับอากาศ<br>ทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่ปรับอากาศ<br>ชั้นบนสุดทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>                             
                        </tr>
                        <tr>
                            <td ><center>{{ $k }}</center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>{{ $parking_area }}</center></td>
                            <td ><center>{{ $used_area }}</center></td>
                            <td ><center>{{ $air_area }}</center></td>
                            <td ><center>{{ $air_area_on_top }}</center></td>
                            <td ><center>&nbsp;</center></td>                             
                        </tr>
                    </table>
<!--                       <div class="form-group">
                          <br>
                          <button type="submit" id="save" class="btn btn-default">แก้ไขข้อมูล|Submit</button>
                      </div>
                    </form> -->
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
