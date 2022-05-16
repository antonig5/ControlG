<?php

require_once("../../../connections/connection.php");


$tipo = $_POST['tipoGasolina'];
$precio = $_POST['precio'];
$insertar = "INSERT INTO tipogasolina (tipoGasolina,precio) VALUES('$tipo','$precio')";
$sql = mysqli_query($mysqli, $insertar);
if ($sql) {
    echo "<script>alert('bien.mmm')</script>";
    echo "<script>window.location='../registrar2.php'</script>";
} else {
    echo "<script>alert('fallo al subir')</script>";
    echo "<script>window.location='../registrar2.php'</script>";
}
