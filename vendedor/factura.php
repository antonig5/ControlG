<?php
session_start();
require_once('../connections/connection.php');

$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "'and usuarios.idTus=tipouser.idTus";
$query = mysqli_query($mysqli, $sql);
$fila = mysqli_fetch_assoc($query);

///fechas
date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d h:i:s");

//traer vehiculos

$sql = "SELECT idTvehiculo, tipoVehiculo FROM tipovehiculo ";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);

///tipo gasolina
$sql1 = "SELECT idTGaso, tipoGasolina,precio FROM tipogasolina";
$result1 = mysqli_query($mysqli, $sql1);
$row1 = mysqli_fetch_assoc($result1);

if (isset($_POST['generar'])) {
    $tipogas = $_POST['idTGaso'];
    $can = $_POST['cantidad'];
    $vehiculo = $_POST['idTvehiculo'];
    // $sql1 = "SELECT * FROM tipogasolina ";
    // $resul = mysqli_query($mysqli, $sql1);
    // $ro = mysqli_fetch_assoc($result1);
    // $tot = $ro['precio'] * $can;
    // echo $tot;

    if (isset($_POST['cliente'])) {
        $id = $_POST['cliente'];
        $user = $_POST['idUs'];
        if ($id == "") {
            echo "<script>alert('sin resultados')
        </script>";
        } else {

            $fecha = $_POST['fecha'];
            $sql = "SELECT * FROM usuarios WHERE documento=$id and idTus=2 ";
            $result = mysqli_query($mysqli, $sql);


            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $sql = "INSERT INTO recibo (idTGaso, idUs,cliente,idTvehiculo,fecha,cantid) VALUES ('$tipogas','$user','$id','$vehiculo','$fecha','$can')";
                $result = mysqli_query($mysqli, $sql);
                if (!$result) {
                    die('F');
                } else {
                    header('Location:generarFac.php');
                }
            } else {
                echo "<script>alert('el documento no existe')
            </script>";
                echo '<script> window.location ="factura.php"</script>';
            }
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
    <link rel="stylesheet" href="../css/style/formV.css">
    <title>Document</title>
</head>

<body>
    <nav class="navMenu">
        <h3> Bienvenido <?php echo $fila["nombre"];  ?> <?php echo $fila["apellido"];  ?></h3>
        <span><?php echo $fila["tipo_user"]; ?></span>

        <a href="index.php">Inicio</a>
        <a href="servicios/index.php">Servicios</a>
        <a href="vehiculos/index.php">Vehiculos</a>

        <div class="dot"></div>
    </nav>
    <div class="contact_form ">
        <div>
            <form action="factura.php" method="POST" name="form">
                <label for="">combustible</label>
                <select name="idTGaso" id="">
                    <?php
                    do {
                    ?>

                        <option value="<?php echo $row1['idTGaso'] ?>"> <?php echo $row1['tipoGasolina'] ?>
                        <?php
                    } while ($row1 = mysqli_fetch_assoc($result1));
                        ?>
                </select>
                <label for="">vehiculo</label>
                <select name="idTvehiculo">
                    <?php
                    do {
                    ?>

                        <option value="<?php echo ($row['idTvehiculo']) ?>"> <?php echo ($row['tipoVehiculo']) ?>
                        <?php
                    } while ($row = mysqli_fetch_assoc($result));
                        ?>
                </select>
                <label for="">fecha</label>
                <input type="datetime" name="fecha" value="<?php echo $fecha_actual ?>">
                <label for="">cantidad</label>
                <input type="number" name="cantidad">
                <input type="hidden" name="idUs" value="<?php echo $_SESSION['id'] ?>">


                <label for="">cliente</label>

                <input type="number" name="cliente">
                <button type="submit" name="generar">enviar</button>

            </form>

        </div>
    </div>
</body>

</html>