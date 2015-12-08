<?php 

include ('config.php');

if ($conn->connect_errno) {
    $Status = "Houston, tenemos un problema. Por favor envía un correo a contacto@pisapapeles.net.";
    exit();
};
if ($conn->ping()) {
    $Status = ("Todo se ve bien.");
} else {
    $Status = "Houston, tenemos un problema. Por favor envía un correo a contacto@pisapapeles.net.";
}

$query = "SELECT COUNT(*) as Telefonos FROM Telefonos";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)){
  $Telefonos = $row["Telefonos"];
};
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
<?php include_once("analyticstracking.php") ?>
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
      <a class="navbar-brand" href="http://pisapapeles.net">Pisapapeles</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/index.php">Bandas</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
  <legend>Acerca de</legend>
  <p>Verificador de Bandas</p>
  <p>Versión: 0.8 Beta "Ayreon"</p>
  <p>Estado de la base de datos: <?php echo $Status ?></p>
  <p>Teléfonos en la base de datos: <?php echo $Telefonos ?></p>
</div>
<footer class="footer">
  <div class="container">
    <p class="text-muted">Verificador de Bandas <a href="about.php">0.8</a> Copyright © <?php echo date("Y") ?> Pisapapeles Networks Ltda. </p>
  </div>
</footer>
</body>
</html>
