<?php
session_start();
require_once("../connections/connection.php");
$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "'and usuarios.idTus=tipouser.idTus";
$query = mysqli_query($mysqli, $sql);
$fila = mysqli_fetch_assoc($query);

if (isset($_GET['search'])) {
    $id = $_GET['search'];
    if ($id == "") {
        echo "<script>alert('sin resultados')
    </script>";
        echo '<script> window.location ="miDat.php"</script>';
    } else {
        $sql = "SELECT * FROM usuarios , tipouser WHERE documento=$id and usuarios.idTus=tipouser.idTus and usuarios.idTus =2";
        $result = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $name = $row['nombre'];
            $ape = $row['apellido'];
            $doc = $row['documento'];
            $tipo = $row['tipo_user'];
        } else {
            echo "<script>alert('Error al buscar')
        </script>";
            echo '<script> window.location ="miDat.php"</script>';
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style/form.css">
    <script>
        document.getElementById("i1").value = <?php echo error_reporting(0); ?>
    </script>
    <title>Document</title>
</head>

<body>
    <nav class="navMenu">
        <h3> Bienvenido <?php echo $fila["nombre"];  ?> <?php echo $fila["apellido"];  ?></h3>
        <span><?php echo $fila["tipo_user"]; ?></span>

        <a href="index.php">Inicio</a>
        <a href="usuarios.php">Servicios </a>
        <div class="dot"></div>
    </nav>
    <div class="contact_form">
        <div class="formulario">
            <form action="">
                <input type="number" name="search" id="i1">
                <label for="">Name</label>
                <input type="text" disabled value="<?php echo $name; ?>">
                <label for="">Last name</label>
                <input type="text" disabled value="<?php echo $ape; ?>">
                <label for="">Document</label>
                <input type="text" disabled value="<?php echo $doc; ?>">
                <label for="">Type of user</label>
                <input type="text" disabled value="<?php echo $tipo; ?>">
                <button type="submit" value="Buscar"> Buscar
            </form>
        </div>

    </div>
</body>

</html>