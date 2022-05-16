<?php
require_once("../connections/connection.php");
session_start();
$sql = "SELECT * FROM usuarios,tipouser WHERE documento='" . $_SESSION['id'] . "' and usuarios.idTus=tipouser.idTus";
$query1 = mysqli_query($mysqli, $sql);
$rows = mysqli_fetch_assoc($query1);
$query = "SELECT * FROM usuarios, tipouser WHERE usuarios.idTus=tipouser.idTus ";
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
    <link rel="stylesheet" href="../css/style/table.css">
    <title>Document</title>
</head>

<body>
    <nav class="navMenu">
        <h3 style="color: black;"> Bienvenido <?php echo $rows["nombre"];  ?> <?php echo $rows["apellido"];  ?></h3>
        <span style="color: black;"><?php echo $rows["tipo_user"]; ?></span>
        <a href="index.php">Inicio</a>
        <a href="servicios/index.php">Servicios</a>
        <a href="vehiculos/index.php">Vehiculos</a>
        <a href="facturaTable/index.php">Reporte cliente</a>
        <a href="registrar1.php">Registar</a>
        <div class="dot"></div>
    </nav>
    <div>
        <?php
        if (!$_GET) {
            header("Location:usuarios.php?pagina=1");
        }
        $inicio = ($_GET['pagina'] - 1) * $articulosPagina;
        $query = "SELECT * FROM usuarios, tipouser WHERE usuarios.idTus=tipouser.idTus LIMIT $inicio,$articulosPagina";

        $result_task = mysqli_query($mysqli, $query);
        ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Documento</th>
                    <th>Tipo</th>
                    <th>Foto</th>

                    <th></th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_task)) {
                ?>
                    <tr>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['documento']; ?></td>
                        <td><?php echo $row['tipo_user']; ?></td>
                        <td><?php echo (' <img src="../images/fotos/' . $row['foto'] . '" width="100"> ') ?></td>
                        <td>
                            <a href="delete.php?documento=<?php echo $row['documento'] ?>">
                                Delete
                            </a>
                        </td>
                        <td>
                            <a href="view.php?documento=<?php echo $row['documento'] ?> #openModal">
                                Ver
                            </a>
                        </td>
                        <td>
                            <a href="editt.php?documento=<?php echo $row['documento'] ?> ">
                                Editar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                <nav aria-label="Page navigation example" style="margin: 615px; position:relative; left:-20%">
                    <ul class="pagination">
                        <?php
                        for ($i = 0; $i < $paginas; $i++) :
                        ?>
                            <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                                <a href="usuarios.php?pagina=<?php echo $i + 1 ?>" class="page-link"><?php echo $i + 1 ?></a>
                            </li>
                        <?php endfor ?>
                    </ul>

                </nav>

            </tbody>

        </table>

    </div>
</body>

</html>