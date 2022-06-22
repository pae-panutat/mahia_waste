@extends('layouts.app-admin')


@section('content')
@if ( Auth::user()->permission_ID == 1 or Auth::user()->email == 'admin_audit@cmu.ac.th')

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

		{{-- <div class="row" >
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ปริมาณการใช้พลังงานไฟฟ้าปี </h4>
					</div>
					<div class="crop"> 
						
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ค่าใช้จ่ายพลังงานไฟฟ้าปี</h4>
					</div>
					<div class="crop"> 
						
					</div>    
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ปริมาณการใช้พลังงานไฟฟ้าเปรียบเทียบปี</h4>
					</div>
					<div class="crop"> 
						
					</div> 
				</div>
			</div>

		  
		</div> --}}

		

	</section>
</div>
@else
    <script>
         alert('สำหรับ Admin เท่านั้น')
        window.location = "home";
    </script>
@endif
@endsection