<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use App\Mail\MAIL_ERDIPV;
use Illuminate\Support\Facades\Session;



use App\Post;
use DateTime;
use PDF;

use App\confirm_pv;



class esmConsumeOfficeController extends Controller

{
    public function index($fk_fac)
    {

        $gname="";
        $esm_consume_office ="";
        $total_energycon_month=0;
        $max_kw=0;
        $total_energycon_day=0;
        $kw_day=0;

        $getSite = DB::connection('pvProduceOffice')
            ->select("SELECT name_fac as gname,number_meter as site_id FROM tbl_solar_point_data where fk_fac='$fk_fac' GROUP BY name_fac, number_meter");
        if($getSite){
            foreach($getSite as $item){
                $max_kw = DB::connection('pvProduceOffice')
                    ->select("SELECT MAX(kW) as kW from electric_daily where month(timeIn)=month(CURRENT_DATE()) and year(timeIn)=year(CURRENT_DATE()) and site_id='$item->site_id' ");
                $kw_day = DB::connection('pvProduceOffice')
                    ->select("SELECT MAX(kW) as kW from electric_daily where DATE(timeIn)=DATE(CURRENT_DATE())  and site_id='$item->site_id' ");

                $total_energycon_month = DB::connection('pvProduceOffice')
                    ->select("SELECT MAX(energyConsumtion)-MIN(energyConsumtion) as kWh from electric_daily where month(timeIn)=month(CURRENT_DATE())
and year(timeIn)=year(CURRENT_DATE()) and site_id='$item->site_id'  and energyConsumtion>10000 and energyConsumtion < 9999999");

                $total_energycon_day = DB::connection('pvProduceOffice')
                    ->select("SELECT MAX(energyConsumtion)-MIN(energyConsumtion) as kWh from electric_daily where DATE(timeIn)=DATE
(CURRENT_DATE()) and site_id='$item->site_id' and energyConsumtion>10000 and energyConsumtion < 9999999  ");

                $realtime = DB::connection('pvProduceOffice')
                    ->select("SELECT MAX(timeIn) as timeIn,energyConsumtion,kW,kWh_RU_value,kwh_ru_export,site_id from electric where DATE(timeIn)=DATE(CURRENT_DATE()) and site_id='$item->site_id' and
energyConsumtion>10000 and energyConsumtion < 9999999 GROUP BY site_id order by timeIn desc   ");


            }

        }
//
//        $total_energycon_month=json_encode($total_energycon_month);
//        $total_energycon_day = json_encode($total_energycon_day);
//        $max_kw = json_encode($max_kw);
//        $kw_day = json_encode($kw_day);


//        dd($total_energycon_month);




        return view('esmConsumeOffice.index',['gname'=>$gname,'fk_fac'=>$esm_consume_office,
            'total_energycon_month'=>$total_energycon_month,
            'max_kw'=>$max_kw,
            'total_energycon_day'=>$total_energycon_day,
            'kw_day'=>$kw_day,
            'fk_fac'=>$fk_fac,'realtime'=>$realtime]);


    }


//===================================================================================================================
    public function offesm_indextest()
    {

//        if(Auth::check()){
//        } else {
//            return redirect('/login');
//        }
        session_start();
        print_r($_SESSION);
        dd(Session::all());
    }


//---------------------------------------------------------------------- //Water_Meter จากเอก

    public function offesm_index($fk_fac)
    {

    //       if(Auth::check()){
    //        } else {
    //            return redirect('/login');
    //        }
        //dd(session()->all());

        //echo session()->get('cmuit');
        $esm_consume_office = $fk_fac;
        $fk_fac = $esm_consume_office;
        //echo $fk_fac;
		//=============================================================================================================
        //total consumer on this month
		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');
        

    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		          gname, MAX(energyConsumtion)-MIN(energyConsumtion) AS total_energyConsumtion
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$end_date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<50000000
                      GROUP BY t2.site_id
					  ");
        
            		$total_energycon_month = 0;


            		if($data){
        				foreach ($data as $key => $value) {
		        			$gname						= $value->gname;
		        			$TotalEnergyConsumtion		= $value->total_energyConsumtion;

				            if($TotalEnergyConsumtion==null)
				            {
				                $total_energycon_month = 0.00;
				            }else{
				                $total_energycon_month = $total_energycon_month+$TotalEnergyConsumtion;
				            }

			        	}
			      
            		}else{

					    	$data2 = DB::connection("pvProduceOffice")
					            ->select("SELECT
					            		          gname
										  FROM
											  payment.db AS t1
										  INNER JOIN cmuElectric.site_map AS t2
											    ON t1.faculty_id = t2.facaulty_id
										  INNER JOIN cmuElectric.electric AS t3
											    ON t2.site_id = t3.site_id
										  WHERE
												t2.facaulty_id='$fk_fac'
										  AND t3.energyConsumtion>10000
										  AND t3.energyConsumtion<50000000
					                      GROUP BY t2.site_id
										  ");
					        foreach ($data2 as $key2 => $value2) {
							$gname						= $value2->gname;
		        			$TotalEnergyConsumtion		= 0;
					        }

					}

		//=============================================================================================================
		//max kw on this month

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');


        $data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		      MAX(kW) AS maxkw
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$end_date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<50000000
            		  ");

			        foreach ($data as $key => $value) {
			        			$maxkw		= $value->maxkw;

				            if($maxkw==null)
				            {
				                $max_kw = 0.00;
				            }else{
				                $max_kw = $maxkw;
				            }

			       	}

		//=============================================================================================================
		//total consumtion on this day

		$date = date('Y-m-d');
    	$data = DB::connection("pvProduceOffice")

            ->select("SELECT
            		         (MAX(energyConsumtion)-MIN(energyConsumtion)) AS total_energyConsumtion_d
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<50000000
					  GROUP BY t2.site_id
            		  ");

            		$total_energycon_day = 0;
			        foreach ($data as $key => $value) {

			        		$totalenergycon_day		= $value->total_energyConsumtion_d;
				            if($totalenergycon_day==null)
				            {
				                $total_energycon_day = 0.00;
				            }else{
				                $total_energycon_day = $totalenergycon_day+$total_energycon_day;
				            }

			       	}

			       	//echo "total_energycon_day : ".$total_energycon_day;
		//=============================================================================================================
		//max kw on this day
		$date = date('Y-m-d');
    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		         MAX(kW) AS kw_day
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<50000000
            		  ");

			        foreach ($data as $key => $value) {
			        			$kw_day		= $value->kw_day;

				            if($kw_day==null)
				            {
				                $kw_day = 0.00;
				            }else{
				                $kw_day = $kw_day;
				            }
			       	}

		//=============================================================================================================
        
//        if($fk_fac == 26 )
//            {
//                $gn = 'สภาบันภาษา';
//            }else{
//                $gn = $gname;
//            }

        	return view('esmConsumeOffice.esm_index',['gname'=>$gname,'fk_fac'=>$esm_consume_office,
        										 'total_energycon_month'=>$total_energycon_month,
        										 'max_kw'=>$max_kw,
        										 'total_energycon_day'=>$total_energycon_day,
        										 'kw_day'=>$kw_day ]);



    }

//===================================================================================================================








//===================================================================================================================
//===================================================================================================================
    public function esm_cover()
    {

        if(Auth::check()){
        } else {
            return redirect('/login');
        }


        //echo "from Controller";

        $data = DB::connection("pvProduceOffice")
        ->select("SELECT DISTINCT(gname), faculty_id FROM (SELECT * FROM payment.db) t1
				  INNER JOIN (SELECT site_id, site_name, facaulty_id FROM site_map GROUP BY site_id) t2 ON t1.faculty_id = t2.facaulty_id
				  ORDER BY t1.faculty_id");


        return view('esmConsumeOffice.esm_cover',['data'=>$data]);
    }

//===================================================================================================================

    public function esm_index(Request $req)
    {

        if(Auth::check()){
        } else {
            return redirect('/login');
        }

        $esm_consume_office = $req->input('esm_consume_office');
        $fk_fac = $esm_consume_office;

        echo "esm_consume_office : ".$esm_consume_office;

       if($esm_consume_office !='***'){

		//=============================================================================================================
        //total consumer on this month
		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');

    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		          gname, MAX(energyConsumtion)-MIN(energyConsumtion) AS total_energyConsumtion
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$end_date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<99000000
                      GROUP BY t2.site_id
					  ");

            		$total_energycon_month = 0;
			        foreach ($data as $key => $value) {
			        			$gname						= $value->gname;
			        			$TotalEnergyConsumtion		= $value->total_energyConsumtion;

				            if($TotalEnergyConsumtion==null)
				            {
				                $total_energycon_month = 0.00;
				            }else{
				                $total_energycon_month = $total_energycon_month+$TotalEnergyConsumtion;
				            }

			       	}

		//=============================================================================================================
		//max kw on this month

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');


        $data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		      MAX(kW) AS maxkw
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$end_date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<99000000
            		  ");

			        foreach ($data as $key => $value) {
			        			$maxkw		= $value->maxkw;

				            if($maxkw==null)
				            {
				                $max_kw = 0.00;
				            }else{
				                $max_kw = $maxkw;
				            }

			       	}

		//=============================================================================================================
		//total consumtion on this day

		$date = date('Y-m-d');

    	$data = DB::connection("pvProduceOffice")

            ->select("SELECT
            		         (MAX(energyConsumtion)-MIN(energyConsumtion)) AS total_energyConsumtion_d
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<99000000
					  GROUP BY t2.site_id
            		  ");

            		$total_energycon_day = 0;
			        foreach ($data as $key => $value) {

			        		$totalenergycon_day		= $value->total_energyConsumtion_d;

				            if($totalenergycon_day==null)
				            {
				                $total_energycon_day = 0.00;
				            }else{
				                $total_energycon_day = $totalenergycon_day+$total_energycon_day;
				            }

			       	}
		//=============================================================================================================
		//max kw on this day
		$date = date('Y-m-d');

    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		         MAX(kW) AS kw_day
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<99000000
            		  ");


			        foreach ($data as $key => $value) {
			        			$kw_day		= $value->kw_day;

				            if($kw_day==null)
				            {
				                $kw_day = 0.00;
				            }else{
				                $kw_day = $kw_day;
				            }
			       	}



		//=============================================================================================================

        	return view('esmConsumeOffice.esm_index',['gname'=>$gname,'fk_fac'=>$esm_consume_office,
        										 'total_energycon_month'=>$total_energycon_month,
        										 'max_kw'=>$max_kw,
        										 'total_energycon_day'=>$total_energycon_day,
        										 'kw_day'=>$kw_day ]);

        }else{

            //return to cover
            $data = DB::connection("pvProduceOffice")
            ->select("SELECT DISTINCT(gname), faculty_id FROM (SELECT * FROM payment.db) t1
				  INNER JOIN (SELECT site_id, site_name, facaulty_id FROM site_map GROUP BY site_id) t2 ON t1.faculty_id = t2.facaulty_id
				  ORDER BY t1.faculty_id
                      ");


            return view('esmConsumeOffice.esm_cover',['data'=>$data]);
        }

    }

//===================================================================================================================

       public function esm_chart1($fk_fac)
      {

        //echo "esm_chart1 : fk_fac => ".$fk_fac;

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');

  //   	//echo "<br>".$date;
  //   	//echo "<br>".$end_date;

    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		         site_name, (MAX(energyConsumtion)-MIN(energyConsumtion)) AS total_energyConsumtion
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$end_date 23:59:59'
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<99000000
                      GROUP BY t2.site_id
					  ");

            		if($data){
					        foreach ($data as $key => $value) {
					        			//$site_name					= $value->site_name;
					        			$total_energyConsumtion			= $value->total_energyConsumtion;

						            if($total_energyConsumtion==null)
						            {
						            	$ARRSite_name[$key] = $value->site_name;
						                $ARRTotalEnergyConsumtion[$key]= 0.00;

						            }else{
						            	$ARRSite_name[$key] = $value->site_name;
						                $ARRTotalEnergyConsumtion[$key] = $value->total_energyConsumtion;
						            }

					       	}

            		}else{

				    	$data2 = DB::connection("pvProduceOffice")
				            ->select("SELECT
				            		         site_name
									  FROM
										  payment.db AS t1
									  INNER JOIN cmuElectric.site_map AS t2
										    ON t1.faculty_id = t2.facaulty_id
									  INNER JOIN cmuElectric.electric AS t3
										    ON t2.site_id = t3.site_id
									  WHERE
											t2.facaulty_id='$fk_fac'
				                      GROUP BY t2.site_id
									  ");

						foreach ($data2 as $key2 => $value2) {
								$ARRSite_name[$key2] = $value2->site_name;
								$ARRTotalEnergyConsumtion[$key2] = 0;
						}
            		}

		 			$site_name = implode(",", $ARRSite_name);
   					$site_name = explode(",",$site_name);
   					$site_name = json_encode( $site_name,JSON_UNESCAPED_UNICODE);
		        	$total_consumtion = json_encode($ARRTotalEnergyConsumtion);

			        //echo '<br>';
			        //print_r($site_name);
			        //echo '<br>';
			        //print_r($total_consumtion);

             return view('esmConsumeOffice.esm_chart1', ['site_name' => $site_name, 'total_consumtion' => $total_consumtion]);
      }

//================================================================================================================================

       public function esm_chart2($fk_fac)
      {

        //echo "esm_chart2 : fk_fac => ".$fk_fac;

		$date = date('Y-m-1',strtotime('this month'));
    	$end_date = date('Y-m-d');


        $data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		         site_name, MAX(kW) AS buildingkw
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND t3.timeIn BETWEEN '$date 00:00:00' and '$end_date 23:59:59'
                      GROUP BY t2.site_id
            		  ");

					if($data){
				        foreach ($data as $key => $value) {
				        			//$site_name		= $value->site_name;
				        			$buildingkw			= $value->buildingkw;
					            if($buildingkw==null)
					            {
					            	$ARRSite_name[$key] = $value->site_name;
					                $ARRbuildingkw[$key]= 0.00;

					            }else{
					            	$ARRSite_name[$key]  = $value->site_name;
					                $ARRbuildingkw[$key] = $value->buildingkw;

					            }
				       	}

					}else{

				        $data2 = DB::connection("pvProduceOffice")
    					->select("SELECT
    		         			  site_name
								  FROM
									  payment.db AS t1
								  INNER JOIN cmuElectric.site_map AS t2
									    ON t1.faculty_id = t2.facaulty_id
								  INNER JOIN cmuElectric.electric AS t3
									    ON t2.site_id = t3.site_id
								  WHERE
										t2.facaulty_id='$fk_fac'
			                      GROUP BY t2.site_id
			            		  ");

						foreach ($data2 as $key2 => $value2) {
								$ARRSite_name[$key2] = $value2->site_name;
								$ARRbuildingkw[$key2] = 0;
						}

					}

				 		$site_name = implode(",", $ARRSite_name);
	       				$site_name = explode(",",$site_name);
	       				$site_name = json_encode( $site_name,JSON_UNESCAPED_UNICODE);
				        $building_kw = json_encode($ARRbuildingkw);
            return view('esmConsumeOffice.esm_chart2', ['site_name' => $site_name, 'building_kw' => $building_kw]);

	  }

//================================================================================================================================

       public function esm_chart3($fk_fac)
      {

        //echo "esm_chart3 : fk_fac => ".$fk_fac;

        $date = date('Y-m-d',strtotime('-30 days'));
    	$end_date = date('Y-m-d');

    	$database_name = DB::connection("pvProduceOffice")
            ->select("SELECT faculty_id,link,gname,zone
            		  FROM payment.db
            		  WHERE faculty_id='$fk_fac'
            		   ");
        foreach ($database_name as $key => $valdb) {
        	$db = $valdb->link;
        }

    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
						  DATE(timeIn) AS timeIn,
						  SUM(kWh) AS total_energyConsumtion
					  FROM
						  (SELECT
						      (MAX(a.energyConsumtion)-MIN(a.energyConsumtion)) AS kWh,
						      a.site_id ,
						      b.site_name ,
						      a.timeIn
						    FROM
						      $db.electric a
						    INNER JOIN $db.siteconfig b ON a.site_id = b.site_id
						    WHERE
						      a.timeIn BETWEEN '$date 00:00:00' and '$end_date 23:59:59'
						    AND
						      a.energyConsumtion>10000
						    AND
						      a.energyConsumtion<99000000
						    GROUP BY DATE(a.timeIn),site_id
						  ) t
					  GROUP BY DATE(timeIn)
					  ORDER BY DATE(timeIn) ASC");


					if(count($data)>0){

				        foreach ($data as $key => $value) 
				        {
				        		$ARRtimeIn[$key]		 			= $value->timeIn;
								$ARRTotalEnergyConsumtion[$key] 	= $value->total_energyConsumtion;
				        }

				    			$timeIn = implode(",", $ARRtimeIn);
				   				$timeIn = explode(",",$timeIn);
				   				$timeIn = json_encode( $timeIn,JSON_UNESCAPED_UNICODE);
						        $total_consumtion = json_encode($ARRTotalEnergyConsumtion);
					}else{


						$adate = date("Y-m-d");
						$start_date = date("Y-m-d",strtotime("-30 days",strtotime($adate)));

						$key = 1 ;
						while (strtotime($start_date) <= strtotime($adate)) {

								$ARRtimeIn[$key] = date($start_date);
								$ARRTotalEnergyConsumtion[$key] 	= 0.00;

								$start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
								$key = $key+1;
						}

				    			$timeIn = implode(",", $ARRtimeIn);
				   				$timeIn = explode(",",$timeIn);
				   				$timeIn = json_encode( $timeIn,JSON_UNESCAPED_UNICODE);
						        $total_consumtion = json_encode($ARRTotalEnergyConsumtion);

					}

		        //echo "<br>";
		       	//print_r($timeIn);
		       	//echo "<br>";
		       	//print_r($total_consumtion);

			    return view('esmConsumeOffice.esm_chart3', ['timeIn' => $timeIn, 'total_consumtion' => $total_consumtion]);

      }


//===================================================================================================================
       public function esm_chart4($fk_fac)
      {

        //echo "esm_chart4 : fk_fac => ".$fk_fac;

    	$database_name = DB::connection("pvProduceOffice")
            ->select("SELECT faculty_id,link,gname,zone
            		  FROM payment.db
            		  WHERE faculty_id='$fk_fac'
            		   ");
        foreach ($database_name as $key => $valdb) {
        	$db = $valdb->link;
        }

    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT SUM(kW) as kW,site_name as name_identify,site_id,time(timeIn) as timeIn
		            	FROM(SELECT (MAX(a.powerAvg)) as kW, a.site_id,b.site_name, FLOOR(UNIX_TIMESTAMP(a.timeIn)/(15*60)) AS timekey, a.timeIn
			            	FROM $db.electric a
			            	INNER JOIN $db.siteconfig b ON a.site_id = b.site_id
			            	WHERE DATE(a.timeIn)=DATE(CURRENT_TIMESTAMP)
			            	AND
						      a.energyConsumtion>10000
						    AND
						      a.energyConsumtion<99000000
			            	GROUP BY site_name,HOUR(a.timeIn),timekey) t
		            	GROUP BY t.timekey");

				if(count($data)>0){

				        foreach ($data as $key => $value) {
			        		$timeIn	= $value->timeIn;
						    if($timeIn==null)
						    {
				        	$ARRtimeIn[$key]	= 0;
							$ARRkw15m[$key] 	= 0;
						    }else{
				        	$ARRtimeIn[$key]	= $value->timeIn;
							$ARRkw15m[$key] 	= $value->kW;
						    }
					}
				}else{
					        $ARRtimeIn[0]	= 0;
							$ARRkw15m[0] 	= 0;
				}

    			$timeIn = implode(",", $ARRtimeIn);
   				$timeIn = explode(",",$timeIn);
   				$timeIn = json_encode( $timeIn,JSON_UNESCAPED_UNICODE);

       			$kw15m = implode(",",$ARRkw15m);
		        $kw15m = explode(",",$kw15m);
		        $kw15m = json_encode($kw15m);

		        //echo "<br>";
		       	//print_r($timeIn);
		       	//echo "<br>";
		       	//print_r($total_consumtion);

			    return view('esmConsumeOffice.esm_chart4', ['timeIn' => $timeIn, 'kw15m' => $kw15m]);
      }

//===================================================================================================================

       public function esm_chart5($fk_fac)
      {

        //echo "esm_chart5 : fk_fac => ".$fk_fac;

    	$database_name = DB::connection("pvProduceOffice")
            ->select("SELECT faculty_id,link,gname,zone
            		  FROM payment.db
            		  WHERE faculty_id='$fk_fac'
            		   ");
        foreach ($database_name as $key => $valdb) {
        	$db = $valdb->link;
        }


    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
						  MONTH(timeIn) AS timeIn,
						  SUM(kWh) AS kWh_year
					  FROM
						  (SELECT
						      (MAX(a.energyConsumtion)-MIN(a.energyConsumtion)) AS kWh,
						      a.site_id ,
						      b.site_name ,
						      a.timeIn
						    FROM
						      $db.electric a
						    INNER JOIN $db.siteconfig b ON a.site_id = b.site_id
						    WHERE
						      YEAR(a.timeIn) = YEAR(CURRENT_TIMESTAMP)
						    AND
						      a.energyConsumtion>10000
						    AND
						      a.energyConsumtion<99000000
						    GROUP BY MONTH(a.timeIn),site_id
						  ) t
					  GROUP BY MONTH(timeIn)
					  ORDER BY MONTH(timeIn) ASC");

			        foreach ($data as $key => $value) {

			        		if($value->timeIn == 1){$timeIn = "มกราคม";}elseif($value->timeIn == 2){$timeIn = "กุมภาพันธ์";}
			        		elseif($value->timeIn == 3){$timeIn = "มีนาคม";}elseif($value->timeIn == 4){$timeIn = "เมษายน";}
			        		elseif($value->timeIn == 5){$timeIn = "พฤษภาคม";}elseif($value->timeIn == 6){$timeIn = "มิถุนายน";}
			        		elseif($value->timeIn == 7){$timeIn = "กรกฎาคม";}elseif($value->timeIn == 8){$timeIn = "สิงหาคม";}
			        		elseif($value->timeIn == 9){$timeIn = "กันยายน";}elseif($value->timeIn == 10){$timeIn = "ตุลาคม";}
			        		elseif($value->timeIn == 11){$timeIn = "พฤศจิกายน";}elseif($value->timeIn == 12){$timeIn = "ธันวาคม";}

				            $ARRtimeIn[$key]		= $timeIn;
				            $temp					= number_format($value->kWh_year,2);
				            //------------------------------------
				            //string->float
	                        $newString1=0;
                            $string1 = $temp;
                            $arrString1 = explode(',', $string1);
                            foreach ($arrString1 as $v1) {
                            $newString1 .=  $v1;
                            }
                            $number1 = (float) $newString1;
                            //------------------------------------
				            $ARRkWh_year[$key] 	    = 	$number1;
			       	}


			       	//echo "----<br>";
			       	//print_r($ARRkWh_year);

			       	$timeIn = implode(",", $ARRtimeIn);
       				$timeIn = explode(",",$timeIn);
       				$timeIn = json_encode( $timeIn,JSON_UNESCAPED_UNICODE);

	       			$kWh_year = implode(",",$ARRkWh_year);
			        $kWh_year = explode(",",$kWh_year);
			        $kWh_year = json_encode($kWh_year);

			        // echo "----<br>";
			        // print_r($timeIn);
			        // echo "-----<br>";
			        // print_r($kWh_year);

			        return view('esmConsumeOffice.esm_chart5', ['timeIn' => $timeIn, 'kWh_year' => $kWh_year]);
      }

//===================================================================================================================
       public function esm_chart6($fk_fac)
      {

        //echo "esm_chart6 : fk_fac => ".$fk_fac;

    	$data = DB::connection("pvProduceOffice")
            ->select("SELECT
            		         MONTH(timeIn) AS timeIn, MAX(kW) AS max_kW
					  FROM
						  payment.db AS t1
					  INNER JOIN cmuElectric.site_map AS t2
						    ON t1.faculty_id = t2.facaulty_id
					  INNER JOIN cmuElectric.electric AS t3
						    ON t2.site_id = t3.site_id
					  WHERE
							t2.facaulty_id='$fk_fac'
					  AND YEAR(t3.timeIn) >= YEAR(CURRENT_TIMESTAMP)
					  AND t3.energyConsumtion>10000
					  AND t3.energyConsumtion<99000000
    				  GROUP BY MONTH(t3.timeIn)
					  ORDER BY t3.timeIn ASC");

			        foreach ($data as $key => $value) {

			        		if($value->timeIn == 1){$timeIn = "มกราคม";}elseif($value->timeIn == 2){$timeIn = "กุมภาพันธ์";}
			        		elseif($value->timeIn == 3){$timeIn = "มีนาคม";}elseif($value->timeIn == 4){$timeIn = "เมษายน";}
			        		elseif($value->timeIn == 5){$timeIn = "พฤษภาคม";}elseif($value->timeIn == 6){$timeIn = "มิถุนายน";}
			        		elseif($value->timeIn == 7){$timeIn = "กรกฎาคม";}elseif($value->timeIn == 8){$timeIn = "สิงหาคม";}
			        		elseif($value->timeIn == 9){$timeIn = "กันยายน";}elseif($value->timeIn == 10){$timeIn = "ตุลาคม";}
			        		elseif($value->timeIn == 11){$timeIn = "พฤศจิกายน";}elseif($value->timeIn == 12){$timeIn = "ธันวาคม";}

				            $ARRtimeIn[$key]		 			= $timeIn;
				            $temp					= number_format($value->max_kW,2);
				            //------------------------------------
				            //string->float
	                        $newString1=0;
                            $string1 = $temp;
                            $arrString1 = explode(',', $string1);
                            foreach ($arrString1 as $v1) {
                            $newString1 .=  $v1;
                            }
                            $number1 = (float) $newString1;
                            //------------------------------------
				            $ARRmax_kW[$key] 	= 	$number1;
			       	}

			       	$timeIn = implode(",", $ARRtimeIn);
       				$timeIn = explode(",",$timeIn);
       				$timeIn = json_encode( $timeIn,JSON_UNESCAPED_UNICODE);

	       			$max_kW = implode(",",$ARRmax_kW);
			        $max_kW = explode(",",$max_kW);
			        $max_kW = json_encode($max_kW);

			        //echo "<br>";
			       	//print_r($timeIn);
			       	//echo "<br>";
			       	//print_r($total_consumtion);

            return view('esmConsumeOffice.esm_chart6', ['timeIn' => $timeIn, 'max_kW' => $max_kW]);

      }

//---------------------------------------------------------------------------------------------------------------------------------//

				public  function dashboard($fk_fac,$gname)
				{
					$db_Water = DB::connection('water')
									->select("SELECT meter_config, name_local, timeIn, SUM(VolumeflowVal) as new_Vol
									FROM loccation_meter 
									LEFT join waterflow on loccation_meter.meter_config = waterflow.IdMeter 
									WHERE meter_config = IdMeter
									AND DATE(timeIn) = CURDATE()
									GROUP BY IdMeter");
					//dd($db_Water);

					foreach($db_Water as $key => $value){
						// dd($value->name_local);
						if($value->meter_config==20){
							$get_name[$key] = $value->name_local;
				
							$get_value[$key] = $value->new_Vol*3600;
						}else{
							$get_name[$key] = $value->name_local;
		
							$get_value[$key] = $value->new_Vol;
						}

					}
					// print_r($get_name);
			
					// print_r($get_value);
					// echo "<br>";
					// exit();
					
					$get_name = json_encode($get_name, JSON_NUMERIC_CHECK);
			
					$get_value = json_encode($get_value, JSON_NUMERIC_CHECK);


					//-------------------------------------------------------------------------------------//

					$db_Water_Max = DB::connection('water')
										->select("SELECT meter_config, name_local, MONTH(timeIn), SUM(VolumeflowVal) as Max_Vol
										FROM loccation_meter 
										LEFT join waterflow on loccation_meter.meter_config = waterflow.IdMeter 
										WHERE meter_config = IdMeter
										AND MONTH(timeIn) = MONTH(CURDATE()) 
										AND YEAR(timeIn) = YEAR(CURRENT_DATE()) 
										GROUP BY IdMeter");

					foreach($db_Water_Max as $key => $value){
						if($value->meter_config==20){
							$get_MaxVal_Name[$key] = $value->name_local;
							$get_MaxVal_month[$key] = $value->Max_Vol*3600;
						}else{
							$get_MaxVal_Name[$key] = $value->name_local;
							$get_MaxVal_month[$key] = $value->Max_Vol;
						}
					}
					// print_r($get_MaxVal_Name);
					// print_r($get_MaxVal_month);
					// echo "<br>";
					// exit();

					$get_MaxVal_Name = json_encode($get_MaxVal_Name, JSON_NUMERIC_CHECK);
			
					$get_MaxVal_month = json_encode($get_MaxVal_month, JSON_NUMERIC_CHECK);


					//-------------------------------------------------------------------------------------//

					$db_Water_Month = DB::connection('water')
										->select("SELECT meter_config, name_local, max(timeIn), MAX(TotalizerVal)-MIN(TotalizerVal) as total
											FROM loccation_meter 
											LEFT join waterflow on loccation_meter.meter_config = waterflow.IdMeter 
											WHERE MONTH(timeIn) = MONTH(CURRENT_DATE()) 
											AND YEAR(timeIn) = YEAR(CURRENT_DATE()) 
											AND meter_config
											GROUP BY IdMeter");
					// dd($db_Water_Month);

					foreach($db_Water_Month as $key => $value){			
							$get_Water_Month_Name[$key] = $value->name_local;
							$get_Water_Month_Val[$key] = $value->total;
					}
					
					// print_r($get_Water_Month_Name);
					// print_r($get_Water_Month_Val);
					// echo "<br>";
					// exit();

					$get_Water_Month_Name = json_encode($get_Water_Month_Name, JSON_NUMERIC_CHECK);
			
					$get_Water_Month_Val = json_encode($get_Water_Month_Val, JSON_NUMERIC_CHECK);


					//-------------------------------------------------------------------------------------//

					return view('esmConsumeOffice.dashboard',['fk_fac' => $fk_fac, 
															  'gname' => $gname,
															  'get_name' => $get_name,
															  'get_value' => $get_value,

															  'get_MaxVal_Name' => $get_MaxVal_Name,
															  'get_MaxVal_month' => $get_MaxVal_month,

															  'get_Water_Month_Name' => $get_Water_Month_Name,
															  'get_Water_Month_Val' => $get_Water_Month_Val,

															]);

				}

//---------------------------------------------------------------------------------------------------------------------------------

      public  function water($fk_fac){
        $getwater = DB::connection('water')
            ->select("SELECT * FROM loccation_meter  where faculty_id='$fk_fac' ");
        foreach($getwater as $item){
            $getDatatodays = DB::connection('water')
                ->select("SELECT * FROM waterflow where IdMeter='$item->meter_config' and date(timeIn)=CURRENT_DATE()
 order by timeIn desc limit 0,1");
            if($getDatatodays){
                $timeIn = ["timeIn" => $getDatatodays[0]->timeIn];
                $IdMeter = ["IdMeter" => $getDatatodays[0]->IdMeter];
                $VolumeflowVal = ["VolumeflowVal" => $getDatatodays[0]->VolumeflowVal];
                $MassflowVal = ["MassflowVal" => $getDatatodays[0]->MassflowVal];
                $TotalizerVal = ["TotalizerVal" => $getDatatodays[0]->TotalizerVal];
                $getDatatoday[] = array_merge($timeIn, $IdMeter, $VolumeflowVal, $MassflowVal, $TotalizerVal);
            }
            
            $get_month = date('m');
            if($get_month=='01'){
              $get_month = '12';
              $get_year = date('Y',strtotime('-1 year'));
			  $payments = DB::connection('water')
				->select(" SELECT MAX(TotalizerVal)-MIN(TotalizerVal) as total, MAX(timeIn) as timeIn,MAX(TotalizerVal) as
 maxTotalizer,MIN(TotalizerVal) as minTotalizer,IdMeter  FROM waterflow where IdMeter='$item->meter_config' and month(timeIn)='$get_month' and year(timeIn)='$get_year'");
			}else{
			  $payments = DB::connection('water')
				->select(" SELECT MAX(TotalizerVal)-MIN(TotalizerVal) as total, MAX(timeIn) as timeIn,MAX(TotalizerVal) as
 maxTotalizer,MIN(TotalizerVal) as minTotalizer,IdMeter  FROM waterflow where IdMeter='$item->meter_config' and month(timeIn)=month
 (CURRENT_DATE())-1 and year(timeIn)=year(CURRENT_DATE())");
			}

            

            if($payments){
                $timeIn = ["timeIn" => $payments[0]->timeIn];
                $IdMeter = ["IdMeter" => $payments[0]->IdMeter];
                $minTotalizer = ["minTotalizer" => $payments[0]->minTotalizer];
                $maxTotalizer = ["maxTotalizer" => $payments[0]->maxTotalizer];
                $total = ["total" => $payments[0]->total];
                $payment[] = array_merge($timeIn, $IdMeter, $minTotalizer, $maxTotalizer, $total);
            }

}

          $getDatamonth = DB::connection('water')
              ->select(" SELECT
	SUM(VolumeflowVal) AS VolumeflowVal ,
	DAY(timeIn) AS timeIn,IdMeter
FROM
	waterflow as water INNER JOIN loccation_meter as location ON water.IdMeter=location.meter_config
WHERE
MONTH(timeIn) = MONTH(CURRENT_DATE())
AND YEAR(timeIn) = YEAR(CURRENT_DATE()) and faculty_id='$fk_fac'
GROUP BY
	DAY(timeIn),meter_config
ORDER BY
	timeIn ASC");
            // dd($getDatamonth);
          foreach($getDatamonth as $key => $value){
              if($item->meter_config==20){
                  $getchartmonth[$key] = number_format($value->VolumeflowVal*3600,2);
                  $getchartdate[$key] = $value->timeIn;
                  $getchartIdMeterVal[$key] = $value->IdMeter;
              }else{
                  $getchartmonth[$key] = number_format($value->VolumeflowVal,2);
                  $getchartdate[$key] = $value->timeIn;
                  $getchartIdMeterVal[$key] = $value->IdMeter;
              }

          }


          $getchartmonthVal = json_encode($getchartmonth);
          $getchartdateVal = json_encode($getchartdate);
          $getchartIdMeterVal = json_encode($getchartIdMeterVal);

//          dd($getchartmonthVal);


          $getname = DB::connection('bath')
              ->select("SELECT gname FROM db where faculty_id='$fk_fac'");
          $gname = $getname[0]->gname;


          if($getwater){
              return view('esmConsumeOffice.water',compact('fk_fac','getDatatoday',
                  'getDatamonth','getwater','getchartmonthVal','getchartdateVal','payment','getchartIdMeterVal','gname'));
          }else{
              return view('esmConsumeOffice.esm_index',compact('fk_fac'));
          }

      }
}










