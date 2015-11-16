<?php 

class telco {
	public $ID;
	public $Nombre;
	public $Tipo;

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

?>