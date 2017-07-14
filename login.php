<?php
  include_once("settings/settings.php");
  @session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - Health Notice</title>

  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
  <!--<link type="text/css" rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css"  media="screen,projection"/>-->
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style media="screen">
    .login-container {
      margin-top: 40px;
    }
  </style>
</head>

<body>
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="center brand-logo" class="brand-logo"><i class="material-icons">contacts</i>Health Notice</a>
    </div>
  </nav>
  <div class="container login-container">
    <div class="row">
      <form action="" method="POST" class="col l6 m6 s12 offset-l3 offset-m3">
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix small">assignment_ind</i>
            <input name="login" id="login" type="email" class="validate">
            <label for="login">E-mail</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix small">https</i>
            <input name="senha" id="senha" type="password" class="validate">
            <label for="password">Senha</label>
          </div>
        </div>
        <div class="row center">
          <div class="col m6">
            <a href="cadastro.php">
              <button class="btn waves-effect waves-light" name="cadastro" id="cadastro">
                Cadastrar-se <i class="material-icons right">assignment</i>
              </button>
            </a>
          </div>

          <div class="col m6">
            <button class="btn waves-effect waves-light" type="submit" name="entrar">
              Entrar
              <i class="material-icons right">send</i>
            </button>
          </div>
      </form>
    </div>
    </div>
  </div>

  <!-- Verificando o login! -->
  <?php
    if (isset($_POST["entrar"])){
      $email = $_POST["login"];
      $senha = $_POST["senha"];

      if(empty($email) || empty($senha)){
        echo "<script language='javascript' type='text/javascript'> alert('Você precisa preencher todos os campos!');</script>";
      } else {
        $query = "SELECT * FROM Paciente WHERE email = '$email' AND senha = '$senha'";
        $result = mysql_query($query);
        $busca = mysql_num_rows($result);
        $linha = mysql_fetch_assoc($result);

        if ($busca > 0){
          $_SESSION['nome'] = $linha['nome'];
          $_SESSION['email'] = $linha['email'];
          header('Location: index.php');
          exit;
        } else {
          echo "<script language='javascript' type='text/javascript'> alert('Usuário ou senha inválido(s)!');</script>";
        }
      }
    }
  ?>

  <footer class="page-footer white">
    <div class="footer-copyright">
      <div class="container black-text text-darken-2">
        <div class="row">
          <div class="col m12" style="display:flex;align-content:center;align-items:center;justify-content:center">
            Health Notice&nbsp<span class="copy-left">©</span>&nbsp 2017.
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/bin/materialize.js"></script>
  <script type="text/javascript" src="js/myjs/login.js"></script>

</body>
</html>
