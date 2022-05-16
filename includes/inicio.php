
<?php
include("../connections/connection.php");
session_start();
if ($_POST["enviarFormulario"]) {
    $documento = $_POST['documento'];
    $contraseña = $_POST['contraseña'];
    $pin = $_POST['pin'];

    $coneccion = "SELECT * FROM usuarios WHERE documento=$documento and contraseña = $contraseña and pin=$pin";
    $query = mysqli_query($mysqli, $coneccion);
    $fila1 = mysqli_fetch_assoc($query);

    if ($fila1) {
        $_SESSION['id'] = $fila1['documento'];
        $_SESSION['nom'] = $fila1['nombre'];
        $_SESSION['ape'] = $fila1['apellido'];
        $_SESSION['tipo'] = $fila1['idTus'];
        if ($_SESSION['tipo'] == 1) {
            header("Location: ../admin/index.php");
            exit();
            # code...
        }
        if ($_SESSION['tipo'] == 2) {
            header("Location: ../cliente/index.php");
            exit();
            # code...
        }
        if ($_SESSION['tipo'] == 3) {
            header("Location: ../vendedor/index.php");
            exit();
            # code...
        } elseif ($documento == "" || $contraseña == "" || $pin == "") {
            echo "<script>alert('Por favor llene los campos requeridos')</script>";
            # code...
        }


        # code...
    } else {

        header("Location: ../loginerror.php");

        exit();
    }
}

?>

