


<?php $__env->startSection('content'); ?>
<?php if( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th'): ?>

<div class="app-content">
		<section class="section">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Chart</a></li>
				<li class="breadcrumb-item active" aria-current="page"> 
					<?php 
						// $off_id = request()->route()->off_id; 
						// $year = request()->route()->year;
						// $pyear = $year-1;
                    ?>
                    <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * FROM audit_cmu.audit_db WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php  echo $db->location; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					สรุปข้อมูลปี <?php echo e($year); ?>

				</li>
			</ol>

			<div class="row">
				<div class="col-12 col-md-12 col-lg-4">
					<div class="card">
						<div class="card-header">
							<h4>ปริมาณการใช้พลังงานไฟฟ้าปี <?php echo e($year); ?></h4>
						</div>
						<div class="card-body">
                            <?php echo e($val); ?>

						</div>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-4">
					<div class="card">
						<div class="card-header">
							<h4>ค่าใช้จ่ายพลังงานไฟฟ้าปี <?php echo e($year); ?></h4>
						</div>
						<div class="card-body">
							
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-4">
					<div class="card">
						<div class="card-header">
							<h4>ปริมาณการใช้พลังงานไฟฟ้าเปรียบเทียบปี <?php echo e($year); ?></h4>
						</div>
						<div class="card-body">
							
						</div>
					</div>
				</div>
			</div>

			
						</div>
					</div>
				</div>
			</div> --}}

		</section>
	</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>