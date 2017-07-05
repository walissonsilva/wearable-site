<?php
//http://www.melhorweb.com.br/artigo/18082-Sessao-session--para-login-em-PHP.htm

// session_start();

$nome = $_GET['nome'] ?? null;
$email = $_GET['email'] ?? null;
$login = $email;
$tipo = $_GET['tipo'] ?? null;
$senha = $_GET['password'] ?? null;    // TODO Adicionar o MD5
$sexo = $_GET['sexo'] ?? null;
$peso = $_GET['peso'] ?? null;
$altura = $_GET['altura'] ?? null;
$nascimento = $_GET['nascimento'] ?? null;
$cpf = $_GET['cpf'] ?? null;
$crm = $_GET['crm'] ?? null;

if(strlen($nascimento) == 10){
  $dia = substr($nascimento, 0, 2);
  $mes = substr($nascimento, 3, 2);
  $ano = substr($nascimento, 6, 4);
} else {
  // Easter egg das gambi
  $dia = '01';
  $mes = '01';
  $ano = '1970';
}

var_dump($dia);
var_dump($mes);
var_dump($ano);

//Conexão mysql
$servername = "localhost";
$username = "root";
$password = "abc123";
$dbname = "BANCOSUPERVISORIO";
$portnumber = "3306";

$conexao = new mysqli($servername, $username, $password, $dbname , $portnumber) or die("Erro de conexão.");

// Checa conexão
if ($conexao->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//Seleciona o banco de dados
// $selecionabd = mysql_select_db($database,$conexao)
//             or die ("Banco de dados inexistente.");

if($tipo == "med"){
  $tabela = "Medico";
} elseif($tipo == "pac") {
  $tabela = "Paciente";
} else {
  die("Problema no tipo de usuário");
}

$sql = "SELECT * FROM $tabela WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql);
$row = mysqli_fetch_array($resultado);
$logarray = $row['email'];

if($email == "" || $email == null){
  // Redundancia, isso também é verificado no HTML
  echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='cadastro.html';</script>";
} else {
  if($logarray == $login){
    echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location.href='cadastro.html';</script>";
    die();
  } else {

    $sql = "SELECT * FROM $tabela WHERE idusuario = (SELECT MAX(idusuario) FROM $tabela)";
    $resultado = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_array($resultado);
    $proxid = $row['idusuario'];

    if ($proxid == null || $proxid == '') {
      $proxid = 1;
    } else {
      $proxid++;
    }
    // var_dump($proxid);
    if($tabela == "Paciente"){
      echo '<pre>' . var_dump($proxid) . '</pre>';
      echo '<pre>' . var_dump($cpf) . '</pre>';
      echo '<pre>' . var_dump($altura) . '</pre>';
      echo '<pre>' . var_dump($peso) . '</pre>';
      echo '<pre>' . var_dump($nome) . '</pre>';
      echo '<pre>' . var_dump($email) . '</pre>';
      echo '<pre>' . var_dump($password) . '</pre>';
      echo '<pre>' . var_dump($sexo) . '</pre>';
      echo '<pre>' . var_dump('$ano/$mes/$dia') . '</pre>';

      $sql = "INSERT INTO $tabela VALUES($proxid, '$cpf', $altura, $peso, '$nome', '$email', '$senha', '$sexo', '$ano/$mes/$dia')";

    } else {
      $sql = "INSERT INTO $tabela VALUES($proxid, '$crm', '$nome', '$email', '$senha')";
    }

    $insert = mysqli_query($conexao,$sql);
    if($insert){
      echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='login.html'</script>";
    } else {
      echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='cadastro.html'</script>";
    }
  }
}

$resultado = mysql_query($sql,$conexao) or die ("Erro na seleção da tabela.");

//Caso consiga logar cria a sessão
if (mysql_num_rows ($resultado) > 0) {
    // session_start inicia a sessão
    session_start();

    $_SESSION['login'] = $login;
    $_SESSION['password'] = $senha;
}

//Caso contrário redireciona para a página de autenticação
else {
    //Destrói
    session_destroy();

    //Limpa
    unset ($_SESSION['login']);
    unset ($_SESSION['password']);

    //Redireciona para a página de autenticação
    header('location:login.php');

}

/*
// COLOCAR ESTE CÓDIGO EM TODAS AS PÁGINAS QUE PRECISAM ESTAR AUTENTICADAS
<?PHP
session_start();

//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if ( !isset($_SESSION['login']) and !isset($_SESSION['password']) ) {
    //Destrói
    session_destroy();

    //Limpa
    unset ($_SESSION['login']);
    unset ($_SESSION['password']);

    //Redireciona para a página de autenticação
    header('location:login.php');
}
?>

*/

?>
