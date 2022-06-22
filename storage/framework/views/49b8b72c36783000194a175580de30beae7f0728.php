

<?php $__env->startSection('content'); ?>


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
                <p>


                <a href="<?php echo e(url('/public')); ?>" class="btn" style="background-color:#3CBC8D; color:white;">หน้าหลัก</a>
                <a href="<?php echo e(url('/public_menu'.'&'.$value->off_id)); ?>" class="btn" style="background-color:#3CBC8D; color:white;">รายงานประจำปี</a>
                
                </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
            </div>

            <br>
            
            <div class="panel-body">

                    <?php 
                    $year_c  = date("Y")+543;
                    $off_id = request()->route()->off_id; ?>

                    <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                    FROM audit_cmu.audit_db 
                                    WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <td ><center><a href="<?php echo e(url('public_general'.'&'.$re->off_id.'&'.$re->year)); ?>">รายงานประจำปี <?php echo e($re->year); ?></a></center></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                    </center>            

                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>    






            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>