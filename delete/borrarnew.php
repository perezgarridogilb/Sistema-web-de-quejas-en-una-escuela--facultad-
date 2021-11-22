<?php
session_start();
include("../conexion.php");
if (!isset($_SESSION['id_user'])) {
   header("Location: ../auth/adminLogin.php");
}

if ($_SESSION['usertype'] != 1) {
   header("Location: ../");
}

?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css" integrity="sha512-7w04XesEFaoeeKX0oxkwayDboZB/+AKNF5IUE50fCUDUywLvDN4gv2513TLQS+RDenAeHEK3O40jZZVrkpnWWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title>Ejemplo de Eliminaci�n</title>

   <script LANGUAGE="JavaScript">
      function confirmSubmit() {
         var eli = confirm("¿Est\u00E1 seguro de eliminar este registro?");
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

<body id="page-top">
   <!-- Navigation-->
   <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
   <nav id="sidebar-wrapper">
      <ul class="sidebar-nav">
         <li class="sidebar-brand text-white font-weight-bold">Sistema de quejas</li>
         <li class="sidebar-nav-item"><a href="./index.php">Inicio</a></li>
         <li class="sidebar-nav-item"><a href="./createReport.php">Crear reportes</a></li>
         <li class="sidebar-nav-item"><a href="./listReports.php">Listar reportes</a></li>
         <li class="sidebar-nav-item"><a href="./administrador/dashboard.php">Estadísticas</a></li>
         <li class="sidebar-nav-item"><a href="about.php">Acerca de nosotros</a></li>
         <hr>
         <li class="sidebar-nav-item"><a href="./auth/userLogin.php">Iniciar sesion</a></li>
         <li class="sidebar-nav-item"><a href="./auth/crearUsuario.php">Crear nueva cuenta</a></li>
         <li class="sidebar-nav-item"><a href="./auth/userLogin.php">Cerrar sesion</a></li>
      </ul>
   </nav>

   <BODY>
      <div class="container">
         <h2 class="text-center mt-5 text-primary mb-3">Administrar usuarios</h2>
         <hr class="mb-5 bg-primary" />
         <form>

            <body>

               <?php
               include("../conexion.php");

               $result = mysqli_query($conn, "select * from users");
               ?>
               <br>

               <table class='table table-hover'>
                  <thead class='thead-dark'>
                     <td class='fw-bold' align="center"><B>ID</B></TD>
                     <td class='fw-bold' align="center"><B>Nombre</B></TD>
                     <td class='fw-bold' align="center"><B>Correo</B></TD>
                     <td class='fw-bold' align="center"><B>Contraseña</B></TD>
                     <td class='fw-bold'>Operaciones</td>
                  </thead>
                  <tbody>
                     </TR>
                     <?php

                     while ($row = mysqli_fetch_array($result)) {

                        $nombre = $row["name"];
                        $correo = $row["mail"];
                        $contraseña = sha1($row["password"]);
                        $id_usuario = $row["id_user"];
                        printf("<tr><td align='center'>%d</td><td align='center'>%s</td><td align='center'>%s</td><td align='center'>%s</td>
                              <td class='d-flex align-items-center'>
                              <a onclick=\"return confirmSubmit()\"href=\"borrar2new.php?id_usuario=%s\">
                              <i class='bi bi-trash-fill text-danger' style='font-size: 1.25rem;'></i>
                              </a>     
                              </a>
                              <span style='width: .5rem;'></span>
                              <a href=\"actualizanew.php?id_usuario=%s\"><i class='bi bi-pencil-fill' style='font-size: 1.25rem;'></i>
                              </a>
                              </td>
                              </tr>", $id_usuario, $nombre, $correo, $contraseña, $id_usuario, $id_usuario);
                     }

                     mysqli_free_result($result);
                     mysqli_close($conn);
                     ?>
                  <tbody>
               </table>
            </body>
         </form>
      </div>

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
      <script src="assets/js/scripts.js"></script>

</html>