<?php

require '../funcs/conexion.php';
require '../funcs/funcs.php';

$id_user = $mysqli->real_escape_string($_POST['id_user']);
$token = $mysqli->real_escape_string($_POST['token']);
$password = $mysqli->real_escape_string($_POST['password']);
$con_password = $mysqli->real_escape_string($_POST['con_password']);

if (validaPassword($password, $con_password)) {
	$pass_hash = $password;

	if (cambiaPassword($pass_hash, $id_user, $token)) {
		echo 'Ha sido modificado';
		echo "<br><a href='userLogin.php'>Iniciar sesi&oacute;n</a>";
	} else {
		echo 'Error al mdf passwd';
	}
} else {
	echo 'Las passwd no coincidens';
}
