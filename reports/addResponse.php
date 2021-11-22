<?php
session_start();
include("../conexion.php");

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/adminLogin.php");
}

$reportId = $_POST['id_report'];
$userId = $_POST['user_id'];
$content = $_POST['content'];

$sql = "INSERT INTO responses(id, id_report, id_user, content, created_at, modified_at) VALUES(0, $reportId, $userId, $content, now(), now())";
$resultado = mysqli_query($conn, $sql);

header('Location: ./listReports.php');
