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
use App\WashAirCustomer;
use App\WashAirSolutionDemand;
use App\ReportYearDetail;
use App\WashAirSuggestion;



class WashAirConController extends Controller

{

//===============================================================================================================
/*----------------------------------------------------*/

    public function customer_form(){
      //echo "now in customer_new";
      return view('WashAirCon.customer_new');
    }

/*----------------------------------------------------*/
    public function customer_insert(Request $req){

      $created_at   = new DateTime();
      $updated_at   = new DateTime();

      $arr = array();

      $arr[] = ['customer_name'=>$req->customer_name,

                'created_at' =>$created_at,
                'updated_at'=> $updated_at
               ];
      //dd($arr);
      DB::table('smart_wash_air_con.customer')->insert($arr);
      return redirect()->route('home');
    }

/*----------------------------------------------------*/
    public function customer_edit($id){

      $data = WashAirCustomer::find($id);

      return view('WashAirCon.customer_edit',['id'=>$id, 'data'=>$data]);
    }

/*----------------------------------------------------*/
    public function customer_update(Request $req){
    	$updated_at   = new DateTime();
    	$id      = $req->input('id');

	    DB::table('smart_wash_air_con.customer')
	            ->where('id', $req->input('id'))
	            ->update([
	            'customer_name'       => $req->input('customer_name'),
	            'updated_at'        	=> $updated_at
	            ]);

      $data = WashAirCustomer::find($id); 
	    return view('WashAirCon.customer_edit',['id'=>$id, 'data'=>$data]);
    }

/*----------------------------------------------------*/
    public function customer_report_year($id){


      return view('WashAirCon.customer_report_year',['id'=>$id]);

    }

/*----------------------------------------------------*/

    public function customer_report_new(Request $req){


             //if1
          if(!empty(DB::connection("smart_wash_air_con")->select("SELECT * FROM report_year WHERE cus_id = $req->cus_id AND year_info = $req->year_info"))){

              echo "รายงานปีนี้ ".$req->year_info." มีแล้ว &nbsp;";
              echo "<a href=".route('customer_report_year', ['cus_id' => $req->cus_id]).">กลับ</a>";

          //if1    
          }else{



            $created_at   = new DateTime();
            $updated_at   = new DateTime();
            $arr = array();

            $arr[] = ['cus_id'=>$req->cus_id,
                      'year_info'=>$req->year_info,

                      'created_at' =>$created_at,
                      'updated_at'=> $updated_at
                     ];
            //dd($arr);
            DB::table('smart_wash_air_con.report_year')->insert($arr);

            return redirect()->route('customer_report_year', ['cus_id'=>$req->input('cus_id')]);

          }

    }

//===============================================================================================================

public function customer_report_year_detail($id, $year){

	$cus_id = $id;
  return view('WashAirCon.customer_report_year_detail',['id'=>$cus_id,'year'=>$year]);

}

//===============================================================================================================
public function customer_report_form_insert(Request $req){

    echo "aaaaaa";
        $cus_id                               = $req->input('cus_id');
        $year_info                            = $req->input('year_info');
        $operation_date                       = $req->input('operation_date');


        $created_at   = new DateTime();
        $updated_at   = new DateTime();
        $user_ID      = $req->input('user_ID');

        $data = array(
          'cus_id'                            =>$cus_id,
          'year_info'                         =>$year_info,
          'operation_date'                    =>$operation_date,

                                                
          'created_at'=>$created_at, 
          'updated_at'=>$updated_at,
          'user_ID'=>$user_ID
        );

        DB::table('smart_wash_air_con.report_year_detail')->insert($data);
        return redirect()->route('customer_report_year_detail', ['id'=>$req->input('cus_id'), 'year'=>$req->input('year_info')]);
}
//===============================================================================================================
public function customer_operation_date($id, $opdate){

  //$cus_id = $id;
  //$opdate = $opdate;
  //echo "now on operation date controller:<br>id = ".$id."<br>opdate = ".$opdate;
return view('WashAirCon.customer_operation_date',['id'=>$id,'opdate'=>$opdate]);
}

//===============================================================================================================
//===============================================================================================================
/*----------------------------------------------------*/
public function customer_excel_measure_performance(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['cus_id'=>$request->cus_id,
                            'year_info'=>$request->year_info,
                            'operation_date'=>$request->opdate,

                           	'aircon_brand' => $value->aircon_brand, 
                            'btu' =>$value->btu,
                            'number' =>$value->number,
                            'aircon_type' =>$value->aircon_type,
                            'place' =>$value->place,
                            'power_before' =>$value->power_before,
                            'power_after' =>$value->power_after,
                            'solution_before' =>$value->solution_before,
                            'solution_after' =>$value->solution_after,
                            'windspeed_before' =>$value->windspeed_before,
                            'windspeed_after' =>$value->windspeed_after,
                            'humidity_before' =>$value->humidity_before,
                            'humidity_after' =>$value->humidity_after,
                            'note' =>$value->note,

                            'created_at' =>$created_at,
                            'updated_at'=> $updated_at

                           ];
                }

