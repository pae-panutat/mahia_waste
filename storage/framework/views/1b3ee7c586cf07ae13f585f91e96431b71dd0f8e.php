

<?php $__env->startSection('content'); ?>
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
                <br>
                <div class="panel-body">
                <center>
                <table border="0" width="80%" >
                <tr>
                <td width="50%">    
                    <a href="<?php echo e(url('/public_analyticChart')); ?>" class="btn" style="background-color:#8533ff; color:white;">
                    กราฟภาพรวมมหาวิทยาลัยเชียงใหม่</a>
                    <a href="<?php echo e(url('/pub')); ?>" class="btn" style="background-color:#8533ff; color:white;">แต่ละส่วนงาน</a> 
                    &nbsp;
                </td>
                <td width="50%"> 
                    <br>
                    &nbsp;
                </td>
                </tr>
                <tr>
                <td colspan="2">
                       
                    <?php if(!empty($yearc)): ?>
                        <?php 
                        $yearc=$yearc;  
                        $year_c=$yearc;

                        $SumAirConPerYear=$SumAirConPerYear;
                        $SumEquipPerYear=$SumEquipPerYear;
                        $SumElampPerYear=$SumElampPerYear;
                        $SumOtherPerYear=$SumOtherPerYear;

                        ?> 
                    <?php else: ?>
                        <?php 
                        $year_c  = date("Y")+542; 
                        $yearc = $year_c;

                        $SumAirConPerYear=0;
                        $SumEquipPerYear=0;
                        $SumElampPerYear=0;
                        $SumOtherPerYear=0;
                        ?> 
                    <?php endif; ?>    
                    <!-- <h3>ตารางสรุปข้อมูลปี 2562 </h3> -->
                    <form action="<?php echo e(url('/public_analyticChartYear')); ?>" method="post">      
                    <?php echo csrf_field(); ?>


                    <center>
                    <table border="0"> 
                        <tr>
                            <td valign="bottom">เลือกปี&nbsp;</td>
                            <td valign="bottom">
                                &nbsp;
                                <select name="year_info" id="year_info">
                                <option value=" <?PHP echo $year_c;?> "><?PHP echo $year_c; ?></option>

                                <?php for($i=0; $i<=100; $i++): ?>
                                <option value="<?PHP echo date("Y")-$i+543; ?>">
                                    <?PHP echo date("Y")-$i+543; ?></option>
                                <?php endfor; ?>
                                </select>
                                &nbsp;
                            </td>
                            <td valign="bottom">
                                &nbsp;
                                <input type="hidden" id="SumAirConPerYear" name="SumAirConPerYear" value="$SumAirConPerYear">
                                <input type="hidden" id="SumEquipPerYear" name="SumEquipPerYear" value="$SumEquipPerYear">
                                <input type="hidden" id="SumElampPerYear" name="SumElampPerYear" value="$SumElampPerYear">
                                <input type="hidden" id="SumOtherPerYear" name="SumOtherPerYear" value="$SumOtherPerYear">
                                <center><input type="submit" value="Submit"></center>
                                
                            </td>
                        </tr>
                    </table>
                    <br>
                    </center>
                    </form>                       
                </td>
                </tr>
                </table>

                <center>
                    <?php //echo $yearc;?>
                    ภาพรวมทุกคณะในมหาวิทยาลัยเชียงใหม่
                    <iframe name="chart_demo1" src="<?php echo e(url('/pubchart1'.'&'.$yearc)); ?>" width="100%" height="360" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                </center>
                <hr>
                <center>
                    <?php //echo $yearc;?>
                    ดัชนีการใช้พลังงานรวมมหาวิทยาลัยเชียงใหม่
                    <iframe name="chart_demo2" src="<?php echo e(url('/pubchart2'.'&'.$yearc)); ?>" width="100%" height="660" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                </center>
                <hr>
                <center>
                    <?php //echo $yearc;?>
                    ดัชนีการใช้พลังงาน : ระบบปรับอากาศต่อพื้นที่
                    <iframe name="chart_demo3" src="<?php echo e(url('/pubchart3'.'&'.$yearc)); ?>" width="100%" height="660" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                </center>
                <hr>
                <center>
                    <?php //echo $yearc;?>
                    ดัชนีการใช้พลังงาน : ระบบอุปกรณ์ไฟฟ้าต่อพื้นที่
                    <iframe name="chart_demo4" src="<?php echo e(url('/pubchart4'.'&'.$yearc)); ?>" width="100%" height="660" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                </center>
                <hr>
                <center>
                    <?php //echo $yearc;?>
                    ดัชนีการใช้พลังงาน : ระบบแสงสว่างต่อพื้นที่
                    <iframe name="chart_demo5" src="<?php echo e(url('/pubchart5'.'&'.$yearc)); ?>" width="100%" height="660" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                </center>
                <hr>
                <center>
                    <?php //echo $yearc;?>
                    ดัชนีการใช้พลังงาน : ระบบอื่นๆ ต่อพื้นที่
                    <iframe name="chart_demo5" src="<?php echo e(url('/pubchart6'.'&'.$yearc)); ?>" width="100%" height="660" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                </center>






                </div>


















            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>