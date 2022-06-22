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
<!-- <body style="background-color:white;"> -->
<body>    
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
                    <td colspan="4" bgcolor="#CEB1FC"><center><b>สรุปข้อมูลปี {{ $year }}<br><font size="1">รวม/ตามหมายเลขมิเตอร์</font> </b></center></td>
                </tr>   
                <tr>
                    <td width="10%" bgcolor="#CEB1FC"><center><b>ลำดับที่</b></center></td>
                    <td width="50%" bgcolor="#CEB1FC"><center><b>รายการ</b></center></td>
                    <td width="30%" bgcolor="#CEB1FC"><center><b>จำนวน</b></center></td>
                    <td width="10%" bgcolor="#CEB1FC"><center><b>หน่วย</b></center></td>
                </tr>
                <tr>
                    <td><center>1</center></td>
                    <td>พลังงานไฟฟ้าที่ใช้</td>
                    <td><center><?php echo number_format($usedE_sumkwh,2); ?></center></td>
                    <td><center>kWh/ปี</center></td>
                </tr>
                <tr>
                    <td><center>2</center></td>
                    <td>ค่าใช้จ่ายด้านพลังงานไฟฟ้า</td>
                    <td><center><?php echo number_format($usedE_sumbaht,2); ?></center></td>
                    <td><center>บาท/ปี</center></td>
                </tr>
                <tr>
                    <td><center>3</center></td>
                    <td>ค่าพลังงานไฟฟ้าต่อหน่วย</td>
                    <td><center><?php if($usedE_sumkwh>0 or $usedE_sumkwh!=''){echo number_format($usedE_sumbaht/$usedE_sumkwh,2);}else{echo number_format(0,2);} ?></center></td>
                    <td><center>บาท/kWh</center></td>
                </tr>
                </table>
                </center>

</body>
</html>