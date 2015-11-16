<?php

$query = $_POST['search'];

$server = "localhost";
$user = "root";
$password = "root";
$database = "bandas";
$conn = new mysqli ($server, $user, $password, $database);
$array = array();


$sql="SELECT * FROM `Telefonos` WHERE `Modelo` LIKE '%" . $query . "%' ORDER BY CASE WHEN `Modelo` LIKE '" . $query . "%' THEN 1 ELSE 2 END, `Modelo`";

$result=mysqli_query($conn, $sql);


while($row=mysqli_fetch_array($result))
{
 $array[] = utf8_encode($row['Modelo']);

}

echo json_encode($array);


?> 