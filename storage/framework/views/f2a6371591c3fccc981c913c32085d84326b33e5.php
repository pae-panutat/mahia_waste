

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
                <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM expenses_t2 WHERE off_id = $off_id AND year = $year"))): ?>     

                <div class="panel-body">
                    <br>
                    <center><h3>ยังไม่มีข้อมูล<h3><center>

                </div>
                <?php else: ?> 

                <div class="panel-body">

                <center>    
                <table border="0" width="80%" >
                <tr>
                <td align="left">
                    <!-- <a href="<?php echo e(url('/import_excel_del_expenses_t2'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a>    -->
                </td>

                <td align="right"> 
                    <a href="<?php echo e(url('/public_expenses_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3498DB; color:white;">ข้อมูลค่าไฟ</a>
                    <a href="<?php echo e(url('/public_expenses_t2'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3498DB; color:white;">ข้อมูลหม้อแปลง</a> 
                    <!-- <a href="<?php echo e(url('/export_file_expenses_t2'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>                 -->
                </td>
                </tr>
                <tr>
                <td  colspan="2">

                    <center>   
<!--                     <form method="POST" action="<?php echo e(url('/import_excel_edit_expenses_t2'.'&'.$off_id.'&'.$year)); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?> -->
                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="4" style="background-color: #EAFAF1;"><center><h3>ข้อมูลการใช้พลังงานไฟฟ้าของอาคาร (หม้อแปลง)</h3></center></td>
                        </tr>
                        <tr>
                            <td width="10%"><center>ลำดับที่</center></td>
                            <td width="50%"><center>รายการ</center></td>
                            <td width="20%"><center>ค่า</center></td>
                            <td width="20%"><center>หน่วย</center></td>

                        </tr>
                        <?php $k=0; ?> 
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.expenses_t2 
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>        
                            <input type="hidden" name="data[<?php echo e($k); ?>][]" id="<?php echo e($data->id); ?>" value="<?php echo e($data->id); ?>" />
                            <input type="hidden" name="data[<?php echo e($k); ?>][]" id="<?php echo e($data->off_id); ?>" value="<?php echo e($data->off_id); ?>" />
                            <input type="hidden" name="data[<?php echo e($k); ?>][]" id="<?php echo e($data->year); ?>" value="<?php echo e($data->year); ?>" />
                            <td ><center><?php echo $k+1; ?> </center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="transformer_name" value="<?php echo e($data->transformer_name); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="transformer_value" value="<?php echo e($data->transformer_value); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="transformer_unit" value="<?php echo e($data->transformer_unit); ?>" ></center></td>
                            
                            
                        </tr>
                        <?php $k=$k+1; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </table>
<!--                       <div class="form-group">
                          <br>
                          <button type="submit" id="save" class="btn btn-default">แก้ไขข้อมูล|Submit</button>
                      </div>
                    </form> -->
                </center>


                </div>                    
                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- ========================================================= -->





        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>