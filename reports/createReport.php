<?php
include("../conexion.php");

session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: ../auth/userLogin.php');
}

$userType = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : null;
$message = null;
$messageType = null;

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    .dropzone {
        background: white;
        border-radius: 5px;
        border: 2px dashed rgb(0, 135, 247);
        border-image: none;
        margin-left: auto;
        margin-right: auto;
        color: #aaa;
    }

    div#dropzone:hover {
        cursor: pointer;
        background-color: rgb(0, 135, 247, 0.1);
    }
</style>

<body id="page-top">
    <?php

    if ($message != null) {
        echo "<div class='alert alert-$messageType'>$message</div>";
    }
    ?>

    <?php
    include('../layout/menu.php');
    ?>

    <div class="container">
        <h2 class="text-center mt-5 text-primary mb-3">Crear queja</h2>
        <hr class="mb-3 bg-primary" />

        <div class='mb-3'>
            <a class="text-decoration-none" href='./listReports.php'>Ver listado de reportes</a>
        </div>
        <form id='report-form' enctype="multipart/form-data" method='POST'>
            <div class="form-group mb-3">
                <label class="mb-1 fw-bold">Título *</label>
                <input name='titulo' type="text" class="form-control" placeholder="Ingresa un título" required>
            </div>

            <div class="form-group mb-3">
                <label class="mb-1 fw-bold">Contenido *</label>
                <textarea rows="8" name='contenido' placeholder="Redacta tu queja aquí..." class="form-control" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label class="mb-1 fw-bold">Imagenes</label>
            </div>

            <div id="dropzone" class="dropzone p-5 mb-5 ">
                <div class="dz-message h4">Suelta las imagenes aquí</div>
            </div>

            <div class='text-center'>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone(
            document.querySelector("div#dropzone"), {
                url: "./createReportAjax.php",
                method: "post",
                // The configuration we've talked about above
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                acceptedFiles: 'image/*',
                init: function() {
                    dzClosure = this;
                    const titleInput = document.querySelector('input[name="titulo"]');
                    const contentInput = document.querySelector('textarea[name="contenido"]');

                    document.querySelector('#report-form').addEventListener('submit', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (dzClosure.getQueuedFiles().length === 0) {
                            var blob = new Blob();
                            blob.upload = {
                                'chunked': false
                            };
                            dzClosure.uploadFile(blob);
                        } else {
                            dzClosure.processQueue();
                        }
                    });

                    // My project only has 1 file hence not sendingmultiple
                    dzClosure.on('sending', function(data, xhr, formData) {
                        formData.append("titulo", titleInput.value);
                        formData.append("contenido", contentInput.value);
                    });

                    dzClosure.on('sendingmultiple', function(data, xhr, formData) {
                        formData.append("titulo", titleInput.value);
                        formData.append("contenido", contentInput.value);
                    });

                    dzClosure.on('successmultiple', function(files, response) {
                        titleInput.value = '';
                        contentInput.value = '';
                        dzClosure.removeAllFiles();
                        alert('Envio Exitoso');
                    });

                    dzClosure.on('errormultiple', function(files, response) {
                        alert('Envio Fallido');
                    });

                },
            });
    </script>
</body>

</html>