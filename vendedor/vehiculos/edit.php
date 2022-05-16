<?php
session_start();
require_once("../../connections/connection.php");

$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "'and usuarios.idTus=tipouser.idTus";
$query = mysqli_query($mysqli, $sql);
$fila = mysqli_fetch_assoc($query);

if (isset($_GET['idTvehiculo'])) {
    $id = $_GET['idTvehiculo'];
    $sql = "SELECT * FROM tipovehiculo WHERE idTvehiculo=$id ";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $tipo = $row['idTvehiculo'];
        $vehi = $row['tipoVehiculo'];
    }
}

if (isset($_POST['idTvehiculo'])) {

    $id = $_POST['idTvehiculo'];
    $vehi = $_POST['tipoVehiculo'];
    //  echo ($id);
    $sql = "UPDATE tipovehiculo SET tipoVehiculo='$vehi' WHERE idTvehiculo='$id'";
    $result = mysqli_query($mysqli, $sql);

    // var_dump($result);
    header("Location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style/editar.css">
    <title>Document</title>
</head>

<body>
    <nav class="navMenu">
        <h3> Bienvenido <?php echo $fila["nombre"];  ?> <?php echo $fila["apellido"];  ?></h3>
        <span><?php echo $fila["tipo_user"]; ?></span>

        <a href="#">Inicio</a>

        <a href="../servicios/index.php">Servicios</a>
        <a href="index.php">Vehiculos</a>
        <a href="../factura.php">Factura</a>



        <div class="dot"></div>
    </nav>
    <div class="contact_form ">
        <div>

            <form action="edit.php?idTvehiculo=<?php echo $_GET['idTvehiculo']; ?>" method="POST">
                <input name="idTvehiculo" type="hidden" value="<?php echo $_GET['idTvehiculo']; ?>"></input>
                <label for="">Tipo Vehiculo</label>
                <input name="tipoVehiculo" type="text" value="<?php echo $vehi; ?>"></input>
                <button name="enviar">editar</button>
            </form>

        </div>

    </div>

</body>

</html>