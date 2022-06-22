@extends('layouts.app')

@section('content')

@if ( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th')
<script type="text/javascript" src="js/jscharts.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                        <h4>ระบบสำรวจการใช้พลังงานมหาวิทยาลัยเชียงใหม่</h4>
                        @foreach( $data as $value )
                        <center><h3><?php  echo $value->location; ?></h3></center>
                    </center>
                </div>
                
                <div class="panel-body">
<!--            <p>

                <a href="{{ url('import_excel_view_airconditioner_t1'.'&'.$value->off_id) }}"> ข้อมูลเครื่องปรับอากาศ_1</a>||
                <a href="{{ url('import_excel_view_airconditioner_t2'.'&'.$value->off_id) }} "> ข้อมูลเครื่องปรับอากาศ_2</a>||
                <a href="{{ url('import_excel_view_elamp_t1'.'&'.$value->off_id) }}"> ระบบแสงสว่าง_t1</a>||
                <a href="{{ url('import_excel_view_elamp_t2'.'&'.$value->off_id) }}"> ระบบแสงสว่าง_t2</a>||
                <a href="# "> สัดส่วน </a></p> -->

                <p>
                <a href="{{ url('/home') }}">หน้าหลัก</a>
                ||&nbsp;<a href="{{ url('/admin_excel_menu'.'&'.$value->off_id) }}">สร้างรายงานใหม่</a>
                </p>
                @endforeach 
                </div>
            </div>

            <br>
            
            <div class="panel-body">

                    <?php 
                    $year_c  = date("Y")+543;
                    $year_c2  = date("Y");
                    $off_id = request()->route()->off_id; ?>

                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                    FROM audit_cmu.audit_db 
                                    WHERE off_id = $off_id ")); as $db)

                    @if(empty(DB::connection($db->db_name)->select("SELECT * FROM report_year WHERE off_id = $off_id"))) 

                    <form action="{{ url('/admin_excel_new_report') }}" method="post">    
                    {!! csrf_field() !!}

                    <center>
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
                                    <input type="hidden" name="off_id" value="<?php echo $off_id ?>" >
                            </td>
                        </tr>
                    </table>
                    <br>
                    </center>
                    </form>

                    <br>

                    <center>
                    <table border="1" width="80%" > 
                        <tr>
                            <td style="background-color: #EAFAF1;"><center>ลำดับที่</center></td>
                            <td style="background-color: #EAFAF1;"><center>รายการ</center></td>
                        </tr>
                        <tr>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>&nbsp;</center></td>
                        </tr>
                    </table>
                    </center>

                    @else


                    <form action="{{ url('/admin_excel_new_report') }}" method="post">
                    {!! csrf_field() !!}

                    <center>
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
                                <input type="hidden" name="off_id" value="<?php echo $off_id ?>" >
                                
                            </td>
                        </tr>
                    </table>
                    <br>
                    </center>
                    </form>

                    <br>
                   
                    <center>
                    <table border="1" width="80%" > 
                        <tr>
                            <td style="background-color: #EAFAF1;"><center>ลำดับที่</center></td>
                            <td style="background-color: #EAFAF1;"><center>รายการ</center></td>
                        </tr>
                    <?php $k=0; ?>   
                    
                    @foreach($report as $re)
                       
                        <tr>
                            <td ><center><?php $k=$k+1; echo $k; ?></center></td>
                            <td ><center><a href="{{ url('import_excel_view_general'.'&'.$re->off_id.'&'.$re->year) }}">รายงานประจำปี {{ $re->year }}</a></center></td>
                        </tr>
                    @endforeach
                    </table>
                    </center>       
                    <?PHP //echo $off_id . " / " ;  echo date("Y")+543; ?>

                    @endif
                    @endforeach
                    <br>
                    <center>
                        <table border="1" width="80%" > 
                            <tr>
                                <td  style="color:red;"><center><h3>ตั้งแต่ปี 2565 เป็นต้นไปข้อมูลจะแสดงเป็นระบบ Realtime <a href="{{ url('view_all_charts_realtime'.'&'.$re->off_id.'&'.$year_c2) }}">(คลิ๊กที่นี่)</h3></a></center></td>
                            </tr>
                        
                        </table>
                    </center>       
            </div>    


            
        </div>
    </div>
</div>
@endif
@endsection
