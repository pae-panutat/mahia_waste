@extends('layouts.app-2')


@section('content')
@if ( Auth::user()->permission_ID == 1 or Auth::user()->permission_ID == 3 or Auth::user()->email == 'admin_audit@cmu.ac.th')

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
				@foreach (DB::SELECT(DB::raw("SELECT * FROM audit_cmu.audit_db WHERE off_id = $off_id ")); as $db)
				<?php  echo $db->location; ?>
				@endforeach
				สรุปข้อมูลปี {{ $year }}
			</li>
		</ol>

		<div class="row" >

			<div class="col-lg-12 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>สัดส่วนการใช้พลังงานในระบบต่างๆ /kWh/y <?php  echo $db->location; ?> ปี {{ $year }}</h4>
					</div>
				</div>
			</div>




			<div class="col-sm-12 col-lg-3 col-md-3 ">
				<div class="card">
					<div class="card-body p-3 text-center">
						<div class="mt-2">
							<h1 class="text-primary"> 
								@foreach (DB::SELECT(DB::raw("SELECT * FROM audit_cmu.audit_db WHERE off_id = $off_id ")); as $db)

								@foreach (DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
									FROM $db->db_name.airconditioner_t1 
									WHERE off_id = $off_id AND year = $year")); as $data)
									<?php echo number_format($data->kwh,2);  ?>
								@endforeach  
								
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
							@foreach (DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
								FROM $db->db_name.elamp_t1
								WHERE off_id = $off_id AND year = $year")); as $data2)
								<?php echo number_format($data2->kwh,2); ?>
							@endforeach  
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
							@foreach (DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
								FROM $db->db_name.equipment_t1 
								WHERE off_id = $off_id AND year = $year")); as $data3)
								<?php echo number_format($data3->kwh,2); ?>
							@endforeach  
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
							@foreach (DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
								FROM $db->db_name.expenses_t1 
								WHERE off_id = $off_id AND year = $year")); as $data4)
								<?php 
									$t = $data->kwh + $data2->kwh + $data3->kwh;
									$expenseskwh_temp = $data4->kwh;	
									echo $otherkwh = number_format($expenseskwh_temp - $t,2);		
								?>
							   
							@endforeach  
							</h1>
							<p>Other</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach  
			{{-- @include('Charts.mixchart') --}}
		
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ปริมาณการใช้พลังงานไฟฟ้าปี {{ $year }}</h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="{{url('/chart1Pae&'.$off_id.'&'.$year)}}"></iframe>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ค่าใช้จ่ายพลังงานไฟฟ้าปี {{ $year }}</h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="{{url('/chart2Pae&'.$off_id.'&'.$year)}}"></iframe>
					</div>    
				</div>
			</div>
            
			<div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ปริมาณการใช้พลังงานไฟฟ้าเปรียบเทียบปี {{ $pyear }} และปี {{ $year }} </h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="{{url('/chart3Pae&'.$off_id.'&'.$year)}}"></iframe>
					</div> 
				</div>
			</div>

            <div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>สัดส่วนการใช้พลังงานไฟฟ้าปี {{ $year }} </h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="{{url('/chart4Pae&'.$off_id.'&'.$year)}}"></iframe>
					</div> 
				</div>
			</div>

            {{-- <div class="col-lg-6 col-md-12">
				<div class="card overflow-hidden" style="overflow-x:auto;">
					<div class="card-header">
						<h4>ค่าใช้จ่ายพลังงานไฟฟ้า 12 เดือน {{ $pyear }} และปี {{ $year }} </h4>
					</div>
					<div class="crop"> 
						<iframe class="responsive-iframe" src="{{url('/chart5Pae&'.$off_id.'&'.$year)}}"></iframe>
					</div> 
				</div>
			</div>
     --}}
            
		  
		</div>

		

	</section>
</div>

@endif
@endsection