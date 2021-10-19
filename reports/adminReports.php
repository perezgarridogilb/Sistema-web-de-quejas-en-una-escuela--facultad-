<?php
session_start();
include("../conexion.php");
if (!isset($_SESSION['id_usuario'])) {
   header("Location: ../auth/adminLogin.php");
}

if ($_SESSION['tipo_usuario'] != 1) {
   header("Location: ../");
}

$userType = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
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
         var eli = confirm("Está seguro de eliminar este registro?");
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
   <?php
   include('../layout/menu.php');
   if (isset($_GET['deleted'])) {
      echo "<div class='alert alert-primary'>Eliminación exitosa</div>";
   }
   ?>

   <div class="container">
      <h2 class="text-center mt-5 text-primary mb-3">Administrar reportes</h2>
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
                  <td class='d-flex align-items-center'>
                     <a class='text-decoration-none' onclick=\"return confirmSubmit()\" href=\"deleteReport.php?id=%s\">
                        <i class='bi bi-trash-fill text-danger' style='font-size: 1.25rem;'></i>
                     </a>
                     <span style='width: .5rem;'></span>
                     <a class='text-decoration-none' href=\"updateReport.php?id=%s\">
                        <i class='bi bi-pencil-fill' style='font-size: 1.25rem;'></i>
                     </a>
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