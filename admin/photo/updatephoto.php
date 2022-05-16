<?php
require_once("../../connections/connection.php");

$documento = $_POST['documento'];
$contraseña = $_POST['contraseña'];
$pin = $_POST['pin'];
$nombre = $_POST['nombre'];
$idTus = $_POST['idTus'];
$apellido = $_POST['apellido'];
$foto = $_FILES['foto']['name'];
$ruta = $_FILES['foto']['tmp_name'];
$tamaño = $_FILES['foto']['size'];
$type = $_FILES['foto']['type'];
$destino = "../../images/fotos/" . $foto;
copy($ruta, $destino);


$insertar = "INSERT INTO usuarios (documento,nombre,apellido,contraseña,pin,idTus,foto) values ('$documento','$nombre','$apellido','$contraseña','$pin','$idTus','$foto')";
$sql = mysqli_query($mysqli, $insertar);
if ($sql) {
    echo "<script>alert('bien.mmm')</script>";
    echo "<script>window.location='../registrar1.php'</script>";
} else {
    echo "<script>alert('fallo al subir')</script>";
    echo "<script>window.location='../registrar1.php'</script>";
}
