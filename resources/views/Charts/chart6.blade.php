    <script src="{{ asset('js/loader.js') }}"></script>
    <script type="text/javascript">

      // Load Charts and the corechart and barchart packages.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart and bar chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data_airkwh = {{ $airkwh }} 
        var data_elampkwh = {{ $elampkwh }} 
        var data_equipkwh = {{ $equipkwh }} 
        var data_otherkwh = {{ $otherkwh }}

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
    <p>สัดส่วนการใช้พลังงานไฟฟ้า : แต่ละมีเตอร์ ปี {{ $year }}</p>
    <table class="columns">
      <tr>
        <td><center><div id="piechart_div" style="border: 0px solid #ccc"></div></center></td>
      </tr>
    </table>
    <br>
    <form action="{{url('/chart6&'.$off_id.'&'.$year)}}">
      <label for="meter">เลือกมีเตอร์: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <select name="meter" id="meter">
        @foreach (DB::SELECT(DB::raw("SELECT * 
                FROM audit_cmu.audit_db 
                WHERE off_id = $off_id ")); as $db)                
        @foreach (DB::SELECT(DB::raw("SELECT id_meter 
                FROM $db->db_name.building_info
                WHERE off_id = $off_id AND year = $year ")); as $data)  
        <option value="{{ $data->id_meter }}"><?php echo "meter : ".$data->id_meter; ?></option>
        @endforeach
        @endforeach 
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" value="Submit">
    </form>   
  </center>








