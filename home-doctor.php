<?php 
	include_once("settings/settings.php");
	@session_start();

	$id = $_SESSION['id'];
	$nome = $_SESSION['nome'];
	$email = $_SESSION['email'];

  if (!isset($_SESSION['email'])){
		header('Location: login.php');
		exit;
	}
?>


<!DOCTYPE html>
<html>
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">

			<!--Import Google Icon Font-->
		  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		  <!--Import materialize.css-->
		  <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
		  <link rel="stylesheet" href="css/meuCss.css">
		  <!--<link type="text/css" rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css"  media="screen,projection"/>-->
		  <!--Let browser know website is optimized for mobile-->
		  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

			<title>Health Notice</title>
		</head>


		<body>

		<nav>
			<div class="nav-wrapper">
				<a href="login.php" class="center brand-logo"><i class="material-icons">contacts</i>Health Notice</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="logout.php">Sair</a></li>
				</ul>
			</div>
		</nav>

		<h4 class="center-text" style="top: 20px;">Pacientes</h4>

		<!--<ul class="collection">
      <li class="collection-item center-text"><h5>Pacientes</h5></li>
    </ul>-->

		<ul class="collection">
		  <li class="collection-item avatar">
		    <i class="material-icons circle">person</i>
		    <span class="title">Title</span>
		    <p>First Line <br>
		       Second Line
		    </p>
		    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
		  </li>
		  <li class="collection-item avatar">
		    <i class="material-icons circle green">person</i>
		    <span class="title">Title</span>
		    <p>First Line <br>
		       Second Line
		    </p>
		    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
		  </li>
		  <li class="collection-item avatar">
		    <i class="material-icons circle red">person</i>
		    <span class="title">Title</span>
		    <p>First Line <br>
		       Second Line
		    </p>
		    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
		  </li>
		</ul>

		<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->
		<!--<script src="//cdn.transifex.com/live.js"></script>-->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <script type="text/javascript" src="js/bin/materialize.min.js"></script>
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
		<script type="text/javascript" src="js/myjs/functions.js"></script>
</html>
