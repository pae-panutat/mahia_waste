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

class ExcelController extends Controller

{
/*----------------------------------------------------*/

    public function adminExcelMenu($off_id){

      $data = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id' ");

      foreach ($data as $key => $db) {

      $report = DB::table($db->db_name.'.report_year')
        ->select('*')
        ->where('off_id','=',$db->off_id)
        ->orderBy('year', 'ASC')
        ->paginate(50);
      }

        return view('Excel.admin_excel_menu',['data'=>$data,'report'=>$report]);
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function adminExcelNewReport(Request $request){


      $data = DB::connection("audit_cmu") 
           ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");

      //first foreach
      foreach ($data as $key => $db) {

          //if1
          if(!empty(DB::connection("$db->db_name")->select("SELECT * FROM report_year WHERE off_id = $request->off_id AND year = $request->year_info"))){

              echo "รายงานปีนี้ ".$request->year." มีแล้ว &nbsp;";
              echo "<a href=".route('admin_excel_menu', ['off_id' => $request->off_id]).">กลับ</a>";

          //if1    
          }else{

                  // //if2
                   if(!empty(DB::connection("$db->db_name")->select("SELECT * FROM report_year WHERE year = $request->year_info"))){

                           echo "มีข้อมูลใน table นี้อยู่ก่อนแล้ว";

                          //add report
                          $off_id       = $request->input('off_id');
                          $year         = $request->input('year_info');

                          $created_at   = new DateTime();
                          $updated_at   = new DateTime();


                          $toDB = array(
                              'off_id'    =>$off_id,
                              'year'      =>$year,
                              
                              'created_at'=>$created_at, 
                              'updated_at'=>$updated_at

                          );

                         //DB::table($db->db_name.'.report_year')->insert($toDB); //add report

                          $year_ck = DB::connection($db->db_name) 
                            ->select("SELECT year FROM report_year WHERE off_id  = '$request->off_id' ORDER BY id DESC LIMIT 1");
                            foreach ($year_ck as $key => $yearck) {
                              //echo $yearck->year;

                                    $general_ck = DB::connection($db->db_name) 
                                    ->select("SELECT * FROM general_info WHERE off_id  = '$request->off_id' AND year = '$yearck->year'");

                                    foreach ($general_ck as $key => $generalck){
                                        // echo $generalck->year;
                                             $off_id                 =$generalck->off_id;
                                             $unit_name              =$generalck->unit_name;
                                             $building_location      =$generalck->building_location;
                                             $tel1_number            =$generalck->tel1_number;
                                             $usage_condition        =$generalck->usage_condition;
                                             $official_time          =$generalck->official_time;
                                             $contact_name           =$generalck->contact_name;
                                             $position1              =$generalck->position1;
                                             $tel2_number            =$generalck->tel2_number;
                                             $coordinator_name       =$generalck->coordinator_name;
                                             $position2              =$generalck->position2;
                                             $tel3_number            =$generalck->tel3_number;
                                             $begin_year             =$generalck->begin_year;
                                             $presented_to           =$generalck->presented_to;
                                             $report_from            =$generalck->report_from;
                                             $report_maker1          =$generalck->report_maker1;
                                             $report_maker2          =$generalck->report_maker2;
                            }} //2 for

                                     $data_general = array(
                                     'off_id'    =>$off_id,
                                     'year'      =>$year,
                                     'unit_name'              =>$unit_name,
                                     'building_location'      =>$building_location,
                                     'tel1_number'            =>$tel1_number,
                                     'usage_condition'        =>$usage_condition,
                                     'official_time'          =>$official_time,
                                     'contact_name'           =>$contact_name,
                                     'position1'              =>$position1,
                                     'tel2_number'            =>$tel2_number,
                                     'coordinator_name'       =>$coordinator_name,
                                     'position2'              =>$position2,
                                     'tel3_number'            =>$tel3_number,
                                     'begin_year'             =>$begin_year,
                                     'presented_to'           =>$presented_to,
                                     'report_from'            =>$report_from,
                                     'report_maker1'          =>$report_maker1,
                                     'report_maker2'          =>$report_maker2,

                                    'created_at'=>$created_at, 
                                    'updated_at'=>$updated_at
                                    );

                                    //dd($data_general);

                              DB::table($db->db_name.'.general_info')->insert($data_general);
                              return redirect()->route('admin_excel_menu', ['off_id'=>$request->input('off_id')]);
                  //if2
                   }else{

                          echo "ยังไม่มีข้อมูลใดๆ ใน table นี้เลย";

                          $off_id       = $request->input('off_id');
                          $year         = $request->input('year_info');

                          $created_at   = new DateTime();
                          $updated_at   = new DateTime();


                          $toDB = array(
                              'off_id'    =>$off_id,
                              'year'      =>$year,
                              
                              'created_at'=>$created_at, 
                              'updated_at'=>$updated_at

                          );
                         DB::table($db->db_name.'.report_year')->insert($toDB);
                         return redirect()->route('admin_excel_menu', ['off_id'=>$request->input('off_id')]);
                  
                   }//if2

          }//if1


       }//first foreach

    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewGeneral($off_id,$year){


        return view('Excel.import_excel_view_general');
    }

/*----------------------------------------------------*/

    public function importExcel_general(Request $request){

        //+++++++++++++++++++++++++++++++++++++++++++++++++++++
        function RotateSquareAssociativeArray($squareArray)
        {
            if ($squareArray == null) { return null; }
            $rotatedArray = array();
            $r = 0;

            foreach($squareArray as $c=>$row) {
                if (is_array($row)) {
                    foreach($row as $key=>$cell) {
                        $rotatedArray[$key][$c] = $cell;
                    }
                }
                else {
                    $rotatedArray[$c][$r] = $row;
                }
                ++$r;
            }
            return $rotatedArray;
        }
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++
            $created_at   = new DateTime();
            $updated_at   = new DateTime();

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  //$arrF[] = ['field_name' => $value->field_name];
                  $arrV[] = ['info_value' => $value->info_value];
                }

                //$arrF = RotateSquareAssociativeArray($arrF);
                $arrV = RotateSquareAssociativeArray($arrV);
                //dd($arrV);

                foreach ($arrV as $kv => $valV) {

                  $unit_name = $arrV['info_value'][0];
                  $building_location = $arrV['info_value'][1];
                  $tel1_number = $arrV['info_value'][2];
                  $usage_condition = $arrV['info_value'][3];
                  $official_time = $arrV['info_value'][4];
                  $contact_name = $arrV['info_value'][5];
                  $position1 = $arrV['info_value'][6];
                  $tel2_number = $arrV['info_value'][7];
                  $coordinator_name = $arrV['info_value'][8];
                  $position2 = $arrV['info_value'][9];
                  $tel3_number = $arrV['info_value'][10];
                  $begin_year = $arrV['info_value'][11];
                  $presented_to = $arrV['info_value'][12];
                  $report_from = $arrV['info_value'][13];
                  $report_maker1 = $arrV['info_value'][14];
                  $report_maker2 = $arrV['info_value'][15];
                }

                 
                 $arr[] = ['off_id'=>$request->off_id,
                           'year'=>$request->year,
                           'unit_name' => $unit_name,
                           'building_location' => $building_location,
                           'tel1_number' => $tel1_number,
                           'usage_condition' => $usage_condition,
                           'official_time' => $official_time,
                           'contact_name' => $contact_name,
                           'position1' => $position1,
                           'tel2_number' => $tel2_number,
                           'coordinator_name' => $coordinator_name,
                           'position2' => $position2,
                           'tel3_number' => $tel3_number,
                           'begin_year' => $begin_year,
                           'presented_to' => $presented_to,
                           'report_from' => $report_from,
                           'report_maker1' => $report_maker1,
                           'report_maker2' => $report_maker2,
                           'created_at' => $created_at,
                           'updated_at' => $updated_at
                          ];



              $data = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");

              foreach ($data as $key => $value) {

                if(!empty($arr)){

                    DB::table($value->db_name.'.general_info')->insert($arr);
                    //dd('Insert Recorded successfully.');

                    return redirect()->route('import_excel_view_general', ['off_id'=>$request->off_id,'year'=>$request->year]);
                }

              }//for $data

            }

        }

