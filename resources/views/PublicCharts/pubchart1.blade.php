<script src="{{ asset('js/Chart.js') }}"></script>
<body>

<center><canvas id="myChart" style="width:100%;max-width:600px"></canvas></center>

<script>

    
//var year = {{ $year }} 
var data_AirConPerYear = {{ $SumAirConPerYear }} 
var data_EquipPerYear = {{ $SumEquipPerYear }} 
var data_ElampPerYear = {{ $SumElampPerYear }}
var data_OtherPerYear = {{ $SumOtherPerYear }}

var xValues = ["Air Condition", "Electrical Equipment", "Lighting", "Other"];
var yValues = [data_AirConPerYear, data_EquipPerYear, data_ElampPerYear, data_OtherPerYear];
var barColors = [
  "#F08080",
  "#76D7C4",
  "#6495ED",
  "#FFBF00"
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "สัดส่วนการใช้พลังงานในระบบ (kWh/y) ปี <?php echo $year ?>"
    }
  }
});
</script>

