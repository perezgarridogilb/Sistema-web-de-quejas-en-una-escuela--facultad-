<?php
include("../conexion.php");
session_start();
if ($_SESSION['tipo_usuario'] != 1) {
    header("Location: ../");
}

$id = $_GET['id'];
// mysqli_query($conn, "DELETE FROM images WHERE id_report = $id");
mysqli_query($conn, "UPDATE reports SET deleted_at=now() WHERE id = $id");
header("Location: ./adminReports.php?deleted=1");
