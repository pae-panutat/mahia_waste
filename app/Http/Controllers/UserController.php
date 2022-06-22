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


use App\User;
use Carbon\Carbon;
use DateTime;


class UserController extends Controller
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

//----------------------------------------------------------------------
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_home()
    {
        //read table user
        $data = DB::table('users')
        ->select('*')
        ->get();    

        return view('user.user_home', ['data' => $data]);
    }
//----------------------------------------------------------------------
   
// ------------------------------------------------------------------------------------------------------

    public function user_editdata($id)
    {
        $data = User::find($id);
        if(count($data)>0){
            return view('user.user_editdata',['data'=>$data]);
        }else{

            $data = DB::table('user')
                ->select('*')
                ->get(); 

            echo "ID :".$id;
            return view('user.user_home',['data'=>$data]);
        }
      
    }
//------------------------------------------------------------------------------------------------------
    public function user_updatedata(Request $req)
    {

        $data = User::find($req->input('id'));
        $data->name                       = $req->input('name');  
        $data->email                      = $req->input('email'); 
        $data->office_ID                  = $req->input('office_ID');
        $data->permission_ID              = $req->input('permission_ID'); 


        $data->updated_at                       = Carbon::now(config('app.timezone'));
        $data->save();    

        return redirect()->route('user_editdata', ['id'=>$req->input('id')]);
    }
//-----------------------------------------------------------------------------------------------------



