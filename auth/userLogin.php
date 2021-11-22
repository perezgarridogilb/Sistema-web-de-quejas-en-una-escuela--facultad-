<?php
session_start();
if (isset($_SESSION['id_user'])) {
  header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/index.css" rel="stylesheet">
  <link href="../assets/css/styles2.css" rel="stylesheet" />
</head>

<?php
include("../conexion.php");
$failled_message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  /* Se utiliza antes de insertar una cadena en una base de datos, ya que elimina 
    cualquier carácter especial que pueda interferir con las operaciones de consulta */
  $sql = "SELECT id_user, name, mail, password, usertype FROM users WHERE  mail='$_POST[user]' AND password='$_POST[pass]' AND usertype=0";
  $resultado = mysqli_query($conn, $sql);
  $rows = $resultado->num_rows;

  if ($rows > 0) {
    $row = mysqli_fetch_array($resultado);
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['usertype'] = $row['usertype'];
    $_SESSION['name'] = $row['name'];
    header("Location: ../index.php");
  } else {
    $failled_message = "Usuario y/o contraseña incorrecto";
  }
}

?>

<body>
  <div class="container-fluid ps-md-0">
    <div class="row g-0">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-black justify-content-center align-items-center">
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
                <div class="login-heading mb-2">
                  <h3 class="text-center mb-2">Bienvenido de nuevo!</h3>
                  <?php if ($failled_message != null) {
                    echo "<div class='alert alert-danger'>";
                    echo $failled_message;
                    echo "</div>";
                  } ?>

                </div>
                <!-- Sign In Form -->
                <form method='POST'>
                  <div class="form-floating mb-3">
                    <input name="user" type="email" class="form-control" placeholder="name@example.com" required>
                    <label for="floatingInput">Correo</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input name="pass" type="password" class="form-control" placeholder="Password" required>
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