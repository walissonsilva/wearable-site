<?php
  include_once("settings/settings.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - Health Notice</title>

  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css"  media="screen,projection"/>
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
      <a href="index.html" class="center brand-logo" class="brand-logo"><i class="material-icons">contacts</i>Health Notice</a>
    </div>
  </nav>
  <div class="container login-container">
    <div class="row">
      <form action="" method="POST" class="col l6 m6 s12 offset-m3 offset-l3">

        <div class="row">
          <div class="input-field">
            <input placeholder="João da Silva" id="nome" name="nome" type="text" class="validate" required>
            <label for="first_name">Nome</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <input placeholder="Apelido" id="apelido" name="apelido" type="text" class="validate" >
            <label for="apelido">Apelido</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <input placeholder="joaodasilva@email.com" id="email" name="email" type="email" class="validate" required>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <input placeholder="********" id="senha" name="senha" type="password" class="validate" required>
            <label for="password">Senha</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            <select id="tipo" name="tipo">
              <option value="" disabled selected>Selecione tipo de usuário</option>
              <option value="med">Médico</option>
              <option value="pac">Paciente</option>
            </select>
            <label>Tipo de Usuário</label>
          </div>
        </div>
        <div class="row" id="sexo">
          <div class="input-field col s6 m6 l6">
            <select name="sexo">
              <option value="" disabled selected>Selecione seu sexo</option>
              <option value="F">Feminino</option>
              <option value="M">Masculino</option>
            </select>
            <label>Sexo</label>
          </div>
          <div class="input-field col s6 m6 l6" id="nascimento">
            <input type="date" name="nascimento" class="datepicker">
            <label for="nascimento">Data de Nascimento</label>
          </div>
        </div>
        <div class="row" id="metrica-corporal">
          <div class="input-field col s6 m6 l6" id="altura">
            <input type="number" name="altura">
            <label for="altura">Altura (cm)</label>
          </div>
          <div class="input-field col s6 m6 l6" id="peso">
            <input type="number" name="peso">
            <label for="altura">Peso (kg)</label>
          </div>
        </div>
        <div class="row" id="cpf">
          <div class="input-field col offset-s3 offset-m3 offset-l3 s6 m6 l6">
            <input type="number" name="cpf">
            <label for="cpf">CPF</label>
          </div>
        </div>
        <div class="row" id="crm">
          <div class="input-field col offset-s3 offset-m3 offset-l3 s6 m6 l6">
            <input type="number" name="crm">
            <label for="crm">CRM</label>
          </div>
        </div>
        <div class="row" id="prompt">
          <div class="input-field col s12 m12 l12 center">
            <span>Escolha um tipo de usuário para realizar o cadastro.</span>
          </div>
        </div>
        <div class="row center" id="submit-button">
          <button class="btn waves-effect waves-light" type="submit" name="cadastrar">
            Cadastrar
            <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <?php
    if (isset($_POST["cadastrar"])){
      $nome = $_POST["nome"] or NULL;
      $email = $_POST['email'] or null;
      $login = $email;
      $tipo = $_POST['tipo'] or null;
      $senha = $_POST['senha'] or null;    // TODO Adicionar o MD5
      $sexo = $_POST['sexo'] or null;
      $peso = $_POST['peso'] or null;
      $altura = $_POST['altura'] or null;
      $nascimento = $_POST['nascimento'] or null;
      $cpf = $_POST['cpf'] or null;
      $crm = $_POST['crm'] or null;

      if(strlen($nascimento) == 10){
        $dia = substr($nascimento, 0, 2);
        $mes = substr($nascimento, 3, 2);
        $ano = substr($nascimento, 6, 4);
      } else {
        $dia = '01';
        $mes = '01';
        $ano = '1970';
      }

      var_dump($dia);
      var_dump($mes);
      var_dump($ano);

      if($tipo == "med"){
        $tabela = "Medico";
      } elseif($tipo == "pac") {
        $tabela = "Paciente";
      } else {
        die("Problema no tipo de usuário");
      }

      $sql = "SELECT * FROM $tabela WHERE email = '$login'";
      $resultado = mysqli_query($conecta, $sql);
      $row = mysqli_fetch_array($resultado);
      $logarray = $row['email'];

      if(empty($login) || $login == null){
        echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');</script>";
      } else {
        if($logarray == $login){
          echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');</script>";
          die();
        } else {
          $sql = "SELECT * FROM $tabela WHERE idusuario = (SELECT MAX(idusuario) FROM $tabela)";
          $resultado = mysqli_query($conecta, $sql);
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
            echo '<pre>' . var_dump($senha) . '</pre>';
            echo '<pre>' . var_dump($sexo) . '</pre>';
            echo '<pre>' . var_dump('$ano/$mes/$dia') . '</pre>';

            $peso = "D00P" . strval($peso);
            $altura = "D00A" . strval($altura);

            $sql = "INSERT INTO $tabela VALUES($proxid, '$cpf', '$altura', '$peso', '$nome', '$email', '$senha', '$sexo', '$ano/$mes/$dia')";

          } else {
            $sql = "INSERT INTO $tabela VALUES($proxid, '$crm', '$nome', '$email', '$senha')";
          }

          $insert = mysqli_query($conecta, $sql);
          if($insert){
            echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');</script>";
          } else {
            echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');</script>";
          }
        }
      }

      $sql = "SELECT * FROM $tabela WHERE nome = '$nome'";
      $resultado = mysqli_query($conecta, $sql) or die ("Erro na seleção da tabela.");

      //Caso consiga logar cria a sessão
      if (mysqli_num_rows($resultado) > 0) {
          // session_start inicia a sessão
          session_start();

          $linha = mysqli_fetch_assoc($resultado);

          if ($tabela == "Paciente"){
            echo "Consegui!";
            $_SESSION['id'] = $linha['idusuario'];
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['email'] = $linha['email'];
            $_SESSION['peso'] = $linha['peso'];
            $_SESSION['altura'] = $linha['altura'];
            $_SESSION['tipo'] = "paciente";
            echo "<script>location.href='home-client.php';</script>";
            exit;
          } elseif ($tabela == "Medico") {
            $_SESSION['id'] = $linha['idusuario'];
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['email'] = $linha['email'];
            $_SESSION['tipo'] = "medico";
            echo "<script>location.href='home-doctor.php';</script>";
            exit;
          }
      } else { // Caso contrário redireciona para a página de autenticação
          //Destrói
          session_destroy();

          // Limpa
          unset ($_SESSION['email']);
          unset ($_SESSION['senha']);

          // Redireciona para a página de autenticação
          header('Location: login.php');
          exit;
      }
    }
  ?>

  <footer class="page-footer white">
    <div class="footer-copyright">
      <div class="container grey-text text-darken-2">
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
  <script>
    $(document).ready(function() {
      $('select').material_select();
    });
    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 120, // Creates a dropdown of 15 years to control year
      monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
      weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
      weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
      today: '',
      clear: 'Limpar',
      close: 'Selecionar',
      labelMonthNext: 'Próximo',
      labelMonthPrev: 'Anterior',
      labelMonthSelect: 'Selecione o mês',
      labelYearSelect: 'Selecione o ano',
      format: 'dd/mm/yyyy',
      min: [1900,1,1],      // year, month, date
      max: [2016,9,2],      // year, month, date
    });
    var typeSelector = document.querySelector('#tipo');
    var type = typeSelector.options[typeSelector.selectedIndex].value;
    updateFieldsVisibility(type);
    typeSelector.onchange = function() {
      type  = typeSelector.options[typeSelector.selectedIndex].value;
      updateFieldsVisibility(type);
      cleanFields();
    }
    function cleanFields() {
      document.querySelector('#crm').value = null;
      document.querySelector('#cpf').value = null;
      document.querySelector('#altura').value = null;
      document.querySelector('#nascimento').value = null;
      document.querySelector('#sexo').value = null;
    }
    function updateFieldsVisibility(type) {
      if(type == 'med') {
        document.querySelector('#crm').style.visibility = "visible";
        document.querySelector('#crm').style.display = "block";
        document.querySelector('#cpf').style.visibility = "hidden";
        document.querySelector('#metrica-corporal').style.visibility = "hidden";
        document.querySelector('#nascimento').style.visibility = "hidden";
        document.querySelector('#sexo').style.visibility = "hidden";
        document.querySelector('#cpf').style.display = "none";
        document.querySelector('#metrica-corporal').style.display = "none";
        document.querySelector('#nascimento').style.display = "none";
        document.querySelector('#sexo').style.display = "none";
        document.querySelector('#submit-button').style.visibility = "visible";
        document.querySelector('#submit-button').style.display = "block";
        document.querySelector('#prompt').style.display = "none";
        document.querySelector('#prompt').style.visibility = "hidden";
      } else {
        if(type == 'pac') {
          document.querySelector('#crm').style.visibility = "hidden";
          document.querySelector('#cpf').style.visibility = "visible";
          document.querySelector('#metrica-corporal').style.visibility = "visible";
          document.querySelector('#nascimento').style.visibility = "visible";
          document.querySelector('#sexo').style.visibility = "visible";
          document.querySelector('#submit-button').style.visibility = "visible";
          document.querySelector('#crm').style.display = "none";
          document.querySelector('#cpf').style.display = "block";
          document.querySelector('#metrica-corporal').style.display = "block";
          document.querySelector('#nascimento').style.display = "block";
          document.querySelector('#sexo').style.display = "block";
          document.querySelector('#submit-button').style.display = "block";
          document.querySelector('#prompt').style.display = "none";
          document.querySelector('#prompt').style.visibility = "hidden";
        } else {
          document.querySelector('#crm').style.visibility = "hidden";
          document.querySelector('#cpf').style.visibility = "hidden";
          document.querySelector('#metrica-corporal').style.visibility = "hidden";
          document.querySelector('#nascimento').style.visibility = "hidden";
          document.querySelector('#sexo').style.visibility = "hidden";
          document.querySelector('#submit-button').style.visibility = "hidden";
          document.querySelector('#crm').style.display = "none";
          document.querySelector('#cpf').style.display = "none";
          document.querySelector('#metrica-corporal').style.display = "none";
          document.querySelector('#nascimento').style.display = "none";
          document.querySelector('#sexo').style.display = "none";
          document.querySelector('#submit-button').style.display = "none";
          document.querySelector('#prompt').style.display = "block";
          document.querySelector('#prompt').style.visibility = "visible";
        }
      }
    }
  </script>
</body>
</html>
