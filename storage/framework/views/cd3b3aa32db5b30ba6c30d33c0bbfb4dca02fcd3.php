

<?php $__env->startSection('content'); ?>

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
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                    FROM audit_cmu.audit_db 
                                    WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <h3><?php  echo $db->location; ?></h3>
                    </center>
                </div>
                <div class="panel-body">
                <p>
                <a href="<?php echo e(url('/public')); ?>" class="btn" style="background-color:#3CBC8D; color:white;">หน้าหลัก</a>        
                <a href="<?php echo e(url('/public_menu'.'&'.$off_id)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">รายงานประจำปี</a>
                <a href="<?php echo e(url('/each_pub_all_charts'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">สรุปการใช้พลังงาน</a>
                <br>  
                ||&nbsp;<a href="<?php echo e(url('/public_general'.'&'.$off_id.'&'.$year)); ?>">ข้อมูลทั่วไป</a>
                ||&nbsp;<a href="<?php echo e(url('/public_expenses_t1'.'&'.$off_id.'&'.$year)); ?> ">ข้อมูลการใช้พลังงานไฟฟ้าของอาคาร</a>
                ||&nbsp;<a href="<?php echo e(url('/public_building'.'&'.$off_id.'&'.$year)); ?>">ข้อมูลลักษณะอาคาร</a>
                ||&nbsp;<a href="<?php echo e(url('/public_equipment_t1'.'&'.$off_id.'&'.$year)); ?>">ข้อมูลอุปกรณ์ไฟฟ้า</a>
                ||&nbsp;<a href="<?php echo e(url('/public_airconditioner_t1'.'&'.$off_id.'&'.$year)); ?>"> ข้อมูลเครื่องปรับอากาศ</a>
                ||&nbsp;<a href="<?php echo e(url('/public_airchiller_t1'.'&'.$off_id.'&'.$year)); ?>"> ข้อมูลเครื่องปรับอากาศแบบAirchiller</a>
                ||&nbsp;<a href="<?php echo e(url('/public_elamp_t1'.'&'.$off_id.'&'.$year)); ?>"> ข้อมูลระบบแสงสว่าง</a>
                ||&nbsp;<a href="<?php echo e(url('/public_water_t1'.'&'.$off_id.'&'.$year)); ?>"> ข้อมูลระบบน้ำ</a>
                ||&nbsp;<a href="<?php echo e(url('/public_oil_t1b'.'&'.$off_id.'&'.$year)); ?>"> ข้อมูลระบบน้ำมัน</a>
                ||&nbsp;<a href="<?php echo e(url('/public_generator_t1'.'&'.$off_id.'&'.$year)); ?>"> ข้อมูลเครื่องปั่นไฟ</a> 
                </p>
                </div>
            </div>
        </div>
    </div>
</div> 
            <!-- ========================================================= -->
                <br>
                <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM airconditioner_t2 WHERE off_id = $off_id AND year = $year"))): ?> 

                <div class="panel-body">
                    <br>
                    <center><h3>ยังไม่มีข้อมูล<h3><center>

                </div>

                <?php else: ?> 

                <center>    
                <table border="0" width="95%" >
                <tr>
                <td align="left"> 
                    &nbsp; 
                </td>

                <td align="right"> 
                    <a href="<?php echo e(url('/public_airconditioner_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3498DB; color:white;">ตารางเครื่องปรับอากาศ</a>
                    <a href="<?php echo e(url('/public_airconditioner_t2'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3498DB; color:white;">ตารางสรุปเครื่องปรับอากาศ</a>
                    <!-- <a href="<?php echo e(url('/export_file_airconditioner_t2'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a> -->                
                </td>
                </tr>
                <tr>
                <td  colspan="2">


                    <center>   
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
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.airconditioner_t2 
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </center>

                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
            <!-- ========================================================= -->









<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>