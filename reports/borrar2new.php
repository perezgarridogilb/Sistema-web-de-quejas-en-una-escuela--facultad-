<?php
include("../conexion.php");
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM reports WHERE id = $id");
header("Location: borrarnew.php");
