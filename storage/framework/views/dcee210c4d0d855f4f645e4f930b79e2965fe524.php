<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>SMART AUDIT</title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">  

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

<?php 
$off_id = request()->route()->off_id; 
$year = request()->route()->year;
$pyear = $year-1;
?>


            <script type="text/javascript" src="js/jscharts.js"></script>
                <br>
                    <center>
                    <table border="1" width="80%">
                    <tr>
                        <td colspan="3" bgcolor="#CEB1FC"><center><b>ปี<?php echo $year;?><br><font size="1">&nbsp;</font> </b></center></td>
                    </tr>  
                    <tr>
                        <td colspan="3" bgcolor="#CEB1FC"><center><b>สัดส่วนการใช้พลังงานไฟฟ้า : อาคาร<br><font size="1">&nbsp;</font> </b></center></td>
                    </tr>
                    <tr>

                        <td  bgcolor="#CEB1FC"><center><b>ระบบ</b></center></td>
                        <td  bgcolor="#CEB1FC"><center><b>kWh/ปี</b></center></td>
                        <td  bgcolor="#CEB1FC"><center><b>ร้อยละ</b></center></td>

                    </tr>               
                    <tr>
                        <td><center>เครื่องปรับอากาศ</center></td>
                        <td><center><?php echo e(number_format($airkwh,2)); ?></center></td>
                        <td><center><?php echo e(number_format($airpc*100,2)); ?></center></td>
                    </tr>
                    <tr>
                        <td><center>แสงสว่าง</center></td>
                        <td><center><?php echo e(number_format($elampkwh,2)); ?></center></td>
                        <td><center><?php echo e(number_format($elamppc*100,2)); ?></center></td>
                    </tr>
                    <tr>
                        <td><center>อุปกรณ์ไฟฟ้า</center></td>
                        <td><center><?php echo e(number_format($equipkwh,2)); ?></center></td>
                        <td><center><?php echo e(number_format($equippc*100,2)); ?></center></td>                     
                    </tr>
                    <tr>
                        <td><center>อื่นๆ</center></td>
                        <td><center><?php echo e(number_format($otherkwh,2)); ?></center></td>
                        <td><center><?php echo e(number_format($otherpc*100,2)); ?></center></td>                      
                    </tr>
                    <tr>
                        <td><center>รวม</center></td>
                        <td><center><?php echo e(number_format($totalkwh,2)); ?></center></td>
                        <td><center><?php echo e(number_format($totalpc*100,2)); ?></center></td>                      
                    </tr>
                    </table>

                    <br>

                        <form action="<?php echo e(url('/table4&'.$off_id.'&'.$year)); ?>">
                          <label for="building_name">เลือกอาคาร: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                          <select name="building_name" id="building_name">
                            <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                    FROM audit_cmu.audit_db 
                                    WHERE off_id = $off_id "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                
                            <?php $__currentLoopData = DB::SELECT(DB::raw("SELECT * 
                                    FROM $db->db_name.building_info
                                    WHERE off_id = $off_id AND year = $year ORDER BY building_name ASC "));; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                            <option value="<?php echo e($data->building_name); ?> "> <?php echo " ".$data->building_name; ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="submit" value="Submit">
                        </form>




</body>
</html>