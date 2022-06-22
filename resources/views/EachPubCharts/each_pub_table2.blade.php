<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMART AUDIT</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">  

</head>
<body style="background-color:white;">
    
<?php
    function monthTH($monthTH){
        if($monthTH=="01"){
            echo "มกราคม";
        }elseif($monthTH=="02"){
            echo "กุมภาพันธ์";
        }elseif($monthTH=="03"){
            echo "มีนาคม";
        }elseif($monthTH=="04"){
            echo "เมษายน";
        }elseif($monthTH=="05"){
            echo "พฤษภาคม";
        }elseif($monthTH=="06"){
            echo "มิถุนายน";
        }elseif($monthTH=="07"){
            echo "กรกฏาคม";
        }elseif($monthTH=="08"){
            echo "สิงหาคม";
        }elseif($monthTH=="09"){
            echo "กันยายน";
        }elseif($monthTH=="10"){
            echo "ตุลาคม";
        }elseif($monthTH=="11"){
            echo "พฤศจิกายน";
        }elseif($monthTH=="12"){
            echo "ธันวาคม";
    }
        }

?>       
            <script type="text/javascript" src="js/jscharts.js"></script>
                <br>
                    <center>
                    <table border="1" width="80%">
                    <tr>
                        <td colspan="5" bgcolor="#CEB1FC"><center><b>ข้อมูลอาคารปี <?php echo $year; ?><br><font size="1">&nbsp;</font> </b></center></td>
                    </tr>  
                    <tr>
                        <td width="10%" bgcolor="#CEB1FC"><center><b>ลำดับที่</b></center></td>
                        <td width="20%" bgcolor="#CEB1FC"><center><b>หมายเลขมิเตอร์</b></center></td>
                        <td width="50%" bgcolor="#CEB1FC"><center><b>ชื่ออาคาร</b></center></td>
                        <td width="10%" bgcolor="#CEB1FC"><center><b>ชั้น</b></center></td>
                        <td width="10%" bgcolor="#CEB1FC"><center><b>จำนวนชั้น</b></center></td>
                    </tr>
                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                FROM audit_cmu.audit_db 
                                WHERE off_id = $off_id ")); as $db)                
                    <?php $k=0;  ?> 
                    @foreach (DB::SELECT(DB::raw("SELECT * 
                                    FROM $db->db_name.building_info
                                    WHERE off_id = $off_id AND year = $year ")); as $data)                 
                    <tr>
                        <td><center><?php echo $k+1; ?></center></td>
                        <td><?php echo $data->id_meter; ?></td>
                        <td><?php echo $data->building_name; ?></td>
                        <td><center>&nbsp;</center></td>
                        <td><center>&nbsp;</center></td>
                    </tr>
                    <?php $k=$k+1; ?>
                    @endforeach
                    @endforeach 
                    </table>
                    </center>

</body>
</html>