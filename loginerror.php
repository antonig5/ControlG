<?php
require_once("connections/connection.php")
?>

<?php
$control = "SELECT * FROM tipouser WHERE idTus>=2";
$query = mysqli_query($mysqli, $control);
$fila = mysqli_fetch_assoc($query);
?>

<?php
$control1 = "SELECT * FROM tipovehiculo";
$query3 = mysqli_query($mysqli, $control1);
$fila2 = mysqli_fetch_assoc($query3);
?>


<?php
if (isset($_POST['documento'], $_POST['contraseña'], $_POST['pin'])) {
    $documento = $_POST['documento'];
    $contraseña = $_POST['contraseña'];
    $pin = $_POST['pin'];



    $validar = "SELECT * FROM usuarios WHERE documento=$documento and contraseña=$contraseña and pin=$pin";
    $query1 = mysqli_query($mysqli, $validar);
    $fila3 = mysqli_fetch_assoc($query1);

    if (!$fila3) {
        echo "<script>alert('Este usuario no existe')</script>";
        # code...
    } elseif ($documento == "" || $contraseña == "" || $pin == "") {
        echo "<script>alert('Por favor llene los campos requeridos')</script>";
        # code...
    }
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
        <img src="images/imagengaso.jpg" alt="imagen1" class="header">


        <div class="formulario">
            <img src="images/logo.png" class="logo">
            <h4>ERROR AL INICIAR SESION</h4>
            <form method="POST" name="form" autocomplete="off" action="includes/inicio.php">
                <input type="number" name="documento" placeholder="Documento" maxlength="11">
                <input type="password" name="contraseña" placeholder="Contraseña" maxlength="8">
                <input type="number" name="pin" placeholder="Pin" maxlength="4">
                <div class="g-recaptcha" data-sitekey="6LebURQfAAAAAD8fkdJwgv-N6KaeDr9_aaq4dRHV"></div>
                <input type="submit" name="enviarFormulario" id="enviar" />

                <div class="help">
                    <a href="recordar.html" class="a1" type="text"> ¿No recuerda su clave?</a>

                    <a href="#" class="a2">ir a la Red</a>
                    <a href="registrar.php" class="a2">Registrate</a>
                </div>

                <div class="mintic">
                    <img src="images/logo-funcion.png" alt="">
                </div>
            </form>
        </div>
    </div>

</body>

</html>