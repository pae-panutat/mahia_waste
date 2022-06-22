

<?php $__env->startSection('content'); ?>

<?php if( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th'): ?>
<script type="text/javascript" src="js/jscharts.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                        <h4>ระบบสำรวจการใช้พลังงานมหาวิทยาลัยเชียงใหม่</h4>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <center><h3><?php  echo $value->location; ?></h3></center>
                    </center>
                </div>
                
                <div class="panel-body">
<!--            <p>

                <a href="<?php echo e(url('import_excel_view_airconditioner_t1'.'&'.$value->off_id)); ?>"> ข้อมูลเครื่องปรับอากาศ_1</a>||
                <a href="<?php echo e(url('import_excel_view_airconditioner_t2'.'&'.$value->off_id)); ?> "> ข้อมูลเครื่องปรับอากาศ_2</a>||
                <a href="<?php echo e(url('import_excel_view_elamp_t1'.'&'.$value->off_id)); ?>"> ระบบแสงสว่าง_t1</a>||
                <a href="<?php echo e(url('import_excel_view_elamp_t2'.'&'.$value->off_id)); ?>"> ระบบแสงสว่าง_t2</a>||
                <a href="# "> สัดส่วน </a></p> -->

                <p>
                <a href="<?php echo e(url('/home')); ?>">หน้าหลัก</a>
                ||&nbsp;<a href="<?php echo e(url('/admin_excel_menu'.'&'.$value->off_id)); ?>">สร้างรายงานใหม่</a>
                </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
            </div>

            <br>
            
            <div class="panel-body">

                    <?php 
                    $year_c  = date("Y")+543;
                    $year_c2  = date("Y");
                    $off_id = request()->route()->off_id; ?>

                    <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                    FROM audit_cmu.audit_db 
                                    WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM report_year WHERE off_id = $off_id"))): ?> 

                    <form action="<?php echo e(url('/admin_excel_new_report')); ?>" method="post">    
                    <?php echo csrf_field(); ?>


                    <center>
                    <table border="0"> 
                        <tr>
                            <td valign="bottom">ข้อมูลปี&nbsp;</td>
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

                    <?php else: ?>


                    <form action="<?php echo e(url('/admin_excel_new_report')); ?>" method="post">
                    <?php echo csrf_field(); ?>


                    <center>
                    <table border="0"> 
                        <tr>
                            <td valign="bottom">ข้อมูลปี&nbsp;</td>
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
                    
                    <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $re): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                        <tr>
                            <td ><center><?php $k=$k+1; echo $k; ?></center></td>
                            <td ><center><a href="<?php echo e(url('import_excel_view_general'.'&'.$re->off_id.'&'.$re->year)); ?>">รายงานประจำปี <?php echo e($re->year); ?></a></center></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                    </center>       
                    <?PHP //echo $off_id . " / " ;  echo date("Y")+543; ?>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                    <center>
                        <table border="1" width="80%" > 
                            <tr>
                                <td  style="color:red;"><center><h3>ตั้งแต่ปี 2565 เป็นต้นไปข้อมูลจะแสดงเป็นระบบ Realtime <a href="<?php echo e(url('view_all_charts_realtime'.'&'.$re->off_id.'&'.$year_c2)); ?>">(คลิ๊กที่นี่)</h3></a></center></td>
                            </tr>
                        
                        </table>
                    </center>       
            </div>    


            
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>