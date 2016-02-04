<?php

if (!isset($_GET["Operadora"])){
  $_SESSION["Alert"] = "Por favor selecciona una operadora";
  header("Location: /");
  die;
}

session_start();

require_once('classesv2.php');
require_once('version.php');
require_once('config.php');
$Operadora = new Operadora($_GET["Operadora"]);
$Telefono = new Telefono($_GET["Telefono"]);
$Comparacion = new Comparacion;

$GSMList = "";
$UMTSList = "";
$LTEList = "";

$LinkFoto = $Telefono->Marca . str_replace(" ", "", $Telefono->Modelo);

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

if ($_GET["Operadora"] != "Entel"){
  if ($Telefono->LTEA == "1"){
    $LTEABoxText = $WarningIcon . " Compatible con LTE-A"; 
    $LTEABoxType = "warning";
    $LTEAResponse = 'es compatible con LTE-Advanced. <b>Servicio exclusivo de Entel. <a href="http://entel.cl/portabilidad">Pórtate aquí</a></b>';
  }
  else {
    $LTEABoxText = $DangerIcon . " No compatible con LTE-A"; 
    $LTEABoxType = "danger";
    $LTEAResponse = "no es compatible con LTE-Advanced. <b>Servicio exclusivo de Entel.</b>";
  };

  if ($Telefono->HDVoice == "1"){
    $HDVoiceBoxText = $WarningIcon . " Compatible con Voz HD"; 
    $HDVoiceBoxType = "warning";
    $HDVoiceResponse = 'es compatible con Voz HD. <b>Servicio exclusivo de Entel. <a href="http://entel.cl/portabilidad">Pórtate aquí</a></b>';
  }
  else {
    $HDVoiceBoxText = $DangerIcon . " No compatible con Voz HD"; 
    $HDVoiceBoxType = "danger";
    $HDVoiceResponse = "no es compatible con Voz HD. <b>Servicio exclusivo de Entel.</b>";
  };
}

