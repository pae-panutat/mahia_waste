@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>
                        <h4>ระบบสำรวจการใช้พลังงาน มหาวิทยาลัยเชียงใหม่</h4>
                        <b>AUDIT</b>
                    </center>
                </div>

                <div class="panel-body">
                    @if ( Auth::user()->permission_ID == 1 or Auth::user()->email == 'orawan.netprasat@gmail.com' )

                    <center> <a href="{{ url('/user') }}"><p>กลับ|Back</p></a> </center>
                    
                    <form action="{{ route('user_updatedata') }}" method="post">
                    {{ csrf_field() }}

                    <table border="0" width="100%" >
                        <tr>
                            <td width="15%" align="right">User-ID</td>
                            <td width="5%">&nbsp;</td>
                            <td>
                                <input type="text" class="form-control" name="id" value="{{ ($data['id']) }}" style="background-color: #3CBC8D; color: white;" readonly><br>
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" align="right">ชื่อ-สกุล</td>
                            <td width="5%">&nbsp;</td>
                            <td>
                                <input type="text" class="form-control" name="name" placeholder="ชือ-สกุล" value="{{ ($data['name']) }}"><br>
                            </td>
                        </tr>      
                        <tr>
                            <td width="15%" align="right">Email</td>
                            <td width="5%">&nbsp;</td>
                            <td>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ ($data['email']) }}"><br>
                            </td>
                        </tr>  
                        <tr>
                            <td width="15%" valign="top" align="right">สังกัดสำนักงาน<br><br></td>
                            <td width="5%">&nbsp;</td>
                            <td>
                                <select name="office_ID">
                                @foreach (App\Office::all() as $key => $value)
                                <option value="{{$value->id}}" 
                                    {{ (($data['office_ID']) == $value->id ? "selected":"") }}> 
                                    {{ $value->office_name}} 
                                </option>
                                @endforeach
                                </select>
                                <br><br>
                            </td>
                        </tr>     
                        <tr>
                            <td width="15%" valign="top" align="right">permission_ID<br><br></td>
                            <td width="5%">&nbsp;</td>
                            <td>
                                <select name="permission_ID">
                                @foreach (App\PermissionType::all() as $key => $value)
                                <option value="{{$value->id}}" 
                                    {{ (($data['permission_ID']) == $value->id ? "selected":"") }}> 
                                    {{ $value->permission_type_name}} 
                                </option>
                                @endforeach
                                </select>
                                <br><br>
                            </td>
                        </tr>               
                        <tr>
                            <td width="15%" align="right">บันทึกล่าสุด</td>
                            <td width="5%">&nbsp;</td>
                            <td>
                                <input type="text" class="form-control" name="updated_at" placeholder="บันทึกล่าสุด" value="{{ ($data['updated_at']) }}" style="background-color: #3CBC8D; color: white;" readonly><br>
                            </td>
                        </tr>
                    </table>  
                    <br>
                    <center>
                        <input type="hidden" name="user_ID" value="{{ Auth::user()->id }}">
                        <input type="submit" value="บันทึก|Submit">
                    </center>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
