<?php
session_start();
$userType = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nosotros</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/css/styles2.css" rel="stylesheet" />
</head>

<body>
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
            <li class="sidebar-nav-item"><a href="./">Inicio</a></li>
            <?php
            if ($userType != null) {
                echo '<li class="sidebar-nav-item"><a href="./reports/createReport.php">Crear reportes</a></li>';
                echo '<li class="sidebar-nav-item"><a href="./dashboard.php">Estadísticas</a></li>';
            }
            ?>
            <li class="sidebar-nav-item"><a href="./reports/listReports.php">Listar reportes</a></li>
            <li class="sidebar-nav-item"><a href="about.php">Acerca de nosotros</a></li>
            <hr class="bg-white">
            <?php
            if ($userType == null) {
                echo '<li class="sidebar-nav-item"><a href="./auth/userLogin.php">Iniciar sesion</a></li>';
                echo '<li class="sidebar-nav-item"><a href="./auth/crearUsuario.php">Crear nueva cuenta</a></li>';
            } else {
                echo '<li class="sidebar-nav-item"><a href="./auth/salir.php">Cerrar sesion</a></li>';
            }
            ?>
        </ul>
    </nav>

    <div class="container">
        <h2 class="h2 mt-5">Acerda de nosotros</h2>

        <p>Somos un sistema de reporte de quejas que permite dar seguimiento a las quejas, mostrar estadísticas y llevar un control de los usuarios registrados</p>
    </div>

    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>