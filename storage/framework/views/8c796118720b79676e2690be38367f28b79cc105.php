    <script src="<?php echo e(asset('js/loader.js')); ?>"></script>
    <script type="text/javascript">

      // Load Charts and the corechart and barchart packages.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart and bar chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data_airkwh = <?php echo e($airkwh); ?> 
        var data_elampkwh = <?php echo e($elampkwh); ?> 
        var data_equipkwh = <?php echo e($equipkwh); ?> 
        var data_otherkwh = <?php echo e($otherkwh); ?>


        var data = new google.visualization.DataTable();
        data.addColumn('string', 'ประเภท');
        data.addColumn('number', 'kWh');
        data.addRows([
          ['เครื่องปรับอากาศ', data_airkwh],
          ['แสงสว่าง', data_elampkwh],
          ['อุปกรณ์ไฟฟ้า', data_equipkwh],
          ['อื่นๆ', data_otherkwh],
        ]);

        var piechart_options = {title:'',
                       width:400,
                       height:300,
                       colors: ['#00FF83', '#49D8F8', '#FFC700', '#f3b49f']
                     };
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);

       
      }
</script>

    <!--Table and divs that hold the pie charts-->
    <center>
    <p>สัดส่วนการใช้พลังงานไฟฟ้า : แต่ละอาคาร ปี <?php echo e($year); ?></p>
    <table class="columns">
      <tr>
        <td><center><div id="piechart_div" style="border: 0px solid #ccc"></div></center></td>
      </tr>
    </table>
    <br>
    <form action="<?php echo e(url('/chart5&'.$off_id.'&'.$year)); ?>">
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
  </center>





