<script src="{{ asset('js/Chart.bundle.js') }}"></script>
<script>

    //var data_ARR_usedE_eachkwh = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
    var data_ARR_kwhpv = {{ $ARR_kwhpv}} 
    var data_ARR_kwh = {{ $ARR_kwh}} 



    var barChartData = {
        labels: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
        datasets: [{
            type: 'bar',
            label: 'kwh_ปีก่อนหน้า',
            backgroundColor: "#ff9933",
            data: data_ARR_kwhpv
        },{
            type: 'bar',
            label: 'kwh_ปีนี้',
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
                responsive: true,
                title: {
                    display: true,
                    text: 'ค่าใช้จ่ายพลังงานไฟฟ้า 12 เดือน'
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