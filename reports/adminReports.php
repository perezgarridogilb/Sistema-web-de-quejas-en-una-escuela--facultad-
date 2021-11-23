<?php
session_start();
include("../funcs/conexion.php");
if (!isset($_SESSION['id_user'])) {
   header("Location: ../auth/adminLogin.php");
}

if ($_SESSION['usertype'] != 1) {
   header("Location: ../");
}

$userType = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : null;
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

<style>
   .image-container {
      position: relative;
   }

   .hidden-image {
      position: absolute;
      top: 2rem;
      left: 2rem;
      display: none;
      z-index: 99;
      max-width: 150px;
   }

   .show-icon:hover {
      color: green;
      cursor: pointer;
   }

   .show-icon:hover+.hidden-image {
      display: block;
   }
</style>

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
      include("../funcs/conexion.php");
      $liveResults = mysqli_query($conn, "SELECT r.id, r.title, r.content, (SELECT image FROM images WHERE id_report = r.id LIMIT 1) as image, (SELECT count(id) FROM responses as r WHERE r.id_report = id) as counter_responses, (SELECT name FROM users as d WHERE d.id_user=r.id_user) as user FROM reports as r WHERE deleted_at IS NULL ORDER BY created_at");
      $deletedResults = mysqli_query($conn, "SELECT r.id, r.title, r.content, (SELECT image FROM images WHERE id_report = r.id LIMIT 1) as image, (SELECT count(id) FROM responses as r WHERE r.id_report = id) as counter_responses, (SELECT name FROM users as d WHERE d.id_user=r.id_user) as user FROM reports as r WHERE deleted_at IS NOT NULL ORDER BY created_at");
      ?>

      <h4 class="mt-5 mb-3">Reportes</h4>
      <table class='table table-hover'>
         <thead class='thead-dark'>
            <tr>
               <td class='fw-bold'>ID</td>
               <td class='fw-bold'>Estado</td>
               <td class='fw-bold'>Usuario</td>
               <td class='fw-bold'>Titulo</td>
               <td class='fw-bold'>Contenido</td>
               <td class='fw-bold'>Imagen</td>
               <td class='fw-bold'>Operaciones</td>
            </tr>
         </thead>

         <tbody>
            <?php

            function truncate($text)
            {

               //specify number fo characters to shorten by
               $chars = 25;

               $text = $text . " ";
               $text = substr($text, 0, $chars);
               $text = substr($text, 0, strrpos($text, ' '));
               $text = $text . "...";
               return $text;
            }

            while ($row = mysqli_fetch_array($liveResults)) {
               $title = $row["title"];
               $content = truncate($row["content"]);
               $user = $row["user"];
               $id = $row["id"];
               $image = $row['image'];
               $nResponses = $row['counter_responses'];
               $status = ($nResponses == 0) ? "Sin resolver" : "Resuelta";
               $statusColor = ($nResponses == 0) ? "warning" : "success";
               $statusBgColor = ($nResponses == 0) ? "red" : "blue";

               printf("<tr ><td>%d</td><td><div style='background-color: $statusBgColor; width: 25px; height: 25px;' class='d-flex  align-items-center justify-content-center'></div></td><td>%s</td><td>%s</td><td>%s</td>
                  <td class='image-container'>", $id, $user, $title, $content,);
               if ($image != null) {
                  echo "<i class='show-icon bi bi-image-fill'></i>";
                  echo "<img class='hidden-image rounded img-fluid' src='../medias/$image'/>";
               }
               printf("</td>
                     <td>
                     <div class='d-flex align-items-center '>
                        <a class='text-decoration-none' onclick=\"return confirmSubmit()\" href=\"deleteReport.php?id=%s\">
                           <i class='bi bi-trash-fill text-danger' style='font-size: 1.25rem;'></i>
                        </a>
                        <span style='width: .5rem;'></span>
                        <a class='text-decoration-none' href=\"updateReport.php?id=%s&from=./adminReports.php\">
                           <i class='bi bi-pencil-fill' style='font-size: 1.25rem;'></i>
                        </a>
                     </div>
                     </td>
                  </tr>", $id, $id);
            }

            mysqli_free_result($liveResults);
            mysqli_close($conn);
            ?>
         </tbody>
      </table>

      <h4 class="mt-5 mb-3">Reportes eliminados</h4>

      <table class='table table-hover'>
         <thead class='thead-dark'>
            <tr>
               <td class='fw-bold'>ID</td>
               <td class='fw-bold'>Estado</td>
               <td class='fw-bold'>Usuario</td>
               <td class='fw-bold'>Titulo</td>
               <td class='fw-bold'>Contenido</td>
               <td class='fw-bold'>Imagen</td>
               <td class='fw-bold'>Operaciones</td>
            </tr>
         </thead>

         <tbody>
            <?php
            while ($row = mysqli_fetch_array($deletedResults)) {
               $title = $row["title"];
               $content = $row["content"];
               $user = $row["user"];
               $id = $row["id"];
               $image = $row['image'];
               $nResponses = $row['counter_responses'];
               $status = ($nResponses == 0) ? "Sin resolver" : "Resuelta";
               $statusColor = ($nResponses == 0) ? "warning" : "success";
               $statusBgColor = ($nResponses == 0) ? "red" : "blue";

               printf("<tr ><td>%d</td><td><div style='background-color: $statusBgColor; width: 25px; height: 25px;' class='d-flex  align-items-center justify-content-center'></div></td><td>%s</td><td>%s</td><td>%s</td>
               <td class='image-container'>", $id, $user, $title, $content,);
               if ($image != null) {
                  echo "<i class='show-icon bi bi-image-fill'></i>";
                  echo "<img class='hidden-image rounded img-fluid' src='../medias/$image'/>";
               }
               printf("</td>
                  <td class='d-flex align-items-center'>
                     <a class='text-decoration-none' href=\"./goBackDelete.php?id=%s\">
                        <i class='bi bi-arrow-counterclockwise'></i>
                     </a>
                     <span style='width: .5rem;'></span>
                  </td>
               </tr>", $id, $id);
            }

            mysqli_free_result($deletedResults);
            ?>
         </tbody>
      </table>
   </div>

   <script src="../assets/js/scripts.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>