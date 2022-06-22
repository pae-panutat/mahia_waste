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
    <p>สัดส่วนการใช้พลังงานไฟฟ้า : รวม ปี <?php echo e($year); ?></p>
    <table class="columns">
      <tr>
        <td><center><div id="piechart_div" style="border: 0px solid #ccc"></div></center></td>
      </tr>
    </table>
  </center>




