<?php 


/**
* Clase para agregar un teléfono a la base de datos
* @author Eduardo Pérez
* @version 1.1
* @category POSTer
* @todo Nada por ahora
*/

class InputPhone {

	//Datos del teléfono a agregar
	public $Marca = "";
	public $Modelo = "";
	public $Variante = "";
	public $LinkReview = "";
	public $GSM1900 = "";
	public $GSM900 = "";
	public $GSM850 = "";
	public $UMTS1900 = "";
	public $UMTS900 = "";
	public $UMTS850 = "";
	public $UMTSAWS = "";
	public $LTE2600 = "";
	public $LTE700 = "";
	public $LTEAWS = "";
	public $LTEA = "";
	public $HDVoice = "";
	public $SAE = "";
	public $NombreCompleto = "";

	//Datos de inserción de datos del teléfono y resultados
	public $InsertTelefonoResult = "";
	public $InsertTelefonoResponse = "";
	public $InsertTelefonoID = "";
	public $InsertBandasResult = "";
	public $InsertBandasResponse = "";

	//Datos para decidir otras funciones
	public $DuplicateMatch = "FALSE";

	//Función para obtener los datos desde el POST
	function GetPOST(){
		//Sección de GSM
		if (isset($_POST["GSM1900"])){
			$this->GSM1900 = "TRUE";
		}
		else {
			$this->GSM1900 = "FALSE";
		};
		if (isset($_POST["GSM900"])){
			$this->GSM900 = "TRUE";
		}
		else {
			$this->GSM900 = "FALSE";
		};
		if (isset($_POST["GSM850"])){
			$this->GSM850 = "TRUE";
		}
		else {
			$this->GSM850 = "FALSE";
		};

		//Sección de UMTS
		if (isset($_POST["UMTS1900"])){
			$this->UMTS1900 = "TRUE";
		}
		else {
			$this->UMTS1900 = "FALSE";
		};
		if (isset($_POST["UMTS900"])){
			$this->UMTS900 = "TRUE";
		}
		else {
			$this->UMTS900 = "FALSE";
		};
		if (isset($_POST["UMTS850"])){
			$this->UMTS850 = "TRUE";
		}
		else {
			$this->UMTS850 = "FALSE";
		};
		if (isset($_POST["UMTSAWS"])){
			$this->UMTSAWS = "TRUE";
		}
		else {
			$this->UMTSAWS = "FALSE";
		};

		//Sección de LTE
		if (isset($_POST["LTE2600"])){
			$this->LTE2600 = "TRUE";
		}
		else {
			$this->LTE2600 = "FALSE";
		};
		if (isset($_POST["LTE700"])){
			$this->LTE700 = "TRUE";
		}
		else {
			$this->LTE700 = "FALSE";
		};
		if (isset($_POST["LTEAWS"])){
			$this->LTEAWS = "TRUE";
		}
		else {
			$this->LTEAWS = "FALSE";
		};

		//Sección de Otros
		if (isset($_POST["LTEA"])){
			$this->LTEA = "1";
		}
		else {
			$this->LTEA = "0";
		}
		if (isset($_POST["HDVoice"])){
			$this->HDVoice = "1";
		}
		else {
			$this->HDVoice = "0";
		}
		if (isset($_POST["SAE"])){
			$this->SAE = "1";
		}
		else {
			$this->SAE = "0";
		}

		//Marca, modelo, variante, nombre completo
		$this->Marca = $_POST["Marca"];
		$this->Modelo = $_POST["Modelo"];
		$this->Variante = $_POST["Variante"];
		$this->NombreCompleto = $this->Marca . " " . $this->Modelo . " " . $this->Variante;
		$this->LinkReview = $_POST["Review"];

	}

