<?php
session_start();
require_once("../connections/connection.php");


if (isset($_GET['documento'])) {
    $id = $_GET['documento'];
    $sql = "SELECT * FROM usuarios , tipouser WHERE documento=$id and usuarios.idTus=tipouser.idTus";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $name = $row['nombre'];
        $ape = $row['apellido'];
        $doc = $row['documento'];
        $tipo = $row['tipo_user'];
        $photo = $row['foto'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style/modal.css">
    <title>Document</title>
</head>

<body>

    <div class="modalDialog" id="openModal">
        <div>
            <a href="usuarios.php" title="Cerrar">X</a>
            <h1>Datos</h1>
            <p><?php echo $name; ?></p>
            <p><?php echo $ape; ?></p>
            <p><?php echo $doc; ?></p>
            <p><?php echo $tipo; ?></p>
            <p class="foto"><?php echo (' <img src="../images/fotos/' . $photo . '" width="100%"> ') ?></p>
        </div>

    </div>

</body>

</html>