<?php

session_start();
$login = $_GET['login'] ?? null;
$password = $_GET['password'] ?? null;

// connection to db
$servername = "localhost";
$username = "root";
$password = "abc123";
$dbname = "BANCOSUPERVISORIO";
$portnumber = "3306";

//Conexão mysql
$conexao = new mysqli($servername, $username, $password, $dbname, $portnumber) or die("Erro de conexão.");

// Check connection
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}
//echo "Connected successfully";

// //Seleciona o banco de dados
// $selecionabd = mysql_select_db($database,$conexao)
//             or die ("Banco de dados inexistente.");

// Verifica no cadastro de médicos
$sql = "SELECT * FROM Paciente WHERE email = '$login'";

$resultado = mysqli_query($conexao, $sql) or die ("Erro na seleção da tabela 1.");
$row = mysqli_fetch_array($resultado);

if ($row == NULL) {
  // Verifica no cadastro de pacientes
  $sql = "SELECT *
  FROM Medico
  WHERE email = '$login'";
  $resultado = mysqli_query($conexao, $sql) or die ("Erro na seleção da tabela 2.");
  $row = mysqli_fetch_array($resultado);
}

//Caso consiga logar cria a sessão
if ($row != NULL) {
    // session_start inicia a sessão
    session_start();

    $_SESSION['login'] = $login;

    header('Location: http://localhost:8080/aula/supervisorio-biomedico/main.php');
}

//Caso contrário redireciona para a página de autenticação
else {

    var_dump('login');
    //Destrói
    session_destroy();

    //Limpa
    unset ($_SESSION['login']);

    //Redireciona para a página de autenticação
    header('location:login.html');


}

?>
