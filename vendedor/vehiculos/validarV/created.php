<?php

require_once("../../../connections/connection.php");


$tipo = $_POST['tipoVehiculo'];
$insertar = "INSERT INTO tipovehiculo (tipoVehiculo) VALUES('$tipo')";
$sql = mysqli_query($mysqli, $insertar);
if ($sql) {
    echo "<script>alert('bien.mmm')</script>";
    echo "<script>window.location='../registrar2.php'</script>";
} else {
    echo "<script>alert('fallo al subir')</script>";
    echo "<script>window.location='../registrar2.php'</script>";
}
