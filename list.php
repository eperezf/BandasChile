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
$query = "SELECT * FROM `Telefonos`";
$result = mysqli_query($conn, $query);

?>
<html>
<head>
	<title>Verificador de bandas | Pisapapeles.net</title>
  <meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="/js/bootstrap-typeahead.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/theme.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titilium+Web' rel='stylesheet' type='text/css'>
  <style>
    body {
      font-family: 'Titilium Web', sans-serif;
    }
  </style>
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
	      <a class="navbar-brand" href="index.php">Pisapapeles</a>
	    </div>
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="/">Inicio</a></li>
	        <li class="active"><a href="#">Lista</a></li>
	        <li><a href="/add.php">Agregar</a></li>
	        <li><a href="http://pisapapeles.net">Volver al blog</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<!--Fin Navbar-->
	<div class="container">
		<div class="row">
			<legend>LISTER SYSTEM ALPHA V0.1</legend>
		</div>
		<div class="row">
			<table class="table table-striped">
				<tr>
					<td>ID</td>
					<td>Marca</td>
					<td>Modelo</td>
					<td>Variante</td>
					<td>Acción</td>
				</tr>
				<?php while ($row = mysqli_fetch_array($result)): ?>
					<tr>
						<td><?php echo $row["idTelefonos"] ?></td>
						<td><?php echo $row["Marca"] ?></td>
						<td><?php echo $row["Modelo"] ?></td>
						<td><?php echo $row["Variante"] ?></td>
						<td><button onclick="delete<?php echo $row['idTelefonos']; ?>()">ELIMINAR</button></td>
					</tr>
					<script>
						function delete<?php echo $row['idTelefonos']; ?>() {
							if(confirm("Estás seguro que quieres eliminar el: \n<?php echo $row['NombreCompleto'] ?> \n ID <?php echo $row['idTelefonos'] ?>?")) document.location = '/delete.php?id=<?php echo $row["idTelefonos"] ?>&fromfile=TRUE';
						}
					</script>
				<?php endwhile; ?>
		</div>
	</div>
</body>
</html>