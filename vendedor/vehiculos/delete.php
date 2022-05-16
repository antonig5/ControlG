<?php
session_start();
require_once("../../connections/connection.php");

if (isset($_GET['idTvehiculo'])) {
    $id = $_GET['idTvehiculo'];
    $query = "DELETE FROM tipovehiculo WHERE idTvehiculo=$id ";
    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        die("error al eliminar");
    }

    header("Location: index.php");
}
