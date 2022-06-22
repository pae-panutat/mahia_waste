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
                $opdate = request()->route()->opdate;
                $opdate = date('Y-m-d', strtotime($opdate));
                $yearth = date('Y', strtotime($opdate+543));
                $cus_id = request()->route()->id;
                //echo date('Y-m-d', strtotime($opdate));
                ?>
                <br>
                <div class="panel-body">
                <center>
                    <h3>เอกสารรายงานการเปรียบเทียบประสิทธิภาพก่อนและหลังล้างเครื่องปรับอากาศ</h3>
                </center>     
                <br>
                <center> <a href="{{ url('/home') }}"> หน้าแรก </a> | <a href="{{ url('customer_report_year_detail'.'&'.$cus_id.'&'.$yearth) }}"> ก่อนหน้า </a> </center>
                <br>
                <br>

                <center>
                <table border="1" width="60%">
                @foreach (DB::SELECT(DB::raw("SELECT *
                                FROM smart_wash_air_con.customer
                                JOIN smart_wash_air_con.measure_performance 
                                ON smart_wash_air_con.customer.id = smart_wash_air_con.measure_performance.cus_id
                                WHERE smart_wash_air_con.measure_performance.cus_id = '$cus_id' 
                                AND smart_wash_air_con.measure_performance.operation_date = '$opdate' 
                                LIMIT 1   
                        ")); as $data)
                <tr>
                    <td width="30%">ชื่อลูกค้า</td>
                    <td><?php echo($data->customer_name); ?></td>
                </tr>
                <tr>
                    <td width="30%">ที่อยู่</td>
                    <td><?php echo ($data->address); ?></td>
                </tr>
                <tr>
                    <td width="30%">วันที่เข้าดำเนินการ</td>
                    <td><?php echo ($data->operation_date); ?></td>
                </tr>
                <tr>
                    <td width="30%">โทรศัพท์</td>
                    <td><?php echo ($data->tel1); ?></td>
                </tr>
                <tr>
                    <td width="30%">โทรสาร</td>
                    <td><?php echo ($data->tel2); ?></td>
                </tr>
                <tr>
                    <td width="30%">อีเมล</td>
                    <td><?php echo ($data->email); ?></td>
                </tr>
                
                @endforeach
                </table>  
                </center>  
                <br>
<!-- ======================================================================================================================== -->
@if(empty(DB::SELECT(DB::raw("SELECT * 
                                FROM smart_wash_air_con.measure_performance 
                                WHERE cus_id ='$cus_id' and operation_date ='$opdate'")))) 


                <div class="panel-body">
                    <br>
                    
                    <center><h3>ยังไม่มีข้อมูล<h3><center>
                    <center><h3>อัพโหลดExcel:ข้อมูล สรุปรายการตรวจวัดประสิทธิภาพ ก่อนและหลังการล้างทำความสะอาดเครื่องปรับอากาศ<h3><center>

                    {!! Form::open(array('route' => 'customer_excel_measure_performance','method'=>'POST','files'=>'true')) !!}

                    {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}

                    {!! Form::file('sample_file', array('class' => 'form-control')) !!}

                    {!! Form::hidden('cus_id', $cus_id ) !!}
                    {!! Form::hidden('year_info', $yearth ) !!}
                    {!! Form::hidden('opdate', $opdate ) !!}

                    {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
@else     
        <br>
        <br>
        <br>
        <center> 
        <h4><b>สรุปรายการตรวจวัดประสิทธิภาพ ก่อนและหลังการล้างทำความสะอาดเครื่องปรับอากาศ</b></h4>   
        <br>
        <table border="0" width="90%" >
        <tr>
        <td align="left"> 
            <a href="{{ url('customer_excel_del_measure_performance'.'&'.$cus_id.'&'.$opdate) }}" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a>

        </td>

        <td align="right"> 
              
            <a href="#" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>             
        </td>
        </tr>
        <tr>
        <td  colspan="2">

                <center>
                <table border="1" width="100%">
                
                <tr> 
                    <th rowspan="2"><center>ที่</center></th> 
                    <th rowspan="2"><center>ยี่ห้อเครื่องปรับอากาศ</center></th> 
                    <th rowspan="2"><center>ขนาด<br>(BTU)</center></th> 
                    <th rowspan="2"><center>จำนวน</center></th> 
                    <th rowspan="2"><center>ชนิด</center></th> 
                    <th rowspan="2"><center>ชื่อห้อง/อาคาร</center></th>
                    <th colspan="2"><center>วัด<br>พลังงาน</center></th> 
                    <th colspan="2"><center>วัดน้ำยา<br>(R22)</center></th> 
                    <th colspan="2"><center>วัด<br>ความเร็วลม</center></th> 
                    <th colspan="2"><center>วัด<br>ความชื้น</center></th> 
                    <th rowspan="2"><center>หมายเหตุ</center></th>
                </tr> 
                <tr> 
                    <th><center>ก่อน<br>(Kw)</center></th> 
                    <th><center>หลัง<br>(Kw)</center></th> 
                    <th><center>ก่อน<br>(PSI)</center></th> 
                    <th><center>หลัง<br>(PSI)</center></th> 
                    <th><center>ก่อน<br>(m/s)</center></th> 
                    <th><center>หลัง<br>(m/s)</center></th> 
                    <th><center>ก่อน<br>(%RH)</center></th> 
                    <th><center>หลัง<br>(%RH)</center></th>            
                </tr> 
                <?php $k=0; ?>  
                @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM smart_wash_air_con.measure_performance 
                                WHERE cus_id = '$cus_id' and operation_date = '$opdate'")); as $re)
                <tr> 
                    <td><center><?php $k=$k+1; echo $k; ?></center></td> 
                    <td><center><?php echo $re->aircon_brand; ?></center></td> 
                    <td><center><?php echo $re->btu; ?></center></td> 
                    <td><center><?php echo $re->number; ?></center></td> 
                    <td><center><?php echo $re->aircon_type; ?></center></td> 
                    <td><center><?php echo $re->place; ?></center></td>
                    <td><center><?php echo $re->power_before; ?></center></td>
                    <td><center><?php echo $re->power_after; ?></center></td>
                    <td><center><?php echo $re->solution_before; ?></center></td>
                    <td><center><?php echo $re->solution_after; ?></center></td>
                    <td><center><?php echo $re->windspeed_before; ?></center></td>
                    <td><center><?php echo $re->windspeed_after; ?></center></td>   
                    <td><center><?php echo $re->humidity_before; ?></center></td>
                    <td><center><?php echo $re->humidity_after; ?></center></td>    
                    <td><center><?php echo $re->note; ?></center></td>               
                </tr>
                @endforeach
                </table>
        </td>
        </tr>
        </table>
                <br><br><br>

@if(empty(DB::connection('smart_wash_air_con')->select("SELECT * 
                            FROM solution_demand
                            WHERE cus_id = $cus_id AND operation_date = '$opdate'"))) 

                <form action="{{ url('customer_excel_solution_insert') }}" method="post">
                {{ csrf_field() }}
                <table border="0" whide="60%">
                <input type="hidden" name="user_ID" value="{{ Auth::user()->id }}">	
                <input type="hidden" name="cus_id" value="{{ $cus_id }}">
                <input type="hidden" name="year_info" value="{{ $yearth }}">
                <input type="hidden" name="opdate" value="{{ $opdate }}">	
               	<tr>            
                <!-- ============================ -->
                <td>    
                  <input type="checkbox" name="solution_used_ck" value="1">&nbsp;&nbsp;
                </td>
                <td>  
                  เติมน้ำยาเครื่องปรับอากาศ ปริมาณ &nbsp;&nbsp;
                </td>
                <td> <input class="form-control" type="number" step="0.01" style="width: 5em" name="solution_used" placeholder="0" value="" > </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td> <input class="form-control" type="text"  name="solution_used_unit" placeholder="หน่วย" value="" size="8"> </td>
                <!-- ============================ -->
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <!-- ============================ -->
                <td>  
                  <input type="checkbox" name="disinfectant_used_ck" value="1">&nbsp;&nbsp;
                </td>  
                <td>  
                  ใช้น้ำยาฆ่าเชื้อโรค ปริมาณ &nbsp;&nbsp;
                </td>
                <td> <input class="form-control" type="number" step="0.01" style="width: 5em" name="disinfectant_used" placeholder="0" value="" > </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td> <input class="form-control" type="text" name="disinfectant_used_unit" placeholder="หน่วย" value="" size="8"> </td>
                <!-- ============================ -->
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <!-- ============================ -->
                <td>
                	<input type="submit" name="submit_solution_insert" value="แก้ไขข้อมูล|Submit"> </center>
                </td>
                <!-- ============================ -->
                </tr>
                </table>
                </form>

@else

                @foreach (DB::SELECT(DB::raw("SELECT * 
                            FROM smart_wash_air_con.solution_demand
                            WHERE cus_id = '$cus_id' AND operation_date = '$opdate' ")); as $data)

                <form action="{{ url('customer_excel_solution_update') }}" method="post">
                {{ csrf_field() }}

                <table border="0" whide="60%">
                <input type="hidden" name="user_ID" value="{{ Auth::user()->id }}">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" name="cus_id" value="{{ $cus_id }}">
				<input type="hidden" name="year_info" value="{{ $yearth }}">	
                <input type="hidden" name="opdate" value="{{ $opdate }}">	

               	<tr>            
                <!-- ============================ -->
                <td>    
                  <input type="checkbox" name="solution_used_ck" onclick="return false;" value="1" <?php if($data->solution_used_ck == '1'){ echo 'checked="checked"'; } ?> > &nbsp;&nbsp;
                </td>
                <td>  
                  เติมน้ำยาเครื่องปรับอากาศ ปริมาณ &nbsp;&nbsp;
                </td>
                <td> <input class="form-control" type="number" step="0.01" style="width: 5em" 
                	name="solution_used" placeholder="0" value="{{ $data->solution_used }}" > </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td> <input class="form-control" type="text"  name="solution_used_unit" 
                	placeholder="หน่วย" value="{{ $data->solution_used_unit }}" size="8"> </td>
                <!-- ============================ -->
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <!-- ============================ -->
                <td>  
                  <input type="checkbox" name="disinfectant_used_ck" onclick="return false;" value="1" <?php if($data->disinfectant_used_ck == '1'){ echo 'checked="checked" '; }?> >&nbsp;&nbsp;
                </td>  
                <td>  
                  ใช้น้ำยาฆ่าเชื้อโรค ปริมาณ &nbsp;&nbsp;
                </td>
                <td> <input class="form-control" type="number" step="0.01" 
                	style="width: 5em" name="disinfectant_used" placeholder="0" value="{{ $data->disinfectant_used }}" > </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td> <input class="form-control" type="text" name="disinfectant_used_unit" 
                	placeholder="หน่วย" value="{{ $data->disinfectant_used_unit }}" size="8"> </td>	
                <!-- ============================ -->
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <!-- ============================ -->
                <td>
                	<input type="submit" name="submit_solution_update" value="แก้ไขข้อมูล|Update"> </center>
                </td>
                <!-- ============================ -->
                </tr>

                </table>
                </form>
                @endforeach   
                <br><br>

@endif  

            <!-- suggest -->
                @if(empty(DB::connection('smart_wash_air_con')->select("SELECT * 
                            FROM suggestion
                            WHERE cus_id = $cus_id AND operation_date = '$opdate'"))) 

                <center>            
                <table border="0" width="90%" >
                <tr>
                <td align="left"> 
                   &nbsp;
                </td>
                <td align="right"> 
                    &nbsp;           
                </td>
                </tr>
                <tr>
                <td  colspan="2" align="center">

                        <form action="{{ url('customer_sugest_insert') }}" id="usrform" method="post">
                        {{ csrf_field() }}   

                        <table border="0" whide="100%">
                        <!-- ============================ -->    
                        <tr>
                        <td>
                            <h4><b>คำแนะนำ</b></h4>
                        </td>
                        </tr> 
                        <!-- ============================ -->
                        <tr>
                        <td>
                            <textarea class="form-control" style="resize:none" rows="10" cols="150" placeholder="คำแนะนำ"  name="suggestion_note">
                            </textarea>
                        </td>
                        </tr>  
                        <!-- ============================ --> 
                        <tr>
                        <td align="right">

                        <input type="hidden" name="user_ID" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="cus_id" value="{{ $cus_id }}">
                        <input type="hidden" name="year_info" value="{{ $yearth }}"> 
                        <input type="hidden" name="opdate" value="{{ $opdate }}">

                        <input type="submit" name="submit_sugest_insert" value="แก้ไขข้อมูล|Update"> </center>
                        </td>
                        </tr>
                        </table>   
                        </form>
                </td>
                </tr>
                </table>
                </center>

                @else


                <center>            
                <table border="0" width="90%" >
                <tr>
                <td align="left"> 
                   &nbsp;
                </td>
                <td align="right"> 
                    &nbsp;           
                </td>
                </tr>
                <tr>
                <td  colspan="2" align="center">

                        @foreach (DB::SELECT(DB::raw("SELECT * 
                            FROM smart_wash_air_con.suggestion
                            WHERE cus_id = '$cus_id' AND operation_date = '$opdate' ")); as $data)

                        <form action="{{ url('customer_sugest_update') }}" id="usrform" method="post">
                        {{ csrf_field() }}   

                        <table border="0" whide="100%">
                        <!-- ============================ -->    
                        <tr>
                        <td>
                            <h4><b>คำแนะนำ</b></h4>
                        </td>
                        </tr> 
                        <!-- ============================ -->
                        <tr>
                        <td>
                            <textarea class="form-control" style="resize:none" rows="10" cols="150" placeholder="คำแนะนำ" name="suggestion_note">
                            {{ $data->suggestion_note }}
                            </textarea>
                        </td>
                        </tr>  
                        <!-- ============================ --> 
                        <tr>
                        <td align="right">

                        <input type="hidden" name="user_ID" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="cus_id" value="{{ $cus_id }}">
                        <input type="hidden" name="year_info" value="{{ $yearth }}"> 
                        <input type="hidden" name="opdate" value="{{ $opdate }}">

                        <input type="submit" name="submit_sugest_insert" value="แก้ไขข้อมูล|Update"> </center>
                        </td>
                        </tr>
                        </table>   
                        </form>
                        @endforeach 
                </td>
                </tr>
                </table>
                </center>

                @endif 
                <br><br>

            <!-- pictures Building -->

                <h4><b>รูปอาคาร/สถาณที่ปฏิบัติงาน<b></h4>  
                @if(empty(DB::connection('smart_wash_air_con')->select("SELECT * 
                            FROM picture_building
                            WHERE cus_id = $cus_id AND operation_date = '$opdate'"))) 

                    <br><a href="{{url('customer_picture_building_new'.'&'.$cus_id.'&'.$opdate)}}">เพิ่มข้อมูล</a><br>          

                @else

                    <br><a href="{{url('customer_picture_building_new'.'&'.$cus_id.'&'.$opdate)}}">แก้ไขข้อมูล</a><br>

                    <!-- <iframe name="picture_demo" src="{{ url('customer_picture_place') }}" width="100%" height="540" style="overflow: hidden; border: 1" scrolling="no"></iframe> -->

                @endif
                <br><br>
            <!-- pictures Building -->

                <h4><b>รูปบริเวณที่ปฏิบัติงาน<b></h4>  
                @if(empty(DB::connection('smart_wash_air_con')->select("SELECT * 
                            FROM picture_place
                            WHERE cus_id = $cus_id AND operation_date = '$opdate'"))) 

                    <br><a href="{{url('customer_picture_place_new'.'&'.$cus_id.'&'.$opdate)}}">เพิ่มข้อมูล</a><br>          

                @else

                    <br><a href="{{url('customer_picture_place_new'.'&'.$cus_id.'&'.$opdate)}}">แก้ไขข้อมูล</a><br>

                    <center>   
                    <table border="1" width="90%" >
                    <tr>
                    <td align="left"> 
                        ลำดับที่
                    </td>
                    <td align="left"> 
                        สถาที่
                    </td>
                    <td align="left"> 
                        แก้ไข
                    </td>
                    <td align="left"> 
                        ลบ
                    </td>
                    </tr>
                    </table>

                    </center>

                    <!-- <iframe name="picture_demo" src="{{ url('customer_picture_place') }}" width="100%" height="540" style="overflow: hidden; border: 1" scrolling="no"></iframe> -->

                @endif
                <br><br>


                </center>

@endif
                </div>
            </div>
        </div>  
    </div>
</div>  

@endif 

@endsection
