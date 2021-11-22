<?php
include("../funcs/conexion.php");
session_start();
$failled_message = null;

$liveResults = mysqli_query($conn, "SELECT r.id, r.title, r.content, (SELECT image FROM images WHERE id_report = r.id LIMIT 1) as image, (SELECT count(id) FROM responses as r WHERE r.id_report = id) as counter_responses, (SELECT name FROM users as d WHERE d.id_user=r.id_user) as user FROM reports as r WHERE deleted_at IS NULL ORDER BY created_at");

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
    <link href="../assets/css/styles2.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css" integrity="sha512-7w04XesEFaoeeKX0oxkwayDboZB/+AKNF5IUE50fCUDUywLvDN4gv2513TLQS+RDenAeHEK3O40jZZVrkpnWWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            max-width: 500px;
        }

        .show-icon:hover {
            color: green;
            cursor: pointer;
        }

        .show-icon:hover+.hidden-image {
            display: block;
        }
    </style>
</head>

<body id="page-top">
    <?php
    include('../layout/menu.php');
    ?>

    <div class="container">
        <h2 class="text-center mt-5 text-primary mb-3">Lista de quejas</h2>
        <hr class="mb-5 bg-primary" />

        <?php
        if ($userType == 0) {
            echo "<a class='mb-5 d-inline-block text-decoration-none' href='createReport.php'>Crear nueva queja</a>";
        }

        ?>

        <table class='table table-hover'>
            <thead class='thead-dark'>
                <tr>
                    <td class='fw-bold'>Estado</td>
                    <td class='fw-bold'>Usuario</td>
                    <td class='fw-bold'>Titulo</td>
                    <td class='fw-bold'>Contenido</td>
                    <td class='fw-bold'>Imagen</td>
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

                    printf("<tr style='cursor: pointer' onclick='window.location = \"detail.php?id=$id\"'><td><div style='background-color: $statusBgColor; width: 25px; height: 25px;' class='d-flex  align-items-center justify-content-center'></div></td><td>%s</td><td>%s</td><td>%s</td>
                  <td class='image-container'>",  $user, $title, $content,);
                    if ($image != null) {
                        echo "<i class='show-icon bi bi-image-fill'></i>";
                        echo "<img class='hidden-image rounded img-fluid' src='../medias/$image'/>";
                    }
                }
                echo "</tr>";
                mysqli_free_result($liveResults);
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
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