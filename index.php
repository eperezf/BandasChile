<?php

session_start();
include ('config.php');
$query = "SELECT `Nombre` FROM `Operadoras`";
$result = mysqli_query($conn, $query);


?>
<html>
<head>
  <title>Verificador de bandas | Pisapapeles.net</title>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  
  <!-- Latest compiled and minified CSS -->
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <script src="js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
  <?php if ($_GET["Branding"] == "True" || $_GET["Branding"] == "Partial"): ?>
    <link rel="stylesheet" href="/css/entel.min.css">
  <?php else : ?>
    <link rel="stylesheet" href="/css/pisapapeles.min.css">
  <?php endif ?>
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
        <?php if ($_GET["Branding"] == "True"): ?>
           <img src="/img/e.png" class="img-responsive">
        <?php elseif ($_GET["Branding"] == "Partial") : ?>
           <img src="/img/emasp.png" class="img-responsive">
        <?php else: ?>
          <img src="/img/p.png" class="img-responsive">
        <?php endif; ?>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Inicio</a></li>
        <li><a href="http://pisapapeles.net">Pisapapeles</a></li>
        <li><a href="http://entel.cl">Entel</a></li>
        <li><a href="/about.php">Acerca de</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
  <?php if (!isset($_SESSION["Alert"])){$_SESSION["Alert"] = "";}; if ($_SESSION["Alert"] != ""):?>
    <div class="row">  
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION["Alert"]; $_SESSION["Alert"] = "" ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-12">
      <h1><p class="text-center">Revisa si tu teléfono es compatible</p></h1>
    </div>
    <div class="col-md-12">
      <h4><p class="text-center">Busca el modelo de tu teléfono y la operadora que quieres usar</p></h4>
    </div>
  </div>
  <div class="row">
    <form action="result.php" method="get">
      <div class="col-md-12 col-lg-6">
        <h4><p class="text-center">Busca tu teléfono</p></h4>
        <input class="form-control" id="typeahead-input" type="text" data-provide="typeahead" name="Telefono"/ autocomplete="off">
          <br/>
          <br/>
        </div>
        <div class="col-md-12 col-lg-6">
          <h4><p class="text-center">Selecciona tu operadora</p></h4>
          <select class="form-control" id="Operadora" name="Operadora">
            <?php 
              while ($row = mysqli_fetch_array($result)){
                echo "<option>" . $row["Nombre"] . "</option>";
              }
            ?>
          </select>
          <br/>
          <br/>
        </div>
        <div class="col-md-12 col-lg-12">
          <button type="submit" class="btn btn-warning center-block">Verificar</button>
        </div>
      </form>
    </div>
    <div class="row">
      <hr></hr>
      <div class="col-md-12">
        <?php if ($_GET["Branding"] == "True"): ?>
        <?php else : ?>
          <h3><p class="text-center">Un proyecto</h3><img src="http://static.pisapapeles.net/uploads/2014/09/logopisapapeles-copy.png" class="img-responsive center-block"></p>
        <?php endif ?>  
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <p class="text-muted">Verificador de Bandas <a href="about.php">1.0</a> Copyright © <?php echo date("Y") ?> Pisapapeles Networks Ltda. </p>
    </div>
  </footer>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      $('#typeahead-input').typeahead({
        source: function (query, process) {
          return $.get('search.php?q=' + query, function (data) {
            return process(JSON.parse(data));
          });
        }
      });
    })
  </script>
</body>
</html>