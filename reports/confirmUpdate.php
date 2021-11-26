<?php
include("../funcs/conexion.php");

//Creamos la sentencia SQL y la ejecutamos
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];

$sSQL = "UPDATE reports SET title='$title', content='$content' WHERE id='$id'";

mysqli_query($conn, $sSQL);

$ds = DIRECTORY_SEPARATOR;
$storeFolder = '../medias';

if (!empty($_FILES)) {
    echo "FIles";
    $totalFiles = count($_FILES['file']['tmp_name']);
    $fileNames = array();

    for ($i = 0; $i < $totalFiles; $i++) {
        $tempFile = $_FILES['file']['tmp_name'][$i];
        $originalName = $_FILES['file']['name'][$i];
        if ($originalName != 'blob') {
            $tokens = explode($ds, $tempFile);
            $finalName = $tokens[count($tokens) - 1];
            $targetPath =
                dirname(__FILE__) . $ds . $storeFolder . $ds;
            $targetFile = $targetPath . $finalName;
            array_push($fileNames, $finalName);
            move_uploaded_file($tempFile, $targetFile);
        }
    }
}

foreach ($fileNames as $file) {
    $sql = "INSERT INTO images(id, id_report, image) VALUES (null, $id, '$file')";
    $result = mysqli_query($conn, $sql);
}
