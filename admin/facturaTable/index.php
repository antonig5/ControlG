<?php
require_once("../../connections/connection.php");
session_start();
$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "' and usuarios.idTus=tipouser.idTus";
$query1 = mysqli_query($mysqli, $sql);
$rows = mysqli_fetch_assoc($query1);
$query = "SELECT * FROM recibo  ";
$result_tasks = mysqli_query($mysqli, $query);
$articulosPagina = 5;
$totalArticulos = mysqli_num_rows($result_tasks);
$paginas = $totalArticulos / 5;
$paginas = ceil($paginas);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/style/table-copy.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body style="background-color: #272727;">
    <nav class="navMenu">
        <h3 style="color: black;"> Bienvenido <?php echo $rows["nombre"];  ?> <?php echo $rows["apellido"];  ?></h3>
        <span style="color: black;"><?php echo $rows["tipo_user"]; ?></span>
        <a href="../index.php">Inicio</a>
        <a href="../usuarios.php">Usuarios</a>
        <a href="../servicios/index.php">Servicios</a>
        <a href="../vehiculos/index.php">Vehiculos</a>

        <div class="dot"></div>
    </nav>
    <div>
        <?php
        if (!$_GET) {
            header("Location:index.php?pagina=1");
        }
        $inicio = ($_GET['pagina'] - 1) * $articulosPagina;
        $query = "SELECT * FROM recibo INNER JOIN tipogasolina ON tipogasolina.idTGaso = recibo.idTGaso INNER JOIN tipovehiculo ON tipovehiculo.idTvehiculo = recibo.idTvehiculo INNER JOIN usuarios ON usuarios.documento = recibo.idUs  LIMIT $inicio,$articulosPagina";

        $result_task = mysqli_query($mysqli, $query);
        ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Combustible</th>
                    <th>Cantidad</th>
                    <th>fecha</th>
                    <th>Action</th>
                    <th></th>


                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_task)) {
                ?>
                    <tr>
                        <td><?php echo $row['idRecibo']; ?></td>
                        <td><?php echo $row['tipoGasolina']; ?></td>
                        <td><?php echo $row['cantid']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>

                        <td>
                            <a id="hh" href="delete.php?idRecibo=<?php echo $row['idRecibo'] ?>">
                                Delete
                            </a>
                        </td>
                        <td>
                            <a href="factura.php?idRecibo=<?php echo $row['idRecibo'] ?> ">
                                Factura
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                <nav aria-label="Page navigation example" style="margin: 446px; padding: 0px 21px">
                    <ul class="pagination">
                        <?php
                        for ($i = 0; $i < $paginas; $i++) :
                        ?>
                            <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                                <a href="index.php?pagina=<?php echo $i + 1 ?>" class="page-link"><?php echo $i + 1 ?></a>
                            </li>
                        <?php endfor ?>
                    </ul>

                </nav>

            </tbody>

        </table>

    </div>
</body>

</html>