<?php
	include_once("settings/settings.php");
	@session_start();

	$id = $_SESSION['id'];
	$nome = $_SESSION['nome'];
	$email = $_SESSION['email'];
	$peso = $_SESSION['peso'];
	$altura = $_SESSION['altura'];

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

		<ul id="dropdown1" class="dropdown-content">
			<li><a href="patient-profile-edit.php">Perfil</a></li>
			<li class="divider"></li>
			<li><a href="logout.php">Sair</a></li>
		</ul>

		<nav class="nav-extended">
			<div class="nav-wrapper">
				<a href="login.php" class="center brand-logo"><i class="material-icons">contacts</i>Health Notice</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a class="dropdown-button" href="login.php" data-activates="dropdown1"><i class="material-icons">menu</i></a></li>
				</ul>
			</div>

			<div class="nav-content">
				<ul class="tabs tabs-fixed-width tabs-transparent">
					<li class="tab"><a href="#heart_rate">Frequência Cardíaca</a></li>
					<li class="tab"><a href="#temperature">Temperatura</a></li>
					<li class="tab"><a href="#passos">Passos</a></li>
					<li class="tab"><a href="#imc">IMC</a></li>
				</ul>
			</div>
		</nav>


		<!-- ################## FREQUÊNCIA CARDÍACA ########################## -->
		<div id="heart_rate" class="row" style="margin-top: 5px;">
			<div class="col s12 m12">
				<div class="col s12 m3">
					<div class="card red darken-1">
						<div class="card-content white-text">
							<span class="card-title">Valor Máximo</span>
							<div id="card_freq01">
								<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-blue-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								 </div>
							</div>
						</div>
					</div>


	        <div class="card yellow darken-1">
	          <div class="card-content white-text">
	            <span class="card-title">Última Leitura</span>
	            <div id="card_freq02">
	            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-red-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								 </div>
	            </div>
	          </div>
	        </div>

				</div>

					<div class="card col s12 m6">
							<div class="card-image waves-effect waves-block waves-light">
								<div id="freq_preload" style="height: 312px;">
									<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-blue">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-red">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-yellow">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-green">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>
								  </div>
								</div>
								<span class="card-title"></span>
							</div>

							<div class="card-content">
					      <span class="card-title activator grey-text text-darken-4">Frequência Cardíaca<i class="material-icons right">more_vert</i></span>
					      <p><a href="#">This is a link</a></p>
					    </div>

							<div class="card-reveal">
		            <span class="card-title grey-text text-darken-4">Frequência Cardíaca<i class="material-icons right">close</i></i></span>
		            <p>Veja na Tabela abaixo mais detalhes das leituras realizadas.</p>
		            <table class="striped">
		            	<thead><tr><th>Data</th><th>Hora</th><th>Leitura (BPM)</th></tr></thead>
		            	<tbody id="tab-freq"></tbody>
		            </table>
		          </div>
							<div class="card-action">
								<a href="#">This is a link</a>
							</div>
					</div>

					<div class="col s12 m3">
		        <div class="card blue darken-1">
		          <div class="card-content white-text">
		            <span class="card-title">Valor Médio</span>
		            <div id="card_freq03">
		            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-yellow-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								  </div>
		            </div>
		          </div>
		        </div>

		        <div class="card orange darken-1">
		          <div class="card-content white-text">
		            <span class="card-title">Card Title</span>
		            <div id="card_freq04">
		            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-green-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								 </div>
		            </div>
		          </div>
		          <div class="card-action">
		            <a href="#" style="color: #ffb64b">This is a link</a>
		            <a href="#" style="color: #ffb64b">This is a link</a>
		          </div>
		        </div>

		      </div>

				</div>
    </div>



    <!-- ################## TEMPERATURA ########################## -->

    <div id="temperature" class="row" style="margin-top: 5px;">
    	<div class="col s12 m12">
				<div class="col s12 m3">
					<div class="card red darken-1">
						<div class="card-content white-text">
							<span class="card-title">Valor Máximo</span>
							<div id="card_temp01">
								<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-blue-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								 </div>
							</div>
						</div>
					</div>


	        <div class="card yellow darken-1">
	          <div class="card-content white-text">
	            <span class="card-title">Última Leitura</span>
	            <div id="card_temp02">
	            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-red-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								 </div>
	            </div>
	          </div>
	        </div>

				</div>

					<div class="card col s12 m6">
							<div class="card-image waves-effect waves-block waves-light">
								<div id="temp_preload" style="height: 312px;">
									<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-blue">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-red">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-yellow">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-green">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>
								  </div>
								</div>
								<span class="card-title"></span>
							</div>

							<div class="card-content">
					      <span class="card-title activator grey-text text-darken-4">Temperatura Corporal<i class="material-icons right">more_vert</i></span>
					      <p><a href="#">This is a link</a></p>
					    </div>

							<div class="card-reveal">
		            <span class="card-title grey-text text-darken-4">Temperatura Corporal<i class="material-icons right">close</i></i></span>
		            <p>Veja na Tabela abaixo mais detalhes das leituras realizadas.</p>
		            <table class="striped">
		            	<thead><tr><th>Data</th><th>Hora</th><th>Leitura (°C)</th></tr></thead>
		            	<tbody id="tab-temp"></tbody>
		            </table>
		          </div>
							<div class="card-action">
								<a href="#">This is a link</a>
							</div>
					</div>

					<div class="col s12 m3">
		        <div class="card blue darken-1">
		          <div class="card-content white-text">
		            <span class="card-title">Valor Médio</span>
		            <div id="card_temp03">
		            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-yellow-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								  </div>
		            </div>
		          </div>
		        </div>

		        <div class="card orange darken-1">
		          <div class="card-content white-text">
		            <span class="card-title">Card Title</span>
		            <div id="card_temp04">
		            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
								    <div class="spinner-layer spinner-green-only">
								      <div class="circle-clipper left">
								        <div class="circle"></div>
								      </div><div class="gap-patch">
								        <div class="circle"></div>
								      </div><div class="circle-clipper right">
								        <div class="circle"></div>
								      </div>
								    </div>
								 </div>
		            </div>
		          </div>
		          <div class="card-action">
		            <a href="#" style="color: #ffb64b">This is a link</a>
		            <a href="#" style="color: #ffb64b">This is a link</a>
		          </div>
		        </div>

		      </div>

				</div>
    </div>


		<!-- ################## PASSOS ########################## -->
		<div id="passos" style="padding: 5px;">
			<div class="row">
				<div class="card col s12 m9">
					<div class="card-image waves-effect waves-block waves-light">
						<canvas id="chart_passos">
							<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
						    <div class="spinner-layer spinner-blue">
					        <div class="circle-clipper left">
					          <div class="circle"></div>
					        </div><div class="gap-patch">
					          <div class="circle"></div>
					        </div><div class="circle-clipper right">
					          <div class="circle"></div>
					        </div>
					      </div>

					      <div class="spinner-layer spinner-red">
					        <div class="circle-clipper left">
					          <div class="circle"></div>
					        </div><div class="gap-patch">
					          <div class="circle"></div>
					        </div><div class="circle-clipper right">
					          <div class="circle"></div>
					        </div>
					      </div>

					      <div class="spinner-layer spinner-yellow">
					        <div class="circle-clipper left">
					          <div class="circle"></div>
					        </div><div class="gap-patch">
					          <div class="circle"></div>
					        </div><div class="circle-clipper right">
					          <div class="circle"></div>
					        </div>
					      </div>

					      <div class="spinner-layer spinner-green">
					        <div class="circle-clipper left">
					          <div class="circle"></div>
					        </div><div class="gap-patch">
					          <div class="circle"></div>
					        </div><div class="circle-clipper right">
					          <div class="circle"></div>
					        </div>
					      </div>
						  </div>
						</canvas>
						<span class="card-title"></span>
					</div>

					<div class="card-content">
			      <span class="card-title activator grey-text text-darken-4">Quantidade de Passos<i class="material-icons right">more_vert</i></span>
			      <p><a href="#">This is a link</a></p>
			    </div>

					<div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Quantidade de Passos<i class="material-icons right">close</i></i></span>
            <p>Veja na Tabela abaixo mais detalhes da quantidade de passos dados nos últimos dias.</p>
            <table class="striped">
            	<thead><tr><th>Data</th><th>Hora</th><th>Leitura</th></tr></thead>
            	<tbody id="tab-passos"></tbody>
            </table>
          </div>
					<div class="card-action">
						<a href="#">This is a link</a>
					</div>
				</div>

				<div class="col s12 m3">
	        <div class="card blue darken-1">
	          <div class="card-content white-text">
	            <span class="card-title">Distância Percorrida</span>
	            <div id="card_passos01">
	            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
							    <div class="spinner-layer spinner-yellow-only">
							      <div class="circle-clipper left">
							        <div class="circle"></div>
							      </div><div class="gap-patch">
							        <div class="circle"></div>
							      </div><div class="circle-clipper right">
							        <div class="circle"></div>
							      </div>
							    </div>
							  </div>
	            </div>
	          </div>
	          <div class="card-action">
	            <a href="#" style="color: #ffb64b">This is a link</a>
	            <a href="#" style="color: #ffb64b">This is a link</a>
	          </div>
	        </div>

	        <div class="card red darken-1">
	          <div class="card-content white-text">
	            <span class="card-title">Calorias</span>
	            <div id="card_passos02">
	            	<div class="preloader-wrapper big active" style="display: block; margin-left: auto; margin-right: auto; top: 50%;">
							    <div class="spinner-layer spinner-green-only">
							      <div class="circle-clipper left">
							        <div class="circle"></div>
							      </div><div class="gap-patch">
							        <div class="circle"></div>
							      </div><div class="circle-clipper right">
							        <div class="circle"></div>
							      </div>
							    </div>
							 </div>
	            </div>
	          </div>
	          <div class="card-action">
	            <a href="#" style="color: #ffb64b">This is a link</a>
	            <a href="#" style="color: #ffb64b">This is a link</a>
	          </div>
	        </div>
	      </div>
	     </div>
		</div>
		

		<!-- ################## IMC ########################## -->
    <div id="imc" style="margin-top: : 5px;">
			<div class="row">
				<div class="col s12 m12">
					<div class="col s12 m6">
	          <div class="card blue darken-1">
	            <div class="card-content white-text">
	              <span class="card-title"><b>Índice de Massa Corporal (IMC)</b></span>
	              <div id="card_imc">
		              <br><p style="display: block; border-top: solid 1px white; padding-top: 35px;">Segundo a Organização Mundial da Saúde (OMS), o Índice de Massa Corporal (IMC) é um índice simples que relaciona o peso e a altura, sendo comumente usado para classificar o baixo peso, o excesso de peso e a obesidade em adultos.Os valores do IMC são independentes da idade e os mesmos para ambos os sexos. No entanto, o IMC pode não corresponder ao mesmo grau de gordura em diferentes populações devido, em parte, a diferentes proporções corporais. Os riscos para a saúde associados ao aumento do IMC são contínuos e a interpretação das classificações de IMC em relação ao risco pode diferir para diferentes populações.</p>
	              </div>
	            </div>
	            <div class="card-action">
	              <a target="_blank" href="http://apps.who.int/bmi/index.jsp?introPage=intro_3.html">Mais informações</a>
	            </div>
	          </div>
	        </div>

	        <div class="col s12 m6">
	          <div class="card red darken-1">
	            <div class="card-content white-text">
	              <span class="card-title"><b>Classificações do IMC</b></span>
	              <div>
	              	<br><p>De acordo com a Organização Mundial da Saúde (OMS) o IMC pode ser classificado conforme é apresentado na Tabela abaixo.</p><br>
	              	<table class="centered">
			            	<thead>
			            		<tr><th>Classificação</th><th>IMC (kg/m²)</th></tr>
			            	</thead>
			            	<tbody>
			            		<tr><td>Subpeso severo</td><td>16,00</td></tr>
			            		<tr><td>Subpeso Moderado</td><td>16,00 - 16,99</td></tr>
			            		<tr><td>Subpeso Leve</td><td>17,00 - 18,49</td></tr>
			            		<tr><td>Peso Normal</td><td>18,50 - 24,99</td></tr>
			            		<tr><td>Sobrepeso</td><td>25,00 - 29,99</td></tr>
			            		<tr><td>Obesidade (Grau I)</td><td>30,00 - 34,99</td></tr>
			            		<tr><td>Obesidade (Grau II)</td><td>35,00 - 39,99</td></tr>
			            		<tr><td>Obesidade (Grau III)</td><td> Maior que 40,00</td></tr>
			            	</tbody>
		            	</table>
	              </div>
	            </div>
	            <div class="card-action">
	              <a href="http://apps.who.int/bmi/index.jsp?introPage=intro_3.html">Mais informações</a>
	            </div>
	          </div>
	        </div>
        </div>
      </div>
    </div>

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
		<script>
			$( document ).ready(function() {
				updateChartFreq()
				updateChartTemp()
				updateChartPassos()
				updateIMC("<?php echo $peso; ?>", "<?php echo $altura; ?>", "<?php echo $nome; ?>")
			});
		</script>
	</body>
</html>
