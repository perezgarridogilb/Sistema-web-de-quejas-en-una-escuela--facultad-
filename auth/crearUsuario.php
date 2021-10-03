<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
  header('Location: ../index.php');
}
?>

<?php
include("../conexion.php");

$failled_message = null;

if (!empty($_POST)) {
  /*$contraseña = sha1(mysqli_real_escape_string($conn, $_POST['pass']));*/
  $sql = "INSERT INTO users (nombre, imagen, correo, contraseña, tipo_usuario) VALUES ('$_POST[nombre]', '', '$_POST[correo]', '$_POST[password]', 0)";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['id_usuario'] = $row['id_usuario'];
    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
    header("Location: ../index.php");
  } else {
    $correo = $_POST['correo'];
    $failled_message = "Ya existe una cuenta existente relacionada con el correo $correo";
    echo "Error: " . $sql . "<br>" . $sql . $conn->error . "<br>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../assets/css/index.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
  <link href="../assets/css/styles2.css" rel="stylesheet">

  <style>
    body {
      color: #fff;
      background: rgb(29, 128, 159);
      font-family: 'Roboto', sans-serif;
    }

    .form-control {
      height: 41px;
      background: #f2f2f2;
      box-shadow: none !important;
      border: none;
    }

    .form-control:focus {
      background: #e2e2e2;
    }

    .form-control,
    .btn {
      border-radius: 3px;
    }

    .signup-form {
      width: 400px;
      margin: 30px auto;
    }

    .signup-form form {
      color: #999;
      border-radius: 3px;
      margin-bottom: 15px;
      background: #fff;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
    }

    .signup-form h2 {
      color: #333;
      font-weight: bold;
      margin-top: 0;
    }

    .signup-form hr {
      margin: 0 -30px 20px;
    }

    .signup-form .form-group {
      margin-bottom: 20px;
    }

    .signup-form input[type="checkbox"] {
      margin-top: 3px;
    }

    .signup-form .row div:first-child {
      padding-right: 10px;
    }

    .signup-form .row div:last-child {
      padding-left: 10px;
    }

    .signup-form .btn {
      font-size: 16px;
      font-weight: bold;
      background: rgb(29, 128, 159);
      border: none;
      min-width: 140px;
    }

    .signup-form .btn:hover,
    .signup-form .btn:focus {
      background: #2389cd !important;
      outline: none;
    }

    .signup-form a {
      color: #fff;
      text-decoration: underline;
    }

    .signup-form a:hover {
      text-decoration: none;
    }

    .signup-form form a {
      color: rgb(29, 128, 159);
      text-decoration: none;
    }

    .signup-form form a:hover {
      text-decoration: underline;
    }

    .signup-form .hint-text {
      padding-bottom: 15px;
      text-align: center;
    }
  </style>
</head>


<body>
  <div class="signup-form">
    <form method="post">
      <div class='p-2'>
        <a href='../'>Ir a inicio</a>
      </div>

      <h2>Registro</h2>
      <p>Rellena los campos para crear una nueva cuenta!</p>


      <?php
      if ($failled_message != null) {
        echo "<div class='alert alert-danger'>";
        echo $failled_message;
        echo "</div>";
      }
      ?>
      <hr>
      <div class="form-group">
        <div class="col"><input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" required="required"></div>
      </div>

      <div class="form-group">
        <input type="email" class="form-control" name="correo" placeholder="Correo" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Contraseña" required="required">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-lg text-white">Registrar</button>
      </div>
    </form>

    <div class="hint-text">¿Ya tienes una cuenta? <a href="userLogin.php">Ingresa aquí</a></div>
  </div>
</body>

</html>