	//Función para saber si hay un duplicado en la base de datos
	function GetDuplicate($Telefono) {
		include('config.php');
		$conn->set_charset("utf8");
		$NombreCompletoQuery = "";
		$query = "SELECT * FROM `Telefonos` WHERE `NombreCompleto` = '" . $Telefono . "'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_array($result)){
			$NombreCompletoQuery = $row["NombreCompleto"]; 
		}
		if ($NombreCompletoQuery == ""){
			$this->DuplicateMatch = "FALSE";
		}
		else {
			$this->DuplicateMatch = "TRUE";
		}
	}

	//Función para insertar el teléfono en la base de datos si no hay duplicado
	function InsertTelefono () {
		include('config.php');
		$conn->set_charset("utf8");
		if ($this->DuplicateMatch == "TRUE"){
			$this->InsertTelefonoResult = "DUPLICATE";
			$this->InsertTelefonoResponse = "El teléfono ingresado ya existe. Sus datos no se agregarán.";
			$this->InsertTelefonoID = "NULL";
		}
		else {
			$InsertTelefono = "INSERT INTO `Telefonos` (`Marca`, `Modelo`, `Variante`, `NombreCompleto`, `LinkReview`, `LTEA`, `HDVoice`, `SAE`) VALUES ('" . mysqli_real_escape_string($conn, $this->Marca) . "', '" . mysqli_real_escape_string($conn, $this->Modelo) . "', '" . mysqli_real_escape_string($conn, $this->Variante) . "', '" . mysqli_real_escape_string($conn, $this->NombreCompleto) . "', '" . mysqli_real_escape_string($conn, $this->LinkReview) . "', '" . mysqli_real_escape_string($conn, $this->LTEA) . "', '" . mysqli_real_escape_string($conn, $this->HDVoice) . "', '" . mysqli_real_escape_string($conn, $this->Marca) . "')" ;
			$Result = mysqli_query($conn, $InsertTelefono);
			if (! $Result){
				$this->InsertTelefonoResult = "ERROR";
				$this->InsertTelefonoResponse = "Ha ocurrido un error al agregar el teléfono.";
				$this->InsertTelefonoID = "NULL";
			}
			else {
				$this->InsertTelefonoResult = "OK";
				$this->InsertTelefonoResponse = "Teléfono agregado correctamente";
				$this->InsertTelefonoID = mysqli_insert_id($conn);
			};
		};
	}
	//Función para insertar el teléfono en la base de datos si no hay duplicado END

	//Función para isertar las bandas del teléfono BEGIN
	function InsertBandas () {
		
		if ($this->DuplicateMatch == "TRUE"){
			$this->InsertBandasResult = "DUPLICATE";
			$this->InsertBandasResponse = "El teléfono ingresado ya existe. Sus bandas no se agregarán.";

		}
		else {
			include('config.php');
			$InsertBandasQuery = "INSERT INTO `Telefonos_Bandas` (`idTelefonos`, `idBandas`) VALUES ";
			if ($this->GSM1900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '1'), ";
			}
			else {
			};
			if ($this->GSM900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '2'), ";
			}
			else {
			};
			if ($this->GSM850 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '3'), ";
			}
			else {
			};
			if ($this->UMTS1900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '4'), ";
			}
			else {
			};
			if ($this->UMTS850 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '5'), ";
			}
			else {
			};
			if ($this->UMTS900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '6'), ";
			}
			else {
			};
			if ($this->UMTSAWS == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '7'), ";
			}
			else {
			};
			if ($this->LTE2600 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '8'), ";
			}
			else {
			};
			if ($this->LTE700 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '9'), ";
			}
			else {
			};
			if ($this->LTEAWS == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '10'), ";
			}
			else {
			};

			$InsertBandasQuery = substr($InsertBandasQuery, 0, -2);
			
			$Result = mysqli_query($conn, $InsertBandasQuery);
			if (! $Result){
					$this->InsertBandasResponse = "Error agregando bandas: " . $InsertBandasQuery;
					$this->InsertBandasResult = "ERROR";
			}
			else {
				$this->InsertBandasResponse = "Bandas agregadas correctamente.";
				$this->InsertBandasResult = "OK";
			};
		}
	}
	//Función para insertar las bandas del teléfono END
}

