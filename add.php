<?php 
session_start();


if ($_SESSION["login"] == "TRUE"){
	//El usuario ya tiene autenticado.
}
else {
	if (isset($_POST["user"]) && isset($_POST["inputPass"])){
		if ($_POST["user"] == "admin" && $_POST["inputPass"] == "PPB##1029"){
			$_SESSION["login"] = "TRUE";
		}
		else {
			$_SESSION["login"] = "FALSE";
			header("Location: /login.php");
			die();
		}
	}
	else {
		$_SESSION["login"] = "FALSE";
		header("Location: /login.php");
		die();
	}
}

require_once('config.php');

?>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="css/theme.min.css">
</head>
<body>
<!--Inicio Navbar-->
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/index.php">BandasChile</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/index.php">Inicio</a></li>
        <li><a href="/list.php">Lista de equipos</a></li>
        <li class="active"><a href="#">Agregar</a></li>
        <li><a href="http://pisapapeles.net">Ir al blog</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
	<div class="row">
		<form action="submit.php" method="POST" role="form">
			<legend>Agregar teléfono</legend>
		
			<div class="form-group">
				<label for="">Marca</label>
				<input type="text" class="form-control" id="Marca" name="Marca" required="required" placeholder="Ej.: Apple">
			</div>
			<div class="form-group">
				<label for="">Modelo</label>
				<input type="text" class="form-control" id="Modelo" name="Modelo" required="required" placeholder="Ej.: iPhone 6s Plus">
			</div>
			<div class="form-group">
				<label for="">Variante</label>
				<input type="text" class="form-control" id="Variante" name="Variante" placeholder="Ej.: A1423">
			</div>
			<div class="form-group">
				<label for="">SLUG (Link sin "http://pisapapeles.net/") del review:</label>
				<input type="text" class="form-control" id="Review" name="Review" placeholder="Ej.: apple-iphone-6s-review">
			</div>
			<div class="form-group">
				<label>Bandas 2G:</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="GSM1900" name="GSM1900" value="TRUE"> 1900MHz.
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="GSM900" name="GSM900" value="TRUE"> 900MHz.
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="GSM850" name="GSM850" value="TRUE"> 850MHz.
				</label>
			</div>
			<div class="form-group">
				<label>Bandas 3G:</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="UMTS1900" name="UMTS1900" value="TRUE"> 1900MHz.
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="UMTS900" name="UMTS900" value="TRUE"> 900MHz.
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="UMTS850" name="UMTS850" value="TRUE"> 850MHz.
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="UMTSAWS" name="UMTSAWS" value="TRUE"> 1700/2100MHz. (AWS)
				</label>
			</div>
			<div class="form-group">
				<label>Bandas 4G:</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="LTE2600" name="LTE2600" value="TRUE"> 2600MHz.
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="LTE700" name="LTE700" value="TRUE"> 700MHz.
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="LTEAWS" name="LTEAWS" value="TRUE"> 1700/2100MHz. (AWS)
				</label>
			</div>
			<div class="form-group">
				<label>Otros:</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="LTEA" name="LTEA" value="TRUE"> LTE-Advanced
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="HDVoice" name="HDVoice" value="TRUE"> Voz HD
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" id="SAE" name="SAE" value="TRUE"> Sistema de Alertas de Emergencia (SAE)
				</label>

			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
</body>
</html>