<?php
session_start();
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
  <link href="assets/css/styles2.css" rel="stylesheet" />
</head>

<body id="page-top">
  <?php
  include('./layout/menu.php');
  ?>

  <!-- Header-->
  <header class="masthead d-flex align-items-center">
    <div class="container px-4 px-lg-5 text-center">
      <h1 class="mb-1">Sistema de quejas</h1>
      <h3 class="mb-5"><em>Bienvenido, somos un sistema de seguimiento de quejas escolares que resuelve dudas, recolecta estadísticas y da retroalimentación.</em></h3>
      <?php
      if ($userType == null) {
        echo '<a class="btn btn-primary btn-xl" href="./auth/crearUsuario.php">Crear una cuenta</a>';
      } else {
        echo '<a class="btn btn-primary btn-xl" href="./reports/createReport.php">Crear una queja</a>';
      }
      ?>
    </div>
  </header>

  <!-- Services-->
  <section class="content-section bg-primary text-white text-center" id="services">
    <div class="container px-4 px-lg-5">
      <div class="content-section-heading">
        <h2 class="mb-5">Nuestra labor</h2>
      </div>
      <div class="row gx-4 gx-lg-5">
        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-screen-smartphone"></i></span>
          <h4><strong>Recolección de quejas</strong></h4>
        </div>
        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-pencil"></i></span>
          <h4><strong>Seguimiento</strong></h4>
        </div>
        <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
          <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-like"></i></span>
          <h4><strong>Respuesta rápida</strong></h4>
        </div>
        <div class="col-lg-3 col-md-6">
          <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-mustache"></i></span>
          <h4><strong>Estadísticas</strong></h4>
        </div>
      </div>
    </div>
  </section>
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
</body>

</html>