                //dd($arr);

                if(!empty($arr)){

                     DB::table('smart_wash_air_con.measure_performance')->insert($arr);
                     //dd('Insert Recorded successfully.');

                     return redirect()->route('customer_operation_date', ['id'=>$request->cus_id,'opdate'=>$request->opdate]);
                }

            }

        }

        dd('Request data does not have any files to import.');      

} 
/*----------------------------------------------------*/
/*----------------------------------------------------*/
public function customer_excel_solution_insert(Request $request){

        if($request->input('solution_used')=='' OR $request->input('solution_used')<=0 OR empty($request->input('solution_used'))){
          $solution_used_ck = 0;
        }elseif($request->input('solution_used')!='' OR $request->input('solution_used')>0 OR !empty($request->input('solution_used'))){
          $solution_used_ck = 1;
        }

        if($request->input('disinfectant_used')=='' OR $request->input('disinfectant_used')<=0 OR empty($request->input('disinfectant_used'))){
          $disinfectant_used_ck = 0;
        }elseif($request->input('disinfectant_used')!='' OR $request->input('disinfectant_used')>0 OR !empty($request->input('disinfectant_used'))) {
          $disinfectant_used_ck = 1;
        }

        //echo "insert : ".$disinfectant_used_ck;

        $cus_id                         = $request->input('cus_id');
        $year_info                      = $request->input('year_info');
        $operation_date                 = $request->input('opdate');
        $solution_used_ck               = $solution_used_ck;
        $solution_used                  = $request->input('solution_used'); 
        $solution_used_unit             = $request->input('solution_used_unit');
        $disinfectant_used_ck           = $disinfectant_used_ck;
        $disinfectant_used              = $request->input('disinfectant_used'); 
        $disinfectant_used_unit         = $request->input('disinfectant_used_unit');

        $created_at                     = new DateTime();
        $updated_at                     = new DateTime();
        $user_ID                        = $request->input('user_ID');

        $data = array(
            'cus_id'                    =>$cus_id,
            'year_info'                 =>$year_info,
            'operation_date'            =>$operation_date,
            'solution_used_ck'          =>$solution_used_ck,
            'solution_used'             =>$solution_used,
            'solution_used_unit'        =>$solution_used_unit,
            'disinfectant_used_ck'      =>$disinfectant_used_ck,
            'disinfectant_used'         =>$disinfectant_used,
            'disinfectant_used_unit'    =>$disinfectant_used_unit,

            'created_at'=>$created_at, 
            'updated_at'=>$updated_at,
            'user_ID'=>$user_ID
        );

        DB::table('smart_wash_air_con.solution_demand')->insert($data);
        return redirect()->route('customer_operation_date',['id'=>$request->input('cus_id'),'opdate'=>$request->input('opdate')]);

}
/*----------------------------------------------------*/
/*----------------------------------------------------*/
public function customer_excel_solution_update(Request $request){

        if($request->input('solution_used')=='' OR $request->input('solution_used')<=0 OR empty($request->input('solution_used'))){
          $solution_used_ck = 0;
        }elseif($request->input('solution_used')!='' OR $request->input('solution_used')>0 OR !empty($request->input('solution_used'))){
          $solution_used_ck = 1;
        }

        if($request->input('disinfectant_used')=='' OR $request->input('disinfectant_used')<=0 OR empty($request->input('disinfectant_used'))){
          $disinfectant_used_ck = 0;
        }elseif($request->input('disinfectant_used')!='' OR $request->input('disinfectant_used')>0 OR !empty($request->input('disinfectant_used'))) {
          $disinfectant_used_ck = 1;
        }

        //echo "update disinfectant_used_ck : ".$disinfectant_used_ck;

        $data = WashAirSolutionDemand::find($request->input('id'));   
        $data->solution_used_ck                 = $solution_used_ck;
        $data->solution_used                    = $request->input('solution_used');
        $data->solution_used_unit               = $request->input('solution_used_unit');

        $data->disinfectant_used_ck             = $disinfectant_used_ck;
        $data->disinfectant_used                = $request->input('disinfectant_used');
        $data->disinfectant_used_unit           = $request->input('disinfectant_used_unit');

        $data->updated_at                       = Carbon::now(config('app.timezone'));
        $data->user_ID                          = $request->input('user_ID');
        $data->save();    

        return redirect()->route('customer_operation_date', ['id'=>$request->input('cus_id'),'opdate'=>$request->input('opdate')]);

}
/*----------------------------------------------------*/
/*----------------------------------------------------*/

    public function customer_excel_del_measure_performance($cus_id,$opdate)
    {
    
    	echo "customer_excel_del_measure_performance";

    	$data1 = DB::table('smart_wash_air_con.measure_performance')->where('cus_id',$cus_id)->where('operation_date',$opdate)->delete();
    	$data2 = DB::table('smart_wash_air_con.solution_demand')->where('cus_id',$cus_id)->where('operation_date',$opdate)->delete();

    return redirect()->route('customer_operation_date', ['id'=>$cus_id,'opdate'=>$opdate]); 
    }

