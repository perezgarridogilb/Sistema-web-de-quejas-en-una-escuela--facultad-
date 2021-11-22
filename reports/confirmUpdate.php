<?php
include("../conexion.php");

if ($_SESSION['usertype'] != 1) {
    header("Location: ../");
}

//Creamos la sentencia SQL y la ejecutamos
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];

$sSQL = "UPDATE reports SET title='$title', content='$content' WHERE id='$id'";
mysqli_query($conn, $sSQL);
header("Location: updateReport.php?id=$id&updated=1");
