
<script src="<?php echo e(asset('p/assets/js/ChartJs/Chart.js')); ?>"></script>

<?php if(!empty($ARR_usedE_eachkwh)): ?>
    <canvas id="chart" width="600" height="280"></canvas>
    <script>

        //var data_ARR_usedE_eachkwh = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        let data_ARR_usedE_eachkwh = <?php echo e($ARR_usedE_eachkwh); ?>

        // console.log(data_ARR_usedE_eachkwh) 


        let canvas = document.getElementById("chart").getContext('2d'),
            gradient = canvas.createLinearGradient(0, 0, 0, 600);
            
            gradient.addColorStop(0, 'rgba(245, 57, 0, 0.74)');
            gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
            gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');
            
                //Chart.defaults.global.defaultFontFamily = 'Helvetica';
                //Chart.defaults.global.defaultFontSize = 12;
                //Chart.defaults.global.defaultFontColor = '#777'
                //chart.destroy();
            let myChart = new Chart(canvas, {
                    responsive: true,
                    type: 'line',
                    
                    data: {
                        labels: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
                        datasets: [
                            {
                            label: 'kWh', 
                            data: data_ARR_usedE_eachkwh,
                            fill: true,
                            lineTension: 0.3,
                            borderDash: [0, 0],
                            display: true,
                            backgroundColor: gradient,
                            pointBackgroundColor: '#f53900',
                            pointBorderColor: '#f53900',
                            pointBorderWidth: 2,
                            borderWidth: 2,
                            borderColor: '#f53900',
                            yAxisID: 'left-y-axis',
                            },
                        ]
                    },
            
                    options: {
                            // maintainAspectRatio: false,
                            // animation: false,
                            tooltips: {
                                mode: 'index',
                                yAlign: 'bottom',
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                    },
                                },
                            backgroundColor: '#000000'
                            },
                        legend: {
                            labels: {
                                fontColor: "#000000",
                                fontSize: 15
                            }
                        },
                    }
            }); 

    
    </script>
<?php else: ?>
    <div align="center" style="font-family: 'Kanit', sans-serif; color:red;">ไม่มีข้อมูลปี <?php echo e($year); ?></div>
<?php endif; ?>