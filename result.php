<?php

if (!isset($_GET["Operadora"])){
  $_SESSION["Alert"] = "Por favor selecciona una operadora";
  header("Location: /");
  die;
}

session_start();

require_once('classesv2.php');
$Operadora = new Operadora($_GET["Operadora"]);
$Telefono = new Telefono($_GET["Telefono"]);
$Comparacion = new Comparacion;

$GSMList = "";
$UMTSList = "";
$LTEList = "";

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

$Comparacion->ProcessResult();

$OKIcon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ';
$WarningIcon = '<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> ';
$DangerIcon = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ';

if ($Comparacion->GSMResult == "OK"){
  $GSMBoxText = $OKIcon . "100% Compatible con 2G";
  $GSMBoxType = "success";
}
if ($Comparacion->GSMResult == "PARTIAL"){
  $GSMBoxText = $WarningIcon . "Parcialmente compatible con 2G";
  $GSMBoxType = "warning";
}
if ($Comparacion->GSMResult == "ERROR"){
  $GSMBoxText = $DangerIcon . "No compatible con 2G";
  $GSMBoxType = "danger";
}

if ($Comparacion->UMTSResult == "OK"){
  $UMTSBoxText = $OKIcon . "100% Compatible con 3G";
  $UMTSBoxType = "success";
}
if ($Comparacion->UMTSResult == "PARTIAL"){
  $UMTSBoxText = $WarningIcon . "Parcialmente compatible con 3G";
  $UMTSBoxType = "warning";
}
if ($Comparacion->UMTSResult == "ERROR"){
  $UMTSBoxText = $DangerIcon . "No compatible con 3G";
  $UMTSBoxType = "danger";
}

if ($Comparacion->LTEResult == "OK"){
  $LTEBoxText = $OKIcon . "100% Compatible con 4G";
  $LTEBoxType = "success";
}
if ($Comparacion->LTEResult == "PARTIAL"){
  $LTEBoxText = $WarningIcon . "Parcialmente compatible con 4G";
  $LTEBoxType = "warning";
}
if ($Comparacion->LTEResult == "ERROR"){
  $LTEBoxText = $DangerIcon . "No compatible con 4G";
  $LTEBoxType = "danger";
}

if ($Operadora->GSM1900 == "TRUE"){
  if ($Comparacion->GSM1900Result == "OK"){
    $GSMList = $GSMList . "<p>" . $OKIcon;
  }
  else {
    $GSMList = $GSMList . "<p>" . $DangerIcon;
  }
  if ($Operadora->GSM1900Roaming == "TRUE"){
    $GSMList = $GSMList . '1900MHz. (Roaming en ' . $Operadora->GSM1900RoamingOperadora . ')</p>';
  }
  else {
    $GSMList = $GSMList . '1900MHz.</p>';
  }
}

if ($Operadora->GSM900 == "TRUE"){
  if ($Comparacion->GSM900Result == "OK"){
    $GSMList = $GSMList . "<p>" . $OKIcon;
  }
  else {
    $GSMList = $GSMList . "<p>" . $DangerIcon;
  }
  if ($Operadora->GSM900Roaming == "TRUE"){
    $GSMList = $GSMList . '900MHz. (Roaming en ' . $Operadora->GSM900RoamingOperadora . ')</p>';
  }
  else {
    $GSMList = $GSMList . '900MHz.</p>';
  }
}

if ($Operadora->GSM850 == "TRUE"){
  if ($Comparacion->GSM850Result == "OK"){
    $GSMList = $GSMList . "<p>" . $OKIcon;
  }
  else {
    $GSMList = $GSMList . "<p>" . $DangerIcon;
  }
  if ($Operadora->GSM850Roaming == "TRUE"){
    $GSMList = $GSMList . '850MHz. (Roaming en ' . $Operadora->GSM850RoamingOperadora . ')</p>';
  }
  else {
    $GSMList = $GSMList . '850MHz.</p>';
  }
}

if ($Operadora->UMTS1900 == "TRUE"){
  if ($Comparacion->UMTS1900Result == "OK"){
    $UMTSList = $UMTSList . "<p>" . $OKIcon;
  }
  else {
    $UMTSList = $UMTSList . "<p>" . $DangerIcon;
  }
  if ($Operadora->UMTS1900Roaming == "TRUE"){
    $UMTSList = $UMTSList . '1900MHz. (Roaming en ' . $Operadora->UMTS1900RoamingOperadora . ')</p>';
  }
  else {
    $UMTSList = $UMTSList . '1900MHz.</p>';
  }
}

if ($Operadora->UMTS900 == "TRUE"){
  if ($Comparacion->UMTS900Result == "OK"){
    $UMTSList = $UMTSList . "<p>" . $OKIcon;
  }
  else {
    $UMTSList = $UMTSList . "<p>" . $DangerIcon;
  }
  if ($Operadora->UMTS900Roaming == "TRUE"){
    $UMTSList = $UMTSList . '900MHz. (Roaming en ' . $Operadora->UMTS900RoamingOperadora . ')</p>';
  }
  else {
    $UMTSList = $UMTSList . '900MHz.</p>';
  }
}

