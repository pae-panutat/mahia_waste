<script src="<?php echo e(asset('js/Chart.bundle.js')); ?>"></script>
<script>

    //var data_ARR_usedE_eachkwh = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
    var data_ARR_usedE_eachkwh = <?php echo e($ARR_usedE_eachkwh); ?> 



    var barChartData = {
        labels: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
        datasets: [{
            type: 'bar',
            label: 'kWh',
            backgroundColor: "#4D5AAE",
            data: data_ARR_usedE_eachkwh
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
                responsive: true,
                title: {
                    display: true,
                    text: 'ปริมาณการใช้พลังงานไฟฟ้า 12 เดือน'
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

                <div class="panel-body">
                    <canvas id="canvas"></canvas>
                </div>