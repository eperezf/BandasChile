<?php 

if (isset($_POST["Marca"])){

}
else {
	header('Location: /add.php');
	die();
};
if (isset($_POST["Modelo"])){

}
else {
	header('Location: /add.php');
	die();
};
if (isset($_POST["Variante"])){

}
else {
	header('Location: /add.php');
	die();
};

require_once('classes.php');

$input = new Inputphone;
$input->GetPOST();
$input->GetDB($input->NombreCompletoIn);
$input->DoInsertFono();
$input->DoInsertBandas();

?>

<p>Marca: <?php echo $input->MarcaIn ?></p>
<p>Modelo: <?php echo $input->ModeloIn ?></p>
<p>Variante: <?php echo $input->VarianteIn ?></p>
<p>Nombre Completo: <?php echo $input->NombreCompletoIn ?></p>
<p>----Bandas 2G----</p>
<p>1900MHz.: <?php echo $input->GSM1900In ?></p>
<p>900MHz.: <?php echo $input->GSM900In ?></p>
<p>850MHz.: <?php echo $input->GSM850In ?></p>
<p>----Bandas 3G----</p>
<p>1900MHz.: <?php echo $input->UMTS1900In ?></p>
<p>900MHz.: <?php echo $input->UMTS900In ?></p>
<p>850MHz.: <?php echo $input->UMTS850In ?></p>
<p>AWS: <?php echo $input->UMTSAWSIn ?></p>
<p>----Bandas 4G:----</p>
<p>2600MHz.: <?php echo $input->LTE2600In ?></p>
<p>700MHz.: <?php echo $input->LTE700In ?></p>
<p>AWS: <?php echo $input->LTEAWSIn ?></p>
<p>----RESULTADOS----</p>
<p>Coincidencia en la base de datos: <?php echo $input->Match ?></p>
<p>Resultado del query de agregación de teléfono: <?php echo $input->InsertedFonoEnd ?></p>
<p>ID del nuevo teléfono (si existe): <?php echo $input->InsertedFonoID ?></p>
<p>Resultado de query de agregación de bandas: <?php echo $input->InsertedBandasEnd ?></p>