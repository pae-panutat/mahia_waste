

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

            <!-- ========================================================= -->
                <br>
                <?php if(empty(DB::connection($db->db_name)->select("SELECT * FROM building_info WHERE off_id = $off_id AND year = $year"))): ?> 

                <div class="panel-body">

                    <center><h3>อัพโหลดExcel:ข้อมูลลักษณะอาคาร<h3><center>

                    <?php echo Form::open(array('route' => 'import_excel_building','method'=>'POST','files'=>'true')); ?>


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

                <div class="panel-body">

                <center>    
                <table border="0" width="80%" >
                <tr>
                <td align="left">
                    <a href="<?php echo e(url('/import_excel_del_building'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#E74C3C; color:white;">ลบข้อมูลเพื่ออัพโหลดใหม่</a>   
                </td>

                <td align="right"> 
                    <a href="<?php echo e(url('/export_file_building'.'&'.$off_id.'&'.$year)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">ExportCSV</a>                
                </td>
                </tr>
                <tr>
                <td  colspan="2">

                    <center>   
                    <form method="POST" action="<?php echo e(url('/import_excel_edit_building'.'&'.$off_id.'&'.$year)); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                        
                    <table border="1" width="100%" > 
                        <tr>
                            <td colspan="10" style="background-color: #EAFAF1;"><center><h3>ข้อมูลลักษณะอาคาร</h3></center></td>
                        </tr>
                        <tr>
                            <td width="20%"><center>ชื่ออาคาร</center></td>
                            <td width="10%"><center>ชั้น</center></td>
                            <td width="10%"><center>หมายเลขมีเตอร์</center></td>
                            <td width="5%"><center>จำนวนชั้น</center></td>
                            <td width="8%"><center>ความสูง<br>แต่ละชั้น<br>(ม.)</center></td>
                            <td width="10%"><center>พื้นที่จอดรถ<br>(ตรม.)</center></td>
                            <td width="10%"><center>พื้นที่ใช้สอยรวม<br>(ตรม.)</center></td>
                            <td width="10%"><center>พื้นที่ปรับอากาศ<br>(ตรม.)</center></td>
                            <td width="10%"><center>พื้นที่ปรับอากาศ<br>ชั้นบนสุด<br>(ตรม.)</center></td> 
                            <td width="7%"><center>อาคารเริ่มใช้งานปี</center></td> 
                        </tr>
                        <?php 
                            $k=0; 
                            $parking_area=0; 
                            $used_area=0; 
                            $air_area=0; 
                            $air_area_on_top=0;
                        ?> 
                        <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                FROM $db->db_name.building_info 
                                WHERE off_id = $off_id AND year = $year "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>        
                            <input type="hidden" name="data[<?php echo e($k); ?>][]" id="<?php echo e($data->id); ?>" value="<?php echo e($data->id); ?>" />
                            <input type="hidden" name="data[<?php echo e($k); ?>][]" id="<?php echo e($data->off_id); ?>" value="<?php echo e($data->off_id); ?>" />
                            <input type="hidden" name="data[<?php echo e($k); ?>][]" id="<?php echo e($data->year); ?>" value="<?php echo e($data->year); ?>" />
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="building_name" value="<?php echo e($data->building_name); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="floor" value="<?php echo e($data->floor); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="id_meter" value="<?php echo e($data->id_meter); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="total_floor" value="<?php echo e($data->total_floor); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="floor_hieght" value="<?php echo e($data->floor_hieght); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="parking_area" value="<?php echo e($data->parking_area); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="used_area" value="<?php echo e($data->used_area); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="air_area" value="<?php echo e($data->air_area); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="air_area_on_top" value="<?php echo e($data->air_area_on_top); ?>" ></center></td>
                            <td ><center><input type="text" class="form-control" name="data[<?php echo e($k); ?>][]" placeholder="year_begin" value="<?php echo e($data->year_begin); ?>" ></center></td>                            
                        </tr>
                        <?php $k=$k+1; 
                              $parking_area     =$parking_area + $data->parking_area; 
                              $used_area        =$used_area + $data->used_area;
                              $air_area         =$air_area + $data->air_area;
                              $air_area_on_top  =$air_area_on_top+$data->air_area_on_top;
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="background-color: #EAFAF1;">
                                <center>จำนวนอาคาร</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่จอดรถ<br>ทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่ใช้สอยรวม<br>ทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่ปรับอากาศ<br>ทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>พื้นที่ปรับอากาศ<br>ชั้นบนสุดทั้งหมด<br>(ตรม.)</center>
                            </td>
                            <td style="background-color: #EAFAF1;">
                                <center>&nbsp;</center>
                            </td>                             
                        </tr>
                        <tr>
                            <td ><center><?php echo e($k); ?></center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center>&nbsp;</center></td>
                            <td ><center><?php echo e($parking_area); ?></center></td>
                            <td ><center><?php echo e($used_area); ?></center></td>
                            <td ><center><?php echo e($air_area); ?></center></td>
                            <td ><center><?php echo e($air_area_on_top); ?></center></td>
                            <td ><center>&nbsp;</center></td>                             
                        </tr>

                    </table>
                      <div class="form-group">
                          <br>
                          <button type="submit" id="save" class="btn btn-default">แก้ไขข้อมูล|Submit</button>
                      </div>
                    </form>
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>