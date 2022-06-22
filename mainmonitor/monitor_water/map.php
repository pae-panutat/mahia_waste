<title>METER</title>

<!-- Bootstrap core CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
	@import url('https://fonts.googleapis.com/css2?family=Kanit:wght@400;600&display=swap');

	div * {
		font-family: 'Kanit', sans-serif;
	}

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

</style>

<script>
    var styles = [
    {
        "featureType": "road",
        "stylers": [
            {
                "hue": "#5e00ff"
            },
            {
                "saturation": -79
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "saturation": -78
            },
            {
                "hue": "#6600ff"
            },
            {
                "lightness": -47
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "lightness": 22
            }
        ]
    },
    {
        "featureType": "landscape",
        "stylers": [
            {
                "hue": "#6600ff"
            },
            {
                "saturation": -11
            }
        ]
    },
    {},
    {},
    {
        "featureType": "water",
        "stylers": [
            {
                "saturation": -65
            },
            {
                "hue": "#1900ff"
            },
            {
                "lightness": 8
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "weight": 1.3
            },
            {
                "lightness": 30
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "visibility": "simplified"
            },
            {
                "hue": "#5e00ff"
            },
            {
                "saturation": -16
            }
        ]
    },
    {
        "featureType": "transit.line",
        "stylers": [
            {
                "saturation": -72
            }
        ]
    },
    {}
]
</script>

<script language="JavaScript">
var map,infowindow,mIcon;
function initMap() { 
	var myOptions = {
	  zoom: 17,
	  center: new google.maps.LatLng(18.803535629803218, 98.95209518731684),
	  //mapTypeId:google.maps.MapTypeId.SATELLITE
      //mapTypeId:google.maps.MapTypeId.HYBRID
      styles: styles
	};

    		mIcon = {
                path: google.maps.SymbolPath.CIRCLE,
				fillColor: "green",
    			fillOpacity: 0.8,
                strokeOpacity: 0.5,
                strokeWeight: 6,
                strokeColor: '#1b7709',
                scale: 30
            };

			mIcon2 = {
                path: google.maps.SymbolPath.CIRCLE,
				fillColor: "red",
    			fillOpacity: 0.8,
                strokeOpacity: 0.5,
                strokeWeight: 6,
                strokeColor: '#ba0d0d',
                scale: 30
            };
            
	 map = new google.maps.Map(document.getElementById('map_canvas'),
		myOptions);


	 infowindow = new google.maps.InfoWindow({
		map:map,
	});



	selectLocation();
}


// var icons = {
// 		0:{
// 			icon: 'icon/gen.png'
// 		},
// 		1:{
// 			icon: 'icon/water_pump.png'
// 		},
// 		2:{
// 			icon: 'icon/fan.png'
// 		},
// 		3:{
// 			icon: 'icon/temp.png'
// 		},
// 		4:{
// 			icon: 'icon/ammonia.png'
// 		}


// };

function showDetail(id){
	$("#IdMeter").val(json[id].IdMeter);
	$("#lat").val(json[id].lat);
	$("#lng").val(json[id].lng);
	$("#name_local").val(json[id].name_local);
	$("#new_Vol").val(json[id].new_Vol);
	$("#timeIn").val(json[id].timeIn);
	$("#status").val(json[id].status);
}

