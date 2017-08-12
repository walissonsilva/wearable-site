<?php
	include_once("settings/settings.php");
	@session_start();

	$id = $_SESSION['id'];

	$query = "SELECT * FROM Paciente WHERE idusuario = $id";
  $result = mysqli_query($conecta, $query);
  $busca = mysqli_num_rows($result);
  $linha = mysqli_fetch_assoc($result);

  if ($busca > 0){
		$_SESSION['nome'] = $nome = $linha['nome'];
		$_SESSION['email'] = $email = $linha['email'];
		$_SESSION['peso'] = $peso = $linha['peso'];
		$_SESSION['altura'] = $altura = $linha['altura'];
  }

	if (!isset($_SESSION['email'])){
		header('Location: login.php');
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Editar Perfil</title>

		<!--Import Google Icon Font-->
	  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <!--Import materialize.css-->
	  <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
	  <!--<link type="text/css" rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css"  media="screen,projection"/>-->
	  <!--Let browser know website is optimized for mobile-->
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>

		<ul id="dropdown1" class="dropdown-content">
			<li><a href="patient-profile-edit.php">Perfil</a></li>
			<li class="divider"></li>
			<li><a href="logout.php">Sair</a></li>
		</ul>

		<nav>
			<div class="nav-wrapper">
				<a href="login.php" class="center brand-logo"><i class="material-icons">contacts</i>Health Notice</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a class="dropdown-button" href="#" data-activates="dropdown1"><i class="material-icons">menu</i></a></li>
				</ul>
			</div>
		</nav>

		<div class="container login-container" style="padding: 40px;">
    <div class="row">
      <form action="" method="POST" class="col l6 m6 s12 offset-m3 offset-l3">

        <div class="row">
          <div class="input-field">
            <input id="nome" value=<?php echo ($nome); ?> name="nome" type="text" class="validate" required>
            <label for="first_name">Nome</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <input value=<?php echo $email; ?> id="email" name="email" type="email" class="validate" required>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row" id="metrica-corporal">
          <div class="input-field col s6 m6 l6" id="altura">
            <input value=<?php echo substr($altura, strpos($altura, 'A', strlen($altura) - 7) + 1); ?> type="number" name="altura">
            <label for="altura">Altura (cm)</label>
          </div>
          <div class="input-field col s6 m6 l6" id="peso">
            <input value=<?php echo substr($peso, strpos($peso, 'P', strlen($peso) - 6) + 1); ?> type="number" name="peso">
            <label for="altura">Peso (kg)</label>
          </div>
        </div>
        <div class="row center" id="submit-button">
        	<div class="col m6">
        		<button class="btn waves-effect waves-light" type="submit" name="cancelar" formaction="home-client.php">
	          	<i class="material-icons left">cancel</i>Cancelar
	          </button>
        	</div>
        	<div class="col m6">
	          <button class="btn waves-effect waves-light" type="submit" name="atualizar">
	            Atualizar
	            <i class="material-icons right">send</i>
	          </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Verificando o login! -->
  <?php
    if (isset($_POST["atualizar"])){
      $novo_email = $_POST["email"];
      $novo_nome = $_POST["nome"];
      $nova_altura = $_POST['altura'];
      $novo_peso = $_POST['peso'];

      if(empty($novo_email) || empty($novo_peso) || empty($nova_altura) || empty($novo_nome)){
        echo "<script language='javascript' type='text/javascript'> alert('Você precisa preencher todos os campos!');</script>";
      } else {
        $query = "SELECT * FROM Paciente WHERE idusuario = $id";
        $result = mysqli_query($conecta, $query);
        $busca = mysqli_num_rows($result);
        $linha = mysqli_fetch_assoc($result);

        if ($busca > 0){
        	if ($nome != $novo_nome){
        		$query = "UPDATE Paciente SET Nome = '$novo_nome' WHERE idusuario = $id";
        		$result = mysqli_query($conecta, $query);
        	}

        	if ($email != $novo_email){
        		$query = "UPDATE Paciente SET email = '$novo_email' WHERE idusuario = $id";
        		$result = mysqli_query($conecta, $query);
        	}

        	if (substr($peso, strpos($peso, 'P', strlen($peso) - 6) + 1) != $novo_peso){
        		$novo_peso = $peso . 'D' . strval(intval(substr($peso, strpos($peso, 'D', strlen($peso) - 6) . 1, strpos($peso, 'P', strlen($peso) - 9))) + 1) . "P" . $novo_peso;
        		$peso = $novo_peso;
        		$query = "UPDATE Paciente SET peso = '$novo_peso' WHERE idusuario = $id";
        		$result = mysqli_query($conecta, $query);
        		//echo "<script language='javascript' type='text/javascript'> alert('Novo Peso!');</script>";
        		//echo $novo_peso;
        	}

        	if (substr($altura, strpos($altura, 'A', strlen($altura) - 7) + 1) != $nova_altura){
        		$nova_altura = $altura . 'D' . strval(intval(substr($altura, strpos($altura, 'D', strlen($altura) - 6) . 1, strpos($altura, 'A', strlen($altura) - 9))) + 1) . "A" . $nova_altura;
        		$altura = $nova_altura;
        		$query = "UPDATE Paciente SET altura = '$nova_altura' WHERE idusuario = $id";
        		$result = mysqli_query($conecta, $query);
        		//echo "<script language='javascript' type='text/javascript'> alert('Nova Altura!');</script>";
        		//echo $nova_altura;
        	}
        }
      }
    }
  ?>

		<!--Import jQuery before materialize.js-->
	  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	  <script type="text/javascript" src="js/bin/materialize.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
		<script type="text/javascript" src="js/myjs/atualizarGrafico.js"></script>
		<script src="//cdn.transifex.com/live.js"></script>
		<script>
			$(document).ready(function(){
		    $('.tooltipped').tooltip({delay: 100});
		  });

		  document.addEventListener('DOMContentLoaded',function() {
			  document.querySelector('input[name="altura"]').onchange=changeEventHandler;
			},false);

			function changeEventHandler(event) {
	    	Materialize.toast('Atualizado!', 3000, 'rounded')
			}
		</script>
	</body>
</html>