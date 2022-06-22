

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
            <!-- ========================================================= -->
                <br>
                <div class="panel-body">
                <center>    
                <table border="0" width="80%" >
                <tr>
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM audit_cmu.audit_db 
                                WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td align="left">    
                    &nbsp;
                </td>
                <td align="right">    
                    <!-- <a href="<?php echo e(url('/export_file_general'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>              -->
                </td>
                </tr>

                <tr>
                <td colspan="2">    

                    <?php if(!empty(DB::connection($db->db_name)->select("SELECT * FROM general_info WHERE off_id = $off_id AND year = $year "))): ?> 

                    <form action="#" method="post">
                    <?php echo e(csrf_field()); ?>


                    <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.general_info 
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                    <input type="hidden" name="off_id" value="<?php echo e($off_id); ?>">
                    <center>
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="2" style="background-color: #EAFAF1;"><center><h3>ข้อมูลทั่วไป</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">ข้อมูลปี&nbsp;&nbsp;</td>
                            <td width="60%"><input type="text" class="form-control" name="year" placeholder="year" value="<?php echo e($data->year); ?>" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">ชื่อหน่วยงาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="unit_name" placeholder="unit_name" value="<?php echo e($data->unit_name); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">สถานที่ตั้งอาคาร&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="building_location" placeholder="building_location" value="<?php echo e($data->building_location); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">โทรศัพท์&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="tel1_number" placeholder="tel1_number" value="<?php echo e($data->tel1_number); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">ลักษณะการใช้งาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="usage_condition" placeholder="usage_condition" value="<?php echo e($data->usage_condition); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">เวลาทำการของอาคาร&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="official_time" placeholder="official_time" value="<?php echo e($data->official_time); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">ชื่อผู้ติดต่อ&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="contact_name" placeholder="contact_name" value="<?php echo e($data->contact_name); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">ตำแหน่ง&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="position1" placeholder="position1" value="<?php echo e($data->position1); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">โทรศัพท์&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="tel2_number" placeholder="tel2_number" value="<?php echo e($data->tel2_number); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">ชื่อผู้ประสานงาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="coordinator_name" placeholder="coordinator_name" value="<?php echo e($data->coordinator_name); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">ตำแหน่ง&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="position2" placeholder="position2" value="<?php echo e($data->position2); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">โทรศัพท์&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="tel3_number" placeholder="tel3_number" value="<?php echo e($data->tel3_number); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">ดำเนินการตั้งแต่ปี&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="begin_year" placeholder="begin_year" value="<?php echo e($data->begin_year); ?>" ></td>
                        </tr>
                        <tr>
                            <td align="right">เสนอรายงานต่อ&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="presented_to" placeholder="presented_to" value="<?php echo e($data->presented_to); ?>" ></td>
                        </tr>      
                        <tr>
                            <td align="right">ผู้จัดทำรายงาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="report_from" placeholder="report_from" value="<?php echo e($data->report_from); ?>" ></td>
                        </tr>    
                        <tr>
                            <td align="right">จัดทำโดย&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="report_maker1" placeholder="report_maker1" value="<?php echo e($data->report_maker1); ?>" ></td>
                        </tr>   
                        <tr>
                            <td align="right">จัดทำโดย&nbsp;&nbsp;</td>
                            <td align="right"><input type="text" class="form-control" name="report_maker2" placeholder="report_maker2" value="<?php echo e($data->report_maker2); ?>" ></td>
                        </tr>                                                         
                    </table>
                    </center>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                    <!-- <center> <input type="submit" name="submit_general" value="แก้ไขข้อมูล|Submit"> </center> -->
                    </form>

                    
                    <?php else: ?>

                            <center><h3>ยังไม่มีข้อมูล<h3><center>

                     

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                </div>                  

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- ========================================================= -->





        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>