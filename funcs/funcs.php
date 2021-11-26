<?php

function isNull($nombre, $pass, $pass_con, $email)
{
	if (strlen(trim($nombre)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1) {
		return true;
	} else {
		return false;
	}
}

function isEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

function validaPassword($var1, $var2)
{
	if (strcmp($var1, $var2) !== 0) {
		return false;
	} else {
		return true;
	}
}

function minMax($min, $max, $valor)
{
	if (strlen(trim($valor)) < $min) {
		return true;
	} else if (strlen(trim($valor)) > $max) {
		return true;
	} else {
		return false;
	}
}


function emailExiste($email)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT id_user FROM users WHERE mail = ? LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function generateToken()
{
	$gen = md5(uniqid(mt_rand(), false));
	return $gen;
}

function hashPassword($password)
{
	$hash = password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

function resultBlock($errors)
{
	if (count($errors) > 0) {
		echo "<div class='alert alert-danger'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
		foreach ($errors as $error) {
			echo "<li>" . $error . "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

function registraUsuario($nombre, $email, $password, $tipo_usuario, $activo, $token)
{

	global $mysqli;

	$stmt = $mysqli->prepare("INSERT INTO users (name, mail, password, usertype, activate, token) VALUES(?,?,?,?,?,?)");
	$stmt->bind_param('sssiis', $nombre, $email, $password, $tipo_usuario, $activo, $token);

	if ($stmt->execute()) {
		return $mysqli->insert_id;
	} else {
		return 0;
	}
}

function enviarEmail($email, $nombre, $asunto, $cuerpo)
{

	require_once '../PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls'; //Modificar
	$mail->Host = 'smtp.gmail.com'; //Modificar
	$mail->Port = 587; //Modificar

	$mail->Username = 'secarmesi@gmail.com'; //Modificar
	$mail->Password = ''; //Modificar

	$mail->setFrom('secarmesi@gmail.com', 'Sistema web de quejas'); //Modificar
	$mail->addAddress($email, $nombre);

	$mail->Subject = $asunto;
	$mail->Body    = $cuerpo;
	$mail->IsHTML(true);

	if ($mail->send())
		return true;
	else
		return false;
}

function validaIdToken($id, $token)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT activate FROM users WHERE id_user = ? AND token = ? LIMIT 1");
	$stmt->bind_param("is", $id, $token);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if ($rows > 0) {
		$stmt->bind_result($activacion);
		$stmt->fetch();

		if ($activacion == 1) {
			$msg = "La cuenta ya se activo anteriormente.";
		} else {
			if (activarUsuario($id)) {
				$msg = 'Cuenta activada.';
			} else {
				$msg = 'Error al Activar Cuenta';
			}
		}
	} else {
		$msg = 'No existe el registro para activar.';
	}
	return $msg;
}

function activarUsuario($id)
{
	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE users SET activate=1 WHERE id_user = ?");
	$stmt->bind_param('s', $id);
	$result = $stmt->execute();
	$stmt->close();
	return $result;
}

function isNullLogin($email, $password)
{
	if (strlen(trim($email)) < 1 || strlen(trim($password)) < 1) {
		return true;
	} else {
		return false;
	}
}

function login($email, $password)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT id_user, typeuser, password FROM users WHERE user = ? || mail = ? LIMIT 1");
	$stmt->bind_param("ss", $email, $email);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if ($rows > 0) {

		if (isActivo($email)) {

			$stmt->bind_result($id, $id_tipo, $passwd);
			$stmt->fetch();

			$validaPassw = password_verify($password, $passwd);

			if ($validaPassw) {


				$_SESSION['id_user'] = $id;
				$_SESSION['usertype'] = $id_tipo;

				header("location: welcome.php");
			} else {

				$errors = "La contrase&ntilde;a es incorrecta";
			}
		} else {
			$errors = 'El usuario no esta activo';
		}
	} else {
		$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
	}
	return $errors;
}

function isActivo($email)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT activate FROM users WHERE user = ? || mail = ? LIMIT 1");
	$stmt->bind_param('ss', $email, $email);
	$stmt->execute();
	$stmt->bind_result($activacion);
	$stmt->fetch();

	if ($activacion == 1) {
		return true;
	} else {
		return false;
	}
}

function generaTokenPass($id_user)
{
	global $mysqli;

	$token = generateToken();

	$stmt = $mysqli->prepare("UPDATE users SET token_password=?, password_request=1 WHERE id_user = ?");
	$stmt->bind_param('ss', $token, $id_user);
	$stmt->execute();
	$stmt->close();

	return $token;
}

function getValor($campo, $campoWhere, $valor)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT $campo FROM users WHERE $campoWhere = ? LIMIT 1");
	$stmt->bind_param('s', $valor);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;
	} else {
		return null;
	}
}

function getPasswordRequest($id)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->bind_result($_id);
	$stmt->fetch();

	if ($_id == 1) {
		return true;
	} else {
		return null;
	}
}

function verificaTokenPass($id_user, $token)
{

	global $mysqli;

	$stmt = $mysqli->prepare("SELECT activate FROM users WHERE id_user = ? AND token_password = ? AND password_request = 1 LIMIT 1");
	$stmt->bind_param('is', $id_user, $token);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($activacion);
		$stmt->fetch();
		if ($activacion == 1) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function cambiaPassword($password, $id_user, $token)
{

	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE users SET password = ?, token_password='', password_request=0 WHERE id_user = ? AND token_password = ?");
	$stmt->bind_param('sis', $password, $id_user, $token);

	if ($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}

function previusKeys($id_user, $password)
{

	global $mysqli;

	$stmt = $mysqli->prepare("SELECT password FROM previous_passwords WHERE id_user = ?");
	$stmt->bind_param('i', $id_user);
	$stmt->execute();
	$stmt->bind_result($passwd);

	$band = 0;
	while ($stmt->fetch()) {
		if ($passwd == $password) {
			$band = 1;
		}
	}

	if ($band != 1) {
		return true;		
	} else {
		return false;
	}
}

function guardaPass($password, $id_user, $con_password, $token)
{
	if (validaPassword($password, $con_password)) {
		$pass_hash = $password;
		previusKeys($pass_hash, $id_user);
		if (cambiaPassword($pass_hash, $id_user, $token)) {
			echo 'Ha sido modificado';
			echo "<br><a href='userLogin.php'>Iniciar sesi&oacute;n</a>";
		} else {
			echo 'Error al modificar contraseñas';
		}
	} else {
		echo 'Las contraseñas no coinciden';
	}
}
