<?php
	// Dados do servidor
	$host = "localhost";
	$login = "root";
	$senha = "363256";
	$banco = "wearable";

	$conecta = mysqli_connect($host, $login, $senha, $banco) or print(mysql_error());

	// Verificação
	if (!$conecta){
		echo "Erro ao conectar com o servidor!";
	}
?>
