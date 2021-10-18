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
         <h2 class="text-center mt-5">Actualizar un registro</h2>
         <form>
            <br>
            <?php
            include("../conexion.php");
            $id = $_GET['id_usuario'];
            /* echo "<br> id usuario = $id"; */
            echo '<FORM METHOD="POST" ACTION="actualiza2new.php">';

            //Creamos la sentencia SQL y la ejecutamos
            //$sSQL="Select titulo,director, actor From pelicula where id_pelicula='$id'";
            //$result=mysql_query($sSQL);

            $result = mysqli_query($conn, "select nombre,correo,tipo_usuario from users where id_usuario='$id'");
            $row = mysqli_fetch_array($result);
            $ti = $row["nombre"];
            $di = $row["correo"];
            $ac = $row["tipo_usuario"];


            echo "<form><div class='form-group mb-5'> <label for='exampleInputEmail1'>Nombre: </label> <INPUT TYPE='text' class='form-control' NAME='titulo' value='$ti' SIZE='50'><br>";
            echo "<label for='exampleInputEmail1'>Correo: </label><INPUT TYPE='text' class='form-control' NAME='director' value='$di' SIZE='50'><br>";
            echo "<label for='exampleInputEmail1'>Tipo usuario: </label><INPUT TYPE='text' class='form-control' NAME='actor' value='$ac' SIZE='50'><br></div>";
            echo "<input type='hidden' name='id' value='$id'> ";

            ?>

            <div class='text-center'>
               <button type="submit" class="btn btn-primary" name='id' value=<?php $id; ?>>Enviar</button>
            </div>
         </form>
         <br>
         
   </BODY>
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
   <script src="assets/js/scripts.js"></script>

</html>