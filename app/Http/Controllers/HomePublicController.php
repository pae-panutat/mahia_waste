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

class HomePublicController extends Controller
{

//=================================================
    //     public function indexDash()
    // {

    //     // $data = DB::connection('audit_cmu') 
    //     //         ->select("SELECT * FROM audit_db ORDER BY CONVERT(location USING tis620) ASC");


    //     // $dataw = DB::table('smart_wash_air_con.customer')
    //     // ->select('*')
    //     // ->orderBy('id', 'ASC')
    //     // ->paginate(50);
        
    //      //return view('homePublicDash');
    // }
//=================================================
//=================================================
    //     public function public_analyticDash()
    // {

    //     $interyear = date("Y");
    //     $yearpv = ($interyear+543)-1;
    //     $date = date("Y",strtotime("-1 year"));

    //     echo $date;
    //     echo "<br>";

    //     return view('homePublicAnalyticDash');
    // }
//=================================================
//=================================================
        public function public_analyticChart()
    {
        //echo "now on analyticGraph controller";
        return view('homePublicAnalyticChart');
    }
//=================================================
//=================================================
        public function public_analyticChartYear(Request $req)
    {

    	$Y = $req->year_info;
        $Y = $Y-543;

        //echo $req->year_info.'<br>';
        if(($Y)==date("Y"))
        {
        	$yearc = $req->year_info;
            $date  = date("Y");
            $SumAirConPerYear = $req->SumAirConPerYear;
            $SumEquipPerYear  = $req->SumEquipPerYear;
            $SumElampPerYear  = $req->SumElampPerYear;
            $SumOtherPerYear  = $req->SumOtherPerYear;
            
        }else{

        	$yearc = $req->year_info;
        	$date  = date("$Y");
            $SumAirConPerYear = $req->SumAirConPerYear;
            $SumEquipPerYear  = $req->SumEquipPerYear;
            $SumElampPerYear  = $req->SumElampPerYear;
            $SumOtherPerYear  = $req->SumOtherPerYear;
            
        }
        //echo "public_analyticChartYear<br>";
        //echo $date+543;
        //echo "<br>";
        return view('homePublicAnalyticChart',['yearc' => $yearc, 
                                              'SumAirConPerYear'=>$SumAirConPerYear,
                                              'SumEquipPerYear'=>$SumEquipPerYear,
                                              'SumElampPerYear'=>$SumElampPerYear,
                                              'SumOtherPerYear'=>$SumOtherPerYear
                                            ]);
    }
//=================================================
//=================================================










}
