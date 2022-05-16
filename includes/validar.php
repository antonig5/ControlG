<?php
if (!isset($_SESSION['id'])|| !isset($_SESSION['tipo'])) 
{
    header("Location: ../index.php");
    exit;
}
