<?php
include("../conexion.php");
session_start();
if ($_SESSION['tipo_usuario'] != 1) {
    header("Location: ../");
}

$id = $_GET['id'];
echo $id;
echo mysqli_query($conn, "UPDATE reports SET deleted_at=NULL WHERE id = $id");

header("Location: ./adminReports.php");
