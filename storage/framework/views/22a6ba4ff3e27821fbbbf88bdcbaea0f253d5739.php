


<?php $__env->startSection('content'); ?>
<?php if( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th'): ?>

<style>
	iframe{
		border:0;
		margin:0;
		display:block;
	}
	.crop {
	  position: relative;
	  width: 100%;
	  overflow: hidden;
	  /* padding-top: 56.25%;  */
	  padding-top: 50%; /* 16:9 Aspect Ratio */
	}
	.responsive-iframe {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		width: 100%;
		height: 100%;
		border: none;
	}
    .googlechart {
        width: 100%; 
        min-height: 450px;
    }
    .rowgooglechart {
        margin:0 !important;
    }
</style>

<div class="app-content">
	<section class="section">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Chart</a></li>
			<li class="breadcrumb-item active" aria-current="page"> 
				<?php 
                    $year_c  = date("Y");
                    $year_c2  = date("Y")+543;
					$off_id = request()->route()->off_id; 
					// $year = request()->route()->year;
					// $pyear = $year-1;
				?>
				<?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * FROM audit_cmu.audit_db WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php  echo $db->location; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				สรุปข้อมูลปี <?php echo e($year_c+543); ?>

			</li>
		</ol>

		<div class="row" >
            <div class="col-lg-4 col-md-4">
                <form action="<?php echo e(url('/calendar')); ?>" method="post"> 
                    <?php echo e(csrf_field()); ?>

                    <div class="input-group">
                        <input type="hidden" id="off_id" name="off_id" value="<?php echo $off_id; ?>">
                        <select class="form-control" name="year_info" id="year_info">
                            <option  value="<?PHP echo $year_c;?>"><h4>-- เลือกข้อมูลปี --</h4></option>
                                <?php for($i=0; $i<=5; $i++): ?>
                                <option value="<?PHP echo date("Y")-$i; ?>">
                                    <?PHP echo date("Y")-$i+543; ?></option>
                                <?php endfor; ?>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Send</button>
                        </div>
                    </div>  
                </form>
            </div>
            
            <br><br><br>

           <div class="col-lg-12 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
                        <h4>สรุปข้อมูล<?php echo $db->location; ?> ปี <?php  echo $year_c+543; ?></h4>
					</div>
				</div>
			</div>

			<?php
				$colors = array("text-primary", "text-danger", "text-info", "text-success");
				$i = 0;
			?>

            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
            <div class="col-sm-12 col-lg-3 col-md-3 ">
				<div class="card">
					<div class="card-body p-3 text-center">
						<div class="mt-2">
                            <p><?php echo e($row->site_name); ?></p>
                                <h1 class="<?php echo $colors[$i];?>">
									<?php echo e(number_format($row->new_kW, 2)); ?>

                                </h1>
							<?php
								$i++;
							?>
							<p>/kWh/y</p>
						</div>
					</div>
				</div>
			</div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>XXXXXXX <?php  echo $year_c+543; ?></h4>
					</div>
					<div class="crop"> 
						
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>XXXXXXX <?php  echo $year_c+543; ?></h4>
					</div>
					<div class="crop"> 
						
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>XXXXXXX <?php  echo $year_c+543; ?></h4>
					</div>
					<div class="crop"> 
						
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>XXXXXXX <?php  echo $year_c+543; ?></h4>
					</div>
					<div class="crop"> 
						
					</div>
				</div>
			</div>

			
			
		</div>

	</section>
</div>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>