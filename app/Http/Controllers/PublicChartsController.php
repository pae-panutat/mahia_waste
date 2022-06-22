<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use DateTime;

class PublicChartsController extends Controller
{

//=================================================
//=================================================
        public function pubchart1($year)
    {
        
	    $data = DB::connection("audit_cmu") 
	          ->select("SELECT db_name FROM audit_db ORDER BY off_id ASC ");

	    $SumAirConPerYear=0; $AirConPerYear=0;
	    $SumEquipPerYear=0;  $EquipPerYear=0;
	    $SumElampPerYear=0;  $ElampPerYear=0;
	    $SumOtherPerYear=0;  $OtherPerYear=0;
	    foreach ($data as $key => $db) {
	    	//echo "db_name : ".$db->db_name."<br>";

	    	//AirCon
			$AirCon_kwh_year = DB::connection($db->db_name) 
	            ->select("SELECT SUM(kwh_per_year) AS kwh_per_year FROM airconditioner_t1 WHERE year  = '$year' ");
	            $AirConPerYear=0;
	            foreach ($AirCon_kwh_year as $key => $val_AirConPY) {
	              //echo "AirCon_kwh_year".$val_AirConPY->kwh_per_year."<br>";
	              $AirConPerYear = $AirConPerYear+$val_AirConPY->kwh_per_year;
	            }
	              $SumAirConPerYear= $SumAirConPerYear + $AirConPerYear;

	        //Equipment
			$Equip_kwh_year = DB::connection($db->db_name) 
	            ->select("SELECT SUM(kwh_per_year) AS kwh_per_year FROM equipment_t1 WHERE year  = '$year' ");
	            $EquipPerYear=0;
	            foreach ($Equip_kwh_year as $key => $val_EquipPY) {
	              //echo "Equip_kwh_year".$val_EquipPY->kwh_per_year."<br>";
	              $EquipPerYear = $EquipPerYear+$val_EquipPY->kwh_per_year;
	            }
	              $SumEquipPerYear= $SumEquipPerYear + $EquipPerYear;

	       	//Elamp
			$Elamp_kwh_year = DB::connection($db->db_name) 
	            ->select("SELECT SUM(kwh_per_year) AS kwh_per_year FROM elamp_t1 WHERE year  = '$year' ");
	            $ElampPerYear=0;
	            foreach ($Elamp_kwh_year as $key => $val_ElampPY) {
	              //echo "Elamp_kwh_year".$val_EquipPY->kwh_per_year."<br>";
	              $ElampPerYear = $ElampPerYear+$val_ElampPY->kwh_per_year;
	            }
	              $SumElampPerYear= $SumElampPerYear + $ElampPerYear;

	       	//Other
			$Other_kwh_year = DB::connection($db->db_name) 
	            ->select("SELECT SUM(kwh) AS kwh_per_year FROM expenses_t1 WHERE year  = '$year' ");
	            $OtherPerYear=0;
	            foreach ($Other_kwh_year as $key => $val_OtherPY) {
	              //echo "Other_kwh_year".$val_OtherPY->kwh_per_year."<br>";
	              $OtherPerYear = $OtherPerYear+$val_OtherPY->kwh_per_year;
	            }
	              $SumOtherPerYear= $SumOtherPerYear + $OtherPerYear;      


	    }        	
	    		 // echo "-------------------------------<br>";
	    		 // echo "AirCon".$SumAirConPerYear."<br>";
	    		 // echo "Equip".$SumEquipPerYear."<br>";
	    		 // echo "Elamp".$SumElampPerYear."<br>";
	    		 // echo "Other".$SumOtherPerYear."<br>";
        return view('PublicCharts.pubchart1',['year' => $year, 
        									  'SumAirConPerYear'=>$SumAirConPerYear,
        									  'SumEquipPerYear'=>$SumEquipPerYear,
        									  'SumElampPerYear'=>$SumElampPerYear,
        									  'SumOtherPerYear'=>$SumOtherPerYear
        									]);
    }

//=================================================
//=================================================
        public function pubchart2($year)
    {

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');
  //   	//echo "<br>".$date;
  //   	//echo "<br>".$end_date;

    	$data = DB::connection("audit_cmu")
            ->select("SELECT db_name, off_id, location AS site_name FROM audit_db ORDER BY off_id ASC  ");

            		$kwh = 0; $uarea = 0;
			        foreach ($data as $key => $value) {
				        $ARRSite_name[$key] = $value->site_name;


						$kwh_year = DB::connection($value->db_name) 
			            ->select("SELECT SUM(kwh) AS kwh_per_year FROM expenses_t1 WHERE off_id = '$value->off_id' AND year  = '$year' ");
			            	$kwh = 0;
				            foreach ($kwh_year as $k1 => $val_kwhPY) {

					            if($val_kwhPY->kwh_per_year<=0 OR $val_kwhPY->kwh_per_year=='' OR $val_kwhPY->kwh_per_year==null ){
					            	$kwh=0;
					            }else{
					            	$kwh = $val_kwhPY->kwh_per_year;
					            }
					            //echo '<br>kwh : '.$kwh;

				            }
			                
			            
						$used_area = DB::connection($value->db_name) 
			            ->select("SELECT SUM(used_area) AS used_area FROM building_info WHERE off_id = '$value->off_id' AND year  = '$year' ");
			             	$uarea = 0;
				             foreach ($used_area as $k2 => $val_uarea) {
				               
					            if($val_uarea->used_area<=0 OR $val_uarea->used_area=='' OR $val_uarea->used_area==null ){
					            	$uarea=0;
					            }else{
					            	$uarea = $val_uarea->used_area;
					            }
					            //echo '<br>uarea : '.$uarea;
				             }


				            $ARRused_area[$key] = $uarea;
				            $ARRkwh_year[$key] = $kwh;

				            if($kwh<=0 OR $uarea<=0){
				            	$ARRkwh_yearAVG[$key] = 0;
				            }else{
				            	$ARRkwh_yearAVG[$key] = $kwh/$uarea;
				            }


			       	}

			 		$site_name = implode(",", $ARRSite_name);
       				$site_name = explode(",",$site_name);
       				$site_name = json_encode($site_name,JSON_UNESCAPED_UNICODE);
       				

       				$kwh_yearAVG = implode(",", $ARRkwh_yearAVG);
					$kwh_yearAVG = explode(",",$kwh_yearAVG);
       				$kwh_yearAVG = json_encode($kwh_yearAVG,JSON_UNESCAPED_UNICODE);
       				

       				// echo '==========================================';
			        // echo '<br>';
			        // print_r($site_name);
			        // echo '<br>';
			        // print_r($kwh_yearAVG);

       	return view('PublicCharts.pubchart2', ['year' => $year, 
       										   'site_name' => $site_name, 
       										   'kwh_yearAVG' => $kwh_yearAVG 
       										  ]);



	}
//=================================================
//=================================================
        public function pubchart3($year)
    {

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');
  //   	//echo "<br>".$date;
  //   	//echo "<br>".$end_date;

    	$data = DB::connection("audit_cmu")
            ->select("SELECT db_name, off_id, location AS site_name FROM audit_db ORDER BY off_id ASC  ");

            		$kwh = 0; $aarea = 0;
			        foreach ($data as $key => $value) {
				        $ARRSite_name[$key] = $value->site_name;


						$kwh_year = DB::connection($value->db_name) 
			            ->select("SELECT SUM(kwh_per_year) AS kwh_per_year FROM airconditioner_t1 WHERE off_id = '$value->off_id' AND year  = '$year' ");
			            	$kwh = 0;
				            foreach ($kwh_year as $k1 => $val_kwhPY) {

					            if($val_kwhPY->kwh_per_year<=0 OR $val_kwhPY->kwh_per_year=='' OR $val_kwhPY->kwh_per_year==null ){
					            	$kwh=0;
					            }else{
					            	$kwh = $val_kwhPY->kwh_per_year;
					            }
					            //echo '<br>kwh : '.$kwh;

				            }
			                
			            
						$air_area = DB::connection($value->db_name) 
			            ->select("SELECT SUM(air_area) AS air_area FROM building_info WHERE off_id = '$value->off_id' AND year  = '$year' ");
			             	$uarea = 0;
				             foreach ($air_area as $k2 => $val_aarea) {
				               
					            if($val_aarea->air_area<=0 OR $val_aarea->air_area=='' OR $val_aarea->air_area==null ){
					            	$aarea=0;
					            }else{
					            	$aarea = $val_aarea->air_area;
					            }
					            //echo '<br>aarea : '.$aarea;
				             }


				            $ARRair_area[$key] = $aarea;
				            $ARRkwh_year[$key] = $kwh;

				            if($kwh<=0 OR $aarea<=0){
				            	$ARRkwh_yearAVG[$key] = 0;
				            }else{
				            	$ARRkwh_yearAVG[$key] = $kwh/$aarea;
				            }


			       	}

			 		$site_name = implode(",", $ARRSite_name);
       				$site_name = explode(",",$site_name);
       				$site_name = json_encode($site_name,JSON_UNESCAPED_UNICODE);
       				

       				$kwh_yearAVG = implode(",", $ARRkwh_yearAVG);
					$kwh_yearAVG = explode(",",$kwh_yearAVG);
       				$kwh_yearAVG = json_encode($kwh_yearAVG,JSON_UNESCAPED_UNICODE);
       				

       				// echo '==========================================';
			        // echo '<br>';
			        // print_r($site_name);
			        // echo '<br>';
			        // print_r($kwh_yearAVG);

       	return view('PublicCharts.pubchart3', ['year' => $year, 
       										   'site_name' => $site_name, 
       										   'kwh_yearAVG' => $kwh_yearAVG 
       										  ]);


    }
//=================================================
//=================================================
        public function pubchart4($year)
    {

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');
  //   	//echo "<br>".$date;
  //   	//echo "<br>".$end_date;

    	$data = DB::connection("audit_cmu")
            ->select("SELECT db_name, off_id, location AS site_name FROM audit_db ORDER BY off_id ASC  ");

            		$kwh = 0; $aarea = 0;
			        foreach ($data as $key => $value) {
				        $ARRSite_name[$key] = $value->site_name;


						$kwh_year = DB::connection($value->db_name) 
			            ->select("SELECT SUM(kwh_per_year) AS kwh_per_year FROM equipment_t1 WHERE off_id = '$value->off_id' AND year  = '$year' ");
			            	$kwh = 0;
				            foreach ($kwh_year as $k1 => $val_kwhPY) {

					            if($val_kwhPY->kwh_per_year<=0 OR $val_kwhPY->kwh_per_year=='' OR $val_kwhPY->kwh_per_year==null ){
					            	$kwh=0;
					            }else{
					            	$kwh = $val_kwhPY->kwh_per_year;
					            }
					            //echo '<br>kwh : '.$kwh;

				            }
			                
			            
						$used_area = DB::connection($value->db_name) 
			            ->select("SELECT SUM(used_area) AS used_area FROM building_info WHERE off_id = '$value->off_id' AND year  = '$year' ");
			             	$uarea = 0;
				             foreach ($used_area as $k2 => $val_uarea) {
				               
					            if($val_uarea->used_area<=0 OR $val_uarea->used_area=='' OR $val_uarea->used_area==null ){
					            	$uarea=0;
					            }else{
					            	$uarea = $val_uarea->used_area;
					            }
					            //echo '<br>uarea : '.$uarea;
				             }


				            $ARRused_area[$key] = $uarea;
				            $ARRkwh_year[$key] = $kwh;

				            if($kwh<=0 OR $uarea<=0){
				            	$ARRkwh_yearAVG[$key] = 0;
				            }else{
				            	$ARRkwh_yearAVG[$key] = $kwh/$uarea;
				            }


			       	}

			 		$site_name = implode(",", $ARRSite_name);
       				$site_name = explode(",",$site_name);
       				$site_name = json_encode($site_name,JSON_UNESCAPED_UNICODE);
       				

       				$kwh_yearAVG = implode(",", $ARRkwh_yearAVG);
					$kwh_yearAVG = explode(",",$kwh_yearAVG);
       				$kwh_yearAVG = json_encode($kwh_yearAVG,JSON_UNESCAPED_UNICODE);
       				

       				// echo '==========================================';
			        // echo '<br>';
			        // print_r($site_name);
			        // echo '<br>';
			        // print_r($kwh_yearAVG);

       	return view('PublicCharts.pubchart4', ['year' => $year, 
       										   'site_name' => $site_name, 
       										   'kwh_yearAVG' => $kwh_yearAVG 
       										  ]);


    }
//=================================================
//=================================================
        public function pubchart5($year)
    {

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');
  //   	//echo "<br>".$date;
  //   	//echo "<br>".$end_date;

    	$data = DB::connection("audit_cmu")
            ->select("SELECT db_name, off_id, location AS site_name FROM audit_db ORDER BY off_id ASC  ");

            		$kwh = 0; $aarea = 0;
			        foreach ($data as $key => $value) {
				        $ARRSite_name[$key] = $value->site_name;


						$kwh_year = DB::connection($value->db_name) 
			            ->select("SELECT SUM(kwh_per_year) AS kwh_per_year FROM elamp_t1 WHERE off_id = '$value->off_id' AND year  = '$year' ");
			            	$kwh = 0;
				            foreach ($kwh_year as $k1 => $val_kwhPY) {

					            if($val_kwhPY->kwh_per_year<=0 OR $val_kwhPY->kwh_per_year=='' OR $val_kwhPY->kwh_per_year==null ){
					            	$kwh=0;
					            }else{
					            	$kwh = $val_kwhPY->kwh_per_year;
					            }
					            //echo '<br>kwh : '.$kwh;

				            }
			                
			            
						$used_area = DB::connection($value->db_name) 
			            ->select("SELECT SUM(used_area) AS used_area FROM building_info WHERE off_id = '$value->off_id' AND year  = '$year' ");
			             	$uarea = 0;
				             foreach ($used_area as $k2 => $val_uarea) {
				               
					            if($val_uarea->used_area<=0 OR $val_uarea->used_area=='' OR $val_uarea->used_area==null ){
					            	$uarea=0;
					            }else{
					            	$uarea = $val_uarea->used_area;
					            }
					            //echo '<br>uarea : '.$uarea;
				             }


				            $ARRused_area[$key] = $uarea;
				            $ARRkwh_year[$key] = $kwh;

				            if($kwh<=0 OR $uarea<=0){
				            	$ARRkwh_yearAVG[$key] = 0;
				            }else{
				            	$ARRkwh_yearAVG[$key] = $kwh/$uarea;
				            }


			       	}

			 		$site_name = implode(",", $ARRSite_name);
       				$site_name = explode(",",$site_name);
       				$site_name = json_encode($site_name,JSON_UNESCAPED_UNICODE);
       				

       				$kwh_yearAVG = implode(",", $ARRkwh_yearAVG);
					$kwh_yearAVG = explode(",",$kwh_yearAVG);
       				$kwh_yearAVG = json_encode($kwh_yearAVG,JSON_UNESCAPED_UNICODE);
       				

       				// echo '==========================================';
			        // echo '<br>';
			        // print_r($site_name);
			        // echo '<br>';
			        // print_r($kwh_yearAVG);

       	return view('PublicCharts.pubchart5', ['year' => $year, 
       										   'site_name' => $site_name, 
       										   'kwh_yearAVG' => $kwh_yearAVG 
       										  ]);


    }
//=================================================
//=================================================
        public function pubchart6($year)
    {

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');
  //   	//echo "<br>".$date;
  //   	//echo "<br>".$end_date;

    	$data = DB::connection("audit_cmu")
            ->select("SELECT db_name, off_id, location AS site_name FROM audit_db ORDER BY off_id ASC  ");

            		$kwh = 0; $aarea = 0;
			        foreach ($data as $key => $value) {
				        $ARRSite_name[$key] = $value->site_name;


						$kwh_year = DB::connection($value->db_name) 
			            ->select("SELECT SUM(kwh) AS kwh_per_year FROM expenses_t1 WHERE off_id = '$value->off_id' AND year  = '$year' ");
			            	$kwh = 0;
				            foreach ($kwh_year as $k1 => $val_kwhPY) {

					            if($val_kwhPY->kwh_per_year<=0 OR $val_kwhPY->kwh_per_year=='' OR $val_kwhPY->kwh_per_year==null ){
					            	$kwh=0;
					            }else{
					            	$kwh = $val_kwhPY->kwh_per_year;
					            }
					            //echo '<br>kwh : '.$kwh;

				            }
			                
			            
						$used_area = DB::connection($value->db_name) 
			            ->select("SELECT SUM(used_area) AS used_area FROM building_info WHERE off_id = '$value->off_id' AND year  = '$year' ");
			             	$uarea = 0;
				             foreach ($used_area as $k2 => $val_uarea) {
				               
					            if($val_uarea->used_area<=0 OR $val_uarea->used_area=='' OR $val_uarea->used_area==null ){
					            	$uarea=0;
					            }else{
					            	$uarea = $val_uarea->used_area;
					            }
					            //echo '<br>uarea : '.$uarea;
				             }


				            $ARRused_area[$key] = $uarea;
				            $ARRkwh_year[$key] = $kwh;

				            if($kwh<=0 OR $uarea<=0){
				            	$ARRkwh_yearAVG[$key] = 0;
				            }else{
				            	$ARRkwh_yearAVG[$key] = $kwh/$uarea;
				            }


			       	}

			 		$site_name = implode(",", $ARRSite_name);
       				$site_name = explode(",",$site_name);
       				$site_name = json_encode($site_name,JSON_UNESCAPED_UNICODE);
       				

       				$kwh_yearAVG = implode(",", $ARRkwh_yearAVG);
					$kwh_yearAVG = explode(",",$kwh_yearAVG);
       				$kwh_yearAVG = json_encode($kwh_yearAVG,JSON_UNESCAPED_UNICODE);
       				

       				// echo '==========================================';
			        // echo '<br>';
			        // print_r($site_name);
			        // echo '<br>';
			        // print_r($kwh_yearAVG);

       	return view('PublicCharts.pubchart6', ['year' => $year, 
       										   'site_name' => $site_name, 
       										   'kwh_yearAVG' => $kwh_yearAVG 
       										  ]);


    }
//=================================================
//=================================================





















}
