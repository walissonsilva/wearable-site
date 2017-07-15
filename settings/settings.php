<?php
	// Dados do servidor
	$host = "localhost";
	$login = "root";
	$senha = "363256";
	$banco = "wearable";

	$conecta = mysql_connect($host, $login, $senha) or print(mysql_error());
	mysql_select_db($banco, $conecta) or print(mysql_query());

	// Verificação
	if (!mysql_connect($host, $login, $senha)){
		echo "Erro ao conectar com o servidor!";
	}
?>
