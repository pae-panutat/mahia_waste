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
                <a href="{{ url('/home') }}" class="btn" style="background-color:#3CBC8D; color:white;">หน้าหลัก</a>
                <a href="{{ url('/admin_excel_menu'.'&'.$off_id) }}" class="btn" style="background-color:#3CBC8D; color:white;">สร้างรายงานใหม่</a>
                <a href="{{ url('/view_all_charts'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">สรุปการใช้พลังงาน</a>
                <br><br>
                <a href="{{ url('/import_excel_view_general'.'&'.$off_id.'&'.$year) }}" class="btn">ข้อมูลทั่วไป</a>
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
                <a href="{{ url('/import_excel_view_generator_t1'.'&'.$off_id.'&'.$year) }}" class="btn"> ข้อมูลเครื่องปั่นไฟ</a>      
                </p>
                </div>
                
            </div>
        </div>
    </div>
</div> 

            <!-- ========================================================= -->
                <br>
                @if(empty(DB::connection($db->db_name)->select("SELECT * FROM airconditioner_t1 WHERE off_id = $off_id AND year = $year"))) 

                <div class="panel-body">

                    <center><h3>อัพโหลดExcel:ตารางเครื่องปรับอากาศ<h3><center>

                    {!! Form::open(array('route' => 'import_excel_airconditioner_t1','method'=>'POST','files'=>'true')) !!}

                    {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}

                    {!! Form::file('sample_file', array('class' => 'form-control')) !!}

                    {!! Form::hidden('off_id', $off_id ) !!}
                    {!! Form::hidden('year', $year ) !!}

                    {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>

                @else 

                <center>    
                <table border="0" width="95%" >
                <tr>
                <td align="left"> 
                    <a href="{{ url('/import_excel_del_airconditioner_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a> 
                </td>

                <td align="right"> 
                    <a href="{{ url('/import_excel_view_airconditioner_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางเครื่องปรับอากาศ</a>
                    <a href="{{ url('/import_excel_view_airconditioner_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางสรุปเครื่องปรับอากาศ</a> 
                    <a href="{{ url('/export_file_airconditioner_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>             
                </td>
                </tr>
                <tr>
                <td  colspan="2">


                    <center>   
                    <form method="POST" action="#" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="39" style="background-color: #EAFAF1;"><center><h3>ข้อมูลเครื่องปรับอากาศ_t1</h3></center></td>
                        </tr>
                        <tr>
                            <td ><center>ลำดับ<br>ที่</center></td>
                            <td ><center>ชื่ออาคาร</center></td>
                            <td ><center>ชื่อห้อง</center></td>
                            <td ><center>มิเตอร์</center></td>
                            <td ><center>ประเภทห้อง</center></td>
                            <td ><center>ชั้น</center></td>
                            <td ><center>พื้นที่<br>ปรับอากาศ<br>(ตรม.)</center></td>
                            <td ><center>ชนิด<br>เครื่อง<br>ปรับ<br>อากาศ</center></td>
                            <td ><center>ขนาด<br>(Btu/hr-ชุด)</center></td>
                            <td ><center>กำลัง<br>ไฟฟ้า<br>ที่ใช้<br>(kW/ชุด)</center></td>
                            <td ><center>จำ<br>นวน<br>(ตัว)</center></td>
                            <td ><center>ปี<br>ติดตั้ง</center></td>
                            <td ><center>อายุ<br>(ปี)</center></td>
                            <td ><center>ชั่วโมง<br>ใช้งาน<br>(ชม./วัน)</center></td>
                            <td ><center>วัน<br>ใช้งาน<br>(วัน/ปี)</center></td>
                            <td ><center>Factor</center></td>
                            <td ><center>สัญ<br>ลักษณ์<br>เครื่อง<br>ปรับอากาศ</center></td>
                            <td ><center>ยี่ห้อ</center></td>
                            <td ><center>ยี่ห้อ</center></td>
                            <td ><center>สัญ<br>ลักษณ์<br>การ<br>ติดตั้ง</center></td>
                            <td ><center>จำ<br>นวน<br>เฟส</center></td>
                            <td ><center>ชนิด<br>เทอร์โม<br>สตัท</center></td>
                            <td ><center>อุณหภูมิที่ตั้ง</center></td>
                            <td ><center>ความเร็วลม<br>(ft/min)</center></td>
                            <td ><center>RH (%)<br>(RHr)</center></td>
                            <td ><center>RH (%)<br>(RHs.)</center></td>
                            <td ><center>Temp (oF)<br>(Tr)</center></td>
                            <td ><center>Temp (oF)<br>(Ts)</center></td>
                            <td ><center>kW</center></td>      
                            <td ><center>V</center></td> 
                            <td ><center>Ir A</center></td> 
                            <td ><center>Is A</center></td> 
                            <td ><center>It A</center></td>
                            <td ><center>PF</center></td>
                            <td ><center>kW รวม</center></td>  
                            <td ><center>kWh/ปี</center></td>
                            <td ><center>บาทต่อปี</center></td>
                            <td ><center>BTUรวม</center></td>   
                            <td ><center>ตำแหน่ง<br>ชั้น<br>บนสุด<br>ตรม.</center></td>                 
                        </tr> 
                        <?php $k=0;  ?> 
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.airconditioner_t1 
                                WHERE off_id = $off_id AND year = $year ")); as $data)
                        <tr>
                            <td ><center><?php echo $k+1; ?></center></td>
                            <td ><center><?php  echo $data->location; ?></center></td>
                            <td ><center><?php  echo $data->room_name; ?></center></td>
                            <td ><center><?php  echo $data->id_meter; ?></center></td>
                            <td ><center><?php  echo $data->room_type; ?></center></td>
                            <td ><center><?php  echo $data->floor; ?></center></td>
                            <td ><center><?php  echo $data->aircon_area; ?></center></td>
                            <td ><center><?php  echo $data->aircon_type; ?></center></td>
                            <td ><center><?php  echo $data->btu_hr_machine; ?></center></td>
                            <td ><center><?php  echo $data->kw_per_machine; ?></center></td>
                            <td ><center><?php  echo $data->amount; ?></center></td>
                            <td ><center><?php  echo $data->year_setting; ?></center></td>
                            <td ><center><?php  echo $data->age; ?></center></td>
                            <td ><center><?php  echo $data->work_hours_per_day; ?></center></td>
                            <td ><center><?php  echo $data->work_days_per_year; ?></center></td>
                            <td ><center><?php  echo $data->factor; ?></center></td>
                            <td ><center><?php  echo $data->symbol1; ?></center></td>
                            <td ><center><?php  echo $data->brand1; ?></center></td>
                            <td ><center><?php  echo $data->brand2; ?></center></td>
                            <td ><center><?php  echo $data->symbol2; ?></center></td>
                            <td ><center><?php  echo $data->phase_total; ?></center></td>
                            <td ><center><?php  echo $data->thermo_type; ?></center></td>
                            <td ><center><?php  echo $data->room_temp; ?></center></td>
                            <td ><center><?php  echo $data->ft_min; ?></center></td>
                            <td ><center><?php  echo $data->rhr; ?></center></td>
                            <td ><center><?php  echo $data->rhs; ?></center></td>
                            <td ><center><?php  echo $data->tr; ?></center></td>
                            <td ><center><?php  echo $data->ts; ?></center></td>
                            <td ><center><?php  echo $data->kw; ?></center></td>
                            <td ><center><?php  echo $data->v; ?></center></td>
                            <td ><center><?php  echo $data->iir; ?></center></td>
                            <td ><center><?php  echo $data->iis; ?></center></td>
                            <td ><center><?php  echo $data->iit; ?></center></td>
                            <td ><center><?php  echo $data->pf; ?></center></td>
                            <td ><center><?php  echo $data->total_kw; ?></center></td>
                            <td ><center><?php  echo $data->kwh_per_year; ?></center></td>
                            <td ><center><?php  echo $data->bath_per_year; ?></center></td>
                            <td ><center><?php  echo $data->total_btu; ?></center></td>
                            <td ><center><?php  echo $data->area_on_top; ?></center></td>
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












@endif
@endsection