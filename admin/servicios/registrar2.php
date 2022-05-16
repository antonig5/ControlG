<?php
require_once("../../connections/connection.php");
session_start();
$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "'and usuarios.idTus=tipouser.idTus";
$query1 = mysqli_query($mysqli, $sql);
$fila1 = mysqli_fetch_assoc($query1);

$control = "SELECT * FROM tipouser WHERE idTus";
$query = mysqli_query($mysqli, $control);
$fila = mysqli_fetch_assoc($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style/formV.css">
    <title>Document</title>
</head>

<body>
    <nav class="navMenu2">
        <h3> Bienvenido <?php echo $fila1["nombre"];  ?> <?php echo $fila1["apellido"];  ?></h3>
        <span><?php echo $fila1["tipo_user"]; ?></span>

        <a href="../index.php">Inicio</a>
        <a href="../usuarios.php">Usuarios</a>
        <a href="index.php">Servicios</a>
        <a href="../vehiculos/index.php">Vehiculos</a>
        <a href="../facturaTable/index.php">Reporte cliente</a>

        <div class="dot"></div>
    </nav>
    <div>
        <div id="contenido" class="contact_for">
            <form action="" method="POST" id="formulario" autocomplete="off">

                <input type="text" name="tipoGasolina" placeholder="Combustible">

                <input type="number" name="precio" placeholder="Precio">


                <button type="submit" name="enviar " id="enviar" class="enviar2">enviar</button>
                <script src="validarS/valid.js"></script>
            </form>
        </div>
    </div>
</body>

</html>