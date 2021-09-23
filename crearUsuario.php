<?php
include("conexion.php");

if (!empty($_POST)) {
  /*$contraseña = sha1(mysqli_real_escape_string($conn, $_POST['pass']));*/
  $sql = "INSERT INTO users (nombre, imagen, correo, contraseña, tipo_usuario) VALUES ('$_POST[nombre]', '$_POST[imagen]', '$_POST[correo]', '$_POST[password]', 1)";
  if ($conn->query($sql) === TRUE) {
    header("Location: sesion.php");
  } else {
      echo "Error: " . $sql . "<br>" . $sql . $conn->error . "<br>";
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
        <div>
        <ul>
          <li><a href="index.php" class="current"><span>Home</span></a></li>
          <li><a href="perfiles.php"><span>Perfiles</span></a></li>
        </ul>
        </div>
      </div>
    </div>
    <body>
      <h1>Crear usuario</h1>
      <span>or <a href="sesion.php">Iniciar sesion</a></span>
      <form action="crearUsuario.php" method="POST">
        <input name="nombre" type="text" placeholder="Ingresa tu nombre" required>
        <input name="imagen" type="text" placeholder="Ingresa tu imagen" required>
        <input name="correo" type="text" placeholder="Ingresa tu email" required>
        <input name="password" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
        <input type="submit" value="Guardar">
      </form>
    </body>
    <div id="footer"> <a href="#">homepage</a> | <a href="mailto:denise@mitchinson.net">contact</a> | <a href="http://validator.w3.org/check?uri=referer">html</a> | <a href="http://jigsaw.w3.org/css-validator">css</a> | &copy; 2007 Anyone | Design by <a href="http://www.mitchinson.net"> www.mitchinson.net</a><br />
      This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 License</a> </div>
    </body>

</html>