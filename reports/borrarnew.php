<?php
session_start();
include("../conexion.php");
// if (!isset($_SESSION['id_usuario'])) {
//    header("Location: ../auth/adminLogin.php");
// }

$userType = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Ejemplo de Eliminaci�n</title>

   <script LANGUAGE="JavaScript">
      function confirmSubmit() {
         var eli = confirm("Est� seguro de eliminar este registro?");
         if (eli) return true;
         else return false;
      }
   </script>
   <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
   <!-- Simple line icons-->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
   <!-- Google fonts-->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
   <!-- Core theme CSS (includes Bootstrap)-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link href="../assets/css/styles2.css" rel="stylesheet" />
</head>

<body id='page-top'>
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
      <h2 class="text-center mt-5 text-primary mb-3">Eliminacion/Actualizacion de reportes</h2>
      <hr class="mb-5 bg-primary" />

      <?php
      include("../conexion.php");
      $result = mysqli_query($conn, "SELECT * FROM reports");
      ?>
      <table class='table table-hover'>
         <thead class='thead-dark'>
            <tr>
               <td class='fw-bold'>ID</td>
               <td class='fw-bold'>Titulo</td>
               <td class='fw-bold'>Contenido</td>
               <td class='fw-bold'>Operaciones</td>
            </tr>
         </thead>

         <tbody>
            <?php

            while ($row = mysqli_fetch_array($result)) {
               $title = $row["title"];
               $content = $row["content"];
               $id = $row["id"];
               printf("<tr><td>%d</td><td>%s</td><td>%s</td>
               <td class='text-left'>
               <a class='text-decoration-none' onclick=\"return confirmSubmit()\" href=\"borrar2new.php?id=%s\"><img src='eliminar.bmp' width='14' height='14'><span>  Eliminar</a> |
               <a class='text-decoration-none' href=\"actualizanew.php?id=%s\"><img src='actualiza.jpg' width='25' height='25'>  Actualizar</a>
               </td>
               </tr>", $id, $title, $content, $id, $id);
            }

            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
         </tbody>
      </table>
   </div>

   <script src="../assets/js/scripts.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>