
<?php

require_once('classes.php');
$telco = new telco;
$fono = new telefono;

$telco->SetInfo($_GET["telco"]);
$telco->GetBands2G();
$telco->GetBands3G();
$telco->GetBands4G();
$telco->SetResponses();

$fono->SetFono($_GET["fono"]);

$NombreCompleto = $fono->Marca . " " . $fono->Modelo . " " . $fono->Variante;



?>

<html>
<head>
  <meta charset="UTF-8">
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
    <div class="col-md-12">
      <h1><p class="text-center"><small>¿Funcionará el</small> <?php echo $NombreCompleto ?> <small>en la operadora</small> <?php echo $telco->Nombre ?><small>?</small></p></h1>
    <div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-4">
              <p><img src="http://placehold.it/600x800" class="img-responsive"></p>
              <h3><p class="text-center"><?php echo $NombreCompleto ?></p></h3>
            </div>
            <div class="col-md-4">
              <div class="panel-group">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#2G"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Compatible con 2G</a>
                    </h4>
                  </div>
                  <div id="2G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $telco->Nombre ?> funciona en la(s) frecuencias:</p>
                      <p><?php echo $telco->GSMResponse ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-group">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#3G"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Compatible con 3G</a>
                    </h4>
                  </div>
                  <div id="3G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $telco->Nombre ?> funciona en la(s) frecuencias:</p>
                      <p><?php echo $telco->UMTSResponse ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-group">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#4G"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Compatible con 4G</a>
                    </h4>
                  </div>
                  <div id="4G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $telco->Nombre ?> funciona en la(s) frecuencias:</p>
                      <p><?php echo $telco->LTEResponse ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              OPERADORA
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
