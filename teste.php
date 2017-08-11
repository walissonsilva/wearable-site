<?php 
	include_once "settings/settings.php";

	$json = file_get_contents('https://api.thingspeak.com/channels/306028/fields/1.json?api_key=DTWASHAB2FDWY6HC&results=8');
	$obj = json_decode($json);

	for ($i = 0; $i < 8; $i++){
		$time = $obj->feeds[$i]->created_at;
	  $value = $obj->feeds[$i]->field1;
		$query = "SELECT * FROM Data WHERE created_at = '{$time}'";
	  $result = mysqli_query($conecta, $query);
	  $busca = mysqli_num_rows($result);
	  $linha = mysqli_fetch_assoc($result);

	  if ($busca > 0){
	  	echo '';
	  } else {
	  	$time = $obj->feeds[$i]->created_at;
	  	$value = $obj->feeds[$i]->field1;
	  	$query = "INSERT INTO Data (created_at, freq) VALUES ('{$time}', {$value})";
	  	$result = mysqli_query($conecta, $query);
	  }
	}

	$query = "SELECT * FROM Data";
	$result = mysqli_query($conecta, $query);
	$busca = mysqli_num_rows($result);

	$jsonArray = array();

	if ($busca > 0){
		while($row = mysqli_fetch_assoc($result)){
			$jsonArrayItem = array();
			$jsonArrayItem['created_at'] = $row['created_at'];
			$jsonArrayItem['freq'] = $row['freq'];

			array_push($jsonArray, $jsonArrayItem);
		}
	}

	echo json_encode($jsonArray);
 ?>