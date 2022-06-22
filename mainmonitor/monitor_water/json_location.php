<?php
error_reporting( error_reporting() & ~E_NOTICE );
include("db_connect.php");
 
// $sql =	"SELECT * From loccation_meter";

		// $query = mysqli_query($conn,$sql);
		// while ($row = mysqli_fetch_array($query)) {
		// 	$meter_config = $row['meter_config'];
			// echo $meter_config = $row['name_local'];

			$query2 = mysqli_query($conn,"SELECT meter_config, name_local, lat, lng, IdMeter, MAX(timeIn) as timeIn, SUM(VolumeflowVal) as new_Vol,
			IF(DATE(timeIn) = curdate() , 'ONLINE', 'OFFLINE') as status
			FROM loccation_meter LEFT join waterflow on loccation_meter.meter_config = waterflow.IdMeter 
			WHERE meter_config = IdMeter AND DATE(timeIn) = curdate() OR timeIn IN 
				( SELECT MAX(timeIn) FROM waterflow 
				WHERE IdMeter GROUP BY IdMeter )
			GROUP BY IdMeter");
			
    		while ($row2 = mysqli_fetch_array($query2)) {
						// echo $row2['IdMeter'];	
                        // echo $row2['name_local'];		
                        // echo "สูงสุด" . number_format($row2['new_Vol']*3600, 2);
                        $rs[] = $row2;
				}   
		// }	

// print_r($rs);
// echo "<BR>";
$arr = array();
foreach($rs as $read){
	$arr2 = array();
	$arr2["IdMeter"] = $read["IdMeter"];
	$arr2["name_local"] = $read["name_local"];
	$arr2["lat"] = $read["lat"];
	$arr2["lng"] = $read["lng"];
	$arr2["timeIn"] = $read["timeIn"];
	$arr2["status"] = $read["status"];

    if ($arr2["IdMeter"]==20){
	    $arr2["new_Vol"] = number_format($read["new_Vol"]*3600,2); 
    } else {
        $arr2["new_Vol"] = number_format($read["new_Vol"],2); 
    }

	array_push($arr,$arr2);
}

echo json_encode($arr);

mysqli_close($conn);

?>