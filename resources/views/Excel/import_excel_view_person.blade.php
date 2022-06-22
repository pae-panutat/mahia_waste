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
                    //echo $year;
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
            @if(empty(DB::connection($db->db_name)->select("SELECT * FROM person_info WHERE off_id = $off_id AND year = $year"))) 

                <div class="panel-body">
                <center>    
                <table border="0" width="80%" >
                <tr>
                <td align="left">    
                    &nbsp;              
                </td>
                <td align="right">    
                    &nbsp;           
                </td>
                </tr>

                <tr>
                <td colspan="2">  
                    <form action="{{ url('/import_excel_insert_person') }}" method="post">
                    {{ csrf_field() }}

                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.general_info 
                                WHERE off_id = $off_id AND year = $year ")); as $data)

                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <input type="hidden" name="off_id" value="{{ $off_id }}">
                    <center>
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="2" style="background-color: #EAFAF1;"><center><h3>ข้อมูลบุคลากร</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">ข้อมูลปี&nbsp;&nbsp;</td>
                            <td width="60%"><input type="text" class="form-control" name="year" placeholder="year" value="{{ $data->year }}" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">ชื่อหน่วยงาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="unit_name" placeholder="unit_name" value="{{ $data->unit_name }}" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">จำนวน พนักงาน/อาจารย์/นักศึกษา (คน) &nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="num_person" placeholder="num_person" value="" ></td>
                        </tr>
                    </table>
                    </center>
                    @endforeach
                    <br>
                    <center> <input type="submit" name="submit_person" value="บันทึกข้อมูล|Submit"> </center>
                    </form>

                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                </div>    

            @else 

                <br>
                <div class="panel-body">
                <center>    
                <table border="0" width="80%" >
                <tr>
                        @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM audit_cmu.audit_db 
                                WHERE off_id = $off_id ")); as $db)
                <td align="left">    
                    &nbsp;              
                </td>
                <td align="right">    
                    &nbsp;           
                </td>
                </tr>

                <tr>
                <td colspan="2">    

                    @if(!empty(DB::connection($db->db_name)->select("SELECT * FROM person_info WHERE off_id = $off_id AND year = $year "))) 

                    <form action="{{ url('/import_excel_edit_person') }}" method="post">
                    {{ csrf_field() }}

                    @foreach (DB::SELECT(DB::raw("SELECT 
                                person_info.id as id, 
                                general_info.off_id as off_id, 
                                general_info.year as year, 
                                general_info.unit_name as unit_name, 
                                person_info.num_person
                                FROM $db->db_name.general_info 
                                JOIN $db->db_name.person_info ON general_info.off_id = person_info.off_id
                                WHERE $db->db_name.person_info.off_id = $off_id AND $db->db_name.person_info.year = $year ")); as $data)

                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <input type="hidden" name="off_id" value="{{ $off_id }}">
                    <center>
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="2" style="background-color: #EAFAF1;"><center><h3>ข้อมูลบุคลากร</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">ข้อมูลปี&nbsp;&nbsp;</td>
                            <td width="60%"><input type="text" class="form-control" name="year" placeholder="year" value="{{ $data->year }}" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">ชื่อหน่วยงาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="unit_name" placeholder="unit_name" value="{{ $data->unit_name }}" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">จำนวน พนักงาน/อาจารย์/นักศึกษา (คน) &nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="num_person" placeholder="num_person" value="{{ $data->num_person }}" ></td>
                        </tr>
                    </table>
                    </center>
                    @endforeach
                    <br>
                    <center> <input type="submit" name="edit_person" value="แก้ไขข้อมูล|Submit"> </center>
                    </form>
                    @endif
                    @endforeach

                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                </div>                  

                @endif
                @endforeach
            <!-- ========================================================= -->





        </div>
    </div>
</div>
@endif
@endsection
