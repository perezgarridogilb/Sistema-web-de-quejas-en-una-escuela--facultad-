<?php
session_start();
include('./funcs/conexion.php');

if (!isset($_SESSION['id_user'])) {
    header("Location: ./auth/adminLogin.php");
}

// Total of users
$sql = "SELECT count(id_user) AS total FROM users";
$resultado = mysqli_query($conn, $sql);
$usersCount = mysqli_fetch_assoc($resultado)["total"];

// Total of users created in the last month
$sql = "SELECT count(id_user) as total FROM users";
$resultado = mysqli_query($conn, $sql);
$lastMonthUsersCount = mysqli_fetch_assoc($resultado)["total"];

// Total of reports
$sql = "SELECT count(id) as total FROM reports";
$resultado = mysqli_query($conn, $sql);
$reportsCount = mysqli_fetch_assoc($resultado)["total"];

// Total of reports in the last month
$sql = "SELECT count(id) as total FROM reports WHERE MONTH(created_at)=MONTH(NOW()) and YEAR(created_at) = YEAR(NOW())";
$resultado = mysqli_query($conn, $sql);
$lastMonthReportsCount = mysqli_fetch_assoc($resultado)["total"];

$userType = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : null;

$liveResults = mysqli_query($conn, "SELECT r.id, r.title, r.content, (SELECT image FROM images WHERE id_report = r.id LIMIT 1) as image, (SELECT count(id) FROM responses as r WHERE r.id_report = id) as counter_responses, (SELECT name FROM users as d WHERE d.id_user=r.id_user) as user FROM reports as r WHERE deleted_at IS NULL AND (SELECT count(id) FROM responses as r WHERE r.id_report = id) = 0 ORDER BY created_at");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="./assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./assets/css/styles2.css" rel="stylesheet" />
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
</head>

<body>
    <?php
    include('./layout/menu.php');
    ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <div class="text-center mb-3">
                        <h2 class="text-center mt-5 text-primary">Panel de control</h2>
                    </div>

                    <hr class="mb-5 bg-primary" />
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Número de usuarios</div>
                                            <?php
                                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>$usersCount</div>"
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nuevos usuarios de este mes</div>
                                            <?php
                                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>$lastMonthUsersCount</div>"
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total de reportes</div>
                                            <?php
                                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>$reportsCount</div>"
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Reportes de este mes</div>
                                            <?php
                                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>$lastMonthReportsCount</div>"
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="mb-5 d-inline-block" href='./reports/adminReports.php'>Administrar reportes</a>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Últimos reportes sin respuesta</h6>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
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

                                                printf("<tr style='cursor: pointer' onclick='window.location = \"./reports/detail.php?id=$id\"'><td><div style='background-color: $statusBgColor; width: 25px; height: 25px;' class='d-flex  align-items-center justify-content-center'></div></td><td>%s</td><td>%s</td><td>%s</td>
                  <td class='image-container'>",  $user, $title, $content,);
                                                if ($image != null) {
                                                    echo "<i class='show-icon bi bi-image-fill'></i>";
                                                    echo "<img class='hidden-image rounded img-fluid' src='./medias/$image'/>";
                                                }
                                            }
                                            echo "</tr>";
                                            mysqli_free_result($liveResults);
                                            mysqli_close($conn);
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End of Main Content -->
                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Core plugin JavaScript-->
            <!-- <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script> -->

            <!-- Custom scripts for all pages-->
            <script src="./assets/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="./assets/js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="./assets/js/chart-area-demo.js"></script>
            <script src="./assets/js/chart-pie-demo.js"></script>
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="./assets/js/scripts.js"></script>

</body>

</html>