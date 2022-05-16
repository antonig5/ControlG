<?php
session_start();
require_once("../../connections/connection.php");

if (isset($_GET['idTGaso'])) {
    $id = $_GET['idTGaso'];
    $query = "DELETE FROM tipogasolina WHERE idTGaso=$id ";
    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        die("error al eliminar");
    }

    header("Location: index.php");
}
