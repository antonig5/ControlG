<?php
session_start();
require_once("../../connections/connection.php");

$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "' and usuarios.idTus=tipouser.idTus";
$query1 = mysqli_query($mysqli, $sql);
$rows = mysqli_fetch_assoc($query1);

$query = "SELECT * FROM tipogasolina";
$result_tasks = mysqli_query($mysqli, $query);
$result_tasks = mysqli_query($mysqli, $query);
$articulosPagina = 3;
$totalArticulos = mysqli_num_rows($result_tasks);
$paginas = $totalArticulos / 3;
$paginas = ceil($paginas);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style/tableV.css">
    <title>Document</title>
</head>

<body>
    <nav class="navMenu">
        <h3 style="color: black;"> Bienvenido <?php echo $rows["nombre"];  ?> <?php echo $rows["apellido"];  ?></h3>
        <span style="color: black;"><?php echo $rows["tipo_user"]; ?></span>

        <a href="../index.php">Inicio</a>
        <a href="../vehiculos/index.php">Vehiculos</a>
        <a href="../factura.php">Factura</a>
        <a href="registrar2.php">Registrar</a>
        <div class="dot"></div>
    </nav>
    <div>
        <?php
        if (!$_GET) {
            header("Location:index.php?pagina=1");
        }
        $inicio = ($_GET['pagina'] - 1) * $articulosPagina;
        $query = "SELECT * FROM tipogasolina LIMIT $inicio,$articulosPagina";

        $result_tasks = mysqli_query($mysqli, $query);
        ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Gasolina</th>
                    <th>Precio</th>
                    <th></th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_tasks)) {
                ?>
                    <tr>
                        <td><?php echo $row['idTGaso']; ?></td>
                        <td><?php echo $row['tipoGasolina']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td>
                            <a href="delete.php?idTGaso=<?php echo $row['idTGaso'] ?>">
                                Delete
                            </a>
                        <th>
                            <a href="view.php?idTGaso=<?php echo $row['idTGaso'] ?> #openModal">
                                Ver
                            </a>
                        </th>
                        <th>
                            <a href="edit.php?idTGaso=<?php echo $row['idTGaso'] ?> ">
                                Editar
                            </a>
                        </th>
                        </td>
                    </tr>
                <?php } ?>
                <nav aria-label="Page navigation example" style="margin: 350px; padding:0px 110px">
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