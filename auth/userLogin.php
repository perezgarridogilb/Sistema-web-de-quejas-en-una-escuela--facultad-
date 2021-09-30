<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="../assets/css/index.css" rel="stylesheet">
</head>

<?php
include("../conexion.php");
session_start();

if (!empty($_POST)) {
  /* Se utiliza antes de insertar una cadena en una base de datos, ya que elimina 
    cualquier carácter especial que pueda interferir con las operaciones de consulta */
  $password = sha1(mysqli_real_escape_string($conn, $_POST['pass']));
  $sql = "SELECT id_usuario, nombre, correo, contraseña, tipo_usuario FROM users WHERE  correo='$_POST[user]' AND contraseña='$_POST[pass]' AND tipo=1";
  $resultado = mysqli_query($conn, $sql);
  $rows = $resultado->num_rows;
  if ($rows > 0) {
    $row = mysqli_fetch_array($resultado);
    $_SESSION['id_usuario'] = $row['id_usuario'];
    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
    header("Location: ./usuarios/index.php");
  } else {
    echo '<div class="alert alert-danger>Usuario o contraseña incorrecto</div>';
  }
}

?>

<body>
  <div class="container-fluid ps-md-0">
    <div class="row g-0">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-secondary justify-content-center align-items-center">
        <p class='text-center text-white h1'>
          Usuarios
        </p>
      </div>
      <div class="col-md-8 col-lg-6">
        <div class='p-2'>
          <a href='../'>Ir a inicio</a>
        </div>
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading mb-4 text-center">Bienvenido de nuevo!</h3>

                <!-- Sign In Form -->
                <form action='sesion.php' method='POST'>
                  <div class="form-floating mb-3">
                    <input type="user" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Correo</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="pass" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Contraseña</label>
                  </div>

                  <div class="d-grid">
                    <button class="btn btn-lg bg-primary text-white btn-login text-uppercase fw-bold mb-2" type="submit">Ingresar</button>
                    <div class="text-center">
                      <a class="small" href="./passwordRecover.php">¿Olvidaste la contraseña?</a> <span class='text-secondary'>|</span> <a class="small" href="./crearUsuario.php">Crea una cuenta</a>
                      <br />
                      <a class="small" href="./adminLogin.php">¿Eres administrador?</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>