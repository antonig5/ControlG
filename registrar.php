<?php
require_once("connections/connection.php");
$control = "SELECT * FROM tipouser WHERE idTus>=2";
$query = mysqli_query($mysqli, $control);
$fila = mysqli_fetch_assoc($query);

$control1 = "SELECT * FROM tipovehiculo";
$query3 = mysqli_query($mysqli, $control1);
$fila2 = mysqli_fetch_assoc($query3);



if (isset($_POST['documento'], $_POST['contraseña'], $_POST["pin"], $_POST['nombre'], $_POST['apellido'])) {
    $documento = $_POST['documento'];
    $contraseña = $_POST['contraseña'];
    $pin = $_POST['pin'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    $validar = "SELECT * FROM usuarios WHERE documento=$documento or contraseña=$contraseña or pin=$pin ";
    $query1 = mysqli_query($mysqli, $validar);
    $fila1 = mysqli_fetch_assoc($query1);

    if ($documento == "" || $contraseña == "" || $pin == "" || $nombre == "" || $apellido == "") {
        echo "<script>alert('Por favor llene los campos requeridos')</script>";
        # code...
    } elseif ($fila1) {
        echo "<script>alert('Este usuario ya existe')</script>";
        # code...
    } else {
        $sql = "INSERT INTO usuarios(nombre,apellido,idTus,documento,contraseña,pin)
                VALUES('$nombre','$apellido',2,$documento,$contraseña,$pin)";
        mysqli_query($mysqli, $sql);
    }
    # code...








    header("Location.index.php");
    $mysqli->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style/style.css">

    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <div class="grid-example">
        <a href="index.php">
            <img src="images/imagengaso.jpg" alt="imagen1" class="header2">
        </a>


        <div class="formulario2">
            <img src="images/logo.png" class="logo">
            <form method="POST" name="form" autocomplete="off" id="formulario" enctype="multipart/form-data">
                <input type="text" name="nombre" placeholder="Nombre">
                <input type="text" name="apellido" placeholder="Apellido">
                <input type="number" name="documento" placeholder="Documento" maxlength="12">
                <input type="password" name="contraseña" placeholder="Contraseña" maxlength="9">
                <input type="number" name="pin" placeholder="Pin" maxlength="5">



                <div class="g-recaptcha" data-sitekey="6LebURQfAAAAAD8fkdJwgv-N6KaeDr9_aaq4dRHV"></div>
                <input type="submit" name="enviarFormulario" id="enviar" value="Registrate" />
                <div class="help">


                    <a href="#" class="a2">ir a la Red</a>
                    <a href="index.php" class="a2">Iniciar sesion</a>
                </div>

                <div class="mintic2">
                    <img src="images/logo-funcion.png" alt="">
                </div>
            </form>
        </div>
    </div>

</body>


</html>