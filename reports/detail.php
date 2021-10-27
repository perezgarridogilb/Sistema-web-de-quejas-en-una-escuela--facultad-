<?php
session_start();
include("../conexion.php");
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../auth/adminLogin.php");
}

$reportId = $_GET['id'];
$sql = "SELECT id, title, content, created_at, modified_at, (SELECT count(id) FROM responses as r WHERE r.id_report = id) as counter_responses FROM reports WHERE id=$reportId;";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);
$sql = "SELECT id, id_report, image FROM images WHERE id_report=$reportId;";
$imageRows = mysqli_query($conn, $sql);
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
    <link href="../assets/css/styles2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <?php
    include('../layout/menu.php');
    ?>

    <div class="container">
        <h2 class="text-center mt-5 text-primary mb-3">Detalle de queja</h2>
        <hr class="mb-5 bg-primary" />

        <a class="text-decoration-none" href='./listReports.php'>Ver listado de reportes</a>

        <?php
        $title = $row['title'];
        $content = $row['content'];
        $createdAt = $row['created_at'];
        $modifiedAt = $row['created_at'];
        $nResponses = $row['counter_responses'];
        $status = ($nResponses == 0) ? "Sin resolver" : "Resuelta";
        $statusColor = ($nResponses == 0) ? "warning" : "success";
        $statusBgColor = ($nResponses == 0) ? "rgba(255, 193, 7, 0.1)" : "rgba(25, 134, 83, 0.1)";

        echo "<h2 class='text-center'>$title</h2>";
        echo "<div style='8px' class='d-flex justify-content-between'>";
        echo "<div><span class='fw-bold'>Estado:</span> $status</div>";
        echo "<p class='text-end'><span class='fw-bold'>Creado:</span> $createdAt <span>|</span> <span class='fw-bold'>Modificado:</span> $modifiedAt</p>";
        echo "</div>";
        echo '<p class="mt-3">';
        echo $content;
        echo '</p>';

        echo "<h4>Imagenes</h4>";
        echo "<div class='row'>";
        while ($imageRow = mysqli_fetch_array($imageRows)) {
            $image = $imageRow['image'];
            echo "<img class='img-fluid col-6 rounded' src='../medias/$image'/>";
        }
        echo "</div>";

        if ($userType == 1) {
            // Solo moderadores
            echo "<div class='py-3'><hr/></div>";
            echo "<h2 class='text-center mt-5'>Agregar respuesta</h2>" .
                "<form method='POST'>" .
                '<div class="form-group mb-3">' .
                '<label class="mb-1 fw-bold">Contenido *</label>' .
                '<textarea rows="8" name="contenido" placeholder="Redacta la respuesta..." class="form-control" required></textarea>' .
                '</div>' .
                "<div class='text-center'>" .
                '<button type="submit" class="btn btn-primary">Enviar</button>' .
                '</div>' .
                '</form>';
        }
        ?>
    </div>

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
    <script src="../assets/js/scripts.js"></script>
</body>

</html>