/*----------------------------------------------------*/ 
/*----------------------------------------------------*/

    public function customer_sugest_insert(Request $request)
    {
        $cus_id                         = $request->input('cus_id');
        $year_info                      = $request->input('year_info');
        $operation_date                 = $request->input('opdate');
        $suggestion_note                = $request->input('suggestion_note');

        $created_at                     = new DateTime();
        $updated_at                     = new DateTime();
        $user_ID                        = $request->input('user_ID');

        $data = array(
            'cus_id'                    =>$cus_id,
            'year_info'                 =>$year_info,
            'operation_date'            =>$operation_date,
            'suggestion_note'          =>$suggestion_note,


            'created_at'=>$created_at, 
            'updated_at'=>$updated_at,
            'user_ID'=>$user_ID
        );

        DB::table('smart_wash_air_con.suggestion')->insert($data);
        return redirect()->route('customer_operation_date',['id'=>$request->input('cus_id'),'opdate'=>$request->input('opdate')]);
    }

/*----------------------------------------------------*/ 
/*----------------------------------------------------*/

    public function customer_sugest_update(Request $request)
    {

    	//echo "customer_sugest_update";


        $data = WashAirSuggestion::find($request->input('id'));   
        $data->suggestion_note                  = $request->input('suggestion_note');


        $data->updated_at                       = Carbon::now(config('app.timezone'));
        $data->user_ID                          = $request->input('user_ID');
        $data->save();    


		return redirect()->route('customer_operation_date',['id'=>$request->input('cus_id'),'opdate'=>$request->input('opdate')]);

    }

/*----------------------------------------------------*/ 
/*----------------------------------------------------*/

    public function customer_picture_building_new($id, $opdate)
	{


    return view('WashAirCon.customer_picture_building_new',['id'=>$id,'opdate'=>$opdate]);

    }

/*----------------------------------------------------*/
/*----------------------------------------------------*/

    public function customer_picture_place_new($id, $opdate)
	{


    return view('WashAirCon.customer_picture_place_new',['id'=>$id,'opdate'=>$opdate]);

    }

/*----------------------------------------------------*/















//===============================================================================================================
//===============================================================================================================




















//===============================================================================================================
}








































 