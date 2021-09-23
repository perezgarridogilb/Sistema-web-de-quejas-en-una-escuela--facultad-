<?php
include("conexion.php");
session_start();

if (!empty($_POST)) {
  /* Se utiliza antes de insertar una cadena en una base de datos, ya que elimina 
    cualquier carácter especial que pueda interferir con las operaciones de consulta */
  $password = sha1(mysqli_real_escape_string($conn, $_POST['pass']));
  $sql = "SELECT id_usuario, nombre, correo, contraseña, tipo_usuario FROM users WHERE  correo='$_POST[user]' AND contraseña='$_POST[pass]'";
  $resultado = mysqli_query($conn, $sql);
  $rows = $resultado->num_rows;
  if ($rows > 0) {
    $row = mysqli_fetch_array($resultado);
    $_SESSION['id_usuario'] = $row['id_usuario'];
    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
    if ($_SESSION['tipo_usuario'] == 1) {
      header("Location: ./usuarios/index.php");
    } else {
      header("Location: ./administrador/index.php");
    }
  } else {
    echo 'Usuario o contraseña incorrecto';
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>*CHESSPIECE 2*</title>
  <link href="style.css" rel="stylesheet" />
  <meta http-equiv="Content-Type" />
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<div id="menucontaine" align="right"><a href="sesion.php">Iniciar sesion</a></div>
<div id="wrap">
  <div id="masthead">
  <h1 align="left">Sistema Web de quejas escolares</h1>
    <div id="menucontainer">
      <div id="menunav">
        <ul>
          <li><a href="index.php" class="current"><span>Home</span></a></li>
          <li><a href="perfiles.php"><span>Perfiles</span></a></li>
        </ul>
        <div>
        </div>
      </div>
    </div>

    <body>
      <h1>Iniciar sesión</h1>
      <span> o <a href="crearUsuario.php">Crear usuario</a></span>
      <form action="sesion.php" method="POST">
        <input name="user" type="text" placeholder="Ingresa tu email" required>
        <input name="pass" type="password" placeholder="Ingresa tu contraseña" required>
        <input type="submit" value="Ingresar">
      </form>
    </body>
    <div id="footer"> <a href="#">homepage</a> | <a href="mailto:denise@mitchinson.net">contact</a> | <a href="http://validator.w3.org/check?uri=referer">html</a> | <a href="http://jigsaw.w3.org/css-validator">css</a> | &copy; 2007 Anyone | Design by <a href="http://www.mitchinson.net"> www.mitchinson.net</a><br />
      This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 License</a> </div>
    </body>

</html>