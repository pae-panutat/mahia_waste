
<script src="{{ asset('p/assets/js/ChartJs/Chart.js') }}"></script>

@if (!empty($ARR_kwhpv) && !empty($ARR_kwh) ) 
    <canvas id="chart" width="600" height="280"></canvas>
    <script>

        //var data_ARR_usedE_eachkwh = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        let data_ARR_kwhpv = {{ $ARR_kwhpv}}
        let data_ARR_kwh = {{ $ARR_kwh}} 
        // console.log(data_ARR_usedE_eachkwh) 


        let canvas = document.getElementById("chart").getContext('2d'),
            gradient = canvas.createLinearGradient(0, 0, 0, 600);
            
            gradient.addColorStop(0, 'rgba(57, 0, 230, 0.78)');
            gradient.addColorStop(0.5, 'rgba(98, 0, 255, 0.58)');
            gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');

            gradient2 = canvas.createLinearGradient(0, 0, 0, 600);
            gradient2.addColorStop(0, 'rgba(0, 208, 245, 0.74)');
            gradient2.addColorStop(0.5, 'rgba(0, 238, 255, 0.25)');
            gradient2.addColorStop(1, 'rgba(255, 0, 0, 0)');
            
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
                            label: 'kwh ปีก่อนหน้า', 
                            data: data_ARR_kwhpv,
                            fill: true,
                            lineTension: 0.3,
                            borderDash: [0, 0],
                            display: true,
                            backgroundColor: gradient,
                            pointBackgroundColor: '#6200ff',
                            pointBorderColor: '#6200ff',
                            pointBorderWidth: 2,
                            borderWidth: 2,
                            borderColor: '#6200ff',
                            yAxisID: 'left-y-axis',
                            },

                            {
                            label: 'kwh ปีนี้', 
                            data: data_ARR_kwh,
                            fill: true,
                            lineTension: 0.3,
                            borderDash: [0, 0],
                            display: true,
                            backgroundColor: gradient2,
                            pointBackgroundColor: '#00d0f5',
                            pointBorderColor: '#00d0f5',
                            pointBorderWidth: 2,
                            borderWidth: 2,
                            borderColor: '#00d0f5',
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
@else
    <div align="center" style="font-family: 'Kanit', sans-serif; color:red;">ไม่มีข้อมูล</div>
@endif