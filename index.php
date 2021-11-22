<<<<<<< HEAD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>*CHESSPIECE 2*</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
  <div id="menucontaine" align="right" ><a href="sesion.php">Iniciar sesion</a></div> 
<div id="wrap">
  <div id="masthead">
    <h1 align="left">Sistema Web de quejas escolares</h1>
    <div id="menucontainer">
      <div id="menunav">
        <ul>
          <li><a href="index.php" class="current"><span>Home</span></a></li>
          <li><a href="perfiles.php" ><span>Perfiles</span></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div id="container">
    <div id="sidebar">
      <h2>Sidebar</h2>
      <form action="#" method="post">
        <fieldset>
        <legend>Search</legend>
        <div> <span>
          <label for="txtsearch"> search:<img src="images/magnify.png" alt="search" /></label>
          </span> <span>
          <input type="text" value="demo only"name="txtsearch" title="Text input: search" id="txtsearch" size="25" />
          </span> </div>
        </fieldset>
      </form>
      <img src="images/img.gif" alt="" />
      <div id="navcontainer">
        <ul>
          <li><a href="#">Snapp Happy</a> </li>
          <li><a href="#">OPEN DESIGNS</a> </li>
          <li><a href="#">ANDREAS VIKLUND</a> </li>
          <li><a href="#">JAMES KOSTER</a> </li>
          <li><a href="#">CSS play</a> </li>
          <li><a href="#">LISTAMATIC </a> </li>
          <li><a href="#"> LAYOUTGALA </a> </li>
          <li><a href="#"> BLUEROBOT </a> </li>
        </ul>
      </div>
      <p>Texto </p>
    </div>
    <div id="content">
      <h2>Bienvenido al <span style="font-weight:bold; color:#4592BE;">Sistema de quejas escolares</span> Universitario</h2>
      <p>Texto </p>
      <blockquote>This template has been tested in Mozilla Firefox and IE7. The page validates as XHTML 1.0 Transitional using valid CSS. It will work in browser widths of 800x600, 1024x768 &amp; 1280x1064. The images used in this template are courtesy of <a href="http://www.sxc.hu/" title="free images">stock xchng</a>. The top navigation menu is from <a href="http://www.13styles.com/" title="free CSS menus">13 Styles</a> and has been amended to suit this template. <br />
        For more FREE CSS templates visit <a href="http://www.mitchinson.net">my website</a>.</blockquote>
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse in odio et nibh </p>
    </div>
  </div>
</div>
<div id="footer"> <a href="#">homepage</a> | <a href="mailto:denise@mitchinson.net">contact</a> | <a href="http://validator.w3.org/check?uri=referer">html</a> | <a href="http://jigsaw.w3.org/css-validator">css</a> | &copy; 2007 Anyone | Design by <a href="http://www.mitchinson.net"> www.mitchinson.net</a><br/>
  This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 License</a> </div>
</body>
</html>
=======
<?php
session_start();
$userType = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : null;
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
>>>>>>> 86d9ac7f980dd6991afba801696a9d4256ba81c4
