

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

                <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM elamp_t1 WHERE off_id = $off_id AND year = $year"))): ?> 

                <div class="panel-body">
                    <br>
                    <center><h3>ยังไม่มีข้อมูล<h3><center>

                </div>

                <?php else: ?> 

                <center>    
                <table border="0" width="90%" >
                <tr>
                <td align="left"> 
                    &nbsp;

                </td>

                <td align="right"> 
                     
                    <a href="<?php echo e(url('/public_elamp_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3498DB; color:white;">ตารางระบบแสงสว่าง</a>
                    <a href="<?php echo e(url('/public_elamp_t2'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3498DB; color:white;">ตารางสรุประบบแสงสว่าง</a>  
                    <!-- <a href="<?php echo e(url('/export_file_elamp_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a> -->             
                </td>
                </tr>
                <tr>
                <td  colspan="2">


                    <center>   
                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="27" style="background-color: #EAFAF1;"><center><h3>ข้อมูลแสงสว่าง_t1</h3></center></td>
                        </tr>
                        <tr>
                            <td ><center>อาคาร</center></td>
                            <td ><center>ชื่อห้อง</center></td>
                            <td ><center>หมายเลข<br>มีเตอร์</center></td>
                            <td ><center>ประเภท<br>ห้อง</center></td>
                            <td ><center>ชั้น</center></td>
                            <td ><center>พื้นที่<br>(ตร.ม)</center></td>
                            <td ><center>ชนิด<br>หลอดไฟ</center></td>
                            <td ><center>ขนาด<br>วัตต์<br>หลอดไฟ</center></td>
                            <td ><center>ชนิด<br>โคม</center></td>
                            <td ><center>ชนิด<br>ฝาครอบ<br>โคม</center></td>
                            <td ><center>ชนิด<br>บัลลาสต์</center></td>
                            <td ><center>กำลัง<br>ไฟฟ้า<br>สูญเสีย<br>บัลลาสต์<br>/ตัว</center></td>
                            <td ><center>หลอด<br>ต่อ<br>โคม</center></td>
                            <td ><center>จำนวน<br>โคม</center></td>
                            <td ><center>ชั่วโมง<br>ใช้งาน<br>(วัน/ปี)</center></td>
                            <td ><center>วัน<br>ใช้งาน<br>(วัน/ปี)</center></td>
                            <td ><center>factor</center></td>
                            <td ><center>จำนวน<br>หลอด</center></td>
                            <td ><center>ลักษณะ<br>การติดตั้ง</center></td>
                            <td ><center>โคม<br>reflector</center></td>
                            <td ><center>ค่า<br>ความ<br>สว่าง<br>จุดที่1<br>(lux)</center></td>
                            <td ><center>ค่า<br>ความ<br>สว่าง<br>ค่า<br>เฉลี่ย<br>(lux)</center></td>
                            <td ><center>จำนวน<br>วัตต์<br>หลอด<br>/โคม</center></td>
                            <td ><center>กำลัง<br>ไฟฟ้า<br>สูญเสีย<br>บัลลาสต์<br>/โคม<br>(lux)</center></td>
                            <td ><center>วัตต์<br>รวม</center></td>
                            <td ><center>ปริมาณ<br>การใช้<br>(kwh/ปี)</center></td>
                            <td ><center>ปริมาณ<br>ค่าไฟ<br>(บาท/ปี)</center></td>
                        </tr>
                        <?php $k=0;  ?> 
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.elamp_t1
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td ><center><?php  echo $data->location; ?></center></td>
                            <td ><center><?php  echo $data->room_name; ?></center></td>
                            <td ><center><?php  echo $data->id_meter; ?></center></td>
                            <td ><center><?php  echo $data->room_type; ?></center></td>
                            <td ><center><?php  echo $data->floor; ?></center></td>
                            <td ><center><?php  echo $data->total_area; ?></center></td>
                            <td ><center><?php  echo $data->bulb_type; ?></center></td>
                            <td ><center><?php  echo $data->elamp_watt; ?></center></td>
                            <td ><center><?php  echo $data->elamp_type; ?></center></td>
                            <td ><center><?php  echo $data->shield_type; ?></center></td>
                            <td ><center><?php  echo $data->ballast_type; ?></center></td>
                            <td ><center><?php  echo $data->lose_ballast_per_piece; ?></center></td>
                            <td ><center><?php  echo $data->bulb_per_lamp; ?></center></td>
                            <td ><center><?php  echo $data->total_lamp; ?></center></td>
                            <td ><center><?php  echo $data->work_hours_per_day; ?></center></td>
                            <td ><center><?php  echo $data->work_days_per_year  ; ?></center></td>
                            <td ><center><?php  echo $data->factor; ?></center></td>
                            <td ><center><?php  echo $data->total_bulb; ?></center></td>
                            <td ><center><?php  echo $data->setting; ?></center></td>
                            <td ><center><?php  echo $data->lamp_reflector; ?></center></td>
                            <td ><center><?php  echo $data->lux_value1; ?></center></td>
                            <td ><center><?php  echo $data->lux_avg; ?></center></td>
                            <td ><center><?php  echo $data->total_watt_bulb_per_lamp; ?></center></td>
                            <td ><center><?php  echo $data->power_lost_ballast_per_bulb; ?></center></td>
                            <td ><center><?php  echo $data->total_watt; ?></center></td>
                            <td ><center><?php  echo $data->kwh_per_year; ?></center></td>
                            <td ><center><?php  echo $data->expenses_bath_per_year; ?></center></td>
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
















            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>