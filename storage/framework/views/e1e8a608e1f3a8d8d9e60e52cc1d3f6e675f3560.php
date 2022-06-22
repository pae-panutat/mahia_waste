

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
                <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM airconditioner_t1 WHERE off_id = $off_id AND year = $year"))): ?> 

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
                    <!-- <a href="<?php echo e(url('/export_file_airconditioner_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>  -->            
                </td>
                </tr>
                <tr>
                <td  colspan="2">

                    <center>      
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="38" style="background-color: #EAFAF1;"><center><h3>ข้อมูลเครื่องปรับอากาศ_t1</h3></center></td>
                        </tr>
                        <tr>
                            <td ><center>ลำดับ<br>ที่</center></td>
                            <td ><center>ชื่ออาคาร</center></td>
                            <td ><center>ชื่อห้อง</center></td>
                            <td ><center>มิเตอร์</center></td>
                            <td ><center>ประเภทห้อง</center></td>
                            <td ><center>ชั้น</center></td>
                            <td ><center>พื้นที่ปรับอากาศ<br>(ตรม.)</center></td>
                            <td ><center>ชนิดเครื่องปรับอากาศ</center></td>
                            <td ><center>ขนาด<br>(Btu/hr-ชุด)</center></td>
                            <td ><center>กำลังไฟฟ้าที่ใช้<br>(kW/ชุด)</center></td>
                            <td ><center>จำนวน<br>(ตัว)</center></td>
                            <td ><center>อายุ<br>(ปี)</center></td>
                            <td ><center>ชั่วโมงใช้งาน<br>(ชม./วัน)</center></td>
                            <td ><center>วันใช้งาน<br>(วัน/ปี)</center></td>
                            <td ><center>Factor</center></td>
                            <td ><center>สัญลักษณ์เครื่องปรับอากาศ</center></td>
                            <td ><center>ยี่ห้อ</center></td>
                            <td ><center>ยี่ห้อ</center></td>
                            <td ><center>สัญลักษณ์การติดตั้ง</center></td>
                            <td ><center>จำนวนเฟส</center></td>
                            <td ><center>ชนิด<br>เทอร์โมสตัท</center></td>
                            <td ><center>อุณหภูมิที่ตั้ง</center></td>
                            <td ><center>ความเร็วลม<br>(ft/min)</center></td>
                            <td ><center>RH (%)<br>(RHr)</center></td>
                            <td ><center>RH (%)<br>(RHs.)</center></td>
                            <td ><center>Temp (oF)<br>(Tr)</center></td>
                            <td ><center>Temp (oF)<br>(Ts)</center></td>
                            <td ><center>kW</center></td>      
                            <td ><center>V</center></td> 
                            <td ><center>Ir A</center></td> 
                            <td ><center>Is A</center></td> 
                            <td ><center>It A</center></td>
                            <td ><center>PF</center></td>
                            <td ><center>kW รวม</center></td>  
                            <td ><center>kWh/ปี</center></td>
                            <td ><center>บาทต่อปี</center></td>
                            <td ><center>BTUรวม</center></td>   
                            <td ><center>ตำแหน่งชั้นบนสุด<br>ตรม.</center></td>                 
                        </tr> 
                        <?php $k=0;  ?> 
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.airconditioner_t1 
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td ><center><?php  echo $k+1; ?></center></td>
                            <td ><center><?php  echo $data->location; ?></center></td>
                            <td ><center><?php  echo $data->room_name; ?></center></td>
                            <td ><center><?php  echo $data->id_meter; ?></center></td>
                            <td ><center><?php  echo $data->room_type; ?></center></td>
                            <td ><center><?php  echo $data->floor; ?></center></td>
                            <td ><center><?php  echo $data->aircon_area; ?></center></td>
                            <td ><center><?php  echo $data->aircon_type; ?></center></td>
                            <td ><center><?php  echo $data->btu_hr_machine; ?></center></td>
                            <td ><center><?php  echo $data->kw_per_machine; ?></center></td>
                            <td ><center><?php  echo $data->amount; ?></center></td>
                            <td ><center><?php  echo $data->age; ?></center></td>
                            <td ><center><?php  echo $data->work_hours_per_day; ?></center></td>
                            <td ><center><?php  echo $data->work_days_per_year; ?></center></td>
                            <td ><center><?php  echo $data->factor; ?></center></td>
                            <td ><center><?php  echo $data->symbol1; ?></center></td>
                            <td ><center><?php  echo $data->brand1; ?></center></td>
                            <td ><center><?php  echo $data->brand2; ?></center></td>
                            <td ><center><?php  echo $data->symbol2; ?></center></td>
                            <td ><center><?php  echo $data->phase_total; ?></center></td>
                            <td ><center><?php  echo $data->thermo_type; ?></center></td>
                            <td ><center><?php  echo $data->room_temp; ?></center></td>
                            <td ><center><?php  echo $data->ft_min; ?></center></td>
                            <td ><center><?php  echo $data->rhr; ?></center></td>
                            <td ><center><?php  echo $data->rhs; ?></center></td>
                            <td ><center><?php  echo $data->tr; ?></center></td>
                            <td ><center><?php  echo $data->ts; ?></center></td>
                            <td ><center><?php  echo $data->kw; ?></center></td>
                            <td ><center><?php  echo $data->v; ?></center></td>
                            <td ><center><?php  echo $data->iir; ?></center></td>
                            <td ><center><?php  echo $data->iis; ?></center></td>
                            <td ><center><?php  echo $data->iit; ?></center></td>
                            <td ><center><?php  echo $data->pf; ?></center></td>
                            <td ><center><?php  echo $data->total_kw; ?></center></td>
                            <td ><center><?php  echo $data->kwh_per_year; ?></center></td>
                            <td ><center><?php  echo $data->bath_per_year; ?></center></td>
                            <td ><center><?php  echo $data->total_btu; ?></center></td>
                            <td ><center><?php  echo $data->area_on_top; ?></center></td>
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