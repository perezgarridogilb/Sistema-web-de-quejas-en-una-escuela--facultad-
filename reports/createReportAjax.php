<?php
include("../conexion.php");

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../auth/userLogin.php');
}

$userType = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
$message = null;
$messageType = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['titulo'];
    $content = $_POST['contenido'];
    $usuario = $_SESSION['id_usuario'];

    $ds = DIRECTORY_SEPARATOR;
    $storeFolder = '../medias';

    if (!empty($_FILES)) {
        $totalFiles = count($_FILES['file']['tmp_name']);
        $fileNames = array();
        for ($i = 0; $i < $totalFiles; $i++) {
            $tempFile = $_FILES['file']['tmp_name'][$i];
            $originalName = $_FILES['file']['name'][$i];
            if ($originalName != 'blob') {
                $tokens = explode($ds, $tempFile);
                $finalName = $tokens[count($tokens) - 1];
                $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
                $targetFile = $targetPath . $finalName;
                array_push($fileNames, $finalName);
                move_uploaded_file($tempFile, $targetFile);
            }
        }

        $sql = "INSERT INTO reports(id,  id_user, title, content) VALUES (null, $usuario, '$title', '$content')";
        $result = mysqli_query($conn, $sql);
    }

    $sql = "INSERT INTO reports(id,  id_user, title, content) VALUES (null, $usuario, '$title', '$content')";
    $result = mysqli_query($conn, $sql);
    $id_report = mysqli_insert_id($conn);

    foreach ($fileNames as $file) {
        $sql = "INSERT INTO images(id, id_report, image) VALUES (null, $id_report, '$file')";
        $result = mysqli_query($conn, $sql);
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($_FILES);
}
