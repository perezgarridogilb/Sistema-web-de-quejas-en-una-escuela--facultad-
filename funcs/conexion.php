<?php

$mysqli = new mysqli("localhost", "root", "", "sistemaalumnos"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
$conn = $mysqli;

if (mysqli_connect_errno()) {
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}
