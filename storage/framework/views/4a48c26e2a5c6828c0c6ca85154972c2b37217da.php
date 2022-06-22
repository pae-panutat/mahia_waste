<script src="<?php echo e(asset('js/loader.js')); ?>"></script>


<?php if(!empty($airkwh) && !empty($elampkwh) && !empty($equipkwh) && !empty($otherkwh) ): ?> 
<div align="center"class="googlechart" id="piechart_div" ></div>
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

    // console.log(data_airkwh)
    // console.log(data_elampkwh)
    // console.log(data_equipkwh)
    // console.log(data_otherkwh)

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'ประเภท');
    data.addColumn('number', 'kWh');
    data.addRows([
      ['เครื่องปรับอากาศ', data_airkwh],
      ['แสงสว่าง', data_elampkwh],
      ['อุปกรณ์ไฟฟ้า', data_equipkwh],
      ['อื่นๆ', data_otherkwh],
    ]);

    var piechart_options = {
            chartArea:{
                left:10,
                right:10, // !!! works !!!
                bottom:20,  // !!! works !!!
                top:20,
                width:"100%",
                height:"100%"
            },
                title:'',
                width: 550,
                height: 300,
                legend: { position: 'bottom' },
                colors: ['#4ECE77', '#49D8F8', '#EAB464', '#6883BA'],
                is3D: true,
    };

    var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
    piechart.draw(data, piechart_options);
   
  }

</script>

<?php else: ?>
    <div align="center" style="font-family: 'Kanit', sans-serif; color:red;">ไม่มีข้อมูลปี <?php echo e($year); ?></div>
<?php endif; ?>






