<?php
include("conexion.php"); 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
 }

echo '<a href=salir.php>Salir</a></br>';
echo 'bienvenido- ' . $_SESSION['id_usuario'];

?>
