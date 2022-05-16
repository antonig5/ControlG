<?php
require_once("../connections/connection.php");
session_start();
$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "'and usuarios.idTus=tipouser.idTus";
$query = mysqli_query($mysqli, $sql);
$fila = mysqli_fetch_assoc($query);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style/menu.css">
    <title>Administrador</title>
</head>

<body>
    <nav class="navMenu">
        <h3> Bienvenido <?php echo $fila["nombre"];  ?> <?php echo $fila["apellido"];  ?></h3>
        <span><?php echo $fila["tipo_user"]; ?></span>

        <a id="salir" href="../index.php">Inicio</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="servicios/index.php">Servicios</a>
        <a href="vehiculos/index.php">Vehiculos</a>
        <a href="facturaTable/index.php">Reporte cliente</a>
        <div class="dot"></div>
        <script src="bay.js"></script>
    </nav>
</body>

</html>