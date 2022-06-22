

<?php $__env->startSection('content'); ?>
<script type="text/javascript" src="js/jscharts.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#D2B4DE;">
                    <center>
                        <h4>ภาพรวมทุกคณะในมหาวิทยาลัยเชียงใหม่</h4>
                    </center>
                </div>
                <br>
                <div class="panel-body">
                <center>

                <table border="0" width="80%" >
                <tr>
                <td width="50%">    
                    <a href="<?php echo e(url('/publicDash')); ?>" class="btn" style="background-color:#8533ff; color:white;">Home</a> 
                    <a href="<?php echo e(url('/public_analyticChart')); ?>" class="btn" style="background-color:#8533ff; color:white;">AnalyticChart</a> 
                </td>
                <td width="50%"> 
                    &nbsp;
                </td>
                </tr>
                </table>

                    <br>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <center>
                    <iframe name="pubchart_demo1" src="<?php echo e(url('/pubchart1')); ?>" width="50%" height="460" style="overflow: hidden; border: 0" scrolling="no"></iframe>
                    <br>
                    <p>
                        xxx
                    </p>
                    </center>
                    <hr>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>