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
   <?php
   include('../layout/menu.php');
   ?>
   <?php
   if (isset($_GET['updated'])) {
      echo "<div class='alert alert-primary'>Actualización exitosa</div>";
   }
   ?>

   <div class="container">
      <h2 class="text-center mt-5 text-primary mb-3">Actualizar un registro</h2>

      <hr class="mb-3 bg-primary" />
      <a class="d-block mb-3 text-decoration-none" href="./adminReports.php">Regresar a listado de usuarios</a>
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
   
</html>