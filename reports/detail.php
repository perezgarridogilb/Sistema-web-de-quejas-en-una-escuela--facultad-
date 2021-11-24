<?php
session_start();
include("../funcs/conexion.php");
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/adminLogin.php");
}

$reportId = $_GET['id'];

# Fetch reports
$sql = "SELECT id, title, id_user, content, created_at, modified_at, (SELECT count(id) FROM responses as r WHERE r.id_report = id) as counter_responses FROM reports WHERE id=$reportId;";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);

if ($_SESSION['id_user'] == $row['id_user'] && $row['counter_responses'] < 1) {
    $onReturnUrl = urlencode("./listReports.php?id=$reportId");
    header("Location: ./updateReport.php?id=$reportId&from=$onReturnUrl");
}

# Fetch images
$sql = "SELECT id, id_report, image FROM images WHERE id_report=$reportId;";
$imageRows = mysqli_query($conn, $sql);
$userType = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : null;
$userId = $_SESSION['id_user'];

# Fetch like
$sql = "SELECT count(id) as count FROM likes WHERE id_report=$reportId AND id_user=$userId";
$result = mysqli_query($conn, $sql);
$hasAssignedLike = false;

if (mysqli_fetch_assoc($result)["count"] > 0) {
    $hasAssignedLike = true;
}

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <script>
        function handleToggledLiked(liked) {
            const likedIcon = document.getElementById('liked-icon');
            const nonLikedIcon = document.getElementById('nonliked-icon');
            const reportId = document.getElementById('storage').getAttribute('data-report-id');
            let likedFlag = 0;

            if (likedIcon.classList.contains('d-none')) {
                likedFlag = 1;
                likedIcon.classList.remove('d-none');
                nonLikedIcon.classList.add('d-none');
            } else {
                nonLikedIcon.classList.remove('d-none');
                likedIcon.classList.add('d-none');
            }

            fetch(`./likeReportAjax.php?reportId=${reportId}&liked=${likedFlag}`, );
        }
    </script>
</head>

<body id="page-top">
    <?php
    include('../layout/menu.php');
    ?>
    <div class="container">
        <h2 class="text-center mt-5 text-primary mb-3">Detalle de queja</h2>
        <hr class="mb-5 bg-primary" />

        <a class="text-decoration-none mb-3 d-block" href='./listReports.php'>Ver listado de quejas</a>

        <?php
        $title = $row['title'];
        $content = $row['content'];
        $createdAt = $row['created_at'];
        $modifiedAt = $row['modified_at'];
        $nResponses = $row['counter_responses'];
        $status = ($nResponses == 0) ? "Sin resolver" : "Resuelta";
        $statusColor = ($nResponses == 0) ? "warning" : "success";
        $statusBgColor = ($nResponses == 0) ? "rgba(255, 193, 7, 0.1)" : "rgba(25, 134, 83, 0.1)";
        $notImages = true;

        echo "<div class='p-5 rounded bg-light'>";

        echo "<div class='d-flex align-items-center'>";
        if ($hasAssignedLike) {
            echo '<i onclick="handleToggledLiked()" id="liked-icon" class="bi bi-star-fill" style="color: #ffd700; cursor: pointer"></i>';
            echo '<i onclick="handleToggledLiked()" id="nonliked-icon" class="bi bi-star d-none" style="cursor: pointer"></i>';
        } else {
            echo '<i onclick="handleToggledLiked()" id="liked-icon" class="bi bi-star-fill d-none" style="color: #ffd700; cursor: pointer"></i>';
            echo '<i onclick="handleToggledLiked()" id="nonliked-icon" class="bi bi-star" style="cursor: pointer; "></i>';
        }

        echo "<h2 class='h3 m-0 p-2'>$title</h2>";
        echo "</div>";
        echo "<span class='fw-bold'>Creado:</span> $createdAt <span>|</span> <span class='fw-bold'>Modificado:</span> $modifiedAt <br>";
        echo "<span class='mt-n1 fw-bold'>Estado:</span> $status <br>";
        echo "<hr class='bg-dark'>";
        echo '<p class="mt-3">';
        echo $content;
        echo '</p>';

        echo "</div>";

        echo "<div class='my-4' />";
        echo "<h4 class='text-center'>Imagenes</h4>";
        echo "<div class='row'>";
        while ($imageRow = mysqli_fetch_array($imageRows)) {
            $notImages = false;
            $image = $imageRow['image'];
            echo "<img  class='img-fluid col-6 rounded p-3' src='../medias/$image'/>";
        }
        if ($notImages) {
            echo "<div class='text-center p-5 mb-4 bg-light rounded-3'> No hay imagenes disponibles</div>";
        }
        echo "</div>";
        echo "</div>";

        if ($userType == 1) {
            $idUser = $_SESSION['id_user'];

            // Solo moderadores
            echo "<div class='py-3'><hr/></div>";
            echo "<h2 class='text-center mt-5'>Agregar respuesta</h2>" .
                "<form method='POST' action='./addResponse'>" .
                '<div class="form-group mb-3">' .
                '<label class="mb-1 fw-bold">Contenido *</label>' .
                "<input type='number' hidden name='user_id' value='$idUser'>" .
                '<textarea rows="8" name="content" placeholder="Redacta la respuesta..." class="form-control" required></textarea>' .
                '</div>' .
                "<div class='text-center'>" .
                '<button type="submit" class="btn btn-primary">Enviar</button>' .
                '</div>' .
                '</form>';
        }
        ?>

        <span id='storage' data-report-id="<?php echo $reportId ?>" />

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