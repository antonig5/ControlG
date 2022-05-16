<?php
session_start();
require_once("../../connections/connection.php");

$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "'and usuarios.idTus=tipouser.idTus";
$query = mysqli_query($mysqli, $sql);
$fila = mysqli_fetch_assoc($query);

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

if (isset($_POST['idTGaso'])) {

    $id = $_POST['idTGaso'];
    $vehi = $_POST['tipoGasolina'];
    $precio = $_POST['precio'];
    //  echo ($id);
    $sql = "UPDATE tipogasolina SET tipoGasolina='$vehi', precio='$precio' WHERE idTGaso='$id'";
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
        <a href="index.php">Servicios</a>
        <a href="../vehiculos/index.php">Vehiculos</a>
        <a href="../factura.php">Factura</a>



        <div class="dot"></div>
    </nav>
    <div class="contact_form ">
        <div>

            <form action="edit.php?idTGaso=<?php echo $_GET['idTGaso']; ?>" method="POST">
                <input name="idTGaso" type="hidden" value="<?php echo $_GET['idTGaso']; ?>"></input>
                <label for="">Tipo Gasolina</label>
                <input name="tipoGasolina" type="text" value="<?php echo $vehi; ?>"></input>
                <label for="">Precio</label>
                <input name="precio" type="number" value="<?php echo $precio; ?>"></input>
                <button name="enviar">editar</button>
            </form>

        </div>

    </div>

</body>

</html>