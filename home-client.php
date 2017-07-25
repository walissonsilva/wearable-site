<?php
	include_once("settings/settings.php");
	@session_start();

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
		  <!--<link type="text/css" rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css"  media="screen,projection"/>-->
		  <!--Let browser know website is optimized for mobile-->
		  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

			<title>Health Notice</title>

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <!--<script type="text/javascript">
	      google.charts.load('current', {'packages':['corechart']});
	      google.charts.setOnLoadCallback(drawChart);

				// DOCUMENTAÇÃO >> https://developers.google.com/chart/interactive/docs/gallery/linechart

	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Year', 'Sales', 'Expenses'],
	          ['2004',  1000,      400],
	          ['2005',  1170,      460],
	          ['2006',  660,       1120],
	          ['2007',  1030,      540],
						['2008',  980,      620],
						['2009',  1002,     690],
						['2010',  1100,      470],
						['2011',  760,      840],
						['2012',  1030,      620]
	        ]);

	        var options = {
	          title: 'Company Performance',
	          curveType: 'none',
	          legend: { position: 'bottom' },
						backgroundColor: '#fff',//'#C9DAE6',
						colors: ['#DE0015', '#FFAE07'],
						lineWidth: 3
	        };

	        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

	        chart.draw(data, options);
	      }
	    </script>-->

			<script type="text/javascript" src="js/myjs/atualizarGrafico.js"></script>

			<script src="//cdn.transifex.com/live.js"></script>
		</head>


		<body>

		<nav>
			<div class="nav-wrapper">
				<a href="#" class="center brand-logo"><i class="material-icons">contacts</i>Health Notice</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="badges.html">Sobre</a></li>
					<li><a href="login.php">Login</a></li>
					<li><a href="logout.php">Sair</a></li>
				</ul>
			</div>
		</nav>


		<div class="row" style="margin-top: 20px;">
			<div class="col s12 m12">
				<div class="col s12 m3">
					<div class="card red darken-1">
						<div class="card-content white-text">
							<span class="card-title">Card Title</span>
							<p>I am a very simple card. I am good at containing small bits of information.
							I am convenient because I require little markup to use effectively.</p>
						</div>
						<div class="card-action">
							<a href="#" style="color: #ffb64b">This is a link</a>
							<a href="#" style="color: #ffb64b">This is a link</a>
						</div>
					</div>


	        <div class="card yellow darken-1">
	          <div class="card-content white-text">
	            <span class="card-title">Card Title</span>
	            <p>I am a very simple card. I am good at containing small bits of information.
	            I am convenient because I require little markup to use effectively.</p>
	          </div>
	          <div class="card-action">
	            <a href="#" style="color: #ffb64b">This is a link</a>
	            <a href="#" style="color: #ffb64b">This is a link</a>
	          </div>
	        </div>

				</div>

					<div class="card col s12 m6">
							<div class="card-image waves-effect waves-block waves-light">
								<div id="curve_chart" class="z-depth-2" style="height: 312px"></div>
								<span class="card-title"></span>
							</div>

							<div class="card-content">
					      <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
					      <p><a href="#">This is a link</a></p>
					    </div>

							<div class="card-reveal">
		            <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></i></span>
		            <p>Here is some more information about this product that is only revealed once clicked on.</p>
		          </div>
							<div class="card-action">
								<a href="#">This is a link</a>
							</div>
					</div>

					<div class="col s12 m3">
		        <div class="card blue darken-1">
		          <div class="card-content white-text">
		            <span class="card-title">Card Title</span>
		            <p>I am a very simple card. I am good at containing small bits of information.
		            I am convenient because I require little markup to use effectively.</p>
		          </div>
		          <div class="card-action">
		            <a href="#" style="color: #ffb64b">This is a link</a>
		            <a href="#" style="color: #ffb64b">This is a link</a>
		          </div>
		        </div>

		        <div class="card orange darken-1">
		          <div class="card-content white-text">
		            <span class="card-title">Card Title</span>
		            <p>I am a very simple card. I am good at containing small bits of information.
		            I am convenient because I require little markup to use effectively.</p>
		          </div>
		          <div class="card-action">
		            <a href="#" style="color: #ffb64b">This is a link</a>
		            <a href="#" style="color: #ffb64b">This is a link</a>
		          </div>
		        </div>

		      </div>

				</div>
    </div>


    <!--<div class="row">
      <div class="col s12 m2">
        <div class="card">
          <div class="card-image grey">
            <img style="width: 200px; height: 200px" src="http://www.blok.koty2.com/wp-content/uploads/icons/Tux-Avatar-129.png">
            <span class="card-title">Card Title</span>
          </div>
          <div class="card-content">
            <p>I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively.</p>
          </div>
          <div class="card-action">
            <a href="#">This is a link</a>
          </div>
        </div>
      </div>
    </div>-->

		<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bin/materialize.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>

		</body>
</html>