/**
* Clase para obtener los datos de la operadora desde la base de datos.
* @version 1.1
* @category Fetcher
* @todo Nada por ahora
*/
class Operadora {

	//Datos generales de la operadora
	public $ID="";
	public $Nombre="";
	public $Tipo="";

	//Datos de las bandas de la operadora
	//GSM 1900
	public $GSM1900 = "FALSE";
	public $GSM1900Roaming = "FALSE";
	public $GSM1900RoamingOperadora;
	//GSM 900
	public $GSM900 = "FALSE";
	public $GSM900Roaming = "FALSE";
	public $GSM900RoamingOperadora;
	//GSM 850
	public $GSM850 = "FALSE";
	public $GSM850Roaming = "FALSE";
	public $GSM850RoamingOperadora;
	//UMTS 1900
	public $UMTS1900 = "FALSE";
	public $UMTS1900Roaming = "FALSE";
	public $UMTS1900RoamingOperadora;
	//UMTS 850
	public $UMTS850 = "FALSE";
	public $UMTS850Roaming = "FALSE";
	public $UMTS850RoamingOperadora;
	//UMTS 900
	public $UMTS900 = "FALSE";
	public $UMTS900Roaming = "FALSE";
	public $UMTS900RoamingOperadora;
	//UMTS AWS
	public $UMTSAWS = "FALSE";
	public $UMTSAWSRoaming = "FALSE";
	public $UMTSAWSRoamingOperadora;
	//LTE 2600
	public $LTE2600 = "FALSE";
	public $LTE2600Roaming = "FALSE";
	public $LTE2600RoamingOperadora;
	//LTE 700
	public $LTE700 = "FALSE";
	public $LTE700Roaming = "FALSE";
	public $LTE700RoamingOperadora;
	//LTE AWS
	public $LTEAWS = "FALSE";
	public $LTEAWSRoaming = "FALSE";
	public $LTEAWSRoamingOperadora;


	//Función para obtener los datos de la operadora consultada
	function __construct ($Operadora){
		include('config.php');
		$conn->set_charset("utf8");
		//$Operadora = utf8_encode(str_replace("ó", "o", $Operadora)); //Hotfix for ó
		$query = "SELECT * FROM `Operadoras` WHERE `Nombre` = '" . mysqli_real_escape_string($conn, $Operadora) . "'";
		$result = mysqli_query($conn, $query);
		while ($row=mysqli_fetch_array($result)){
			$this->ID = $row["idOperadoras"];
			$this->Nombre = $row["Nombre"];
			$this->Tipo = $row["Tipo"];
		};
	}

	//Función para obtener las bandas y roeaming de estas si existen
	function GetBandas (){
		include('config.php');
		$conn->set_charset("utf8");

		//GSM
		if ($this->ID != ""){
			$query = "SELECT * FROM `Operadoras`, `Bandas`, `Operadoras_Bandas` WHERE `Bandas`.`Tipo`='2G' and `Operadoras_Bandas`.`idOperadoras` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Operadoras`.`idOperadoras` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Bandas`.`idBandas` = `Operadoras_Bandas`.`idBandas`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "1900"){
					$this->GSM1900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->GSM1900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM1900RoamingOperadora = $rowRoaming["Nombre"];
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
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM900RoamingOperadora = $rowRoaming["Nombre"];
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
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM850RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{						
					}
				};
			}
			$query = "";
			$result = "";
			$row = "";

