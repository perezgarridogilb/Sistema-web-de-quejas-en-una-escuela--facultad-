<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header('Location: ../index.php');
}

require '../funcs/conexion.php';
require '../funcs/funcs.php';

$errors = array();

if (!empty($_POST)) {
    $email = $mysqli->real_escape_string($_POST['email']);

    if (!isEmail($email)) {
        $errors[] = "Debe ingresar un correo eléctronico válido";
    }
    if (emailExiste($email)) {
        $id_user = getValor('id_user', 'mail', $email);
        $nombre = getValor('name', 'mail', $email);

        $token = generaTokenPass($id_user);

        $url = 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER['SERVER_PORT'] .
            '/Otono2021/Sistema-web-de-quejas-en-una-escuela-facultad/auth/cambia_pass.php?id_user=' . $id_user . '&token=' . $token;

        $asunto = 'Recuperar contraseña - Sistema web de quejas';
        $cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la 
			contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'> Cambiar contraseña </a>";

        if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {

            echo "Hemos enviado un correo electronico a la dirección 
				$email para restablecer la contraseña.<br />";
            echo "<a href='userLogin.php'> Iniciar sesi&oacute;n </a>";
            exit;
        } else {
            $errors[] = "Error al enviar Email";
        }
    } else {
        $errors[] = "No existe el correo electrónico";
    }
}

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../assets/css/styles2.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../assets/css/styles2.css" rel="stylesheet" />

</head>

<body class="bg-gradient-primary">
    <?php /*
    if ($error !== '') {
        echo "<div class='alert alert-danger'>$error</div>";
    } */

    include('../layout/menu.php');
    ?>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Cambiar la contraseña</h1>
                                </div>
                                <form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Correo" required>
                                    </div>

                                    <div style="margin-top:10px" class="form-group">
                                        <div class="text-center mt-3 mb-3">
                                            <button id="btn-login" type="submit" class="btn btn-primary">Enviar</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                                ¿No tiene una cuenta? <a href="crearUsuario.php">Registrate aquí</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php echo resultBlock($errors); ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../assets/js/scripts.js"></script>

</body>

</html>