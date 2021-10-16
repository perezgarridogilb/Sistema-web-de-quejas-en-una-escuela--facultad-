<?php
include("../conexion.php");

//Creamos la sentencia SQL y la ejecutamos
$title = $_REQUEST['titulo'];
$content = $_REQUEST['contenido'];
$id = $_REQUEST['id'];

mysqli_query($conn, $sSQL);
$sSQL = "UPDATE reports SET title='$title', content='$content' WHERE id='$id'";
header("Location: borrarnew.php");
