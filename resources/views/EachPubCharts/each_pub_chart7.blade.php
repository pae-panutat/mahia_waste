<script src="{{ asset('jquery/2.1.1/jquery.min.js') }}"></script>
<script src="{{ asset('jquery/2.7.2/Chart.bundle.min.js') }}"></script>


<script type="text/javascript">
$(document).ready(function() {
  new Chart(document.getElementById("myChart").getContext("2d"), {
    type: "bar",
    data: {
      labels: ["2018", "2019"],
      datasets: [
        {
            backgroundColor: ["#673AB7", "#90A4AE"],
            fillColor: "#000000",
            data: [1, 4]
        },
        {
            backgroundColor: ["#E1BEE7", "#0D47A1"],
            data: [2, 5]
        },
        {
            backgroundColor: ["#BA68C8", "#455A64"],
            data: [3, 6]
        }
      ]
    },
      options: {
      legend: {
        display: false
      },
      scales: {
        xAxes:[{
          stacked: true
        }],
        yAxes:[{
          stacked: true
        }],
      }
    }
  });
});

</script>


<div class="panel-body">
    <canvas id="myChart"></canvas>
</div>
