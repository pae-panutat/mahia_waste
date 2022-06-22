@extends('layouts.app')

@section('content')
@if ( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" >
            <div class="panel panel-default" >
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
            <!-- ========================================================= -->
                <br>
                @if(empty(DB::connection($db->db_name)->select("SELECT * FROM expenses_t1 WHERE off_id = $off_id AND year = $year"))) 

                <div class="panel-body">

                    <center><h3>อัพโหลดExcel:ข้อมูลใช้พลังงานไฟฟ้าของอาคาร(ค่าไฟ)<h3><center>

                    {!! Form::open(array('route' => 'import_excel_expenses_t1','method'=>'POST','files'=>'true')) !!}

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

                <div class="panel-body">

                <center>    
                <table border="0" width="80%" >
                <tr>
                <td align="left">
                    <a href="{{ url('/import_excel_del_expenses_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a>   
                </td>

                <td align="right"> 
                    <a href="{{ url('/import_excel_view_expenses_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ข้อมูลค่าไฟ</a>
                    <a href="{{ url('/import_excel_view_expenses_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ข้อมูลหม้อแปลง</a> 
                    <a href="{{ url('/export_file_expenses_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>                
                </td>
                </tr>
                <tr>
                <td  colspan="2">

                    <center>   
                    <form method="POST" action="{{ url('/import_excel_edit_expenses_t1'.'&'.$off_id.'&'.$year) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="6" style="background-color: #EAFAF1;"><center><h3>ข้อมูลการใช้พลังงานไฟฟ้าของอาคาร (ค่าไฟ)</h3></center></td>
                        </tr>
                        <tr>
                            <td width="15%"><center>หมายเลข<br>มิเตอร์</center></td>
                            <td width="15%"><center>เดือน</center></td>
                            <td width="15%"><center>ความต้องการ<br>ไฟฟ้าสูงสุด<br>(กิโลวัตต์)</center></td>
                            <td width="15%"><center>พลังงานไฟฟ้า<br>(กิโลวัตต์+ชั่วโมง)</center></td>
                            <td width="20%"><center>ค่าไฟฟ้า<br>(บาท)</center></td>
                            <td width="20%"><center>ค่าไฟฟ้าเฉลี่ย<br>(บาท/กิโลวัตต์+ชั่วโมง)</center></td>
                            
                        </tr>
                        <?php $k=0; ?> 
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.expenses_t1 
                                WHERE off_id = $off_id AND year = $year ")); as $data)
                        <tr>        
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->id }}" value="{{ $data->id }}" />
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->off_id }}" value="{{ $data->off_id }}" />
                            <input type="hidden" name="data[{{$k}}][]" id="{{ $data->year }}" value="{{ $data->year }}" />
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="id_meter" value="{{ $data->id_meter }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="date_info" value="{{ $data->date_info }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="kw_peak" value="{{ $data->kw_peak }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="kwh" value="{{ $data->kwh }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="expenses_bath" value="{{ $data->expenses_bath }}" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[{{$k}}][]" placeholder="unit_bath" value="{{ $data->unit_bath }}" ></center></td>
                        </tr>
                        <?php $k=$k+1; ?>
                        @endforeach
                        
                    </table>
                      <div class="form-group">
                          <br>
                          <button type="submit" id="save" class="btn btn-default">แก้ไขข้อมูล|Submit</button>
                      </div>
                    </form>
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
@endif
@endsection
