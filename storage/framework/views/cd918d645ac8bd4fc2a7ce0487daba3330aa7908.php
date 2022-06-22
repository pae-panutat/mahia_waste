

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
                <?php if( Auth::user()->permission_ID == 1 or Auth::user()->email == 'admin_audit@cmu.ac.th'): ?>
                <br>
                <div class="panel-body">
                <center>
                    <table border="0" width="80%" >
                    <tr>
                    <td width="50%">    
                        <a href="<?php echo e(url('/indexDash')); ?>" class="btn" style="background-color:#8533ff; color:white;">Home</a> 
                        <a href="<?php echo e(url('/analyticDash')); ?>" class="btn" style="background-color:#8533ff; color:white;">AnalyticDash</a>
                        <a href="<?php echo e(url('/alldatacmu')); ?>" class="btn btn-success" target="_blank">ภาพรวมทั้งมหาลัยฯ</a>

                        <!-- <a href="<?php echo e(url('/public')); ?>" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a>  -->
                        <!-- <a href="<?php echo e(url('/analyticChart')); ?>" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a>  -->
                    </td>
                    <td width="50%"> 
                        &nbsp;
                    </td>
                    </tr>
                    </table>
                    
                    <br>

                    <table border="1" width="80%" >
                    <tr>
                        <th width="10%" style="background-color: #EAFAF1;"><center><h4>ลำดับที่</h4></center></th>
                        <th width="90%" style="background-color: #EAFAF1;"><center><h4>ส่วนงาน</h4></center></th>
                    </tr>
                    <?php $k=0; ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td ><center><?php $k=$k+1; echo $k ;?></center></td>
                        <td >&nbsp;<a href="<?php echo e(url('/admin_excel_menu'.'&'.$value->off_id)); ?>" target="_blank"> <?php echo e($value->location); ?> </a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </table>  
                </center>
                </div>
                <?php endif; ?>



                <!-- ================================================================== -->
                <?php if(Auth::user()->permission_ID == 3): ?>
                <br>
                <div class="panel-body">
                <center>
                    <table border="0" width="80%" >
                    <tr>
                    <td width="50%">    
                        <a href="<?php echo e(url('/indexDash')); ?>" class="btn" style="background-color:#8533ff; color:white;">Home</a> 
                        <a href="<?php echo e(url('/analyticChart')); ?>" class="btn btn-success">AnalyticChart</a> 
                        <a href="<?php echo e(url('/analyticDash')); ?>" class="btn btn-primary">AnalyticDash</a> 
                    </td>
                    <td width="50%"> 
                        &nbsp;
                    </td>
                    </tr>
                    </table>
                    
                    <br>

                    <table border="1" width="80%" >
                    <tr>
                        <th width="10%" style="background-color: #EAFAF1;"><center><h4>ลำดับที่</h4></center></th>
                        <th width="90%" style="background-color: #EAFAF1;"><center><h4>ส่วนงาน</h4></center></th>
                    </tr>
                    <?php $k=0; ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($value->off_id == Auth::user()->office_ID): ?>
                    <tr>
                        <td ><center><?php $k=$k+1; echo $k ;?></center></td>
                        <td >&nbsp;<a href="<?php echo e(url('/admin_excel_menu'.'&'.$value->off_id)); ?>"> <?php echo e($value->location); ?> </a></td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </table>  
                </center>
                </div>
                <?php endif; ?>



                <!-- ================================================================== -->
                <?php if(Auth::user()->permission_ID == 4): ?>
                <br>
                <div class="panel-body">
                <center>
                    <h3>เอกสารรายงานการเปรียบเทียบประสิทธิภาพก่อนและหลังล้างเครื่องปรับอากาศ</h3>
                <br>
                <a href="<?php echo e(url('/customer_new')); ?>"> เพิ่มลูกค้า </a>
                <br>
                <br>
                <table border="1" width="80%" >
                    <tr>
                        <th width="10%" style="background-color: #EAFAF1;"><center><h4>ลำดับที่</h4></center></th>
                        <th width="80%" style="background-color: #EAFAF1;"><center><h4>รายชื่อลูกค้า</h4></center></th>
                        <th width="10%" style="background-color: #EAFAF1;"><center><h4>แก้ไข<br>ชื่อลูกค้า</h4></center></th>
                    </tr>
                    <?php $k=0; ?>
                    <?php $__currentLoopData = $dataw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td ><center><?php $k=$k+1; echo $k ;?></center></td>
                        <td >&nbsp;<a href="<?php echo e(url('/customer_report_year'.'&'.$dw->id)); ?>"><?php echo e($dw->customer_name); ?></a></td>
                        <td ><center><a href="<?php echo e(url('/customer_edit'.'&'.$dw->id)); ?>">แก้ไข</a></center></td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php echo e($dataw->links()); ?>    

                </center>
                </div>
                <?php endif; ?>










            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>