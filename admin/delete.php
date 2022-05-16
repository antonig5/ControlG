<?php
session_start();
require_once("../connections/connection.php");

if(isset($_GET['documento'])){
    $id=$_GET['documento'];
    $query = "DELETE FROM usuarios WHERE documento=$id ";
    $result=mysqli_query($mysqli,$query);
    if (!$result) {
        die("error al eliminar");
        
    }

  header("Location: usuarios.php");

}
