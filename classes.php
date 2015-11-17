<?php 

class telco {
	public $ID;
	public $Nombre;
	public $Tipo;

	public $GSMResponse = "";
	public $UMTSResponse = "";
	public $LTEResponse = "";

	public $GSM1900 = "FALSE";
	public $GSM1900Roaming = "FALSE";
	public $GSM1900RoamingTelco;

	public $GSM900 = "FALSE";
	public $GSM900Roaming = "FALSE";
	public $GSM900RoamingTelco;

	public $GSM850 = "FALSE";
	public $GSM850Roaming = "FALSE";
	public $GSM850RoamingTelco;

	public $UMTS1900 = "FALSE";
	public $UMTS1900Roaming = "FALSE";
	public $UMTS1900RoamingTelco;

	public $UMTS850 = "FALSE";
	public $UMTS850Roaming = "FALSE";
	public $UMTS850RoamingTelco;
	
	public $UMTS900 = "FALSE";
	public $UMTS900Roaming = "FALSE";
	public $UMTS900RoamingTelco;
	
	public $UMTSAWS = "FALSE";
	public $UMTSAWSRoaming = "FALSE";
	public $UMTSAWSRoamingTelco;
	
	public $LTE2600 = "FALSE";
	public $LTE2600Roaming = "FALSE";
	public $LTE2600RoamingTelco;
	
	public $LTE700 = "FALSE";
	public $LTE700Roaming = "FALSE";
	public $LTE700RoamingTelco;
	
	public $LTEAWS = "FALSE";
	public $LTEAWSRoaming = "FALSE";
	public $LTEAWSRoamingTelco;

	public function SetInfo($NameInput){
		include('config.php');
		$NameInput = str_replace("ó", "o", $NameInput); //Hotfix for ó
		$query = "SELECT * FROM `Operadoras` WHERE `Nombre` = '" . utf8_encode($NameInput) . "'";
		$result = mysqli_query($conn, $query);
		while ($row=mysqli_fetch_array($result)){
			$this->ID = $row["idOperadoras"];
			$this->Nombre = utf8_encode($row["Nombre"]);
			$this->Tipo = $row["Tipo"];

		};
		return "Query realizada. El nombre de la operadora es " . $this->Nombre . " y es una operadora de tipo " . $this->Tipo . ".";
	}

