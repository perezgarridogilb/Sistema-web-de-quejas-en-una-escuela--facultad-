<?php
session_start();
include("../conexion.php");
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../auth/userLogin.php");
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $id_usuario = $_SESSION['id_usuario'];
    $query = mysqli_query($conn, "CALL update_password($id_usuario, '$password', '$new_password', @error)");
    $row = mysqli_fetch_assoc($query);
    $error = $row['error'];

    if ($error == '') {
        header('Location: ../index.php');
    }
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
    <?php
    if ($error !== '') {
        echo "<div class='alert alert-danger'>$error</div>";
    }

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

                                <form method="POST">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Contraseña actual</label>
                                        <input name="password" type="password" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Nueva contraseña</label>
                                        <input name="new_password" type="password" class="form-control" required>
                                    </div>

                                    <div class="text-center mt-3 mb-3">
                                        <input type="submit" class="btn btn-primary" value="Actualizar" />
                                    </div>
                                </form>
                            </div>
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