


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
					$off_id = request()->route()->off_id; 
					$year = request()->route()->year;
					$pyear = $year-1;
				?>
				<?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * FROM audit_cmu.audit_db WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php  echo $db->location; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				สรุปข้อมูลปี <?php echo e($year); ?>

			</li>
		</ol>

		<div class="row" >

			<div class="col-lg-12 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>สัดส่วนการใช้พลังงานในระบบต่างๆ /kWh/y <?php  echo $db->location; ?> ปี <?php echo e($year); ?></h4>
					</div>
				</div>
			</div>




			<div class="col-sm-12 col-lg-3 col-md-3 ">
				<div class="card">
					<div class="card-body p-3 text-center">
						<div class="mt-2">
							<h1 class="text-primary"> 
								<?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * FROM audit_cmu.audit_db WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<?php $__currentLoopData = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
									FROM $db->db_name.airconditioner_t1 
									WHERE off_id = $off_id AND year = $year"));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php echo number_format($data->kwh,2);  ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
								
							</h1>
							<p>Air Conditioning /kWh/y</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-3 col-md-3 ">
				<div class="card">
					<div class="card-body p-3 text-center">

						<div class="mt-2">
							<h1 class="text-danger">
							<?php $__currentLoopData = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
								FROM $db->db_name.elamp_t1
								WHERE off_id = $off_id AND year = $year"));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo number_format($data2->kwh,2); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
							</h1>
							<p>Electrical equipment /kWh/y</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-3 col-md-3 ">
				<div class="card">
					<div class="card-body p-3 text-center">

						<div class="mt-2">
							<h1 class="text-success">
							<?php $__currentLoopData = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
								FROM $db->db_name.equipment_t1 
								WHERE off_id = $off_id AND year = $year"));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo number_format($data3->kwh,2); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
							</h1>
							<p>Lighting /kWh/y</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-3 col-md-3 ">
				<div class="card">
					<div class="card-body p-3 text-center">

						<div class="mt-2">
							<h1 class="text-info">
							<?php $__currentLoopData = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
								FROM $db->db_name.expenses_t1 
								WHERE off_id = $off_id AND year = $year"));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php 
									$t = $data->kwh + $data2->kwh + $data3->kwh;
									$expenseskwh_temp = $data4->kwh;	
									echo $otherkwh = number_format($expenseskwh_temp - $t,2);		
								?>
							   
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
							</h1>
							<p>Other</p>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
			
		
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ปริมาณการใช้พลังงานไฟฟ้าปี <?php echo e($year); ?></h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="<?php echo e(url('/chart1Pae&'.$off_id.'&'.$year)); ?>"></iframe>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ค่าใช้จ่ายพลังงานไฟฟ้าปี <?php echo e($year); ?></h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="<?php echo e(url('/chart2Pae&'.$off_id.'&'.$year)); ?>"></iframe>
					</div>    
				</div>
			</div>
            
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ปริมาณการใช้พลังงานไฟฟ้าเปรียบเทียบปี <?php echo e($pyear); ?> และปี <?php echo e($year); ?> </h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="<?php echo e(url('/chart3Pae&'.$off_id.'&'.$year)); ?>"></iframe>
					</div> 
				</div>
			</div>

            <div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>สัดส่วนการใช้พลังงานไฟฟ้าปี <?php echo e($year); ?> </h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="<?php echo e(url('/chart4Pae&'.$off_id.'&'.$year)); ?>"></iframe>
					</div> 
				</div>
			</div>

            
            
		  
		</div>

		

	</section>
</div>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>