if ($Operadora->UMTS850 == "TRUE"){
  if ($Comparacion->UMTS850Result == "OK"){
    $UMTSList = $UMTSList . "<p>" . $OKIcon;
  }
  else {
    $UMTSList = $UMTSList . "<p>" . $DangerIcon;
  }
  if ($Operadora->UMTS850Roaming == "TRUE"){
    $UMTSList = $UMTSList . '850MHz. (Roaming en ' . $Operadora->UMTS850RoamingOperadora . ')</p>';
  }
  else {
    $UMTSList = $UMTSList . '850MHz.</p>';
  }
}

if ($Operadora->UMTSAWS == "TRUE"){
  if ($Comparacion->UMTSAWSResult == "OK"){
    $UMTSList = $UMTSList . "<p>" . $OKIcon;
  }
  else {
    $UMTSList = $UMTSList . "<p>" . $DangerIcon;
  }
  if ($Operadora->UMTSAWSRoaming == "TRUE"){
    $UMTSList = $UMTSList . '1700/2100MHz. (AWS) (Roaming en ' . $Operadora->UMTSAWSRoamingOperadora . ')</p>';
  }
  else {
    $UMTSList = $UMTSList . '1700/2100MHz. (AWS)</p>';
  }
}

if ($Operadora->LTE2600 == "TRUE"){
  if ($Comparacion->LTE2600Result == "OK"){
    $LTEList = $LTEList . "<p>" . $OKIcon;
  }
  else {
    $LTEList = $LTEList . "<p>" . $DangerIcon;
  }
  if ($Operadora->LTE2600Roaming == "TRUE"){
    $LTEList = $LTEList . '2600MHz. (Roaming en ' . $Operadora->LTE2600RoamingOperadora . ')</p>';
  }
  else {
    $LTEList = $LTEList . '2600MHz.</p>';
  }
}

if ($Operadora->LTE700 == "TRUE"){
  if ($Comparacion->LTE700Result == "OK"){
    $LTEList = $LTEList . "<p>" . $OKIcon;
  }
  else {
    $LTEList = $LTEList . "<p>" . $DangerIcon;
  }
  if ($Operadora->LTE700Roaming == "TRUE"){
    $LTEList = $LTEList . '700MHz. (Roaming en ' . $Operadora->LTE700RoamingOperadora . ')</p>';
  }
  else {
    $LTEList = $LTEList . '700MHz.</p>';
  }
}

if ($Operadora->LTEAWS == "TRUE"){
  if ($Comparacion->LTEAWSResult == "OK"){
    $LTEList = $LTEList . "<p>" . $OKIcon;
  }
  else {
    $LTEList = $LTEList . "<p>" . $DangerIcon;
  }
  if ($Operadora->LTEAWSRoaming == "TRUE"){
    $LTEList = $LTEList . '1700/2100MHz. (AWS) (Roaming en ' . $Operadora->LTEAWSRoamingOperadora . ')</p>';
  }
  else {
    $LTEList = $LTEList . '1700/2100MHz. (AWS)</p>';
  }
}
if ($LTEList == ""){
  $LTEList = "<p>" . $WarningIcon . $Operadora->Nombre . " no opera en 4G</p>";
  $LTEBoxText = $DangerIcon . $Operadora->Nombre . " no opera en 4G";
  $LTEBoxType = "danger";
}

if ($_GET["Telefono"] == ""){
  $_SESSION["Alert"] = "Por favor busca un teléfono";
  header("Location: /");
  die;
}

if (!isset($Telefono->Marca)){
  $_SESSION["Alert"] = "El teléfono que buscaste no existe";
  header("Location: /");
  die;
}

if ($Telefono->Marca == ""){
  $_SESSION["Alert"] = "El teléfono que buscaste no existe";
  header("Location: /");
  die;
}

if ($Operadora->Nombre == ""){
  $_SESSION["Alert"] = "La operadora no existe";
  header("Location: /");
  die;
}

if ($_GET["Operadora"] == ""){
  $_SESSION["Alert"] = "Por favor selecciona una operadora";
  header("Location: /");
  die;
}

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
              <h3><p class="text-center"><?php echo $Telefono->NombreCompleto ?></p></h3>
            </div>
            <div class="col-md-4">
              <div class="panel-group">
                <div class="panel panel-<?php echo $GSMBoxType ?>">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#2G"><?php echo $GSMBoxText ?></a>
                    </h4>
                  </div>
                  <div id="2G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $Operadora->Nombre ?> funciona en la(s) frecuencias:</p>
                      <?php echo $GSMList ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-group">
                <div class="panel panel-<?php echo $UMTSBoxType ?>">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#3G"><?php echo $UMTSBoxText ?></a>
                    </h4>
                  </div>
                  <div id="3G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $Operadora->Nombre ?> funciona en la(s) frecuencias:</p>
                      <?php echo $UMTSList ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-group">
                <div class="panel panel-<?php echo $LTEBoxType ?>">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#4G"><?php echo $LTEBoxText ?></a>
                    </h4>
                  </div>
                  <div id="4G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $Operadora->Nombre ?> funciona en la(s) frecuencias:</p>
                      <?php echo $LTEList ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <img src="img/<?php echo str_replace(" ", "_", $Operadora->Nombre) ?>.png" class="img-responsive center-block" alt="<?php echo $Operadora->Nombre ?>">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
