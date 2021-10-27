<?php
session_start();
if (isset($_SESSION['id_user']) | empty($_POST['correo'])) {
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
                                    <h1 class="h4 text-gray-900 mb-4">Cambia tu contraseña<?php echo ' ' . $_POST['correo']; ?></h1>
                                </div>


                                <form class="user" method="POST" action="passwordRecover.php?correo=<?php echo $_POST['correo']; ?>">
                                    <div class="form-group">
                                        <input type="password"  name="passwd" placeholder="Ingresa tu contraseña nueva" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" required="true">
                                        <br> 
                                        <input type="password"  name="passwd_confirmation" placeholder="Repite tu contraseña nueva" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" required="true">
                                    </div>
                                    <div class="text-center mt-3 mb-3">
                                        <input type="submit" name="enviar" value="Reiniciar" class="btn btn-primary btn-user btn-block">
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
