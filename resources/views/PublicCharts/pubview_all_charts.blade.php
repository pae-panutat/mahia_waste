@extends('layouts.app')

@section('content')
<script type="text/javascript" src="js/jscharts.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                        <h4>ภาพรวมทุกคณะในมหาวิทยาลัยเชียงใหม่</h4>
                    </center>
                </div>
                <br>
                <div class="panel-body">
                <center>

                <table border="0" width="80%" >
                <tr>
                <td width="50%">    
                    <a href="{{ url('/publicDash') }}" class="btn" style="background-color:#8533ff; color:white;">Home</a> 
                    <a href="{{ url('/public_analyticChart') }}" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a> 
                </td>
                <td width="50%"> 
                    &nbsp;
                </td>
                </tr>
                </table>

                    <br>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <div class="panel-body">
                <center>
                <?php $yearc  = date("Y")+543; ?>    
                        
                    <form action="{{ url('/public_analyticYear') }}" method="post">      
                    {!! csrf_field() !!}

                    <center>
                    <table border="0"> 
                        <tr>
                            <td valign="bottom">เลือกปี&nbsp;</td>
                            <td valign="bottom">
                                &nbsp;
                                <select name="year_info" id="year_info">
                                <option value=" <?PHP echo $yearc;?> "><?PHP echo $yearc; ?></option>

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
                    <br>
                    <iframe name="pubchart_demo1" src="{{url('/pubview_all_charts&'.$yearc)}}" width="50%" height="460" style="overflow: hidden; border: 0" scrolling="no"></iframe>



                    </center>
                    <hr>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





            </div>
        </div>
    </div>
</div>
@endsection

