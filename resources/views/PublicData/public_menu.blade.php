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
                        @foreach( $data as $value )
                        <center><h3><?php  echo $value->location; ?></h3></center>
                    </center>
                </div>
                
                <div class="panel-body">
                <p>


                <a href="{{ url('/public') }}" class="btn" style="background-color:#3CBC8D; color:white;">หน้าหลัก</a>
                <a href="{{ url('/public_menu'.'&'.$value->off_id) }}" class="btn" style="background-color:#3CBC8D; color:white;">รายงานประจำปี</a>
                
                </p>
                @endforeach 
                </div>
            </div>

            <br>
            
            <div class="panel-body">

                    <?php 
                    $year_c  = date("Y")+543;
                    $off_id = request()->route()->off_id; ?>

                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                    FROM audit_cmu.audit_db 
                                    WHERE off_id = $off_id ")); as $db)
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
                            <td ><center><a href="{{ url('public_general'.'&'.$re->off_id.'&'.$re->year) }}">รายงานประจำปี {{ $re->year }}</a></center></td>
                        </tr>
                    @endforeach
                    </table>
                    </center>            

                    
                    @endforeach


            </div>    






            
        </div>
    </div>
</div>
@endsection
