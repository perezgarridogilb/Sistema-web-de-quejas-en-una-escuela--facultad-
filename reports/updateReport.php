<?php
session_start();
include("../conexion.php");

if ($_SESSION['tipo_usuario'] != 1) {
   header("Location: ../");
}

$userType = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM reports WHERE id=$id");
$row = mysqli_fetch_array($result);
$title = $row["title"];
$content = $row["content"];
?>


<!DOCTYPE html>

<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Actualizar.php</title>
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
      <a class="d-block mb-3 text-decoration-none" href="./adminReports.php">Regresar a listado de quejas</a>
      <form method="POST" action="confirmUpdate.php">
         <div class="mb-3">
            <label class="form-label">Titulo</label>
            <?php
            echo "<input class='form-control' type='text' name='title' value='$title'>";
            ?>
         </div>

         <div class="mb-3">
            <label class="form-label">Contenido</label>
            <?php
            echo "<input class='form-control' type='text' name='content' value='$content'>";
            ?>
         </div>

         <?php
         echo "<input type='hidden' name='id' value='$id'>";
         ?>

         <input class="btn btn-primary" type="submit" value="Actualizar">
      </form>
   </div>
   <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
   <script src="../assets/js/scripts.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>