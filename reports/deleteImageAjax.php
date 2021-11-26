<?php
include('../funcs/conexion.php');
$imageId = $_GET['id'];
$sql = "DELETE FROM images WHERE id=$imageId";
mysqli_query($conn, $sql);
