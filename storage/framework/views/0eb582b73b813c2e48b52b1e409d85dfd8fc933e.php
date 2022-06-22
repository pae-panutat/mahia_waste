

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
               
                <br>
                <div class="panel-body">
                <center>
                    <table border="0" width="80%" >
                    <tr>
                    <td width="50%">   
                        <a href="<?php echo e(url('/public_analyticChart')); ?>" class="btn" style="background-color:#8533ff; color:white;">กราฟภาพรวมมหาวิทยาลัยเชียงใหม่</a>  
                        <a href="<?php echo e(url('/pub')); ?>" class="btn" style="background-color:#8533ff; color:white;">แต่ละส่วนงาน</a> 
                        &nbsp;
                    </td>
                    <td width="50%"> 
                        <br>
                        dash
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
                        <td >&nbsp;<a href="<?php echo e(url('/public_menu'.'&'.$value->off_id)); ?>"> <?php echo e($value->location); ?> </a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </table>  


                </center>
                </div>
          


















            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>