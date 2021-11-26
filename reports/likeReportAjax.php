<?php
include('../funcs/conexion.php');
session_start();

$reportId = $_GET['reportId'];
$liked = ($_GET['liked'] == 1) ? true : false;
$userId = $_SESSION['id_user'];

if ($liked) {
    $sql = "INSERT INTO likes(id, id_report, id_user) VALUES(null, $reportId, $userId)";
} else {
    $sql = "DELETE FROM likes WHERE id_report=$reportId AND id_user=$userId";
}

mysqli_query($conn, $sql);
