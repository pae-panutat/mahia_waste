

<?php $__env->startSection('content'); ?>
<?php if( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th'): ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                    <?php 
                    $off_id = request()->route()->off_id; 
                    $year = request()->route()->year;
                    //echo $year;
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
                <a href="<?php echo e(url('/home')); ?>" class="btn" style="background-color:#3CBC8D; color:white;">หน้าหลัก</a>
                <a href="<?php echo e(url('/admin_excel_menu'.'&'.$off_id)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">สร้างรายงานใหม่</a>
                <a href="<?php echo e(url('/view_all_charts'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">สรุปการใช้พลังงาน</a>
                <br><br>
                <a href="<?php echo e(url('/import_excel_view_general'.'&'.$off_id.'&'.$year)); ?>" class="btn">ข้อมูลทั่วไป</a>
                <a href="<?php echo e(url('/import_excel_view_person'.'&'.$off_id.'&'.$year)); ?>" class="btn">ข้อมูลบุคลากร</a>
                <a href="<?php echo e(url('/import_excel_view_expenses_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn">ข้อมูลการใช้พลังงานไฟฟ้าของอาคาร</a>
                <a href="<?php echo e(url('/import_excel_view_building'.'&'.$off_id.'&'.$year)); ?>" class="btn">ข้อมูลลักษณะอาคาร</a>
                <a href="<?php echo e(url('/import_excel_view_equipment_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn">ข้อมูลอุปกรณ์ไฟฟ้า</a>
                <a href="<?php echo e(url('/import_excel_view_airconditioner_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn"> ข้อมูลเครื่องปรับอากาศ</a>
                <a href="<?php echo e(url('/import_excel_view_airchiller_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn"> ข้อมูลเครื่องปรับอากาศแบบAirchiller</a>
                <a href="<?php echo e(url('/import_excel_view_elamp_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn"> ข้อมูลระบบแสงสว่าง</a>
                <a href="<?php echo e(url('/import_excel_view_water_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn"> ข้อมูลระบบน้ำ</a>
                <br>
                <a href="<?php echo e(url('/import_excel_view_oil_t1b'.'&'.$off_id.'&'.$year)); ?>" class="btn"> ข้อมูลระบบน้ำมัน</a>
                <a href="<?php echo e(url('/import_excel_view_generator_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn"> ข้อมูลเครื่องปั่นไฟ</a>      
                </p>
                </div>
            </div>
            <!-- ========================================================= -->
            <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM person_info WHERE off_id = $off_id AND year = $year"))): ?> 

                <div class="panel-body">
                <center>    
                <table border="0" width="80%" >
                <tr>
                <td align="left">    
                    &nbsp;              
                </td>
                <td align="right">    
                    &nbsp;           
                </td>
                </tr>

                <tr>
                <td colspan="2">  
                    <form action="<?php echo e(url('/import_excel_insert_person')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>


                    <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.general_info 
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                    <input type="hidden" name="off_id" value="<?php echo e($off_id); ?>">
                    <center>
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="2" style="background-color: #EAFAF1;"><center><h3>ข้อมูลบุคลากร</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">ข้อมูลปี&nbsp;&nbsp;</td>
                            <td width="60%"><input type="text" class="form-control" name="year" placeholder="year" value="<?php echo e($data->year); ?>" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">ชื่อหน่วยงาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="unit_name" placeholder="unit_name" value="<?php echo e($data->unit_name); ?>" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">จำนวน พนักงาน/อาจารย์/นักศึกษา (คน) &nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="num_person" placeholder="num_person" value="" ></td>
                        </tr>
                    </table>
                    </center>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                    <center> <input type="submit" name="submit_person" value="บันทึกข้อมูล|Submit"> </center>
                    </form>

                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                </div>    

            <?php else: ?> 

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
                    &nbsp;           
                </td>
                </tr>

                <tr>
                <td colspan="2">    

                    <?php if(!empty(DB::connection($db->db_name)->select("SELECT * FROM person_info WHERE off_id = $off_id AND year = $year "))): ?> 

                    <form action="<?php echo e(url('/import_excel_edit_person')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>


                    <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT 
                                person_info.id as id, 
                                general_info.off_id as off_id, 
                                general_info.year as year, 
                                general_info.unit_name as unit_name, 
                                person_info.num_person
                                FROM $db->db_name.general_info 
                                JOIN $db->db_name.person_info ON general_info.off_id = person_info.off_id
                                WHERE $db->db_name.person_info.off_id = $off_id AND $db->db_name.person_info.year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                    <input type="hidden" name="off_id" value="<?php echo e($off_id); ?>">
                    <center>
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="2" style="background-color: #EAFAF1;"><center><h3>ข้อมูลบุคลากร</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">ข้อมูลปี&nbsp;&nbsp;</td>
                            <td width="60%"><input type="text" class="form-control" name="year" placeholder="year" value="<?php echo e($data->year); ?>" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">ชื่อหน่วยงาน&nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="unit_name" placeholder="unit_name" value="<?php echo e($data->unit_name); ?>" style="background-color: #3CBC8D; color: white;" readonly></td>
                        </tr>
                        <tr>
                            <td align="right">จำนวน พนักงาน/อาจารย์/นักศึกษา (คน) &nbsp;&nbsp;</td>
                            <td ><input type="text" class="form-control" name="num_person" placeholder="num_person" value="<?php echo e($data->num_person); ?>" ></td>
                        </tr>
                    </table>
                    </center>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                    <center> <input type="submit" name="edit_person" value="แก้ไขข้อมูล|Submit"> </center>
                    </form>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <br>
                    <br>
                </td>
                </tr>
                </table>
                </center>
                </div>                  

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- ========================================================= -->





        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>