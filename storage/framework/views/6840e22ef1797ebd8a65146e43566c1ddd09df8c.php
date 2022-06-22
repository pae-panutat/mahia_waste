<script src="<?php echo e(asset('p/assets/js/ChartJs/Chart.js')); ?>"></script>

<?php if(!empty($ARR_kwhpv) && !empty($ARR_kwh) ): ?> 
<canvas id="canvas" width="600" height="230"></canvas>
<script>

    //var data_ARR_usedE_eachkwh = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
    var data_ARR_kwhpv = <?php echo e($ARR_kwhpv); ?> 
    var data_ARR_kwh = <?php echo e($ARR_kwh); ?> 



    var barChartData = {
        labels: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
        datasets: [{
            type: 'bar',
            label: 'kwh ปีก่อนหน้า',
            backgroundColor: "#ff9933",
            data: data_ARR_kwhpv
        },{
            type: 'bar',
            label: 'kwh ปีนี้',
            backgroundColor: "#04BFBF",
            data: data_ARR_kwh
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(255, 255, 255)',
                        borderSkipped: 'bottom'
                    }
                },
                tooltips: {
                        yAlign: 'bottom',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            },
                        },
                    backgroundColor: '#000000'
                    },
                responsive: true,
                title: {
                    display: true,
                    // text: 'ค่าใช้จ่ายพลังงานไฟฟ้า 12 เดือน'
                },
                    scales: {
                    yAxes: [{
                    ticks: {
                        beginAtZero: true} }],

                }

            }
        });


    };
</script>
<?php else: ?>
    <div align="center" style="font-family: 'Kanit', sans-serif; color:red;">ไม่มีข้อมูล</div>
<?php endif; ?>         