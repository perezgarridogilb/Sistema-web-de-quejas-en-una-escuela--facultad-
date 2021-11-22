<?php
include("../funcs/conexion.php");
session_start();
if ($_SESSION['usertype'] != 1) {
    header("Location: ../");
}

$id = $_GET['id'];
// mysqli_query($conn, "DELETE FROM images WHERE id_report = $id");
mysqli_query($conn, "UPDATE reports SET deleted_at=now() WHERE id = $id");
header("Location: ./adminReports.php?deleted=1");