var json;
function selectLocation(){
	$.ajax({
		type:"POST",
		url: "json_location.php",
		
	}).done(function(text){
		// console.log(text);
		json = $.parseJSON(text);
		for(var i = 0 ;i<json.length;i++){
			var lat = json[i].lat;
			var lng = json[i].lng;
			var IdMeter =  json[i].IdMeter;
			var name_local =  json[i].name_local;
			var new_Vol =  json[i].new_Vol;
			var timeIn =  json[i].timeIn;
			var status =  json[i].status;

			var latlng = new google.maps.LatLng(lat,lng);
			console.log(status)
			var id = i;
				if (status == "ONLINE") {
					var makeroption = {
					map:map,
					html:id,
					position:latlng,
					icon: mIcon,
					label: {color: '#FFF', fontSize: '14px', fontWeight: '600', text: json[i].new_Vol},
					title: json[i].new_Vol,
					//animation: google.maps.Animation.DROP
					// icon: icons[type].icon
					//console.log();
					//position:new google.maps.LatLng(lat,lng),
					// icon: json[i].location_type
					};
				// console.log(status)
				var marker = new google.maps.Marker(makeroption);
				google.maps.event.addListener(marker,'click',function(e){
					infowindow.setContent('<div align="left" style="font-size: 20px">' + 
					'<B> <span style="color:green;">'+ (json[this.html].name_local +'</span> </B>' +
					'<br>' + 'วันที่-เวลา: <B> <span style="color:green;">' + (json[this.html].timeIn  + '</span> </B>' +
					'<br>Volume Flow Today:&nbsp' + '<B> <span style="color:green;">'+ (json[this.html].new_Vol +
					'&nbsp m3/h </span></B>' + 
					'<br>สถานะ:&nbsp' + '<B> <span style="color:green; font-size: 15px">'+ (json[this.html].status +
					'&nbsp</span></B>' + 
					'</B></div>' )))));

					infowindow.open(map,this);
					showDetail(this.html);
				});
			} else if (status == "OFFLINE") {
				var makeroption = {
					map:map,
					html:id,
					position:latlng,
					icon: mIcon2,
					label: {color: '#FFF', fontSize: '14px', fontWeight: '600', text: json[i].new_Vol},
					title: json[i].new_Vol,
					};
				// console.log(status)
				var marker = new google.maps.Marker(makeroption);
				google.maps.event.addListener(marker,'click',function(e){
					infowindow.setContent('<div align="left" style="font-size: 20px">' + 
					'<B> <span style="color:red;">'+ (json[this.html].name_local +'</span> </B>' +
					'<br>' + 'วันที่-เวลา: <B> <span style="color:red;">' + (json[this.html].timeIn  + '</span> </B>' +
					'<br>Volume Flow Today:&nbsp' + '<B> <span style="color:red; font-size: 15px"">'+ (json[this.html].new_Vol +'&nbspm3/h </span></B>' +
					'<br>สถานะ:&nbsp' + '<B> <span style="color:red;">'+ (json[this.html].status +
					'&nbsp</span></B>' + 
					'</B></div>' )))));

					infowindow.open(map,this);
					showDetail(this.html);
				});

			}
			
		}
	});
}
</script>
</head>
<body>
	<div >
	
		<!--<div class="col-10">
		<div id="map_canvas" style="width:100%;height:88vh"></div>-->
		<div id="map_canvas" style="width:100%;height:100%"></div>
		<!--</div>-->

		<!--<div class="col-2">
		<div style="margin-top:10px; margin-right:20px">
					<form>		
						<div class="form-group">
						  <label for="location_name">Meter</label>
						  <input type="text" class="form-control" id="location_name" placeholder="">
						</div>
						<div class="form-group">
								<label for="lat">ละติจูด</label>
								<input type="text" class="form-control" id="lat" placeholder="">
						</div>
						<div class="form-group">
							<label for="Lng">ลองจิจูด</label>
							<input type="text" class="form-control" id="lng" placeholder="">
						</div>
						<div class="form-group">
						  <label for="time_date">Date-Time</label>
						  <input type="text" class="form-control" id="time_date" placeholder="">
						</div>
						<div class="form-group">
								<label for="heat">Location_detail</label>
								<input type="text" class="form-control" id="location_detail" placeholder="">
						</div>
						<div class="form-group">
								<label for="heat">Current (A)</label>
								<input type="text" class="form-control" id="current" placeholder="">
						</div>
						<div class="form-group">
								<label for="heat">Voltage (V)</label>
								<input type="text" class="form-control" id="voltage" placeholder="">
						</div>
						<div class="form-group">
								<label for="heat">Power (kW)</label>
								<input type="text" class="form-control" id="power_k" placeholder="">
						</div>
						<div class="form-group">
						  <label for="cool">Temperature (C)</label>
						  <input type="text" class="form-control" id="cool" placeholder="">
						</div>
						<div class="form-group">
								<label for="heat">Humidity (%)</label>
								<input type="text" class="form-control" id="heat" placeholder="">
						</div>
						<div class="form-group">
								<label for="heat">Total_Energy (kWh)</label>
								<input type="text" class="form-control" id="sumtotal_energy" placeholder="">
						</div>
			</form>
		</div>-->
		
		<!--<section class="content-header">
      <h1>
			กราฟการใช้พลังงาน
			<div class="small-box bg-yellow">
            <div class="inner">
              <h3>150 kWh</h3>

              <p></p>
            </div>
          </div>
        
      </h1>
     
    </section>-->
		</div>

	</div>

	</body>
	</html>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANpUFSuCVpHCvDU4uOFhYmNqchf8NU2Xg&callback=initMap" type="text/javascript"></script>