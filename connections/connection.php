<?php
// datos de la database
$hostname = "localhost";
$username = "root";
$password = "";
$Database = "gasolinera";

$mysqli = new mysqli ($hostname, $username, $password, $Database);

//conectividad
if ($mysqli -> connect_errno) {

    die("fallo la conexion" . mysqli_connect_errno());# code...
}

?>