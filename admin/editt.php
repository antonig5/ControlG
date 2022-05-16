<?php
session_start();
require_once("../connections/connection.php");

$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "'and usuarios.idTus=tipouser.idTus";
$query = mysqli_query($mysqli, $sql);
$fila = mysqli_fetch_assoc($query);


if (isset($_GET['documento'])) {
    $id = $_GET['documento'];
    $sql = "SELECT * FROM usuarios WHERE documento=$id ";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $tipo = $row['documento'];
        $nombre = $row['nombre'];
        $ape = $row['apellido'];
    }
}

if (isset($_POST['documento'])) {

    $id = $_POST['documento'];
    $name = $_POST['nombre'];
    $ape = $_POST['apellido'];
    //echo ($id);
    $sql = "UPDATE usuarios SET nombre='$name', apellido='$ape' WHERE documento='$id'";
    $result = mysqli_query($mysqli, $sql);

    //var_dump($result);
    header("Location:usuarios.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style/editar.css">
    <title>Document</title>
</head>

<body>
    <nav class="navMenu">
        <h3> Bienvenido <?php echo $fila["nombre"];  ?> <?php echo $fila["apellido"];  ?></h3>
        <span><?php echo $fila["tipo_user"]; ?></span>

        <a href="../index.php">Inicio</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="servicios/index.php">Servicios</a>
        <a href="servicios/index.php">Vehiculos</a>
        <a href="#">Reporte cliente</a>


        <div class="dot"></div>
    </nav>
    <div class="contact_form ">
        <div>

            <form action="editt.php?documento=<?php echo $_GET['documento']; ?>" method="POST">
                <label for="">Documento</label>
                <input name="documento" type="number" value="<?php echo $_GET['documento']; ?>"></input>
                <label for="">Nombre</label>
                <input name="nombre" type="text" value="<?php echo $nombre; ?>"></input>
                <label for="">Apellido</label>
                <input name="apellido" type="text" value="<?php echo $ape; ?>"></input>
                <button name="envia">editar</button>
            </form>

        </div>

    </div>

</body>

</html>