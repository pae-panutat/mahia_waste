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
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use DateTime;

class PublicController extends Controller

{
/*----------------------------------------------------*/

        public function public_index()
    {

        $data = DB::connection('audit_cmu') 
                ->select("SELECT * FROM audit_db ORDER BY CONVERT(location USING tis620) ASC");

        // $dataw = DB::table('smart_wash_air_con.customer')
        // ->select('*')
        // ->orderBy('id', 'ASC')
        // ->paginate(50);
        
        return view('homePublicDash',['data' => $data]);
    }

/*----------------------------------------------------*/
// //===============================================================================================================
/*----------------------------------------------------*/

    public function publiclMenu($off_id){

      $data = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id' ");

      foreach ($data as $key => $db) {

      $report = DB::table($db->db_name.'.report_year')
        ->select('*')
        ->where('off_id','=',$db->off_id)
        ->orderBy('year', 'ASC')
        ->paginate(50);
      }

        return view('PublicData.public_menu',['data'=>$data,'report'=>$report]);
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewGeneral($off_id,$year){


        return view('PublicData.public_general');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewExpenses_t1($off_id,$year){

        return view('PublicData.public_expenses_t1');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewExpenses_t2($off_id,$year){

        return view('PublicData.public_expenses_t2');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewBuilding($off_id,$year){

        return view('PublicData.public_building');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewEquipment_t1($off_id,$year){

        return view('PublicData.public_equipment_t1');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewEquipment_t2($off_id,$year){

        return view('PublicData.public_equipment_t2');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewAirconditioner_t1($off_id,$year){

        return view('PublicData.public_airconditioner_t1');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewAirconditioner_t2($off_id){

        return view('PublicData.public_airconditioner_t2');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function publicViewAirchiller_t1($off_id,$year){

        return view('PublicData.public_airchiller_t1');

    }
/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewElamp_t1($off_id,$year){

        return view('PublicData.public_elamp_t1');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewElamp_t2($off_id,$year){

        return view('PublicData.public_elamp_t2');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewWater_t1($off_id,$year){

        return view('PublicData.public_water_t1');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewOil_t1b($off_id,$year){

        return view('PublicData.public_oil_t1b');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewOil_t2d($off_id,$year){

        return view('PublicData.public_oil_t2d');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function publicViewGenerator_t1($off_id,$year){

        return view('PublicData.public_generator_t1');
    }

/*----------------------------------------------------*/







}








































 