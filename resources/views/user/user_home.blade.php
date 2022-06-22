@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>
                        <h4>ระบบสำรวจการใช้พลังงานมหาวิทยาลัยเชียงใหม่</h4>
                        <b>AUDIT</b>
                    </center>
                </div>

                <div class="panel-body">
                    @if ( Auth::user()->permission_ID == 1 or Auth::user()->email == 'orawan.netprasat@gmail.com')

                    <center> <a href="{{ url('/audit') }}"><p>หน้าหลัก|Home</p></a> </center>
                    <br>
                    <table border="1" width="100%">
                        <tr>
                            <th width="10%"><center>ลำดับที่</center></th>
                            <th width="60%"><center>USER</center></th>
                            <th width="15%"><center>แก้ไข</center></th>
                            <th width="15%"><center>ลบ</center></th>
                        </tr>
                        <?php $i=1 ?>
                        @foreach( $data as $value )
                        <tr>
                            <td><center><?php print $i++ ?></center></td>
                            <td><center>
                                {{ $value->name }}
                                <br>
                            </center></td>
                            <td><center><a href="{{ route('user_editdata', $value->id) }}">Edit</a></center></td>
                            <td><center>Delete</center></td>
                        </tr>  
                        @endforeach     
                        
                    </table>  
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
