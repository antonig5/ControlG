<?php
session_start();
require_once("../../connections/connection.php");


if (isset($_GET['idTGaso'])) {
    $id = $_GET['idTGaso'];
    $sql = "SELECT * FROM tipogasolina WHERE idTGaso=$id ";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $tipo = $row['idTGaso'];
        $vehi = $row['tipoGasolina'];
        $precio = $row['precio'];
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
            <p> Gasolina: <?php echo $vehi; ?></p>
            <p> Precio: <?php echo $precio; ?></p>
        </div>

    </div>

</body>

</html>