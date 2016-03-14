<?php 

include ('config.php');
require_once('version.php');

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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <script src="js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="/css/footer.css">
  <style>
    body {
      font-family: 'Titillium Web', sans-serif;
    }
    .navbar-brand {
      padding: 7px 15px;
    }
  </style>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<!--Inicio Navbar-->
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand navbar-active" href="/index.php">
           <img src="/img/e.png" class="img-responsive">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Inicio</a></li>
        <li><a href="http://entel.cl">Entel</a></li>
        <li><a href="http://pisapapeles.net">Pisapapeles</a></li>         
        <li><a href="/about.php">Acerca de</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
  <legend>Acerca de</legend>
  <p>Verificador de Bandas</p>
  <p>Versión: <?php echo $Version ?> "<?php echo $Codename ?>"</p>
  <p>Estado de la base de datos: <?php echo $Status ?></p>
  <p>Teléfonos en la base de datos: <?php echo $Telefonos ?></p>
</div>
<footer class="footer">
  <div class="container">
    <p class="text-muted">Verificador de Bandas <a href="about.php"><?php echo $Version ?></a> Copyright © <?php echo date("Y") ?> Pisapapeles Networks Ltda. </p>
  </div>
</footer>
</body>
</html>
