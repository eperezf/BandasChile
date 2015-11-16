
<?php

$phone = $_GET["fono"];
$server = "localhost";
$user = "root";
$password = "root";
$database = "bandas";
$phoneidentical = "";
$conn = new mysqli ($server, $user, $password, $database);

$identical = "SELECT * FROM `Telefonos` WHERE `Modelo` = '" . $phone . "'";
$result1=mysqli_query($conn, $identical);
while($row1=mysqli_fetch_array($result1)){
  $phoneidentical = $row1["Modelo"];
};

$similar = "SELECT * FROM `Telefonos` WHERE `Modelo` LIKE '%" . $phone . "%'";
$result2=mysqli_query($conn, $similar);
while($row2=mysqli_fetch_array($result2)){
  $phonesimilar = $row2["Modelo"];
};

if ($phoneidentical == ""){
  $response = "Modelo idéntico no encontrado";
  $phoneidentical = "No encontrado";
}
else {
  $response = "Modelo idéntico encontrado";
  $phonesimilar = "No es necesario";
};

?>

<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
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
      <a class="navbar-brand" href="index.php">Pisapapeles</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">Inicio</a></li>
        <li><a href="http://pisapapeles.net">Volver al blog</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
  <div class="row">
    <p>Búsqueda: <?php echo $phone; ?></p>
    <p><?php echo $response?></p>
    <p>$phonesimilar = <?php echo $phonesimilar ?></p>
    <p>$phoneidentical = <?php echo $phoneidentical ?></p>
  </div>
</div>
</body>
