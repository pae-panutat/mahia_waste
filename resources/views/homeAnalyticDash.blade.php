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
                @if ( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th')
                <br>
                <div class="panel-body">
                <center>
                <?php $year_c  = date("Y")+543; ?>    
                        <!-- <h3>ตารางสรุปข้อมูลปี 2562 </h3> -->
                  

                    <form action="{{ url('/analyticYear') }}" method="post">      
                    {!! csrf_field() !!}

                    <center>
                    <table border="0"> 
                        <tr>
                            <td valign="bottom">เลือกปี&nbsp;</td>
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
                                <center><input type="submit" value="Submit"></center>
                                
                            </td>
                        </tr>
                    </table>
                    <br>
                    </center>
                    </form>


                <table border="0" width="80%" >
                <tr>
                <td width="50%">    
                    <a href="{{ url('/indexDash') }}" class="btn" style="background-color:#8533ff; color:white;">Home</a> 
                    <a href="{{ url('/analyticDash') }}" class="btn" style="background-color:#8533ff; color:white;">AnalyticDash</a> 
                    <!-- <a href="{{ url('/public') }}" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a>  -->
                    <!-- <a href="{{ url('/analyticChart') }}" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a>  -->
                </td>
                <td width="50%"> 
                    &nbsp;
                </td>
                </tr>
                </table>
                <?php $k=0; $year_get=0;?>

                @foreach( $data as $valuey )
                 <?php $year_get = $valuey['year'] ?>
                @endforeach
                <br>
                
                <h3><b> ข้อมูลปี <?php echo $year_get; ?> </b></h3>
                <table border="1" width="80%">
                <thead class="cf">
                <tr>
                    <th scope="col" bgcolor="#e6b3ff"><center>ลำดับ<br>ที่</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>หน่วยงาน</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>kWh/เดือน</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>จำนวนคน</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>พื้นที่ปรับอากาศ</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>พื้นที่ไม่ปรับอากาศ</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>พื้นที่รวม</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>kWh/พท.ปรับอากาศ</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>kWh/พท.รวม</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>พท.รวม/จำนวนคน</center></th>
                    <th scope="col" bgcolor="#e6b3ff"><center>kWh/คน</center></th>
                </tr>
                </thead>
                <?php $k=0; ?>
                @foreach( $data as $value )
                <tr>
                    <td ><center><?php $k=$k+1; echo $k ;?></center></td>
                    <td align="center"><?php echo $value['location']; ?></td>
                    <td align="right"><?php echo number_format($value['kwh'],2); ?></td>
                    <td align="right"><?php echo $value['num_person']; ?></td>
                    <td align="right"><?php echo $value['air_area']; ?></td>
                    <td align="right"><?php echo $value['nonair_area']; ?></td>
                    <td align="right"><?php echo $value['used_area']; ?></td>
                    <td align="right">
                        <!-- kWh/พท.ปรับอากาศ -->
                        <?php
                        if($value['air_area']>0){
                        $kwh_per_air_area = $value['kwh']/$value['air_area'];
                        echo number_format($kwh_per_air_area,2);
                        }else{
                        echo "-";
                        }
                        ?>
                    </td>
                    <td align="right">
                        <!-- kWh/พท.รวม -->
                        <?php
                        if($value['used_area']>0){
                        $kwh_per_used_area = $value['kwh']/$value['used_area'];
                        echo number_format($kwh_per_used_area,2);
                        }else{
                        echo "-";
                        }
                        ?>
                    </td>
                    <td align="right">                        
                        <!-- พท.รวม/จำนวนคน -->
                        <?php
                        if($value['num_person']>0){
                        $used_area_per_person = $value['used_area']/$value['num_person'];
                        echo number_format($used_area_per_person,2);
                        }else{
                        echo "-";
                        }
                        ?>
                    </td>
                    <td align="right">
                        <!-- kwh/คน -->
                        <?php
                        if($value['num_person']>0){
                        $kwh_per_person = $value['kwh']/$value['num_person'];
                        echo number_format($kwh_per_person,2);
                        }else{
                        echo "-";
                        }
                        ?>
                    </td>
                </tr>    
                @endforeach 
                </table>










                </center>
                </div>
                @endif


















            </div>
        </div>
    </div>
</div>
@endsection
