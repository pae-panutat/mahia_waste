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

class HomeController extends Controller
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
        public function indexDash()
    {

        $data = DB::connection('audit_cmu') 
                ->select("SELECT * FROM audit_db ORDER BY CONVERT(location USING tis620) ASC");


        $dataw = DB::table('smart_wash_air_con.customer')
        ->select('*')
        ->orderBy('id', 'ASC')
        ->paginate(50);

        
        return view('homeDash',['data' => $data, 'dataw'=> $dataw]);
    }
//=================================================
//=================================================
        public function analyticChart()
    {


        //echo "now on analyticGraph controller";
        return view('homeAnalyticChart');
    }
//=================================================
//=================================================
        public function analyticDash()
    {

        $interyear = date("Y");
        $yearpv = ($interyear+543)-1;
        $date = date("Y",strtotime("-1 year"));

        //echo $date;
        //echo "<br>";

        ini_set('max_execution_time', 1000);
        $getdb = DB::connection('audit_cmu') 
                ->select("SELECT * FROM audit_db ORDER BY CONVERT(location USING tis620) ASC");

        $data = array();
        $unit_name=0;
        $num_person=0;
        $air_area=0; $nonair_area=0; $used_area=0; $kwh=0;

        //first foreach
        foreach ($getdb as $key => $db) {

            $esmdb = $db->esm_db_name;

            $unit_name=0;
            $general_info = DB::connection($db->db_name) 
                ->select("SELECT * FROM general_info WHERE off_id  = '$db->off_id' AND year = '$yearpv' ");
            foreach ($general_info as $val1) {
                $unit_name = $val1->unit_name; 
            }

            $num_person=0;
            $person_info = DB::connection($db->db_name) 
                ->select("SELECT * FROM person_info WHERE off_id  = '$db->off_id' AND year = '$yearpv' ");
            foreach ($person_info as $val2) {
                $num_person = $val2->num_person; 
            }

            $air_area=0; $nonair_area=0; $used_area=0;
            $building_info = DB::connection($db->db_name) 
                ->select("SELECT * FROM building_info WHERE off_id  = '$db->off_id' AND year = '$yearpv' ");
            foreach ($building_info as $val3) {

                $air_area = $air_area+$val3->air_area; 
                $nonair_area = $nonair_area+($val3->used_area-$val3->air_area); 
                $used_area = $used_area+$val3->used_area;
            }

            // echo $esmdb;
            // echo "<br>";

            if($esmdb){ 
//=====================================
                    $kwhxx = DB::connection($esmdb) 
                        ->select("SELECT SUM(afterkWhX) AS kWh, count(timeIn) as month
                            FROM
                                (
                                    SELECT
                                        MAX(b.kWh_this_month) AS afterkWhX ,
                                        b.site_id AS groupID, timeIn
                                    FROM
                                        meter_of_faculty a
                                    INNER JOIN electric b ON b.site_id = a.site_id
                                    WHERE
                                        a.co_payment = 0
                                    AND YEAR(b.timeIn)  = '$date'
                                    AND a.site_id != '212606695'
                                    AND b.kWh_this_month <= 380000
                                    GROUP BY
                                        b.site_id
                                    ORDER BY
                                        b.timeIn DESC
                                ) x ");
              
                    foreach ($kwhxx as $val4) {

                        if($val4->kWh!=""){
                            //$month = $val4->month;
                            $kwh = $val4->kWh;
                        }else{

                            //$month = $val4->month;
                            $kwh=0; 
                        }  

                    } 
//=====================================
                    // echo "esmdb: ".$esmdb."<br>";
                    // echo "<br>";
                    // echo "kwh: ".$kwh."<br>";
                    // echo "<br>";
            }else{

                $esmdb=0;
                $kwh=0; 

            }//if

                    // echo $unit_name;
                    // echo "<br>";
                    // echo "esmdb: ".$esmdb;
                    // echo "<br>";                
                    // echo "kwh: ".number_format($kwh,2);
                    // echo "<br>";
                    // echo "============";
                    // echo "<br>";


            $data[$key] = [	'year'=>$yearpv,
                            'location'=>$db->location, 
                            'kwh'=>$kwh,
                            'unit_name'=>$unit_name, 
                            'num_person'=>$num_person, 
                            'air_area'=>$air_area, 
                            'nonair_area'=>$nonair_area,
                            'used_area'=>$used_area
                          ];

        }//$getdb


        return view('homeAnalyticDash',['data' => $data]);
    }
//=================================================
//=================================================
        public function analyticYear(Request $req)
    {

    	$Y = $req->year_info;
        $Y = $Y-543;

        //echo $req->year_info.'<br>';
        if(($Y)==date("Y"))
        {
        	$yearc = $req->year_info;
            $date  = date("Y");
            //$date = date("Y-m")."-01 00:00:00";
        }else{

        	$yearc = $req->year_info;
        	$date  = date("$Y");
            //$date = date("$Y")."-12-01 00:00:00";
        }

        //echo $date;
        //echo "<br>";

        $getdb = DB::connection('audit_cmu') 
                ->select("SELECT * FROM audit_db ORDER BY CONVERT(location USING tis620) ASC");

        $data = array();
        $unit_name=0;
        $num_person=0;
        $air_area=0; $nonair_area=0; $used_area=0; $kwh=0;
        //first foreach
        foreach ($getdb as $key => $db) {

         	$esmdb = $db->esm_db_name;

            $unit_name=0;
            $general_info = DB::connection($db->db_name) 
                ->select("SELECT * FROM general_info WHERE off_id  = '$db->off_id' AND year = '$yearc' ");
            foreach ($general_info as $val1) {
                $unit_name = $val1->unit_name; 
            }

            $num_person=0;
            $person_info = DB::connection($db->db_name) 
                ->select("SELECT * FROM person_info WHERE off_id  = '$db->off_id' AND year = '$yearc' ");
            foreach ($person_info as $val2) {
                $num_person = $val2->num_person; 
            }

            $air_area=0; $nonair_area=0; $used_area=0;
            $building_info = DB::connection($db->db_name) 
                ->select("SELECT * FROM building_info WHERE off_id  = '$db->off_id' AND year = '$yearc' ");
            foreach ($building_info as $val3) {

                $air_area = $air_area+$val3->air_area; 
                $nonair_area = $nonair_area+($val3->used_area-$val3->air_area); 
                $used_area = $used_area+$val3->used_area;
            }

            // echo $esmdb;
            // echo "<br>";

            if($esmdb){ 
//=====================================
                    $kwhxx = DB::connection($esmdb) 
                        ->select("SELECT SUM(afterkWhX) AS kWh, count(timeIn) as month
                            FROM
                                (
                                    SELECT
                                        MAX(b.kWh_this_month) AS afterkWhX ,
                                        b.site_id AS groupID, timeIn
                                    FROM
                                        meter_of_faculty a
                                    INNER JOIN electric b ON b.site_id = a.site_id
                                    WHERE
                                        a.co_payment = 0
                                    AND YEAR(b.timeIn)  = '$date'
                                    AND a.site_id != '212606695'
                                    AND b.kWh_this_month <= 380000
                                    GROUP BY
                                        b.site_id
                                    ORDER BY
                                        b.timeIn DESC
                                ) x ");
              
                    foreach ($kwhxx as $val4) {

                        if($val4->kWh!=""){
                            //$month = $val4->month;
                            $kwh = $val4->kWh;
                        }else{

                            //$month = $val4->month;
                            $kwh=0; 
                        }  

                    } 
//=====================================
                    // echo "esmdb: ".$esmdb."<br>";
                    // echo "<br>";
                    // echo "kwh: ".$kwh."<br>";
                    // echo "<br>";
            }else{

                $esmdb=0;
                $month=0;
                $kwh=0;
                 

            }//if

                    // echo $unit_name;
                    // echo "<br>";
                    // echo "esmdb: ".$esmdb;
                    // echo "<br>";                
                    // echo "kwh: ".number_format($kwh,2);
                    // echo "<br>";
                    // echo "Month: ".$month; 
                    // echo "<br>";
                    // echo "============";
                    // echo "<br>";



            $data[$key] = [ 'year'=>$req->year_info,
                            'location'=>$db->location, 
                            'kwh'=>$kwh,
                            'unit_name'=>$unit_name, 
                            'num_person'=>$num_person, 
                            'air_area'=>$air_area, 
                            'nonair_area'=>$nonair_area,
                            'used_area'=>$used_area
                          ];

        }//$getdb


        return view('homeAnalyticDash',['data' => $data]);
    }
//=================================================




    public function alldatacmu()
    {
        return view('Cmu.alldatacmu');
    }




}