			//UMTS
			$query = "SELECT * FROM `Operadoras`, `Bandas`, `Operadoras_Bandas` WHERE `Bandas`.`Tipo`='3G' and `Operadoras_Bandas`.`idOperadoras` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Operadoras`.`idOperadoras` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Bandas`.`idBandas` = `Operadoras_Bandas`.`idBandas`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "1900"){
					$this->UMTS1900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTS1900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS1900RoamingOperadora = $rowRoaming["Nombre"];
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
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS900RoamingOperadora = $rowRoaming["Nombre"];
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
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTSAWSRoamingOperadora = $rowRoaming["Nombre"];
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
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS850RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{				
					}
				};
			}
			$query = "";
			$result = "";
			$row = "";

			//LTE
			$query = "SELECT * FROM `Operadoras`, `Bandas`, `Operadoras_Bandas` WHERE `Bandas`.`Tipo`='4G' and `Operadoras_Bandas`.`idOperadoras` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Operadoras`.`idOperadoras` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Bandas`.`idBandas` = `Operadoras_Bandas`.`idBandas`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "2600"){
					$this->LTE2600 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->LTE2600Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTE2600RoamingOperadora = $rowRoaming["Nombre"];
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
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTE700RoamingOperadora = $rowRoaming["Nombre"];
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
						$queryRoaming = "SELECT `Nombre` FROM Operadoras WHERE idOperadoras =" . mysqli_real_escape_string($conn, $row["idOperadoras_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTEAWSRoamingOperadora = $rowRoaming["Nombre"];
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
	}
}

/**
* Clase para obtener los datos del teléfono desde la base de datos.
* @author Eduardo Pérez
* @version 1.1
* @category Fetcher
* @todo Nada por ahora
* @uses $var = new Telefono(Nombre) genera el query y carga los datos.
*/
class Telefono {

	//Datos generales del teléfono
	public $ID;
	public $Marca;
	public $Modelo;
	public $Variante;
	public $LinkReview;
	public $Identical;
	public $Similar;
	public $NombreCompleto;
	public $LTEA = "FALSE";
	public $HDVoice = "FALSE";
	public $SAE = "FALSE";

	//Datos de las bandas del teléfono
	public $GSM1900 = "FALSE";
	public $GSM900 = "FALSE";
	public $GSM850 = "FALSE";
	public $UMTS1900 = "FALSE";
	public $UMTS900 = "FALSE";
	public $UMTS850 = "FALSE";
	public $UMTSAWS = "FALSE";
	public $LTE2600 = "FALSE";
	public $LTE700 = "FALSE";
	public $LTEAWS = "FALSE";
	

	function __construct ($NameInput){
		include('config.php');
		$conn->set_charset("utf8");
		$query = "SELECT * FROM `Telefonos` WHERE `NombreCompleto` = '" . mysqli_real_escape_string($conn, $NameInput) . "'";
		$result = mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($result)){
			$this->ID = $row ["idTelefonos"];
  		$this->Marca = $row["Marca"];
  		$this->Modelo = $row["Modelo"];
  		$this->Variante = $row["Variante"];
  		$this->LinkReview = $row["LinkReview"];
  		$this->LTEA = $row["LTEA"];
  		$this->HDVoice = $row["HDVoice"];
  		$this->SAE = $row["SAE"];
		};
		$query = "";
		$result = "";
		$row = "";
		if ($this->Marca == ""){
			$this->Identical = "FALSE";
			$this->Similar = "TRUE";
			$query = "SELECT * FROM `Telefonos` WHERE `NombreCompleto` LIKE '%" . mysqli_real_escape_string($conn, $NameInput) . "%'";
			$result = mysqli_query($conn, $query);
			while($row=mysqli_fetch_array($result)){
				$this->ID = $row ["idTelefonos"];
	  		$this->Marca = $row["Marca"];
	  		$this->Modelo = $row["Modelo"];
	  		$this->Variante = $row["Variante"];
	  		$this->LinkReview = $row["LinkReview"];
	  		$this->LTEA = $row["LTEA"];
	  		$this->HDVoice = $row["HDVoice"];
	  		$this->SAE = $row["SAE"];
			};
		}
		$this->NombreCompleto = $this->Marca . " " . $this->Modelo . " " . $this->Variante;
		$query = "";
		$result = "";
		$row = "";

