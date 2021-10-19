<?php
$rootProjectPath = "/Otono2021/Sistema-web-de-quejas-en-una-escuela-facultad";
?>

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
        <?php
        echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/'>Inicio</a></li>";
        if ($userType != null) {
            echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/reports/createReport.php'>Crear reportes</a></li>";
            echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/dashboard.php'>Estadísticas</a></li>";
        }
        echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/reports/listReports.php'>Listar reportes</a></li>";
        if ($userType === 0) {
            echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/reports/adminReports.php'>Administrar reportes</a></li>";
        }
        echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/about.php'>Acerca de nosotros</a></li>";
        echo "<hr class='bg-white'>";

        if ($userType == null) {
            echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/auth/userLogin.php'>Iniciar sesion</a></li>";
            echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/auth/crearUsuario.php'>Crear nueva cuenta</a></li>";
        } else {
            echo "<li class='sidebar-nav-item'><a href='$rootProjectPath/auth/salir.php'>Cerrar sesion</a></li>";
        }
        ?>
    </ul>
</nav>