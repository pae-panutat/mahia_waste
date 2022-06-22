

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

        </div>
    </div>
</div> 

            <!-- ========================================================= -->            
                <br>

                <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM generator_t1 WHERE off_id = $off_id AND year = $year"))): ?> 

                <div class="panel-body">

                    <center><h3>อัพโหลดExcel:ตารางเครื่องกำเนิดไฟฟ้า<h3><center>

                    <?php echo Form::open(array('route' => 'import_excel_generator_t1','method'=>'POST','files'=>'true')); ?>


                    <?php echo Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']); ?>


                    <?php echo Form::file('sample_file', array('class' => 'form-control')); ?>


                    <?php echo Form::hidden('off_id', $off_id ); ?>

                    <?php echo Form::hidden('year', $year ); ?>



                    <?php echo $errors->first('sample_file', '<p class="alert alert-danger">:message</p>'); ?>


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        <?php echo Form::submit('Upload',['class'=>'btn btn-primary']); ?>

                    </div>
                    <?php echo Form::close(); ?>


                </div>

                <?php else: ?> 

                <center>    
                <table border="0" width="90%" >
                <tr>
                <td align="left"> 
                    <a href="<?php echo e(url('/import_excel_del_generator_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a>

                </td>

                <td align="right"> 
                      
                    <a href="<?php echo e(url('/export_file_generator_t1'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>             
                </td>
                </tr>
                <tr>
                <td  colspan="2">


                    <center>   
                    <form method="POST" action="#" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="25" style="background-color: #EAFAF1;"><center><h3>ข้อมูลเครื่องกำเนิดไฟฟ้า_t1</h3></center></td>
                        </tr>
                        <tr>
                            <td ><center>เครื่องที่</center></td>
                            <td ><center>พิกัดขนาดติดตั้ง<br>(kW)</center></td>
                            <td ><center>พิกัดแรงดัน(Volt)</center></td>
                            <td ><center>พิกัดกระแส(Amp)</center></td>
                            <td ><center>ตัวประกอบกำลัง</center></td>
                            <td ><center>ความเร็ว<br>เครื่องกำเนิดไฟฟ้า<br>(รอบ/นาที)</center></td>
                            <td ><center>ชื่อผู้ผลิต</center></td>
                            <td ><center>เดือน/พ.ศ.<br>ที่ติดตั้ง</center></td>
                            <td ><center>สถาณที่ใช้งาน</center></td>
                            <td ><center>หมายเหตุ</center></td>
                        </tr> 
                        <?php $k=0;  ?> 
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.generator_t1
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td ><center><?php  echo $k+1; ?></center></td>
                            <td ><center><?php  echo $data->kw; ?></center></td>
                            <td ><center><?php  echo $data->volt; ?></center></td>
                            <td ><center><?php  echo $data->amp; ?></center></td>
                            <td ><center><?php  echo $data->power_factor; ?></center></td>
                            <td ><center><?php  echo $data->speed; ?></center></td>
                            <td ><center><?php  echo $data->manufacturer_name; ?></center></td>
                            <td ><center><?php  echo $data->date_begin; ?></center></td>
                            <td ><center><?php  echo $data->location; ?></center></td>
                            <td ><center><?php  echo $data->note; ?></center></td>
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>