<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../auth/userLogin.php');
}

$userType = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bienvenido al sistema de quejas</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../assets/css/styles2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand text-white">
                Sistema de quejas
                <?php
                if ($userType != null) {
                    $nombre = $_SESSION['nombre'];
                    echo "<div class='name'>Bienvenido, <span class='fw-bold'>$nombre</span></div>";
                }
                ?>
            </li>
            <li class="sidebar-nav-item"><a href="../">Inicio</a></li>
            <?php
            if ($userType != null) {
                echo '<li class="sidebar-nav-item"><a href="../reports/createReport.php">Crear reportes</a></li>';
                echo '<li class="sidebar-nav-item"><a href="../dashboard.php">Estadísticas</a></li>';
            }
            ?>
            <li class="sidebar-nav-item"><a href="../reports/listReports.php">Listar reportes</a></li>
            <li class="sidebar-nav-item"><a href="../about.php">Acerca de nosotros</a></li>
            <hr class="bg-white">
            <?php
            if ($userType == null) {
                echo '<li class="sidebar-nav-item"><a href="../auth/userLogin.php">Iniciar sesion</a></li>';
                echo '<li class="sidebar-nav-item"><a href="../auth/crearUsuario.php">Crear nueva cuenta</a></li>';
            } else {
                echo '<li class="sidebar-nav-item"><a href="../auth/salir.php">Cerrar sesion</a></li>';
            }
            ?>
        </ul>
    </nav>

    <div class="container">
        <h2 class="text-center mt-5">Crear queja</h2>

        <form>
            <div class="form-group mb-5">
                <label for="exampleInputEmail1">Titulo</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa un titulo">
            </div>


            <div class="form-group mb-5">
                <label for="exampleInputEmail1">Contenido</label>
                <textarea class="form-control"></textarea>
            </div>

            <div class='text-center'>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container px-4 px-lg-5">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i class="icon-social-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i class="icon-social-twitter"></i></a>
                </li>
            </ul>
            <p class="text-muted small mb-0">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../assets/js/scripts.js"></script>
</body>

</html>