		$query = "SELECT * FROM `Telefonos_Bandas` WHERE `idTelefonos` = '" . mysqli_real_escape_string($conn, $this->ID) . "'";
		$result = mysqli_query ($conn, $query);
		while ($row = mysqli_fetch_array($result)){
			if ($row["idBandas"] == "1"){
				$this->GSM1900 = "TRUE";
			}
			elseif ($row["idBandas"] == "2"){
				$this->GSM900 = "TRUE";
			}
			elseif ($row["idBandas"] == "3"){
				$this->GSM850 = "TRUE";
			}
			elseif ($row["idBandas"] == "4"){
				$this->UMTS1900 = "TRUE";
			}
			elseif ($row["idBandas"] == "5"){
				$this->UMTS900 = "TRUE";
			}
			elseif ($row["idBandas"] == "6"){
				$this->UMTS850 = "TRUE";
			}
			elseif ($row["idBandas"] == "7"){
				$this->UMTSAWS = "TRUE";
			}
			elseif ($row["idBandas"] == "8"){
				$this->LTE2600 = "TRUE";
			}
			elseif ($row["idBandas"] == "9"){
				$this->LTE700 = "TRUE";
			}
			elseif ($row["idBandas"] == "10"){
				$this->LTEAWS = "TRUE";
			};
		}
	}
}

/**
* Clase para comparar teléfono y bandas
* @author Eduardo Pérez
* @version 1.1
* @category Processer
* @todo Nada por ahora
*/
class Comparacion {

	public $GSM1900Result;
	public $GSM900Result;
	public $GSM850Result;
	public $UMTS1900Result;
	public $UMTS900Result;
	public $UMTS850Result;
	public $UMTSAWSResult;
	public $LTE2600Result;
	public $LTE700Result;
	public $LTEAWSResult;

	public $GSMResult;
	public $UMTSResult;
	public $LTEResult;

