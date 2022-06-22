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
                @if(empty(DB::connection($db->db_name)->select("SELECT * FROM airconditioner_t2 WHERE off_id = $off_id AND year = $year"))) 

                <div class="panel-body">

                    <center><h3>อัพโหลดExcel:ตารางสรุปเครื่องปรับอากาศ<h3><center>


                    {!! Form::open(array('route' => 'import_excel_airconditioner_t2','method'=>'POST','files'=>'true')) !!}

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
                    <a href="{{ url('/import_excel_del_airconditioner_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a> 
                </td>

                <td align="right"> 
                    <a href="{{ url('/import_excel_view_airconditioner_t1'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางเครื่องปรับอากาศ</a>
                    <a href="{{ url('/import_excel_view_airconditioner_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3498DB; color:white;">ตารางสรุปเครื่องปรับอากาศ</a>
                    <a href="{{ url('/export_file_airconditioner_t2'.'&'.$off_id.'&'.$year) }}" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>                
                </td>
                </tr>
                <tr>
                <td  colspan="2">


                    <center>   
                    <form method="POST" action="#" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="9" style="background-color: #EAFAF1;"><center><h3>สรุปเครื่องปรับอากาศ</h3></center></td>
                        </tr>
                        <tr>
                            <td ><center>ขนาดเครื่องปรับอากาศ<br>(btu/ชั่วโมง)</center></td>
                            <td ><center>ชนิดเครื่องปรับอากาศ</center></td>
                            <td ><center>อายุ<br><3 ปี</center></td>
                            <td ><center>อายุ<br>3-5 ปี</center></td>
                            <td ><center>อายุ<br>6-7 ปี</center></td>
                            <td ><center>อายุ<br>8-9 ปี</center></td>
                            <td ><center>อายุ<br><10 ปี</center></td>
                            <td ><center>จำนวน<br>(ตัว)</center></td>
                            <td ><center>รวมทั้งหมด<br>(btu/ชั่วโมง)</center></td>
                        </tr> 
                        <?php $k=0;  ?> 
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.airconditioner_t2 
                                WHERE off_id = $off_id AND year = $year ")); as $data)
                        <tr>
                            <td ><center><?php  echo $data->btu_per_hour; ?></center></td>
                            <td ><center><?php  echo $data->aircon_type; ?></center></td>
                            <td ><center><?php  echo $data->year_less_3; ?></center></td>
                            <td ><center><?php  echo $data->year3to5; ?></center></td>
                            <td ><center><?php  echo $data->year6to7; ?></center></td>
                            <td ><center><?php  echo $data->year8to9; ?></center></td>
                            <td ><center><?php  echo $data->year_more_10; ?></center></td>
                            <td ><center><?php  echo $data->amount; ?></center></td>
                            <td ><center><?php  echo $data->total_btu_per_hour; ?></center></td>
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