        dd('Request data does not have any files to import.');      

    } 
/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelEditGeneral(Request $req){

              $updated_at   = new DateTime();
              //$user_ID      = $req->input('user_ID');

              $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$req->off_id'");    

              foreach ($db as $key => $value){
                  DB::table($value->db_name.'.general_info')
                        ->where('id', $req->input('id'))
                        ->update([
                        'unit_name'         => $req->input('unit_name'),
                        'building_location' => $req->input('building_location'),
                        'tel1_number'       => $req->input('tel1_number'),
                        'usage_condition'   => $req->input('usage_condition'),
                        'official_time'     => $req->input('official_time'),
                        'contact_name'      => $req->input('contact_name'),
                        'position1'         => $req->input('position1'),
                        'tel2_number'       => $req->input('tel2_number'),
                        'coordinator_name'  => $req->input('coordinator_name'),
                        'position2'         => $req->input('position2'),
                        'tel3_number'       => $req->input('tel3_number'),
                        'begin_year'        => $req->input('begin_year'),
                        'presented_to'      => $req->input('presented_to'),
                        'report_from'       => $req->input('report_from'),
                        'report_maker1'     => $req->input('report_maker1'),
                        'report_maker2'     => $req->input('report_maker2'),
                        'updated_at'        => $updated_at
                        ]);

              }

         return redirect()->route('import_excel_view_general', ['off_id'=>$req->input('off_id'), 'year'=>$req->input('year')]);      
    }

