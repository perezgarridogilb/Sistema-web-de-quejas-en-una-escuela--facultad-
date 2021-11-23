<?php
include('../funcs/conexion.php');
include('../funcs/path.php');

$reportId = $_GET['reportId'];
$sql = "SELECT * FROM images WHERE id_report=$reportId";
$result = mysqli_query($conn, $sql);
$files = [];

while ($row = mysqli_fetch_array($result)) {
    array_push($files, [
        "id" => $row["id"],
        "name" => $row["image"],
        "url" => "http://" . "localhost/" . $rootProjectPath . "/medias/" . $row["image"],
        "size" => 12213
    ]);
}

header('Content-Type: application/json');
$jsonData = json_encode(["results" => $files]);
echo $jsonData;
