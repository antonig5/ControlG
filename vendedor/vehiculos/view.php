<?php
session_start();
require_once("../../connections/connection.php");


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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style/modal.css">
    <title>Document</title>
</head>

<body>

    <div class="modalDialog" id="openModal">
        <div>
            <a href="index.php" title="Cerrar">X</a>
            <h1>Datos</h1>
            <p>ID: <?php echo $tipo; ?></p>
            <p> Vehiculo: <?php echo $vehi; ?></p>
        </div>

    </div>

</body>

</html>