/*----------------------------------------------------*/  
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelGeneral($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.general_info')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_general', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileGeneral($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             general_info.unit_name as unit_name,
             general_info.building_location as   building_location,
             general_info.tel1_number as tel1_number,
             general_info.usage_condition as usage_condition,
             general_info.official_time as official_time,
             general_info.contact_name as contact_name,
             general_info.position1 as position1,
             general_info.tel2_number as tel2_number,
             general_info.coordinator_name as coordinator_name,
             general_info.position2 as position2,
             general_info.tel3_number as tel3_number,
             general_info.begin_year as begin_year,
             general_info.presented_to as presented_to,
             general_info.report_from as report_from,
             general_info.report_maker1 as report_maker1,
             general_info.report_maker2 as report_maker2
            FROM $db->db_name.general_info
            WHERE general_info.off_id = '$off_id'
            AND general_info.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_left = array( 
                'field_name',          
                'unit_name',
                'building_location',
                'tel1_number',
                'usage_condition',
                'official_time',
                'contact_name',
                'position1',
                'tel2_number',
                'coordinator_name',
                'position2',
                'tel3_number',
                'begin_year',
                'presented_to',
                'report_from',
                'report_maker1',
                'report_maker2'
              );
             foreach ($ck_data as $k => $ck) {
              $ck_body = array(
                'field_name'              => 'info_value',
                'unit_name'               => $ck->unit_name,
                'building_location'       => $ck->building_location,
                'tel1_number'             => $ck->tel1_number,
                'usage_condition'         => $ck->usage_condition,
                'official_time'           => $ck->official_time,
                'contact_name'            => $ck->contact_name,
                'position1'               => $ck->position1,
                'tel2_number'             => $ck->tel2_number,
                'coordinator_name'        => $ck->coordinator_name,
                'position2'               => $ck->position2,
                'tel3_number'             => $ck->tel3_number,
                'begin_year'              => $ck->begin_year,
                'presented_to'            => $ck->presented_to,
                'report_from'             => $ck->report_from,
                'report_maker1'           => $ck->report_maker1,
                'report_maker2'           => $ck->report_maker2
            );

                      
               }
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++
        function RotateSquareAssociativeArray($squareArray)
        {
            if ($squareArray == null) { return null; }
            $rotatedArray = array();
            $r = 0;

            foreach($squareArray as $c=>$row) {
                if (is_array($row)) {
                    foreach($row as $key=>$cell) {
                        $rotatedArray[$key][$c] = $cell;
                    }
                }
                else {
                    $rotatedArray[$c][$r] = $row;
                }
                ++$r;
            }
            return $rotatedArray;
        }
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++
        $ck_left = RotateSquareAssociativeArray($ck_left);
        $ck_body = RotateSquareAssociativeArray($ck_body);
        //$ck_body = array_flatten($ck_body);
        //$ck_body = implode(',', $ck_body);

        //dd($ck_body);
              Excel::create('General_info', function($excel) use ($ck_left,$ck_body){
               $excel->setTitle('General_info');
               $excel->sheet('General_info', function($sheet) use ($ck_left,$ck_body){
               $sheet->fromArray($ck_left, null, 'A1', false, false);
               $sheet->data = [];
               $sheet->fromArray($ck_body, null, 'B1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewPerson($off_id,$year){


      //echo "test";
      return view('Excel.import_excel_view_person');
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelInsertPerson(Request $req)
    {
        //add person_info
        $off_id                           = $req->input('off_id');
        $year                             = $req->input('year');
        $num_person                       = $req->input('num_person');

        $created_at   = new DateTime();
        $updated_at   = new DateTime();


        $data = array(
            'off_id'                    =>$off_id,
            'year'                      =>$year,
            'num_person'                =>$num_person,

            'created_at'=>$created_at, 
            'updated_at'=>$updated_at

        );


              $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$req->off_id'");    

              foreach ($db as $key => $value){

                    DB::table($value->db_name.'.person_info')->insert($data);

              }      

        return redirect()->route('import_excel_view_person', ['off_id'=>$req->input('off_id'), 'year'=>$req->input('year')]);  
    }
/*----------------------------------------------------*/    
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelEditPerson(Request $req){

              $updated_at   = new DateTime();
              //$user_ID      = $req->input('user_ID');

              $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$req->off_id'");    

              foreach ($db as $key => $value){
                  DB::table($value->db_name.'.person_info')
                        ->where('id', $req->input('id'))
                        ->update([
                        'num_person'        => $req->input('num_person'),
                        'updated_at'        => $updated_at
                        ]);

              }

         return redirect()->route('import_excel_view_person', ['off_id'=>$req->input('off_id'), 'year'=>$req->input('year')]);      
    }

/*----------------------------------------------------*/  
//===============================================================================================================








//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewExpenses_t1($off_id,$year){

        return view('Excel.import_excel_view_expenses_t1');
    }

/*----------------------------------------------------*/

    public function importExcel_expenses_t1(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id'=>$request->off_id,
                            'year'=>$request->year,
                            'id_meter' =>$value->id_meter,
                            'date_info' => $value->date_info, 
                            'kw_peak' =>$value->kw_peak,
                            'kwh' =>$value->kwh,
                            'expenses_bath' =>$value->expenses_bath,
                            'unit_bath' =>$value->unit_bath,
                            'created_at' =>$created_at,
                            'updated_at'=> $updated_at
                           ];

                }

                //dd($arr);

              $data = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");

              foreach ($data as $key => $value) {


                if(!empty($arr)){

                    DB::table($value->db_name.'.expenses_t1')->insert($arr);
                    //dd('Insert Recorded successfully.');

                    return redirect()->route('import_excel_view_expenses_t1', ['off_id'=>$request->off_id,'year'=>$request->year]);
                }

              }//for $data

            }

        }

        dd('Request data does not have any files to import.');      

    } 

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelEditExpenses_t1(Request $req,$off_id,$year){

              $updated_at   = new DateTime();

              //dd(request('data'));
              //echo sizeof(request('data'));
              //$off_id = array_flatten($arr1[$k]['off_id']);

              $db = DB::connection("audit_cmu") 
                      ->select("SELECT * FROM audit_db WHERE off_id = $off_id ");    
              foreach ($db as $key => $value){
                 
                  foreach (request('data') as $k => $va){

                   // echo $va[0]."&nbsp;".$va[1]."&nbsp;".$va[3]."<br>";

                    DB::table($value->db_name.'.expenses_t1')
                          ->where('id', $va[0])
                          ->update([
                          'id_meter'          => $va[3],  
                          'date_info'         => $va[4],
                          'kw_peak'           => $va[5],
                          'kwh'               => $va[6],
                          'expenses_bath'     => $va[7],
                          'unit_bath'         => $va[8],
                          'updated_at'        => $updated_at
                          ]);
                  }
              }

              return redirect()->route('import_excel_view_expenses_t1', ['off_id'=>$off_id,'year'=>$year] );
               
    }

/*----------------------------------------------------*/  
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelExpenses_t1($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.expenses_t1')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_expenses_t1', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileExpenses_t1($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             expenses_t1.id_meter as id_meter,
             expenses_t1.date_info as date_info,
             expenses_t1.kw_peak as kw_peak,
             expenses_t1.kwh as kwh,
             expenses_t1.expenses_bath as expenses_bath,
             expenses_t1.unit_bath as unit_bath
             
            FROM $db->db_name.expenses_t1
            WHERE expenses_t1.off_id = '$off_id'
            AND expenses_t1.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(  
                'id_meter',              
                'date_info',
                'kw_peak',
                'kwh',
                'expenses_bath',
                'unit_bath'
              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'id_meter'                => $ck->id_meter,
                'date_info'               => $ck->date_info,
                'kw_peak'                 => $ck->kw_peak,
                'kwh'                     => $ck->kwh,
                'expenses_bath'           => $ck->expenses_bath,
                'unit_bath'               => $ck->unit_bath
                
            );
                      
               }
        //dd($ck_body);
              Excel::create('Expenses_t1', function($excel) use ($ck_array){
               $excel->setTitle('Expenses_t1');
               $excel->sheet('Expenses_t1', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewExpenses_t2($off_id,$year){

        return view('Excel.import_excel_view_expenses_t2');
    }

/*----------------------------------------------------*/

    public function importExcel_expenses_t2(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();      

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id'=>$request->off_id,
                            'year'=>$request->year,
                            'transformer_name' =>$value->transformer_name, 
                            'transformer_value' =>$value->transformer_value,
                            'transformer_unit' =>$value->transformer_unit,
                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];

                }

                //dd($arr);

              $data = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");

              foreach ($data as $key => $value) {


                if(!empty($arr)){

                    DB::table($value->db_name.'.expenses_t2')->insert($arr);
                    //dd('Insert Recorded successfully.');

                    return redirect()->route('import_excel_view_expenses_t2', ['off_id'=>$request->off_id,'year'=>$request->year]);
                }

              }//for $data

            }

        }

        dd('Request data does not have any files to import.');      

    } 

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelEditExpenses_t2(Request $req,$off_id,$year){

              $updated_at   = new DateTime();

              // dd(request('data'));
              // echo sizeof(request('data'));
              // $off_id = array_flatten($arr1[$k]['off_id']);

              $db = DB::connection("audit_cmu") 
                      ->select("SELECT * FROM audit_db WHERE off_id = $off_id ");    
              foreach ($db as $key => $value){
                 
                  foreach (request('data') as $k => $va){
                    DB::table($value->db_name.'.expenses_t2')
                          ->where('id', $va[0])
                          ->update([
                          'transformer_name'  => $va[3],
                          'transformer_value' => $va[4],
                          'transformer_unit'  => $va[5],
                          'updated_at'        => $updated_at
                          ]);
                  }
              }

              return redirect()->route('import_excel_view_expenses_t2', ['off_id'=>$off_id,'year'=>$year]);
               
    }

/*----------------------------------------------------*/  
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelExpenses_t2($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.expenses_t2')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_expenses_t2', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileExpenses_t2($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             expenses_t2.transformer_name as transformer_name,
             expenses_t2.transformer_value as transformer_value,
             expenses_t2.transformer_unit as transformer_unit
            FROM $db->db_name.expenses_t2
            WHERE expenses_t2.off_id = '$off_id'
            AND expenses_t2.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(              
                'transformer_name',
                'transformer_value',
                'transformer_unit'

              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'transformer_name'               => $ck->transformer_name,
                'transformer_value'              => $ck->transformer_value,
                'transformer_unit'               => $ck->transformer_unit
            );
                      
               }
        //dd($ck_body);
              Excel::create('Expenses_t2', function($excel) use ($ck_array){
               $excel->setTitle('Expenses_t2');
               $excel->sheet('Expenses_t2', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewBuilding($off_id,$year){

        return view('Excel.import_excel_view_building');
    }

/*----------------------------------------------------*/

    public function importExcel_building(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();        

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id'=>$request->off_id,
                            'year'=>$request->year,
                            'building_name' => $value->building_name, 
                            'floor' => $value->floor,
                            'id_meter' => $value->id_meter, 
                            'total_floor' => $value->total_floor,
                            'floor_hieght' => $value->floor_hieght,
                            'parking_area' => $value->parking_area,
                            'used_area' => $value->used_area,
                            'air_area' => $value->air_area,
                            'air_area_on_top' => $value->air_area_on_top,
                            'year_begin' => $value->year_begin,
                            'created_at' =>$created_at,
                            'updated_at'=> $updated_at
                           ];

                }
                 
            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.building_info')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.building_info')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_building', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 





/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelEditBuilding(Request $req,$off_id,$year){

              $updated_at   = new DateTime();

              // dd(request('data'));
              // echo sizeof(request('data'));
              // $off_id = array_flatten($arr1[$k]['off_id']);

              $db = DB::connection("audit_cmu") 
                      ->select("SELECT * FROM audit_db WHERE off_id = $off_id ");    
              foreach ($db as $key => $value){
                 
                  foreach (request('data') as $k => $va){
                    DB::table($value->db_name.'.building_info')
                          ->where('id', $va[0])
                          ->update([
                          'building_name'     => $va[3],
                          'floor'             => $va[4],
                          'id_meter'          => $va[5],
                          'total_floor'       => $va[6],
                          'floor_hieght'      => $va[7],
                          'parking_area'      => $va[8],
                          'used_area'         => $va[9],
                          'air_area'          => $va[10],
                          'air_area_on_top'   => $va[11],
                          'year_begin'        => $va[12],
                          'updated_at'        => $updated_at
                          ]);
                  }
              }

              return redirect()->route('import_excel_view_building', ['off_id'=>$off_id,'year'=>$year]);
               
    }

/*----------------------------------------------------*/  
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelBuilding($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.building_info')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_building', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileBuilding($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             building_info.building_name as building_name,
             building_info.floor as floor,
             building_info.id_meter as id_meter,
             building_info.total_floor as total_floor,
             building_info.floor_hieght as floor_hieght,
             building_info.parking_area as parking_area,
             building_info.used_area as used_area,
             building_info.air_area as air_area,
             building_info.air_area_on_top as air_area_on_top,
             building_info.year_begin as year_begin
            FROM $db->db_name.building_info
            WHERE building_info.off_id = '$off_id'
            AND building_info.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'building_name', 
                'floor', 
                'id_meter',      
                'total_floor',
                'floor_hieght',
                'parking_area',
                'used_area',
                'air_area',
                'air_area_on_top',
                'year_begin'

              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'building_name'                  => $ck->building_name,
                'floor'                          => $ck->floor,
                'id_meter'                       => $ck->id_meter,
                'total_floor'                    => $ck->total_floor,
                'floor_hieght'                   => $ck->floor_hieght,
                'parking_area'                   => $ck->parking_area,
                'used_area'                      => $ck->used_area,
                'air_area'                       => $ck->air_area,
                'air_area_on_top'                => $ck->air_area_on_top,
                'year_begin'                     => $ck->year_begin
            );
                      
               }
        //dd($ck_body);
              Excel::create('Building_info', function($excel) use ($ck_array){
               $excel->setTitle('Building_info');
               $excel->sheet('Building_info', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewEquipment_t1($off_id,$year){

        return view('Excel.import_excel_view_equipment_t1');
    }

/*----------------------------------------------------*/

    public function importExcel_equipment_t1(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {
                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year, 
                            'location' => $value->location,
                            'room_name' => $value->room_name,
                            'id_meter' => $value->id_meter,
                            'room_type' => $value->room_type,
                            'floor' => $value->floor,
                            'equipment_name' => $value->equipment_name,
                            'watt' => $value->watt,
                            'amount' => $value->amount,
                            'work_hours_per_day' => $value->work_hours_per_day,
                            'work_days_per_year' => $value->work_days_per_year,
                            'factor' => $value->factor,
                            'kwh_per_year' => $value->kwh_per_year,
                            'expenses_per_year' => $value->expenses_per_year,
                            'created_at' =>$created_at,
                            'updated_at'=> $updated_at
                           ];
                }
            
            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.equipment_t1')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.equipment_t1')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_equipment_t1', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/ 

    public function importExcelDelEquipment_t1($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.equipment_t1')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_equipment_t1', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileEquipment_t1($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             equipment_t1.location as location,
             equipment_t1.room_name as room_name,
             equipment_t1.id_meter as id_meter,
             equipment_t1.room_type as room_type,
             equipment_t1.floor as floor,
             equipment_t1.equipment_name as equipment_name,
             equipment_t1.watt as watt,
             equipment_t1.amount as amount,
             equipment_t1.work_hours_per_day as work_hours_per_day,
             equipment_t1.work_days_per_year as work_days_per_year,
             equipment_t1.factor as factor,
             equipment_t1.kwh_per_year as kwh_per_year,
             equipment_t1.expenses_per_year as expenses_per_year
            FROM $db->db_name.equipment_t1
            WHERE equipment_t1.off_id = '$off_id'
            AND equipment_t1.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(    
                'location',         
                'room_name',
                'id_meter',
                'room_type',
                'floor',
                'equipment_name',
                'watt',
                'amount',
                'work_hours_per_day',
                'work_days_per_year',
                'factor',
                'kwh_per_year',
                'expenses_per_year'

              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'location'                       => $ck->location,
                'room_name'                      => $ck->room_name,
                'id_meter'                       => $ck->id_meter,
                'room_type'                      => $ck->room_type,
                'floor'                          => $ck->floor,
                'equipment_name'                 => $ck->equipment_name,
                'watt'                           => $ck->watt,
                'amount'                         => $ck->amount,
                'work_hours_per_day'             => $ck->work_hours_per_day,
                'work_days_per_year'             => $ck->work_days_per_year,
                'factor'                         => $ck->factor,
                'kwh_per_year'                   => $ck->kwh_per_year,
                'expenses_per_year'              => $ck->expenses_per_year
            );
                      
               }
        //dd($ck_body);
              Excel::create('Equipment_t1', function($excel) use ($ck_array){
               $excel->setTitle('Equipment_t1');
               $excel->sheet('Equipment_t1', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewEquipment_t2($off_id,$year){

        return view('Excel.import_excel_view_equipment_t2');
    }

/*----------------------------------------------------*/

    public function importExcel_equipment_t2(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'equiptment_type' => $value->equiptment_type, 
                            'watt' =>$value->watt,
                            'amount' =>$value->amount,
                            'total_watt' =>$value->total_watt,
                            'created_at' =>$created_at,
                            'updated_at'=> $updated_at
                           ];

                }
                //dd($arr);

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  


            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.equipment_t2')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.equipment_t2')->insert($arr);

           }//if $datasize > 1000

                  return redirect()->route('import_excel_view_equipment_t2', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelEditEquipment_t2(Request $req,$off_id,$year){

              $updated_at   = new DateTime();

              // dd(request('data'));
              // echo sizeof(request('data'));
              // $off_id = array_flatten($arr1[$k]['off_id']);

              $db = DB::connection("audit_cmu") 
                      ->select("SELECT * FROM audit_db WHERE off_id = $off_id ");    
              foreach ($db as $key => $value){
                 
                  foreach (request('data') as $k => $va){
                    DB::table($value->db_name.'.equipment_t2')
                          ->where('id', $va[0])
                          ->update([
                          'equiptment_type' => $va[3],
                          'watt'            => $va[4],
                          'amount'          => $va[5],
                          'total_watt'      => $va[6],
                          'updated_at'      => $updated_at
                          ]);
                  }
              }

              return redirect()->route('import_excel_view_equipment_t2', ['off_id'=>$off_id,'year'=>$year]);
               
    }

/*----------------------------------------------------*/  
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelEquipment_t2($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.equipment_t2')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_equipment_t2', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileEquipment_t2($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             equipment_t2.equiptment_type as equiptment_type,
             equipment_t2.watt as watt,
             equipment_t2.amount as amount,
             equipment_t2.total_watt as total_watt
            FROM $db->db_name.equipment_t2
            WHERE equipment_t2.off_id = '$off_id'
            AND equipment_t2.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(    
                'equiptment_type',
                'watt',
                'amount',
                'total_watt'
              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'equiptment_type'                => $ck->equiptment_type,
                'watt'                           => $ck->watt,
                'amount'                         => $ck->amount,
                'total_watt'                     => $ck->total_watt
            );
                      
               }
        //dd($ck_body);
              Excel::create('Equipment_t2', function($excel) use ($ck_array){
               $excel->setTitle('Equipment_t2');
               $excel->sheet('Equipment_t2', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewAirconditioner_t1($off_id,$year){

        return view('Excel.import_excel_view_airconditioner_t1');
    }

/*----------------------------------------------------*/
    public function importExcel_airconditioner_t1(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();      

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();

           if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,  
                            'location' => $value->location,
                            'room_name' => $value->room_name,
                            'id_meter' => $value->id_meter,
                            'room_type' => $value->room_type,
                            'floor' => $value->floor,
                            'aircon_area' => $value->aircon_area,
                            'aircon_type' => $value->aircon_type,
                            'btu_hr_machine' => $value->btu_hr_machine,
                            'kw_per_machine' => $value->kw_per_machine,
                            'work_days_per_year' => $value->work_days_per_year,
                            'amount' => $value->amount,
                            'year_setting' => $value->year_setting,
                            'age' => $value->age,
                            'work_hours_per_day' => $value->work_hours_per_day,
                            'work_days_per_year' => $value->work_days_per_year,
                            'factor' => $value->factor,
                            'symbol1' => $value->symbol1,
                            'brand1' => $value->brand1,
                            'brand2' => $value->brand2,
                            'symbol2' => $value->symbol2,
                            'phase_total' => $value->phase_total,
                            'thermo_type' => $value->thermo_type,
                            'room_temp' => $value->room_temp,
                            'ft_min' => $value->ft_min,
                            'rhr' => $value->rhr,
                            'rhs' => $value->rhs,
                            'tr' => $value->tr,
                            'ts' => $value->ts,
                            'kw' => $value->kw,
                            'v' => $value->v,
                            'iir' => $value->iir,
                            'iis' => $value->iis,
                            'iit' => $value->iit,
                            'pf' => $value->pf,
                            'total_kw' => $value->total_kw,
                            'kwh_per_year' => $value->kwh_per_year,
                            'bath_per_year' => $value->bath_per_year,
                            'total_btu' => $value->total_btu,
                            'area_on_top' => $value->area_on_top,
                            'created_at' =>$created_at,
                            'updated_at'=> $updated_at
                           ];

                }

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  


            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.airconditioner_t1')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.airconditioner_t1')->insert($arr);
                  
           }//if $datasize > 1000

                  return redirect()->route('import_excel_view_airconditioner_t1', ['off_id'=>$request->off_id,'year'=>$request->year]);
          }//data count

        }//if($request->hasFile('sample_file'))
        dd('Request data does not have any files to import.'); 
        
    }  
/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelAirconditioner_t1($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.airconditioner_t1')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_airconditioner_t1', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileAirconditioner_t1($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             airconditioner_t1.location as location,
             airconditioner_t1.room_name as room_name,
             airconditioner_t1.id_meter as id_meter,
             airconditioner_t1.room_type as room_type,
             airconditioner_t1.floor as floor,
             airconditioner_t1.aircon_area as aircon_area,
             airconditioner_t1.aircon_type as aircon_type,
             airconditioner_t1.btu_hr_machine as btu_hr_machine,
             airconditioner_t1.kw_per_machine as kw_per_machine,
             airconditioner_t1.amount as amount,
             airconditioner_t1.year_setting as year_setting,
             airconditioner_t1.age as age,
             airconditioner_t1.work_hours_per_day as work_hours_per_day,
             airconditioner_t1.work_days_per_year as work_days_per_year,
             airconditioner_t1.factor as factor,
             airconditioner_t1.symbol1 as symbol1,
             airconditioner_t1.brand1 as brand1,
             airconditioner_t1.brand2 as brand2,
             airconditioner_t1.symbol2 as symbol2,
             airconditioner_t1.phase_total as phase_total,
             airconditioner_t1.thermo_type as thermo_type,
             airconditioner_t1.room_temp as room_temp,
             airconditioner_t1.ft_min as ft_min,
             airconditioner_t1.rhr as rhr,
             airconditioner_t1.rhs as rhs,
             airconditioner_t1.tr as tr,
             airconditioner_t1.ts as ts,
             airconditioner_t1.kw as kw,
             airconditioner_t1.v as v,
             airconditioner_t1.iir as iir,
             airconditioner_t1.iis as iis,
             airconditioner_t1.iit as iit,
             airconditioner_t1.pf as pf,
             airconditioner_t1.total_kw as total_kw,
             airconditioner_t1.kwh_per_year as kwh_per_year,
             airconditioner_t1.bath_per_year as bath_per_year,
             airconditioner_t1.total_btu as total_btu,             
             airconditioner_t1.area_on_top as area_on_top
            FROM $db->db_name.airconditioner_t1
            WHERE airconditioner_t1.off_id = '$off_id'
            AND airconditioner_t1.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'location',
                'room_name',
                'id_meter',
                'room_type',
                'floor',
                'aircon_area',
                'aircon_type',
                'btu_hr_machine',
                'kw_per_machine',
                'amount',
                'year_setting',
                'age',
                'work_hours_per_day',
                'work_days_per_year',
                'factor',
                'symbol1',
                'brand1',
                'brand2',
                'symbol2',
                'phase_total',
                'thermo_type',
                'room_temp',
                'ft_min',
                'rhr',
                'rhs',
                'tr',
                'ts',
                'kw',
                'v',
                'iir',
                'iis',
                'iit',
                'pf',
                'total_kw',
                'kwh_per_year',
                'bath_per_year',                
                'total_btu',
                'area_on_top'
              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'location'           => $ck->location,
                'room_name'          => $ck->room_name,
                'id_meter'           => $ck->id_meter,
                'room_type'          => $ck->room_type,
                'floor'              => $ck->floor,
                'aircon_area'        => $ck->aircon_area,
                'aircon_type'        => $ck->aircon_type,
                'btu_hr_machine'     => $ck->btu_hr_machine,
                'kw_per_machine'     => $ck->kw_per_machine,
                'amount'             => $ck->amount,
                'year_setting'       => $ck->year_setting,
                'age'                => $ck->age,
                'work_hours_per_day' => $ck->work_hours_per_day,
                'work_days_per_year' => $ck->work_days_per_year,
                'factor'             => $ck->factor,
                'symbol1'            => $ck->symbol1,
                'brand1'             => $ck->brand1,
                'brand2'             => $ck->brand2,
                'symbol2'            => $ck->symbol2,
                'phase_total'        => $ck->phase_total,
                'thermo_type'        => $ck->thermo_type,
                'room_temp'          => $ck->room_temp,
                'ft_min'             => $ck->ft_min,
                'rhr'                => $ck->rhr,
                'rhs'                => $ck->rhs,
                'tr'                 => $ck->tr,
                'ts'                 => $ck->ts,
                'kw'                 => $ck->kw,
                'v'                  => $ck->v,
                'iir'                => $ck->iir,
                'iis'                => $ck->iis,
                'iit'                => $ck->iit,
                'pf'                 => $ck->pf,
                'total_kw'           => $ck->total_kw,
                'kwh_per_year'       => $ck->kwh_per_year,
                'bath_per_year'      => $ck->bath_per_year,
                'total_btu'          => $ck->total_btu,
                'area_on_top'        => $ck->area_on_top
            );
                      
               }
        //dd($ck_body);
              Excel::create('Airconditioner_t1', function($excel) use ($ck_array){
               $excel->setTitle('Airconditioner_t1');
               $excel->sheet('Airconditioner_t1', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewAirconditioner_t2($off_id){

        return view('Excel.import_excel_view_airconditioner_t2');
    }

/*----------------------------------------------------*/

    public function importExcel_airconditioner_t2(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime();       

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'btu_per_hour' => $value->btu_per_hour, 
                            'aircon_type' => $value->aircon_type,
                            'year_less_3' => $value->year_less_3,
                            'year3to5' => $value->year3to5,
                            'year6to7' => $value->year6to7,
                            'year8to9' => $value->year8to9,
                            'year_more_10' => $value->year_more_10,
                            'amount' => $value->amount,
                            'total_btu_per_hour' => $value->total_btu_per_hour,
                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];

                }
 
            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.airconditioner_t2')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.airconditioner_t2')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_airconditioner_t2', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 
/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelAirconditioner_t2($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.airconditioner_t2')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_airconditioner_t2', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileAirconditioner_t2($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             airconditioner_t2.btu_per_hour as btu_per_hour,
             airconditioner_t2.aircon_type as aircon_type,
             airconditioner_t2.year_less_3 as year_less_3,
             airconditioner_t2.year3to5 as year3to5,
             airconditioner_t2.year6to7 as year6to7,
             airconditioner_t2.year8to9 as year8to9,
             airconditioner_t2.year_more_10 as year_more_10,
             airconditioner_t2.amount as amount,
             airconditioner_t2.total_btu_per_hour as total_btu_per_hour
            FROM $db->db_name.airconditioner_t2
            WHERE airconditioner_t2.off_id = '$off_id'
            AND airconditioner_t2.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(  
                'btu_per_hour',   
                'aircon_type',
                'year_less_3',
                'year3to5',
                'year6to7',
                'year8to9',
                'year_more_10',
                'amount',
                'total_btu_per_hour'
              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'btu_per_hour'       => $ck->btu_per_hour,
                'aircon_type'        => $ck->aircon_type,
                'year_less_3'        => $ck->year_less_3,
                'year3to5'           => $ck->year3to5,
                'year6to7'           => $ck->year6to7,
                'year8to9'           => $ck->year8to9,
                'year_more_10'       => $ck->year_more_10,
                'amount'             => $ck->amount,
                'total_btu_per_hour' => $ck->total_btu_per_hour
            );
                      
               }
        //dd($ck_body);
              Excel::create('Airconditioner_t2', function($excel) use ($ck_array){
               $excel->setTitle('Airconditioner_t2');
               $excel->sheet('Airconditioner_t2', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcelViewAirchiller_t1($off_id,$year){

        return view('Excel.import_excel_view_airchiller_t1');

    }
/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/
    public function importExcel_airchiller_t1(Request $request){


            $created_at   = new DateTime();
            $updated_at   = new DateTime();      

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,  
                            'airchiller_type' => $value->airchiller_type,
                            'size_btu' => $value->size_btu,
                            'airchiller_total' => $value->airchiller_total,
                            'bimetal_num' => $value->bimetal_num,
                            'electronic_num' => $value->electronic_num,
                            'total_btu' => $value->total_btu,
                            'kwh_year' => $value->kwh_year,

                            'created_at' =>$created_at,
                            'updated_at'=> $updated_at
                           ];
                }

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.airchiller_t1')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.airchiller_t1')->insert($arr);
                  

           }//if $datasize > 1000
            


          return redirect()->route('import_excel_view_airchiller_t1', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 

//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelAirchiller_t1($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.airchiller_t1')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_airchiller_t1', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/ 
    public function exportFileAirchiller_t1($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             airchiller_t1.airchiller_type as airchiller_type,
             airchiller_t1.size_btu as size_btu,
             airchiller_t1.airchiller_total as airchiller_total,
             airchiller_t1.bimetal_num as bimetal_num,
             airchiller_t1.electronic_num as electronic_num,
             airchiller_t1.total_btu as total_btu,
             airchiller_t1.kwh_year as kwh_year

            FROM $db->db_name.airchiller_t1
            WHERE airchiller_t1.off_id = '$off_id'
            AND airchiller_t1.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(  
                'airchiller_type',   
                'size_btu',
                'airchiller_total',
                'bimetal_num',
                'electronic_num',
                'total_btu',
                'kwh_year'
              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'airchiller_type'    => $ck->airchiller_type,
                'size_btu'           => $ck->size_btu,
                'airchiller_total'   => $ck->airchiller_total,
                'bimetal_num'        => $ck->bimetal_num,
                'electronic_num'     => $ck->electronic_num,
                'total_btu'          => $ck->total_btu,
                'kwh_year'           => $ck->kwh_year
            );
                      
               }
        //dd($ck_body);
              Excel::create('Airchiller_t1', function($excel) use ($ck_array){
               $excel->setTitle('Airchiller_t1');
               $excel->sheet('Airchiller_t2', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }



/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewElamp_t1($off_id,$year){

        return view('Excel.import_excel_view_elamp_t1');
    }

/*----------------------------------------------------*/

    public function importExcel_elamp_t1(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime(); 

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'location' => $value->location, 
                            'room_name' => $value->room_name,
                            'id_meter' => $value->id_meter,
                            'room_type' => $value->room_type,
                            'floor' => $value->floor,
                            'total_area' => $value->total_area,
                            'bulb_type' => $value->bulb_type,
                            'elamp_watt' => $value->elamp_watt,
                            'elamp_type' => $value->elamp_type,
                            'shield_type' => $value->shield_type,
                            'ballast_type' => $value->ballast_type,
                            'lose_ballast_per_piece' => $value->lose_ballast_per_piece,
                            'bulb_per_lamp' => $value->bulb_per_lamp,
                            'total_lamp' => $value->total_lamp,
                            'work_hours_per_day' => $value->work_hours_per_day,
                            'work_days_per_year' => $value->work_days_per_year,
                            'factor' => $value->factor,
                            'total_bulb' => $value->total_bulb,
                            'setting' => $value->setting,
                            'lamp_reflector' => $value->lamp_reflector,
                            'lux_value1' => $value->lux_value1,
                            'lux_avg' => $value->lux_avg,
                            'total_watt_bulb_per_lamp' => $value->total_watt_bulb_per_lamp,
                            'power_lost_ballast_per_bulb' => $value->power_lost_ballast_per_bulb,
                            'total_watt' => $value->total_watt,
                            'kwh_per_year' => $value->kwh_per_year,
                            'expenses_bath_per_year' => $value->expenses_bath_per_year,
                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];

                }

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.elamp_t1')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.elamp_t1')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_elamp_t1', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 
/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelElamp_t1($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.elamp_t1')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_elamp_t1', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileElamp_t1($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             elamp_t1.location as location,
             elamp_t1.room_name as room_name,
             elamp_t1.id_meter as id_meter,
             elamp_t1.room_type as room_type,
             elamp_t1.floor as floor,
             elamp_t1.total_area as total_area,
             elamp_t1.bulb_type as bulb_type,
             elamp_t1.elamp_watt as elamp_watt,
             elamp_t1.elamp_type as elamp_type,
             elamp_t1.shield_type as shield_type,
             elamp_t1.ballast_type as ballast_type,
             elamp_t1.lose_ballast_per_piece as lose_ballast_per_piece,
             elamp_t1.bulb_per_lamp as bulb_per_lamp,
             elamp_t1.total_lamp as total_lamp,
             elamp_t1.work_hours_per_day as work_hours_per_day,
             elamp_t1.work_days_per_year as work_days_per_year,
             elamp_t1.factor as factor,
             elamp_t1.total_bulb as total_bulb,
             elamp_t1.setting as setting,
             elamp_t1.lamp_reflector as lamp_reflector,
             elamp_t1.lux_value1 as lux_value1,
             elamp_t1.lux_avg as lux_avg,
             elamp_t1.total_watt_bulb_per_lamp as total_watt_bulb_per_lamp,
             elamp_t1.power_lost_ballast_per_bulb as power_lost_ballast_per_bulb,
             elamp_t1.total_watt as total_watt,
             elamp_t1.kwh_per_year as kwh_per_year,
             elamp_t1.expenses_bath_per_year as expenses_bath_per_year
            FROM $db->db_name.elamp_t1
            WHERE elamp_t1.off_id = '$off_id'
            AND elamp_t1.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'location',
                'room_name',
                'id_meter',
                'room_type',
                'floor',
                'total_area',
                'bulb_type',
                'elamp_watt',
                'elamp_type',
                'shield_type',
                'ballast_type',
                'lose_ballast_per_piece',
                'bulb_per_lamp',
                'total_lamp',
                'work_hours_per_day',
                'work_days_per_year',
                'factor',
                'total_bulb',
                'setting',
                'lamp_reflector',
                'lux_value1',
                'lux_avg',
                'total_watt_bulb_per_lamp',
                'power_lost_ballast_per_bulb',
                'total_watt',
                'kwh_per_year',
                'expenses_bath_per_year'
              );
             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'location'                    => $ck->location,
                'room_name'                   => $ck->room_name,
                'id_meter'                    => $ck->id_meter,
                'room_type'                   => $ck->room_type,
                'floor'                       => $ck->floor,
                'total_area'                  => $ck->total_area,
                'bulb_type'                   => $ck->bulb_type,
                'elamp_watt'                  => $ck->elamp_watt,
                'elamp_type'                  => $ck->elamp_type,
                'shield_type'                 => $ck->shield_type,
                'ballast_type'                => $ck->ballast_type,
                'lose_ballast_per_piece'      => $ck->lose_ballast_per_piece,
                'bulb_per_lamp'               => $ck->bulb_per_lamp,
                'total_lamp'                  => $ck->total_lamp,
                'work_hours_per_day'          => $ck->work_hours_per_day,
                'work_days_per_year'          => $ck->work_days_per_year,
                'factor'                      => $ck->factor,
                'total_bulb'                  => $ck->total_bulb,
                'setting'                     => $ck->setting,
                'lamp_reflector'              => $ck->lamp_reflector,
                'lux_value1'                  => $ck->lux_value1,
                'lux_avg'                     => $ck->lux_avg,
                'total_watt_bulb_per_lamp'    => $ck->total_watt_bulb_per_lamp,
                'power_lost_ballast_per_bulb' => $ck->power_lost_ballast_per_bulb,
                'total_watt'                  => $ck->total_watt,
                'kwh_per_year'                => $ck->kwh_per_year,
                'expenses_bath_per_year'      => $ck->expenses_bath_per_year
            );
                      
               }
        //dd($ck_body);
              Excel::create('Elamp_t1', function($excel) use ($ck_array){
               $excel->setTitle('Elamp_t1');
               $excel->sheet('Elamp_t1', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewElamp_t2($off_id,$year){

        return view('Excel.import_excel_view_elamp_t2');
    }

/*----------------------------------------------------*/

    public function importExcel_elamp_t2(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime(); 

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'elamp_type' => $value->elamp_type, 
                            'watt' => $value->watt,
                            'lose_ballast_per_piece' => $value->lose_ballast_per_piece,
                            'total_bulb' => $value->total_bulb,
                            'power_bulb' => $value->power_bulb,
                            'power_lose_ballast' => $value->power_lose_ballast,
                            'power_total' => $value->power_total,
                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];

                }
 
            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.elamp_t2')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.elamp_t2')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_elamp_t2', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 
/*----------------------------------------------------*/
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelDelElamp_t2($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.elamp_t2')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_elamp_t2', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileElamp_t2($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             elamp_t2.elamp_type as elamp_type,
             elamp_t2.watt as watt,
             elamp_t2.lose_ballast_per_piece as lose_ballast_per_piece,
             elamp_t2.total_bulb as total_bulb,
             elamp_t2.power_bulb as power_bulb,
             elamp_t2.power_lose_ballast as power_lose_ballast,
             elamp_t2.power_total as power_total
            FROM $db->db_name.elamp_t2
            WHERE elamp_t2.off_id = '$off_id'
            AND elamp_t2.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'elamp_type',
                'watt',
                'lose_ballast_per_piece',
                'total_bulb',
                'power_bulb',
                'power_lose_ballast',
                'power_total'
              );

             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'elamp_type'                => $ck->elamp_type,
                'watt'                      => $ck->watt,
                'lose_ballast_per_piece'    => $ck->lose_ballast_per_piece,
                'total_bulb'                => $ck->total_bulb,
                'power_bulb'                => $ck->power_bulb,
                'power_lose_ballast'        => $ck->power_lose_ballast,
                'power_total'               => $ck->power_total
            );
                      
               }
        //dd($ck_body);
              Excel::create('Elamp_t2', function($excel) use ($ck_array){
               $excel->setTitle('Elamp_t2');
               $excel->sheet('Elamp_t2', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewWater_t1($off_id,$year){

        return view('Excel.import_excel_view_water_t1');
    }

/*----------------------------------------------------*/

    public function importExcel_water_t1(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime(); 

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'month_info' => $value->month_info, 
                            'volume' => $value->volume,
                            'cost_baht' => $value->cost_baht,
                            'cost_avg_baht_per_meter' => $value->cost_avg_baht_per_meter,

                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];
                }

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.water_t1')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.water_t1')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_water_t1', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 
/*----------------------------------------------------*/

    public function importExcelDelWater_t1($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.water_t1')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_water_t1', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileWater_t1($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             water_t1.month_info as month_info,
             water_t1.volume as volume,
             water_t1.cost_baht as cost_baht,
             water_t1.cost_avg_baht_per_meter as cost_avg_baht_per_meter
            FROM $db->db_name.water_t1
            WHERE water_t1.off_id = '$off_id'
            AND water_t1.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'month_info',
                'volume',
                'cost_baht',
                'cost_avgBahtPerMeter'
              );

             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'month_info'                => $ck->month_info,
                'volume'                    => $ck->volume,
                'cost_baht'                 => $ck->cost_baht,
                'cost_avg_baht_per_meter'   => $ck->cost_avg_baht_per_meter
            );
                      
               }
        //dd($ck_body);
              Excel::create('Water_t1', function($excel) use ($ck_array){
               $excel->setTitle('water_t1');
               $excel->sheet('Water_t1', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewOil_t1b($off_id,$year){

        return view('Excel.import_excel_view_oil_t1b');
    }

/*----------------------------------------------------*/

    public function importExcel_oil_t1b(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime(); 

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'month_info' => $value->month_info, 
                            'volume' => $value->volume,
                            'cost_baht' => $value->cost_baht,
                            'costoilb_avg_baht_per_meter' => $value->costoilb_avg_baht_per_meter,

                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];
                }

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.oil_t1b')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.oil_t1b')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_oil_t1b', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 
/*----------------------------------------------------*/

    public function importExcelDelOil_t1b($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.oil_t1b')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_oil_t1b', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileOil_t1b($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             oil_t1b.month_info as month_info,
             oil_t1b.volume as volume,
             oil_t1b.cost_baht as cost_baht,
             oil_t1b.costoilb_avg_baht_per_meter as costoilb_avg_baht_per_meter
            FROM $db->db_name.oil_t1b
            WHERE oil_t1b.off_id = '$off_id'
            AND oil_t1b.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'month_info',
                'volume',
                'cost_baht',
                'costoilb_avgBahtPerMeter'
              );

             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'month_info'                => $ck->month_info,
                'volume'                    => $ck->volume,
                'cost_baht'                 => $ck->cost_baht,
                'costoilb_avg_baht_per_meter'   => $ck->costoilb_avg_baht_per_meter
            );
                      
               }
        //dd($ck_body);
              Excel::create('Oil_t1b', function($excel) use ($ck_array){
               $excel->setTitle('oil_t1b');
               $excel->sheet('Oil_t1b', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewOil_t2d($off_id,$year){

        return view('Excel.import_excel_view_oil_t2d');
    }

/*----------------------------------------------------*/
    public function importExcel_oil_t2d(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime(); 

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'month_info' => $value->month_info, 
                            'volume' => $value->volume,
                            'cost_baht' => $value->cost_baht,
                            'costoild_avg_baht_per_meter' => $value->costoild_avg_baht_per_meter,

                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];
                }

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.oil_t2d')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.oil_t2d')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_oil_t2d', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 
/*----------------------------------------------------*/

    public function importExcelDelOil_t2d($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.oil_t2d')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_oil_t2d', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 
//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileOil_t2d($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             oil_t2d.month_info as month_info,
             oil_t2d.volume as volume,
             oil_t2d.cost_baht as cost_baht,
             oil_t2d.costoild_avg_baht_per_meter as costoild_avg_baht_per_meter
            FROM $db->db_name.oil_t2d
            WHERE oil_t2d.off_id = '$off_id'
            AND oil_t2d.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'month_info',
                'volume',
                'cost_baht',
                'costoild_avgBahtPerMeter'
              );

             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'month_info'                => $ck->month_info,
                'volume'                    => $ck->volume,
                'cost_baht'                 => $ck->cost_baht,
                'costoild_avg_baht_per_meter'   => $ck->costoild_avg_baht_per_meter
            );
                      
               }
        //dd($ck_body);
              Excel::create('Oil_t2d', function($excel) use ($ck_array){
               $excel->setTitle('oil_t2d');
               $excel->sheet('Oil_t2d', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================

//===============================================================================================================
/*----------------------------------------------------*/

    public function importExcelViewGenerator_t1($off_id,$year){

        return view('Excel.import_excel_view_generator_t1');
    }

/*----------------------------------------------------*/

    public function importExcel_generator_t1(Request $request){

            $created_at   = new DateTime();
            $updated_at   = new DateTime(); 

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $arr = array();
            if($data->count()){

                foreach ($data as $key => $value) {

                  $arr[] = ['off_id' => $request->off_id, 
                            'year' => $request->year,
                            'kw' => $value->kw, 
                            'volt' => $value->volt,
                            'amp' => $value->amp,
                            'power_factor' => $value->power_factor,
                            'speed' => $value->speed,
                            'manufacturer_name' => $value->manufacturer_name,
                            'date_begin' => $value->date_begin,
                            'location' => $value->location,
                            'note' => $value->note,

                            'created_at' => $created_at,
                            'updated_at' => $updated_at
                           ];
                }

            $dbcon = DB::connection("audit_cmu") 
                ->select("SELECT * FROM audit_db WHERE off_id  = '$request->off_id' ");
                foreach ($dbcon as $k => $value) { $dbconname=$value->db_name; }

            $datasize = sizeof($arr);
            $numset = ceil($datasize/1000);  

            if($datasize > 1000){ 
                for($i=1; $i <= $numset; $i++){
                      $dataSet = array(); 
                      $idx=0;
                    if($i!=$numset){
                      $numdata = 1000;
                      for($j=$numdata*($i-1); $j < ($numdata*$i)-1; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }

                    }else{
                      for($j=1000*($i-1); $j < $datasize; $j++){
                        $dataSet[$idx] = $arr[$j];
                        $idx=$idx+1;
                      }
                    }
                  
                  DB::table($dbconname.'.generator_t1')->insert($dataSet);
                }//end for

           }else{

                  DB::table($dbconname.'.generator_t1')->insert($arr);

           }//if $datasize > 1000
            

          return redirect()->route('import_excel_view_generator_t1', ['off_id'=>$request->off_id,'year'=>$request->year]);

            }
        }
        dd('Request data does not have any files to import.');      
    } 
/*----------------------------------------------------*/

    public function importExcelDelGenerator_t1($off_id,$year)
    {
    
    $db = DB::connection("audit_cmu") 
          ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");    

          foreach ($db as $key => $db){
              $data = DB::table($db->db_name.'.generator_t1')->where('off_id',$off_id)->where('year',$year)->delete();
          }

    return redirect()->route('import_excel_view_generator_t1', ['off_id'=>$off_id,'year'=>$year]); 
    }

/*----------------------------------------------------*/ 

//===============================================================================================================
/*----------------------------------------------------*/
    public function exportFileGenerator_t1($off_id,$year){

          $db = DB::connection("audit_cmu") 
                    ->select("SELECT * FROM audit_db WHERE off_id  = '$off_id'");   
          foreach ($db as $key => $db){          
          $ck_data = DB::select(DB::raw("
            SELECT 
             generator_t1.kw as kw,
             generator_t1.volt as volt,
             generator_t1.amp as amp,
             generator_t1.power_factor as power_factor,
             generator_t1.speed as speed,
             generator_t1.manufacturer_name as manufacturer_name,
             generator_t1.date_begin as date_begin,
             generator_t1.location as location

            FROM $db->db_name.generator_t1
            WHERE generator_t1.off_id = '$off_id'
            AND generator_t1.year = '$year' 
            "));
        }
          //print_r($ck_data);
              $ck_array[] = array(     
                'kw',
                'volt',
                'amp',
                'power_factor',
                'speed',
                'manufacturer_name',
                'date_begin',
                'location'
              );

             foreach ($ck_data as $k => $ck) {
              $ck_array[] = array(
                'kw'                            => $ck->kw,
                'volt'                          => $ck->volt,
                'amp'                           => $ck->amp,
                'power_factor'                  => $ck->power_factor,
                'speed'                         => $ck->speed,
                'manufacturer_name'             => $ck->manufacturer_name,
                'date_begin'                    => $ck->date_begin,
                'location'                      => $ck->location
            );
                      
               }
        //dd($ck_body);
              Excel::create('Generator_t1', function($excel) use ($ck_array){
               $excel->setTitle('generator_t1');
               $excel->sheet('Generator_t1', function($sheet) use ($ck_array){
               $sheet->fromArray($ck_array, null, 'A1', false, false);
               });
              })->download('xls');

    }
/*----------------------------------------------------*/ 
//===============================================================================================================
























}








































 