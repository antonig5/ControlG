<?php
require_once("connections/connection.php");
session_start();

if ((isset($_GET['MM_update'])) && ($_GET['MM_update'] == "form")) {

    $valit = $_GET['pass'];
    $dc = $_GET['document'];

    if ($_GET['pass'] == "" || $_GET['pass1'] == "") {

        echo "<script>alert('Por favor ingrese su nueva contraseña')</script>";
        echo '<script> window.location ="recordar.html"</script>';
    } else {

        $insert = "UPDATE usuarios SET contraseña = '$valit' WHERE documento = $dc";
        mysqli_query($mysqli, $insert);
        echo '<script> alert ("Se actualizo correctamente");</script>';
        echo '<script> window.location ="index.php"</script>';
    }
}
?>

<?php
if ($_GET['enviar']) {
    $documento = $_GET['documento'];
    $pin = $_GET['pin'];
    $sql = "SELECT * FROM usuarios WHERE documento=$documento and pin=$pin";
    $query = mysqli_query($mysqli, $sql);
    $fila = mysqli_fetch_assoc($query);



    if ($fila) {
        $_SESSION['id'] = $fila['documento'];
        $_SESSION['pine'] = $fila['pin'];


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

                    <form method="get" name="form" autocomplete="off">
                        <input id="pass1" type="password" name="pass" placeholder="Contraseña" maxlength="8" required>
                        <input id="pass2" type="password" name="pass1" placeholder="Repetir Contraseña" maxlength="8" required>
                        <input type="hidden" name="document" value="<?php echo $_SESSION['id']; ?>" ;>

                        <div class="g-recaptcha" data-sitekey="6LebURQfAAAAAD8fkdJwgv-N6KaeDr9_aaq4dRHV"></div>
                        <input type="submit" name="enviarr" id="enviar" value="Cambiar" />
                        <script src="pasvalid.js"></script>
                        <input type="hidden" name="MM_update" value="form" />
                        <div class="help">


                            <a href="#" class="a2">ir a la Red</a>
                            <a href="index.php" class="a2">Iniciar sesion</a>
                        </div>

                        <div class="mintic">
                            <img src="images/logo-funcion.png" alt="">
                        </div>
                    </form>
                </div>
            </div>

        </body>

        </html>

<?php
    } else {
        echo "<script>alert('El documento o pin no existen');</script>";
        echo '<script> window.location ="recordar.html"</script>';
    }
}
?>