	public function GetBands2G(){
		if (isset($this->Nombre)){
			include('config.php');
			$query = "SELECT * FROM `Operadoras`, `Bandas`, `Operadoras_Bandas` WHERE `Bandas`.`Tipo`='2G' and `Operadoras_Bandas`.`idOperadoras` =" . $this->ID . " AND `Operadoras`.`idOperadoras` =" . $this->ID . " AND `Bandas`.`idBandas` = `Operadoras_Bandas`.`idBandas`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "1900"){
					$this->GSM1900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->GSM1900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM1900RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{

					}
				}
				elseif($row["Frecuencia"] == "900"){
					$this->GSM900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->GSM900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM900RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				}
				elseif($row["Frecuencia"] == "850"){
					$this->GSM850 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->GSM850Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM850RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				};
			}
		}
		else {
			return "No hay un nombre seteado";
		}
	}
	public function GetBands3G(){
		if (isset($this->Nombre)){
			include('config.php');
			$query = "SELECT * FROM `Operadoras`, `Bandas`, `Operadoras_Bandas` WHERE `Bandas`.`Tipo`='3G' and `Operadoras_Bandas`.`idOperadoras` =" . $this->ID . " AND `Operadoras`.`idOperadoras` =" . $this->ID . " AND `Bandas`.`idBandas` = `Operadoras_Bandas`.`idBandas`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "1900"){
					$this->UMTS1900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTS1900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS1900RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				}
				elseif($row["Frecuencia"] == "900"){
					$this->UMTS900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTS900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS900RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				}
				elseif($row["Frecuencia"] == "1700"){
					$this->UMTSAWS = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTSAWSRoaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTSAWSRoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				}
				elseif($row["Frecuencia"] == "850"){
					$this->UMTS850 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTS850Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS850RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				};
			}
		}
		else {
			return "No hay un nombre seteado";
		}
	}
	public function GetBands4G(){
		if (isset($this->Nombre)){
			include('config.php');
			$query = "SELECT * FROM `Operadoras`, `Bandas`, `Operadoras_Bandas` WHERE `Bandas`.`Tipo`='4G' and `Operadoras_Bandas`.`idOperadoras` =" . $this->ID . " AND `Operadoras`.`idOperadoras` =" . $this->ID . " AND `Bandas`.`idBandas` = `Operadoras_Bandas`.`idBandas`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "2600"){
					$this->LTE2600 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->LTE2600Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTE2600RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				}
				elseif($row["Frecuencia"] == "700"){
					$this->LTE700 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->LTE700Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTE700RoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				}
				elseif($row["Frecuencia"] == "1700"){
					$this->LTEAWS = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->LTEAWSRoaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . $row["idOperadoras_Roaming"];
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTEAWSRoamingTelco = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
						
					}
				};
			}
		}
		else {
			return "No hay un nombre seteado";
		}
	}

	public function SetResponses(){
		if ($this->GSM1900 == "TRUE"){
		  $this->GSMResponse = $this->GSMResponse . "<p>1900MHz.";
		  if ($this->GSM1900Roaming == "TRUE"){
		    $this->GSMResponse = $this->GSMResponse . " (Roaming en " . $this->GSM1900RoamingTelco . ")</p>";
		  }
		  else {
		    $this->GSMResponse = $this->GSMResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->GSM900 == "TRUE"){
		  $this->GSMResponse = $this->GSMResponse . "<p>900MHz.";
		  if ($this->GSM900Roaming == "TRUE"){
		    $this->GSMResponse = $this->GSMResponse . " (Roaming en " . $this->GSM900RoamingTelco . ")</p>";
		  }
		  else {
		    $this->GSMResponse = $this->GSMResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->GSM850 == "TRUE"){
		  $this->GSMResponse = $this->GSMResponse . "<p>850MHz.";
		  if ($this->GSM850Roaming == "TRUE"){
		    $this->GSMResponse = $this->GSMResponse . " (Roaming en " . $this->GSM850RoamingTelco . ")</p>";
		  }
		  else {
		    $this->GSMResponse = $this->GSMResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->UMTS1900 == "TRUE"){
		  $this->UMTSResponse = $this->UMTSResponse . "<p>1900MHz.";
		  if ($this->UMTS1900Roaming == "TRUE"){
		    $this->UMTSResponse = $this->UMTSResponse . " (Roaming en " . $this->UMTS1900RoamingTelco . ")</p>";
		  }
		  else {
		    $this->UMTSResponse = $this->UMTSResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->UMTS900 == "TRUE"){
		  $this->UMTSResponse = $this->UMTSResponse . "<p>900MHz.";
		  if ($this->UMTS900Roaming == "TRUE"){
		    $this->UMTSResponse = $this->UMTSResponse . " (Roaming en " . $this->UMTS900RoamingTelco . ")</p>";
		  }
		  else {
		    $this->UMTSResponse = $this->UMTSResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->UMTS850 == "TRUE"){
		  $this->UMTSResponse = $this->UMTSResponse . "<p>850MHz.";
		  if ($this->UMTS850Roaming == "TRUE"){
		    $this->UMTSResponse = $this->UMTSResponse . " (Roaming en " . $this->UMTS850RoamingTelco . ")</p>";
		  }
		  else {
		    $this->UMTSResponse = $this->UMTSResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->UMTSAWS == "TRUE"){
		  $this->UMTSResponse = $this->UMTSResponse . "<p>1700/2100MHz. (AWS)";
		  if ($this->UMTSAWSRoaming == "TRUE"){
		    $this->UMTSResponse = $this->UMTSResponse . " (Roaming en " . $this->UMTSAWSRoamingTelco . ")</p>";
		  }
		  else {
		    $this->UMTSResponse = $this->UMTSResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->LTE2600 == "TRUE"){
		  $this->LTEResponse = $this->LTEResponse . "<p>2600MHz.";
		  if ($this->LTE2600Roaming == "TRUE"){
		    $this->LTEResponse = $this->LTEResponse . " (Roaming en " . $this->LTE2600RoamingTelco . ")</p>";
		  }
		  else {
		    $this->LTEResponse = $this->LTEResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->LTE700 == "TRUE"){
		  $this->LTEResponse = $this->LTEResponse . "<p>700MHz.";
		  if ($this->LTE700Roaming == "TRUE"){
		    $this->LTEResponse = $this->LTEResponse . " (Roaming en " . $this->LTE700RoamingTelco . ")</p>";
		  }
		  else {
		    $this->LTEResponse = $this->LTEResponse . "</p>";
		  }
		}
		else {  
		};
		if ($this->LTEAWS == "TRUE"){
		  $this->LTEResponse = $this->LTEResponse . "<p>1700/2100MHz. (AWS)";
		  if ($this->LTEAWSRoaming == "TRUE"){
		    $this->LTEResponse = $this->LTEResponse . " (Roaming en " . $this->LTEAWSRoamingTelco . ")</p>";
		  }
		  else {
		    $this->LTEResponse = $this->LTEResponse . "</p>";
		  }
		}
		else {  
		};
		if (isset($this->LTEResponse)){

		}
		else {
			$this->LTEResponse ="<p>" . $this->Nombre . " no opera en 4G LTE</p>";
		};
	}
}

class telefono {
	public $Marca;
	public $Modelo;
	public $Variante;
	public $LinkReview;
	public $Identical;
	public $Similar;

	function SetFono($NameInput){
		include('config.php');
		$query = "SELECT * FROM `Telefonos` WHERE `NombreCompleto` = '" . $NameInput . "'";
		$result = mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($result)){
  		$this->Marca = $row["Marca"];
  		$this->Modelo = $row["Modelo"];
  		$this->Variante = $row["Variante"];
  		$this->LinkReview = $row["LinkReview"];
		};
		$query = "";
		$result = "";
		$row = "";
		if ($this->Marca == ""){
			$this->Identical = "FALSE";
			$this->Similar = "TRUE";
			$query = "SELECT * FROM `Telefonos` WHERE `NombreCompleto` LIKE '%" . $NameInput . "%'";
			$result = mysqli_query($conn, $query);
			while($row=mysqli_fetch_array($result)){
	  		$this->Marca = $row["Marca"];
	  		$this->Modelo = $row["Modelo"];
	  		$this->Variante = $row["Variante"];
	  		$this->LinkReview = $row["LinkReview"];
			};
		}
	}
}

class Inputphone {
	public $MarcaIn = "";
	public $ModeloIn = "";
	public $VarianteIn = "";
	public $GSM1900In = "";
	public $GSM900In = "";
	public $GSM850In = "";
	public $UMTS1900In = "";
	public $UMTS900In = "";
	public $UMTS850In = "";
	public $UMTSAWSIn = "";
	public $LTE2600In = "";
	public $LTE700In = "";
	public $LTEAWSIn = "";
	public $NombreCompletoIn = "";

	public $MarcaQuery = "";
	public $ModeloQuery = "";
	public $VarianteQuery = "";
	public $NombreCompletoQuery = "";

	public $Match = "FALSE";
	public $Result = "";
	public $InsertedFonoEnd = "Query no realizado";
	public $InsertedFonoID = "";

	function GetPOST(){
		if (isset($_POST["GSM1900"])){
			$this->GSM1900In = "TRUE";
		}
		else {
			$this->GSM1900In = "FALSE";
		};
		if (isset($_POST["GSM900"])){
			$this->GSM900In = "TRUE";
		}
		else {
			$this->GSM900In = "FALSE";
		};
		if (isset($_POST["GSM850"])){
			$this->GSM850In = "TRUE";
		}
		else {
			$this->GSM850In = "FALSE";
		};
		if (isset($_POST["UMTS1900"])){
			$this->UMTS1900In = "TRUE";
		}
		else {
			$this->UMTS1900In = "FALSE";
		};
		if (isset($_POST["UMTS900"])){
			$this->UMTS900In = "TRUE";
		}
		else {
			$this->UMTS900In = "FALSE";
		};
		if (isset($_POST["UMTS850"])){
			$this->UMTS850In = "TRUE";
		}
		else {
			$this->UMTS850In = "FALSE";
		};
		if (isset($_POST["UMTSAWS"])){
			$this->UMTSAWSIn = "TRUE";
		}
		else {
			$this->UMTSAWSIn = "FALSE";
		};
		if (isset($_POST["LTE2600"])){
			$this->LTE2600In = "TRUE";
		}
		else {
			$this->LTE2600In = "FALSE";
		};
		if (isset($_POST["LTE700"])){
			$this->LTE700In = "TRUE";
		}
		else {
			$this->LTE700In = "FALSE";
		};
		if (isset($_POST["LTEAWS"])){
			$this->LTEAWSIn = "TRUE";
		}
		else {
			$this->LTEAWSIn = "FALSE";
		};
		$this->MarcaIn = $_POST["Marca"];
		$this->ModeloIn = $_POST["Modelo"];
		$this->VarianteIn = $_POST["Variante"];
		$this->NombreCompletoIn = $this->MarcaIn . " " . $this->ModeloIn . " " . $this->VarianteIn;

	}

	function GetDB($SearchArg) {
		include('config.php');
		$query = "SELECT * FROM `Telefonos` WHERE `NombreCompleto` = '" . $SearchArg . "'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_array($result)){
			$this->NombreCompletoQuery = $row["NombreCompleto"]; 
		}
		if ($this->NombreCompletoQuery == ""){
			$this->Match = "FALSE";
		}
		else {
			$this->Match = "TRUE";
		}
	}

	function DoInsertFono () {
		include('config.php');
		if ($this->Match == "TRUE"){
			$this->Result = "DUPLICATE";
		}
		else {
			$InsertTelefono = "INSERT INTO `Telefonos` (`Marca`, `Modelo`, `Variante`, `NombreCompleto`) VALUES ('" . $this->MarcaIn . "', '" . $this->ModeloIn . "', '" . $this->VarianteIn . "', '" . $this->NombreCompletoIn . "')";
			$Result = mysqli_query($conn, $InsertTelefono);
			$this->InsertedFonoID = mysqli_insert_id($conn);
			if (! $Result){
				$this->InsertedFonoEnd = "Error agregando teléfono.";
			}
			else {
				$this->InsertedFonoEnd = "Teléfono agregado correctamente";
			};
		};
	}

	function DoInsertBands () {
		include('config.php');


	}

}

?>