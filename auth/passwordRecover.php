<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header('Location: ../index.php');
    include("../conexion.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../assets/css/styles2.css" rel="stylesheet">

    <?php
    if (!empty($_POST)) {
        $conn = new mysqli("localhost", "root", "", "sistemaalumnos");
        if ($_REQUEST['passwd'] != $_REQUEST['passwd_confirmation']) {
            echo "Incorrecta";
        } else {
            $correo = $_GET['correo'];
            $result = mysqli_query($conn, "select id_user from users where mail='$correo'");
            while ($row = mysqli_fetch_array($result)) {
                $id_user = $row["id_user"];
            }
            $band = 0;
            $result = mysqli_query($conn, "select password from previous_passwords where id_user=$id_user");
            while ($row = mysqli_fetch_array($result)) {
                $passwd = $row["password"];
                if ($_REQUEST['passwd'] != $passwd) {
                    $band = 1;
                }
            }
            if ($band != 0) {
                echo "<div class='alert alert-primary'>Esta contraseña es antigua</div>";
            } else {
                echo "<div class='alert alert-primary'>Guardado</div>";
            }
        }
    }

    ?>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class='p-2'>
                            <a href='../'>Ir a inicio</a>
                        </div>

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">¿Olvidaste la contraseña?</h1>
                                </div>
                                <form class="user" method="POST" action="changePassword.php">
                                    <div class="form-group">
                                        <input type="email" name="correo" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingresa tu mail" required>
                                    </div>
                                    <div class="text-center mt-3 mb-3">
                                        <input type="submit" value="Reiniciar" class="btn btn-primary btn-user btn-block">
                                    </div>
                                </form>
                                <div class="row justify-content-center">
                                    <div class="col text-center">
                                        <a class="small" href="crearUsuario.php">Crea una cuenta!</a>
                                    </div>
                                    <div class="col text-center">
                                        <a class="small" href="userLogin.php">¿Ya tienes una cuenta? Ingresa!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>