	function ProcessBand ($OperadoraInput, $TelefonoInput, $BandaInput){
		
		if ($BandaInput == "GSM1900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->GSM1900Result = "OK";
				return "La operadora posee banda 2G 1900MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->GSM1900Result = "ERROR";
				return "La operadora posee banda 2G 1900MHz. pero el teléfono no es compatible.";		
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->GSM1900Result = "IRRELEVANT";
				return "La operadora no posee banda 2G 1900MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->GSM1900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 2G 1900MHz. No importa.";
			};
		}
		if ($BandaInput == "GSM900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->GSM900Result = "OK";
				return "La operadora posee banda 2G 900MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->GSM900Result = "ERROR";
				return "La operadora posee banda 2G 900MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->GSM900Result = "IRRELEVANT";
				return "La operadora no posee banda 2G 900MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->GSM900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 2G 900MHz. No importa.";
			};
		}
		if ($BandaInput == "GSM850"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->GSM850Result = "OK";
				return "La operadora posee banda 2G 850MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->GSM850Result = "ERROR";
				return "La operadora posee banda 2G 850MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->GSM850Result = "IRRELEVANT";
				return "La operadora no posee banda 2G 850MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->GSM850Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 2G 850MHz. No importa.";
			};
		}
		if ($BandaInput == "UMTS1900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTS1900Result = "OK";
				return "La operadora posee banda 3G 1900MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTS1900Result = "ERROR";
				return "La operadora posee banda 3G 1900MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTS1900Result = "IRRELEVANT";
				return "La operadora no posee banda 3G 1900MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTS1900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 1900MHz. No importa.";
			};
		}
		if ($BandaInput == "UMTS900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTS900Result = "OK";
				return "La operadora posee banda 3G 900MHz. y el teléfono es compatible.";
				
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTS900Result = "ERROR";
				return "La operadora posee banda 3G 900MHz. pero el teléfono no es compatible.";
				
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTS900Result = "IRRELEVANT";
				return "La operadora no posee banda 3G 900MHz. y el teléfono sí. No importa.";
				
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTS900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 900MHz. No importa.";
				
			};
		}
		if ($BandaInput == "UMTS850"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTS850Result = "OK";
				return "La operadora posee banda 3G 850MHz. y el teléfono es compatible.";				
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTS850Result = "ERROR";
				return "La operadora posee banda 3G 850MHz. pero el teléfono no es compatible.";			
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTS850Result = "IRRELEVANT";
				return "La operadora no posee banda 3G 850MHz. y el teléfono sí. No importa.";	
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTS850Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 850MHz. No importa.";				
			};
		}
		if ($BandaInput == "UMTSAWS"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTSAWSResult = "OK";
				return "La operadora posee banda 3G 1700/2100MHz. (AWS) y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTSAWSResult = "ERROR";
				return "La operadora posee banda 3G 1700/2100MHz. (AWS) pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTSAWSResult = "IRRELEVANT";
				return "La operadora no posee banda 3G 1700/2100MHz. (AWS) y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTSAWSResult = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 1700/2100MHz. (AWS) No importa.";
			};
		}
		if ($BandaInput == "LTE2600"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->LTE2600Result = "OK";
				return "La operadora posee banda 4G 2600MHz. y el teléfono es compatible.";		
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->LTE2600Result = "ERROR";
				return "La operadora posee banda 4G 2600MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->LTE2600Result = "IRRELEVANT";
				return "La operadora no posee banda 4G 2600MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->LTE2600Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 4G 2600MHz. No importa.";
			};
		}
		if ($BandaInput == "LTE700"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->LTE700Result = "OK";
				return "La operadora posee banda 4G 700MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->LTE700Result = "ERROR";
				return "La operadora posee banda 4G 700MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->LTE700Result = "IRRELEVANT";
				return "La operadora no posee banda 4G 700MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->LTE700Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 4G 700MHz. No importa.";
			};
		}
		if ($BandaInput == "LTEAWS"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->LTEAWSResult = "OK";
				return "La operadora posee banda 4G 1700/2100MHz. (AWS) y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->LTEAWSResult = "ERROR";
				return "La operadora posee banda 4G 1700/2100MHz. (AWS) pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->LTEAWSResult = "IRRELEVANT";
				return "La operadora no posee banda 4G 1700/2100MHz. (AWS) y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->LTEAWSResult = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 4G 1700/2100MHz. (AWS) No importa.";
			};
		}
	}

	function ProcessResult (){
		if ($this->GSM1900Result == "ERROR" || $this->GSM900Result == "ERROR" || $this->GSM850Result == "ERROR"){
			if ($this->GSM1900Result == "OK" || $this->GSM900Result == "OK" || $this->GSM850Result == "OK"){
				$this->GSMResult = "PARTIAL";
			}
			else {
				$this->GSMResult = "ERROR";
			};
		}
		else {
			$this->GSMResult = "OK";
		};

		if ($this->UMTS1900Result == "ERROR" || $this->UMTS900Result == "ERROR" || $this->UMTS850Result == "ERROR" || $this->UMTSAWSResult == "ERROR"){
			if ($this->UMTS1900Result == "OK" || $this->UMTS900Result == "OK" || $this->UMTS850Result == "OK" || $this->UMTSAWSResult == "OK"){
				$this->UMTSResult = "PARTIAL";
			}
			else {
				$this->UMTSResult = "ERROR";
			};
		}
		else {
			$this->UMTSResult = "OK";
		};

		if ($this->LTE2600Result == "ERROR" || $this->LTE700Result == "ERROR" || $this->LTEAWSResult == "ERROR"){
			if ($this->LTE2600Result == "OK" || $this->LTE700Result == "OK" || $this->LTEAWSResult == "OK"){
				$this->LTEResult = "PARTIAL";
			}
			else {
				$this->LTEResult = "ERROR";
			};
		}
		else {
			$this->LTEResult = "OK";
		};
	}
}



?>