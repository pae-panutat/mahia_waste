


<?php $__env->startSection('content'); ?>
<?php if( Auth::user()->permission_ID == 1 or Auth::user()->email == 'admin_audit@cmu.ac.th'): ?>

<style>
	.crop {
	  position: relative;
	  width: 100%;
	  overflow: hidden;
	  padding-top: 56.25%; /* 16:9 Aspect Ratio */
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
</style>

<div class="app-content">
	<section class="section">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Chart</a></li>
			<li class="breadcrumb-item active" aria-current="page"> 
                ภาพรวมมหาวิทยาลัยเชียงใหม่
			</li>
		</ol>

		

		

	</section>
</div>
<?php else: ?>
    <script>
         alert('สำหรับ Admin เท่านั้น')
        window.location = "home";
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>