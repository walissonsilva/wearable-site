<?php 
	include_once "../settings/settings.php";

	@session_start();

	$query = "SELECT * FROM Paciente";
  $result = mysqli_query($conecta, $query);
  $busca = mysqli_num_rows($result);

  $jsonArray = array();
  
  if ($busca > 0){
  	while ($linha = mysqli_fetch_assoc($result)){
  		$nome = $linha['nome'];
  		$id = $linha['idusuario'];

  		$jsonArrayItem = array();
			$jsonArrayItem['nome'] = $nome;
			$jsonArrayItem['idusuario'] = $id;

			array_push($jsonArray, $jsonArrayItem);
		}
  }

  echo json_encode($jsonArray);

 	/*
	try {
		// Tomar os JSON's do paciente id
		$query = "SELECT * FROM Json WHERE id_paciente = {$id}";
	  $result = mysqli_query($conecta, $query);
	  $busca = mysqli_num_rows($result);
	  $linha = mysqli_fetch_assoc($result);
	  
	  if ($busca > 0){
	  	$freq_json = json_decode(file_get_contents($linha['freq']));
	  }

	  // Observar se os valores lidos no JSON já existem no Banco de Dados
		for ($i = 0; $i < 50; $i++){
			$time = $freq_json->feeds[$i]->created_at;
		  $value = $freq_json->feeds[$i]->field1;
			$query = "SELECT * FROM Freq WHERE created_at = '{$time}' AND id_paciente = {$id}";
		  $result = mysqli_query($conecta, $query);
		  $busca = mysqli_num_rows($result);
		  $linha = mysqli_fetch_assoc($result);

		  if ($busca > 0){
		  	echo '';
		  } else {
		  	$time = $freq_json->feeds[$i]->created_at;
		  	$value = $freq_json->feeds[$i]->field1;
		  	if ($value != null){
		  		$query = "INSERT INTO Freq (id_paciente, created_at, freq) VALUES ($id, '{$time}', {$value})";
		  		$result = mysqli_query($conecta, $query);
		  	}
		  }
		}
	} catch (Exception $e) {
		echo '';
	}

	$query = "SELECT * FROM Freq WHERE id_paciente = $id";
	$result = mysqli_query($conecta, $query);
	$busca = mysqli_num_rows($result);

	$jsonArray = array();

	if ($busca > 0){
		while($row = mysqli_fetch_assoc($result)){
			$jsonArrayItem = array();
			$jsonArrayItem['id_paciente'] = $id;
			$jsonArrayItem['created_at'] = $row['created_at'];
			$jsonArrayItem['freq'] = $row['freq'];

			array_push($jsonArray, $jsonArrayItem);
		}
	}

	echo json_encode($jsonArray);*/
 ?>