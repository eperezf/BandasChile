
<?php

require_once('classesv2.php');
$Operadora = new Operadora($_GET["Operadora"]);
$Telefono = new Telefono($_GET["Telefono"]);
$Comparacion = new Comparacion;

$Operadora->GetBandas();
$GSM1900 = $Comparacion->ProcessBand($Operadora->GSM1900, $Telefono->GSM1900, "GSM1900");
$GSM900 = $Comparacion->ProcessBand($Operadora->GSM900, $Telefono->GSM900, "GSM900");
$GSM850 = $Comparacion->ProcessBand($Operadora->GSM850, $Telefono->GSM850, "GSM850");
$UMTS1900 = $Comparacion->ProcessBand($Operadora->UMTS1900, $Telefono->UMTS1900, "UMTS1900");
$UMTS900 = $Comparacion->ProcessBand($Operadora->UMTS900, $Telefono->UMTS900, "UMTS900");
$UMTS850 = $Comparacion->ProcessBand($Operadora->UMTS850, $Telefono->UMTS850, "UMTS850");
$UMTSAWS = $Comparacion->ProcessBand($Operadora->UMTSAWS, $Telefono->UMTSAWS, "UMTSAWS");
$LTE2600 = $Comparacion->ProcessBand($Operadora->LTE2600, $Telefono->LTE2600, "LTE2600");
$LTE700 = $Comparacion->ProcessBand($Operadora->LTE700, $Telefono->LTE700, "LTE700");
$LTEAWS = $Comparacion->ProcessBand($Operadora->LTEAWS, $Telefono->LTEAWS, "LTEAWS");



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
      <h1><p class="text-center"><small>¿Funcionará el</small> <?php echo $Telefono->NombreCompleto?> <small>en la operadora</small> <?php echo $Operadora->Nombre ?><small>?</small></p></h1>
    <div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-4">
              <p><img src="http://placehold.it/600x800" class="img-responsive"></p>
              <h3><p class="text-center">TELEFONO</p></h3>
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
                      <p>OPERADORA funciona en la(s) frecuencias:</p>
                      <p>FRECUENCIAS GSM</p>
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
                      <p>OPERADORA funciona en la(s) frecuencias:</p>
                      <p>FRECUENCIAS UMTS</p>
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
                      <p>OPERADORA funciona en la(s) frecuencias:</p>
                      <p>FRECUENCIAS LTE</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <p>RESULTADOS 2G:</p>
              <p><?php echo $GSM1900 ?></p>
              <p><?php echo $GSM900 ?></p>
              <p><?php echo $GSM850 ?></p>
              <p>RESULTADOS 3G:</p>
              <p><?php echo $UMTS1900 ?></p>
              <p><?php echo $UMTS900 ?></p>
              <p><?php echo $UMTS850 ?></p>
              <p><?php echo $UMTSAWS ?></p>
              <p>RESULTADOS 4G:</p>
              <p><?php echo $LTE2600 ?></p>
              <p><?php echo $LTE700 ?></p>
              <p><?php echo $LTEAWS ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
