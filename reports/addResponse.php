<?php
session_start();
include("../funcs/conexion.php");

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/adminLogin.php");
}

$userId = $_SESSION['id_user'];
$reportId = $_POST['id_report'];
$content = $_POST['content'];

$sql = "INSERT INTO responses(id, id_report, id_user, content, created_at, modified_at) VALUES(NULL, $reportId, $userId, '$content', now(), now())";
$resultado = mysqli_query($conn, $sql);
echo $resultado;

header('Location: ./listReports.php');
