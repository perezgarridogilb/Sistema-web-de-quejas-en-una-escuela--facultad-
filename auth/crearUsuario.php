<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header('Location: ../index.php');
}

require '../funcs/conexion.php';
require '../funcs/funcs.php';

$errors = array();

if (!empty($_POST)) {
  $nombre = $mysqli->real_escape_string($_POST['nombre']);
  $password = $mysqli->real_escape_string($_POST['password']);
  $con_password = $mysqli->real_escape_string($_POST['con_password']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);

  $activo = 0;
  $tipo_usuario = 0;
  $secret = '6LdXFEQdAAAAAONwDP7xK-QqWFD1s50psF_RQBbC';

  if (!$captcha) {
    $errors[] = "Porfavor verifica el captcha";
  }

  if (isNull($nombre, $password, $con_password, $email)) {
    $errors[] = "Debe llenar todos los campos";
  }

  if (!isEmail($email)) {
    $errors[] = "Dirección de correo inválida";
  }

  if (!validaPassword($password, $con_password)) {
    $errors[] = "Las contraseñas no coinciden";
  }

  if (emailExiste($email)) {
    $errors[] = "El correo electronico $email ya existe";
  }
  if (count($errors) == 0) {
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

    $arr = json_decode($response, TRUE);

    if ($arr['success']) {

      $pass_hash = hashPassword($password);
      $token = generateToken();

      $registro = registraUsuario($nombre, $email, $password, $tipo_usuario, $activo, $token);

      if ($registro > 0) {

        $url = 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER['SERVER_PORT'] .
          '/Otono2021/Sistema-web-de-quejas-en-una-escuela-facultad/auth/activar.php?id=' . $registro . '&val=' . $token;

        $asunto = 'Activar cuenta - Sistema de Usuarios';
        $cuerpo = "Estimado $nombre: <br /><br />Para continuar con
			el proceso de registro es indispensable de click en la 
			siguiente liga <a href='$url'>Activar cuenta</a>";

        if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {

          echo 'Para terminar el proceso de registro siga las instrucciones que le enviamos al correo electronico: ' . $email;
          echo "<br><a href='userLogin.php'>Iniciar sesion</a>";
          exit;
        } else {
          $errors[] = "Error al enviar correo electronico";
        }
      } else {
        $errors[] = "Error al registrar";
      }
    } else {
      $errors[] = 'Error al comprobar Captcha';
    }
  }
}

?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../assets/css/index.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
  <link href="../assets/css/styles2.css" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js"></script>

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
    <div class="panel-body">
      <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
        <div class='p-2'>
          <a href='../'>Ir a inicio</a>
        </div>
        <div class="panel-heading">
          <div class="panel-title">
            <h2>Reg&iacute;strate</h2>
          </div>
          <p>Rellena los campos para crear una nueva cuenta!</p>
        </div>
        <hr>
        <div class="form-group">
          <div class="col"><input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" required="required"></div>
        </div>

        <div class="form-group">
          <input type="email" class="form-control" name="email" placeholder="Correo" value="<?php if (isset($email)) echo $email; ?>" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Contraseña" required="required">
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="con_password" placeholder="Confirmar contraseña" required="required">
        </div>

        <div class="form-group">
          <label for="captcha" class="col-md-3 control-label"></label>
          <div class="g-recaptcha col-md-9" data-sitekey="6LdXFEQdAAAAAD8NRTVVju55NG6cIBLTZ3UlE7DT"></div>
        </div>

        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <button id="btn-signup" type="submit" class="btn btn-info text-white"><i class="icon-hand-right"></i>Registrar</button>
          </div>
        </div>

      </form>
      <?php echo resultBlock($errors); ?>
      <div class="hint-text">¿Ya tienes una cuenta? <a href="userLogin.php">Ingresa aquí</a></div>
    </div>
  </div>
</body>

</html>