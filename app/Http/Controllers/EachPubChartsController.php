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

class EachPubChartsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//=================================================
        public function analyticChart_chart1()
    {
        echo "อยู่ระหว่างการปรับปรุง";

        //return view('Charts.analyticChart_chart1');

    }
//=================================================
//=================================================
        public function each_pub_all_charts($off_id, $year)
    {

        //echo "อยู่ระหว่างการปรับปรุง<br>";
        //echo "year : ".$year;


        return view('EachPubCharts.each_pub_all_charts',['off_id'=>$off_id,'year'=>$year]);

    }
//=================================================
        public function each_pub_table1($off_id, $year)
    {
        //echo "อยู่ระหว่างการปรับปรุง<br>";
        //echo "year : ".$year;

        $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){

                $usedE_sumkwh = DB::SELECT(DB::raw("SELECT sum(kwh) as sum_kwh
                                FROM $db->db_name.expenses_t1 
                                WHERE off_id = $off_id AND year = $year "));

                foreach ($usedE_sumkwh as $key => $val_usedE_kwh){
                    $usedE_sumkwh = $val_usedE_kwh->sum_kwh;
                }


                $usedE_sumbaht = DB::SELECT(DB::raw("SELECT sum(expenses_bath) as sum_baht
                                FROM $db->db_name.expenses_t1 
                                WHERE off_id = $off_id AND year = $year "));

                foreach ($usedE_sumbaht as $key => $val_usedE_baht){
                    $usedE_sumbaht = $val_usedE_baht->sum_baht;
                }

          }
        //print_r($usedE_sumkwh);
        return view('EachPubCharts.each_pub_table1',['off_id'=>$off_id,'year'=>$year, 'usedE_sumkwh'=>$usedE_sumkwh, 'usedE_sumbaht'=>$usedE_sumbaht]);

    }
//=================================================
//=================================================
        public function each_pub_chart1($off_id, $year)
    {
        //echo "อยู่ระหว่างการปรับปรุง<br>";
        echo "<center>ข้อมูลปี ".$year."</center><br>";

        $ARR_usedE_eachkwh = array();
        $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

                foreach ($db as $key => $db){

                    $usedE_sumkwh = DB::SELECT(DB::raw("SELECT kwh
                                    FROM $db->db_name.expenses_t1 
                                    WHERE off_id = $off_id AND year = $year "));

                    foreach ($usedE_sumkwh as $k=> $val_usedE_kwh){
                        $ARR_usedE_eachkwh[$k] = $val_usedE_kwh->kwh;
                    }

                        $ARR_usedE_eachkwh = implode(",",$ARR_usedE_eachkwh);
                        $ARR_usedE_eachkwh = (explode(",",$ARR_usedE_eachkwh));
                        $ARR_usedE_eachkwh  = json_encode($ARR_usedE_eachkwh,JSON_NUMERIC_CHECK); 

                }

        //echo $ARR_usedE_eachkwh;
        return view('EachPubCharts.each_pub_chart1',['off_id'=>$off_id,'year'=>$year, 'ARR_usedE_eachkwh'=>$ARR_usedE_eachkwh]);

    }
//=================================================
//=================================================
        public function each_pub_chart2($off_id, $year)
    {
        //echo "อยู่ระหว่างการปรับปรุง<br>";
        echo "<center>ข้อมูลปี ".$year."</center><br>";

        $ARR_expenses_bath = array();
        $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

                foreach ($db as $key => $db){

                    $expenses_bath = DB::SELECT(DB::raw("SELECT expenses_bath
                                    FROM $db->db_name.expenses_t1 
                                    WHERE off_id = $off_id AND year = $year "));

                    foreach ($expenses_bath as $k=> $val_expenses_bath){
                        $ARR_expenses_bath[$k] = $val_expenses_bath->expenses_bath;
                    }

                        $ARR_expenses_bath = implode(",",$ARR_expenses_bath);
                        $ARR_expenses_bath = (explode(",",$ARR_expenses_bath));
                        $ARR_expenses_bath  = json_encode($ARR_expenses_bath,JSON_NUMERIC_CHECK); 

                }

        //echo $ARR_usedE_eachkwh;
        return view('EachPubCharts.each_pub_chart2',['off_id'=>$off_id,'year'=>$year, 'ARR_expenses_bath'=>$ARR_expenses_bath]);

    }
//=================================================
//=================================================
        public function each_pub_chart3($off_id, $year)
    {
        //echo "อยู่ระหว่างการปรับปรุง<br>";
        $yearpv = ($year-1);
        echo "<center>เปรียบเทียบข้อมูลระหว่างปี ".$yearpv." และปี ".$year." </center><br>";

        $ARR_kwh = array();
        $ARR_kwhpv = array();

        $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

                foreach ($db as $key => $db){

                    $kwh = DB::SELECT(DB::raw("SELECT kwh
                                    FROM $db->db_name.expenses_t1 
                                    WHERE off_id = $off_id AND year = $year "));

                    foreach ($kwh as $k=> $val_kwh){
                        $ARR_kwh[$k] = $val_kwh->kwh;
                    }

                        $ARR_kwh = implode(",",$ARR_kwh);
                        $ARR_kwh = (explode(",",$ARR_kwh));
                        $ARR_kwh  = json_encode($ARR_kwh,JSON_NUMERIC_CHECK); 
                }
                //---------------------------------------------------------------
                foreach ($db as $key => $db2){

                        $kwhpv = DB::SELECT(DB::raw("SELECT kwh
                                FROM $db->db_name.expenses_t1 
                                WHERE off_id = $off_id AND year = $yearpv "));


                        if(!empty($kwhpv))
                        { 
                            //echo "AAA";
                            foreach ($kwhpv as $kpv=> $val_kwhpv){
                                $ARR_kwhpv[$kpv] = $val_kwhpv->kwh;
                            }

                    
                        }else{ 
                            //echo "BBB";
                                $ARR_kwhpv[0] = 0;
                                $ARR_kwhpv[1] = 0;
                                $ARR_kwhpv[2] = 0;
                                $ARR_kwhpv[3] = 0;
                                $ARR_kwhpv[4] = 0;
                                $ARR_kwhpv[5] = 0;
                                $ARR_kwhpv[6] = 0;
                                $ARR_kwhpv[7] = 0;
                                $ARR_kwhpv[8] = 0;
                                $ARR_kwhpv[9] = 0;
                                $ARR_kwhpv[10] = 0;
                                $ARR_kwhpv[11] = 0;	
                        }
                }

                                $ARR_kwhpv = implode(",",$ARR_kwhpv);
                                $ARR_kwhpv = (explode(",",$ARR_kwhpv));
                                $ARR_kwhpv  = json_encode($ARR_kwhpv,JSON_NUMERIC_CHECK); 

        //echo $ARR_kwhpv;
        //print_r($ARR_kwhpv);
        return view('EachPubCharts.each_pub_chart3',['off_id'=>$off_id,'year'=>$year, 'ARR_kwh'=>$ARR_kwh, 'ARR_kwhpv'=>$ARR_kwhpv]);

    }
//=================================================
//=================================================
        public function each_pub_table2($off_id, $year)
    {
        //$pyear = $year-1;
        // echo "อยู่ระหว่างการปรับปรุง<br>";
        // echo "pyear : ".$pyear;
        // echo "<br>";
        // echo "year : ".$year;


        //print_r($building_info);
        return view('EachPubCharts.each_pub_table2',['off_id'=>$off_id,'year'=>$year]);

    }
//=================================================
//=================================================
        public function each_pub_table3($off_id, $year)
    {
        //รวม
        echo "<center>ตารางแสดงสัดส่วนการใช้พลังงานไฟฟ้า : รวม<br></center>";

        $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

        foreach ($db as $key => $db){

                //--------------------------------------------
                $airkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                    FROM $db->db_name.airconditioner_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($airkwh as $k=> $val_kwh){
                     $airkwh = $val_kwh->kwh;
                }

                //--------------------------------------------
                $elampkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                    FROM $db->db_name.elamp_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($elampkwh as $k=> $val_kwh){
                     $elampkwh = $val_kwh->kwh;
                }

                //--------------------------------------------
                $equipkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                    FROM $db->db_name.equipment_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($equipkwh as $k=> $val_kwh){
                     $equipkwh = $val_kwh->kwh;
                } 

                //--------------------------------------------
                $otherkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                                    FROM $db->db_name.expenses_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($otherkwh as $k=> $val_kwh){
                     $expenseskwh_temp = $val_kwh->kwh;
                     $otherkwh = $expenseskwh_temp -($elampkwh+$elampkwh+$equipkwh);
                } 

                //--------------------------------------------
                // $totalkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                //                     FROM $db->db_name.expenses_t1 
                //                     WHERE off_id = '$off_id' AND year = '$year' "));

                // foreach ($totalkwh as $k=> $val_kwh){
                //      $totalkwh = $val_kwh->kwh;
                // } 

        }

        $totalkwh = $airkwh+$elampkwh+$equipkwh+$otherkwh;


        if($totalkwh>0){
            $airpc = $airkwh/$totalkwh;
            $elamppc = $elampkwh/$totalkwh;
            $equippc = $equipkwh/$totalkwh;
            $otherpc = $otherkwh/$totalkwh;
            $totalpc = $totalkwh/$totalkwh;

        }else{
            $airpc = 0;
            $elamppc = 0;
            $equippc = 0;
            $otherpc = 0;
            $totalpc = 0;
        }

        return view('EachPubCharts.each_pub_table3',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh,
                                             'airpc'=>$airpc,'elamppc'=>$elamppc,'equippc'=>$equippc,'otherpc'=>$otherpc,'totalpc'=>$totalpc
                                            ]);

    }
//=================================================
//=================================================
        public function each_pub_table4($off_id, $year, Request $req)
    {
    	//ตามอาคาร
        echo "<center>ตารางแสดงสัดส่วนการใช้พลังงานไฟฟ้า : กรุณาเลือกอาคาร<br></center>";
        //echo $req->building_name;


		if (empty($req->building_name)) {

				//echo "<br>A";
                $airkwh = 0;
                $elampkwh = 0;
                $equipkwh = 0;
                $otherkwh = 0;
                $totalkwh = 0;

                $airpc = 0;
                $elamppc = 0;
                $equippc = 0;
                $otherpc = 0;
                $totalpc = 0;

		        return view('EachPubCharts.each_pub_table4',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh,
                                             'airpc'=>$airpc,'elamppc'=>$elamppc,'equippc'=>$equippc,'otherpc'=>$otherpc,'totalpc'=>$totalpc
                                            ]);


		}else{

				//echo "<br>B";
		        $db = DB::connection("audit_cmu") 
		          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

		        foreach ($db as $key => $db){

		                $airkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
		                                    FROM $db->db_name.airconditioner_t1 
		                                    WHERE location LIKE '%$req->building_name%'
		                                    AND off_id = '$off_id' AND year = '$year' "));

	                    foreach ($airkwh as $k=> $val_kwh){
	                    		$airkwh = $val_kwh->kwh;

	                    }

                        //--------------------------------------------
                        $elampkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.elamp_t1 
                                            WHERE location LIKE '%$req->building_name%'
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($elampkwh as $k=> $val_kwh){
                             $elampkwh = $val_kwh->kwh;
                        }

                        //--------------------------------------------
                        $equipkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.equipment_t1 
                                            WHERE location LIKE '%$req->building_name%'
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($equipkwh as $k=> $val_kwh){
                             $equipkwh = $val_kwh->kwh;
                        } 

                        //--------------------------------------------
                        $otherkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh FROM
                                            (
                                            SELECT a.kWh as kwh, a.id_meter as id_meter, b.building_name as building_name
                                            FROM $db->db_name.expenses_t1 a INNER JOIN $db->db_name.building_info b on a.id_meter = b.id_meter
                                            WHERE b.building_name LIKE '%$req->building_name%'
                                            AND a.off_id = '$off_id' AND a.year = '$year'
                                            ) t 
                                            "));

                        foreach ($otherkwh as $k=> $val_kwh){
                             $expenseskwh_temp = $val_kwh->kwh;
                             $otherkwh = $expenseskwh_temp -($elampkwh+$elampkwh+$equipkwh);
                             if($otherkwh<0){$otherkwh = 0;}
                        } 

                        //--------------------------------------------
                        // $totalkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh FROM
                        //                     (
                        //                     SELECT a.kWh as kwh, a.id_meter as id_meter, b.building_name as building_name
                        //                     FROM $db->db_name.expenses_t1 a INNER JOIN $db->db_name.building_info b on a.id_meter = b.id_meter
                        //                     WHERE b.building_name LIKE '%$req->building_name%'
                        //                     AND a.off_id = '$off_id' AND a.year = '$year'
                        //                     ) t 
                        //                     "));

                        // foreach ($totalkwh as $k=> $val_kwh){
                        //      $totalkwh = $val_kwh->kwh;
                        // }

		        }


                $totalkwh = $airkwh+$elampkwh+$equipkwh+$otherkwh;
                

                if($totalkwh>0){
                    $airpc = $airkwh/$totalkwh;
                    $elamppc = $elampkwh/$totalkwh;
                    $equippc = $equipkwh/$totalkwh;
                    $otherpc = $otherkwh/$totalkwh;
                    $totalpc = $totalkwh/$totalkwh;

                }else{
                    $airpc = 0;
                    $elamppc = 0;
                    $equippc = 0;
                    $otherpc = 0;
                    $totalpc = 0;
                }

		        return view('EachPubCharts.each_pub_table4',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh,
                                             'airpc'=>$airpc,'elamppc'=>$elamppc,'equippc'=>$equippc,'otherpc'=>$otherpc,'totalpc'=>$totalpc
                                            ]);

		}

    }
//=================================================
//=================================================
        public function each_pub_table5($off_id, $year, Request $req)
    {
        //ตามมีเตอร์
        echo "<center>ตารางแสดงสัดส่วนการใช้พลังงานไฟฟ้า : กรุณาเลือกมีเตอร์<br></center>";

        if (empty($req->id_meter)) {

                //echo "<br>A";
                $airkwh = 0;
                $elampkwh = 0;
                $equipkwh = 0;
                $otherkwh = 0;
                $totalkwh = 0;

                $airpc = 0;
                $elamppc = 0;
                $equippc = 0;
                $otherpc = 0;
                $totalpc = 0;

                return view('EachPubCharts.each_pub_table5',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh,
                                             'airpc'=>$airpc,'elamppc'=>$elamppc,'equippc'=>$equippc,'otherpc'=>$otherpc,'totalpc'=>$totalpc
                                            ]);


        }else{

                //echo "<br>B";

                $db = DB::connection("audit_cmu") 
                  ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

                foreach ($db as $key => $db){
                            $airkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.airconditioner_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($airkwh as $k=> $val_kwh){
                              $airkwh = $val_kwh->kwh;
                        }
                }

                //--------------------------------------------
                foreach ($db as $key => $db){
                            $elampkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.elamp_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($elampkwh as $k=> $val_kwh){
                              $elampkwh = $val_kwh->kwh;
                        }
                }

                //--------------------------------------------
                foreach ($db as $key => $db){
                            $equipkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.equipment_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($equipkwh as $k=> $val_kwh){
                              $equipkwh = $val_kwh->kwh;
                        }
                }

                //--------------------------------------------
                foreach ($db as $key => $db){
                            $otherkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                                            FROM $db->db_name.expenses_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($otherkwh as $k=> $val_kwh){
                              $expenseskwh_temp = $val_kwh->kwh;
                              $otherkwh = $expenseskwh_temp -($elampkwh+$elampkwh+$equipkwh);
                        }
                }

                //--------------------------------------------
                // foreach ($db as $key => $db){
                //             $totalkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                //                             FROM $db->db_name.expenses_t1 
                //                             WHERE id_meter = $req->meter
                //                             AND off_id = '$off_id' AND year = '$year' "));

                //         foreach ($totalkwh as $k=> $val_kwh){
                //               $totalkwh = $val_kwh->kwh;
                //         }
                // }

                $totalkwh = $airkwh+$elampkwh+$equipkwh+$otherkwh;

                if($totalkwh>0){
                    $airpc = $airkwh/$totalkwh;
                    $elamppc = $elampkwh/$totalkwh;
                    $equippc = $equipkwh/$totalkwh;
                    $totalkwh = $totalkwh/$totalkwh;


                }else{
                    $airpc = 0;
                    $elamppc = 0;
                    $equippc = 0;
                    $totalkwh = 0;
                }
                 
                return view('EachPubCharts.each_pub_table5',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh,
                                             'airpc'=>$airpc,'elamppc'=>$elamppc,'equippc'=>$equippc,'otherpc'=>$otherpc,'totalpc'=>$totalpc
                                            ]);

        }


    }
//=================================================
//=================================================
        public function each_pub_chart4($off_id, $year)
    {

        //รวม
        //echo "<center>กราฟแสดงสัดส่วนการใช้พลังงานไฟฟ้า : รวม<br></center>";

        $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

        foreach ($db as $key => $db){

                //--------------------------------------------
                $airkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                    FROM $db->db_name.airconditioner_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($airkwh as $k=> $val_kwh){
                     $airkwh = $val_kwh->kwh;
                }

                //--------------------------------------------
                $elampkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                    FROM $db->db_name.elamp_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($elampkwh as $k=> $val_kwh){
                     $elampkwh = $val_kwh->kwh;
                }

                //--------------------------------------------
                $equipkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                    FROM $db->db_name.equipment_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($equipkwh as $k=> $val_kwh){
                     $equipkwh = $val_kwh->kwh;
                } 

                //--------------------------------------------
                $otherkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                                    FROM $db->db_name.expenses_t1 
                                    WHERE off_id = '$off_id' AND year = '$year' "));

                foreach ($otherkwh as $k=> $val_kwh){
                     $expenseskwh_temp = $val_kwh->kwh;
                     $otherkwh = $expenseskwh_temp -($elampkwh+$elampkwh+$equipkwh);
                } 

                //--------------------------------------------
                // $totalkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                //                     FROM $db->db_name.expenses_t1 
                //                     WHERE off_id = '$off_id' AND year = '$year' "));

                // foreach ($totalkwh as $k=> $val_kwh){
                //      $totalkwh = $val_kwh->kwh;
                // } 

        }

        $totalkwh = $airkwh+$elampkwh+$equipkwh+$otherkwh;

        $year  = json_encode($year,JSON_NUMERIC_CHECK);
        $airkwh = json_encode($airkwh,JSON_NUMERIC_CHECK);
        $elampkwh = json_encode($elampkwh,JSON_NUMERIC_CHECK);
        $equipkwh = json_encode($equipkwh,JSON_NUMERIC_CHECK);
        $otherkwh = json_encode($otherkwh,JSON_NUMERIC_CHECK);


        return view('EachPubCharts.each_pub_chart4',['off_id'=>$off_id,'year'=>$year,
                                     'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh        
                                    ]);
    }
//=================================================
//=================================================    
        public function each_pub_chart5($off_id, $year, Request $req)
    {
        //ตามอาคาร
        //echo "<center>ตารางแสดงสัดส่วนการใช้พลังงานไฟฟ้า : กรุณาเลือกอาคาร<br></center>";
        //echo $req->building_name;


        if (empty($req->building_name)) {

                //echo "<br>A";
                $airkwh = 0;
                $elampkwh = 0;
                $equipkwh = 0;
                $otherkwh = 0;
                $totalkwh = 0;

                $year  = json_encode($year,JSON_NUMERIC_CHECK);
                $airkwh = json_encode($airkwh,JSON_NUMERIC_CHECK);
                $elampkwh = json_encode($elampkwh,JSON_NUMERIC_CHECK);
                $equipkwh = json_encode($equipkwh,JSON_NUMERIC_CHECK);
                $otherkwh = json_encode($otherkwh,JSON_NUMERIC_CHECK);

                return view('EachPubCharts.each_pub_chart5',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh
                                            ]);


        }else{

                //echo "<br>B";
                $db = DB::connection("audit_cmu") 
                  ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

                foreach ($db as $key => $db){

                        $airkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.airconditioner_t1 
                                            WHERE location LIKE '%$req->building_name%'
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($airkwh as $k=> $val_kwh){
                                $airkwh = $val_kwh->kwh;

                        }

                        //--------------------------------------------
                        $elampkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.elamp_t1 
                                            WHERE location LIKE '%$req->building_name%'
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($elampkwh as $k=> $val_kwh){
                             $elampkwh = $val_kwh->kwh;
                        }

                        //--------------------------------------------
                        $equipkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.equipment_t1 
                                            WHERE location LIKE '%$req->building_name%'
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($equipkwh as $k=> $val_kwh){
                             $equipkwh = $val_kwh->kwh;
                        } 

                        //--------------------------------------------
                        $otherkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh FROM
                                            (
                                            SELECT a.kWh as kwh, a.id_meter as id_meter, b.building_name as building_name
                                            FROM $db->db_name.expenses_t1 a INNER JOIN $db->db_name.building_info b on a.id_meter = b.id_meter
                                            WHERE b.building_name LIKE '%$req->building_name%'
                                            AND a.off_id = '$off_id' AND a.year = '$year'
                                            ) t 
                                            "));

                        foreach ($otherkwh as $k=> $val_kwh){
                             $expenseskwh_temp = $val_kwh->kwh;
                             $otherkwh = $expenseskwh_temp -($elampkwh+$elampkwh+$equipkwh);
                             if($otherkwh<0){$otherkwh = 0;}
                        } 

                        //--------------------------------------------
                        // $totalkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh FROM
                        //                     (
                        //                     SELECT a.kWh as kwh, a.id_meter as id_meter, b.building_name as building_name
                        //                     FROM $db->db_name.expenses_t1 a INNER JOIN $db->db_name.building_info b on a.id_meter = b.id_meter
                        //                     WHERE b.building_name LIKE '%$req->building_name%'
                        //                     AND a.off_id = '$off_id' AND a.year = '$year'
                        //                     ) t 
                        //                     "));

                        // foreach ($totalkwh as $k=> $val_kwh){
                        //      $totalkwh = $val_kwh->kwh;
                        // }

                }


                $totalkwh = $airkwh+$elampkwh+$equipkwh+$otherkwh;
                
                $year  = json_encode($year,JSON_NUMERIC_CHECK);
                $airkwh = json_encode($airkwh,JSON_NUMERIC_CHECK);
                $elampkwh = json_encode($elampkwh,JSON_NUMERIC_CHECK);
                $equipkwh = json_encode($equipkwh,JSON_NUMERIC_CHECK);
                $otherkwh = json_encode($otherkwh,JSON_NUMERIC_CHECK);


                return view('EachPubCharts.each_pub_chart5',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh
                                            ]);

        }

    }
//=================================================
//=================================================
        public function each_pub_chart6($off_id, $year, Request $req)
    {
        //ตามมีเตอร์
        //echo "<center>ตารางแสดงสัดส่วนการใช้พลังงานไฟฟ้า : กรุณาเลือกมีเตอร์<br></center>";

        if (empty($req->id_meter)) {

                //echo "<br>A";
                $airkwh = 0;
                $elampkwh = 0;
                $equipkwh = 0;
                $otherkwh = 0;
                $totalkwh = 0;

                return view('EachPubCharts.each_pub_chart6',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh
                                            ]);


        }else{

                //echo "<br>B";

                $db = DB::connection("audit_cmu") 
                  ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

                foreach ($db as $key => $db){
                            $airkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.airconditioner_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($airkwh as $k=> $val_kwh){
                              $airkwh = $val_kwh->kwh;
                        }
                }

                //--------------------------------------------
                foreach ($db as $key => $db){
                            $elampkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.elamp_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($elampkwh as $k=> $val_kwh){
                              $elampkwh = $val_kwh->kwh;
                        }
                }

                //--------------------------------------------
                foreach ($db as $key => $db){
                            $equipkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                            FROM $db->db_name.equipment_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($equipkwh as $k=> $val_kwh){
                              $equipkwh = $val_kwh->kwh;
                        }
                }

                //--------------------------------------------
                foreach ($db as $key => $db){
                            $otherkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                                            FROM $db->db_name.expenses_t1 
                                            WHERE id_meter = $req->meter
                                            AND off_id = '$off_id' AND year = '$year' "));

                        foreach ($otherkwh as $k=> $val_kwh){
                              $expenseskwh_temp = $val_kwh->kwh;
                              $otherkwh = $expenseskwh_temp -($elampkwh+$elampkwh+$equipkwh);
                        }
                }

                //--------------------------------------------
                // foreach ($db as $key => $db){
                //             $totalkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh
                //                             FROM $db->db_name.expenses_t1 
                //                             WHERE id_meter = $req->meter
                //                             AND off_id = '$off_id' AND year = '$year' "));

                //         foreach ($totalkwh as $k=> $val_kwh){
                //               $totalkwh = $val_kwh->kwh;
                //         }
                // }

                $totalkwh = $airkwh+$elampkwh+$equipkwh+$otherkwh;
                 
                return view('EachPubCharts.each_pub_table6',['off_id'=>$off_id,'year'=>$year,
                                             'airkwh'=>$airkwh,'elampkwh'=>$elampkwh,'equipkwh'=>$equipkwh,'otherkwh'=>$otherkwh,'totalkwh'=>$totalkwh
                                            ]);

        }


    }

//=================================================
//=================================================
        public function each_pub_chart7($off_id, $year)
    {
        //ทุกมีเตอร์
        //echo "<center>ตารางแสดงสัดส่วนการใช้พลังงานไฟฟ้า : กรุณาเลือกอาคาร<br></center>";
        //echo $req->building_name;

                $db = DB::connection("audit_cmu") 
                  ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

                foreach ($db as $key => $db){

                    $meter = DB::connection("audit_cmu") 
                      ->select("SELECT id_meter FROM $db->db_name.building_info WHERE off_id = $off_id AND year = $year ");    

                    foreach ($meter as $key => $meter){


                            if (empty($meter->id_meter)) {

                                //echo "<br>A";
                                $airkwh = 0;
                                $elampkwh = 0;
                                $equipkwh = 0;
                                $otherkwh = 0;
                                $totalkwh = 0;


                                return view('EachPubCharts.each_pub_chart7',['off_id'=>$off_id,'year'=>$year]);

                            }else{

                                //echo "<br>B";

                                //echo $meter->id_meter;
                                $airkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                                    FROM $db->db_name.airconditioner_t1 
                                                    WHERE id_meter = '$meter->id_meter'
                                                    AND off_id = '$off_id' AND year = '$year' "));

                                foreach ($airkwh as $k=> $val_kwh){
                                      $airkwh = $val_kwh->kwh;
                                }

                                //--------------------------------------------
                                $elampkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                                    FROM $db->db_name.elamp_t1 
                                                    WHERE id_meter = '$meter->id_meter'
                                                    AND off_id = '$off_id' AND year = '$year' "));

                                foreach ($elampkwh as $k=> $val_kwh){
                                     $elampkwh = $val_kwh->kwh;
                                }

                                //--------------------------------------------
                                $equipkwh = DB::SELECT(DB::raw("SELECT SUM(kwh_per_year) as kwh
                                                    FROM $db->db_name.equipment_t1 
                                                    WHERE id_meter = '$meter->id_meter'
                                                    AND off_id = '$off_id' AND year = '$year' "));

                                foreach ($equipkwh as $k=> $val_kwh){
                                     $equipkwh = $val_kwh->kwh;
                                } 

                                //--------------------------------------------
                                $otherkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh FROM
                                                    (
                                                    SELECT a.kWh as kwh, a.id_meter as id_meter, b.building_name as building_name
                                                    FROM $db->db_name.expenses_t1 a INNER JOIN $db->db_name.building_info b on a.id_meter = b.id_meter
                                                    WHERE id_meter = '$meter->id_meter'
                                                    AND a.off_id = '$off_id' AND a.year = '$year'
                                                    ) t 
                                                    "));

                                foreach ($otherkwh as $k=> $val_kwh){
                                     $expenseskwh_temp = $val_kwh->kwh;
                                     $otherkwh = $expenseskwh_temp -($elampkwh+$elampkwh+$equipkwh);
                                     if($otherkwh<0){$otherkwh = 0;}
                                } 

                                //--------------------------------------------
                                // $totalkwh = DB::SELECT(DB::raw("SELECT SUM(kwh) as kwh FROM
                                //                     (
                                //                     SELECT a.kWh as kwh, a.id_meter as id_meter, b.building_name as building_name
                                //                     FROM $db->db_name.expenses_t1 a INNER JOIN $db->db_name.building_info b on a.id_meter = b.id_meter
                                //                     WHERE id_meter = '$meter->id_meter'
                                //                     AND a.off_id = '$off_id' AND a.year = '$year'
                                //                     ) t 
                                //                     "));

                                // foreach ($totalkwh as $k=> $val_kwh){
                                //      $totalkwh = $val_kwh->kwh;
                                // }

                            }

                    }


                }










    }
//=================================================
































}
