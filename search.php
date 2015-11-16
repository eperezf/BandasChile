<?php

$query = $_POST['search'];

$server = "localhost";
$user = "root";
$password = "root";
$database = "bandas";
$conn = new mysqli ($server, $user, $password, $database);
$array = array();


$sql="SELECT * FROM `Telefonos` WHERE `NombreCompleto` LIKE '%" . $query . "%' ORDER BY CASE WHEN `NombreCompleto` LIKE '" . $query . "%' THEN 1 ELSE 2 END, `NombreCompleto`";

$result=mysqli_query($conn, $sql);


while($row=mysqli_fetch_array($result))
{
 $array[] = utf8_encode($row['NombreCompleto']);

}

echo json_encode($array);


?> 