else {
  if ($Telefono->LTEA == "1"){
    $LTEABoxText = $OKIcon . " Compatible con LTE-A"; 
    $LTEABoxType = "Success";
    $LTEAResponse = "es compatible con LTE-Advanced. <b>Servicio exclusivo de Entel.</b>";
  }
  else {
    $LTEABoxText = $DangerIcon . " No compatible con LTE-A"; 
    $LTEABoxType = "danger";
    $LTEAResponse = "no es compatible con LTE-Advanced. <b>Servicio exclusivo de Entel.</b>";
  };

  if ($Telefono->HDVoice == "1"){
    $HDVoiceBoxText = $OKIcon . " Compatible con Voz HD"; 
    $HDVoiceBoxType = "Success";
    $HDVoiceResponse = "es compatible con Voz HD. <b>Servicio exclusivo de Entel.</b>";
  }
  else {
    $HDVoiceBoxText = $DangerIcon . " No compatible con Voz HD"; 
    $HDVoiceBoxType = "danger";
    $HDVoiceResponse = "no es compatible con Voz HD. <b>Servicio exclusivo de Entel.</b>";
  };
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

$OpQuery = "SELECT `Nombre` FROM `Operadoras`";
$OpResult = mysqli_query($conn, $OpQuery);

$FullNamePlus = $Telefono->Marca . "+" . str_replace(" ", "+", $Telefono->Modelo);
if ($Telefono->Variante != ""){
  $FullNamePlus = $FullNamePlus . "+" . str_replace(" ", "+", $Telefono->Variante);
}

?>

<html>
<head>
  <title>Verificador de bandas | Pisapapeles.net</title>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <script src="js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
  <script src="js/collapse.js" type="text/javascript"></script>
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
        <li><a href="/index.php">Inicio</a></li>
        <li><a href="http://pisapapeles.net">Pisapapeles</a></li>
        <?php if ($_GET["Branding"] == "True"): ?>
           <li><a href="http://entel.cl">Entel</a></li>
        <?php elseif ($_GET["Branding"] == "Partial") : ?>
           <li><a href="http://entel.cl">Entel</a></li>
        <?php else: ?>
        <?php endif; ?>       
        <li><a href="/about.php">Acerca de</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1><p class="text-center"><small>¿Funcionará el</small> <?php echo $Telefono->NombreCompleto?> <small>en la operadora</small> <?php echo $Operadora->Nombre ?><small>?</small></p></h1>
    </div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-4">
              <p><img src="<?php echo '/img/phones/' . $LinkFoto . '.png' ?>" class="img-responsive" onError="this.onerror=null;this.src='http://placehold.it/600x800';"></p>
              <h3><p class="text-center"><?php echo $Telefono->NombreCompleto ?></p></h3>
              <?php if ($Telefono->LinkReview != ""){echo '<h2><p class="text-center"><a href="http://pisapapeles.net/' . $Telefono->LinkReview . '" class="btn btn-warning">Leer review</a></p></h2>';}; ?>
            </div>
            <div class="col-md-4">
              <div class="panel-group">
                <div class="panel panel-<?php echo $GSMBoxType ?>">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#2G"><?php echo $GSMBoxText ?><span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
                    </h4>
                  </div>
                  <div id="2G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $Operadora->Nombre ?> funciona en la(s) frecuencias:</p>
                      <?php echo $GSMList ?>
                    </div>
                  </div>
                </div>
                <div class="panel panel-<?php echo $UMTSBoxType ?>">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#3G"><?php echo $UMTSBoxText ?><span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
                    </h4>
                  </div>
                  <div id="3G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $Operadora->Nombre ?> funciona en la(s) frecuencias:</p>
                      <?php echo $UMTSList ?>
                    </div>
                  </div>
                </div>
                <div class="panel panel-<?php echo $LTEBoxType ?>">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#4G"><?php echo $LTEBoxText ?><span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
                    </h4>
                  </div>
                  <div id="4G" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p><?php echo $Operadora->Nombre ?> funciona en la(s) frecuencias:</p>
                      <?php echo $LTEList ?>
                    </div>
                  </div>
                </div>
                  <div class="panel panel-<?php echo $LTEABoxType ?>">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" href="#LTEA"><?php echo $LTEABoxText ?><span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
                      </h4>
                    </div>
                    <div id="LTEA" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>El <?php echo $Telefono->Marca ?> <?php echo $Telefono->Modelo ?> variante <?php echo $Telefono->Variante ?> <?php echo $LTEAResponse ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-<?php echo $HDVoiceBoxType ?>">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" href="#HDVoice"><?php echo $HDVoiceBoxText ?><span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
                      </h4>
                    </div>
                    <div id="HDVoice" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>El <?php echo $Telefono->Marca ?> <?php echo $Telefono->Modelo ?> variante <?php echo $Telefono->Variante ?> <?php echo $HDVoiceResponse ?></p>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="col-md-12 col-lg-12">
                <img src="img/<?php echo str_replace(" ", "_", $Operadora->Nombre) ?>.png" class="img-responsive center-block" alt="<?php echo $Operadora->Nombre ?>" style="max-height: 150px;">
              </div>
              <div class="col-md-12 col-lg-12">
                <h4><p class="text-center">Verificar en otra operadora: </p></h4>
                <form action="result.php" method="get">
                  <select class="form-control" id="Operadora" name="Operadora">
                    <?php 
                      while ($OpRow = mysqli_fetch_array($OpResult)){
                        echo "<option>" . $OpRow["Nombre"] . "</option>";
                      }
                    ?>
                  </select>
                  <input type="hidden" id="Telefono" name="Telefono" value="<?php echo $Telefono->NombreCompleto ?>">
                  </br>
                  <div class="col-md-12 col-lg-12">
                    <button type="submit" class="btn btn-warning center-block">Verificar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="footer">
    <div class="container">
      <p class="text-muted">Verificador de Bandas <a href="about.php"><?php echo $Version ?></a> Copyright © <?php echo date("Y") ?> Pisapapeles Networks Ltda. </p>
    </div>
  </footer>
</body>
