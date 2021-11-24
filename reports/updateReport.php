 <?php
   session_start();
   include("../funcs/conexion.php");

   $id = $_GET['id'];
   $result = mysqli_query($conn, "SELECT * FROM reports WHERE id=$id");
   $row = mysqli_fetch_array($result);

   // if ($_SESSION['usertype'] != 1 && $_SESSION['id_user'] != $row['id_user']) {
   //    header("Location: ../");
   // }

   $userType = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : null;
   $title = $row["title"];
   $content = $row["content"];

   $sql = "SELECT id, id_report, image FROM images WHERE id_report=$id;";
   $imageRows = mysqli_query($conn, $sql);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
       <h2 class="text-center mt-5 text-primary mb-3">Actualizar queja</h2>

       <hr class="mb-3 bg-primary" />
       <?php
         $from = $_GET['from'];
         echo "<a class='d-block mb-3 text-decoration-none' href='$from'>Regresar</a>";
         ?>
       <form method="POST" id="report-form" action="confirmUpdate.php">
          <div class="mb-3">
             <label class="mb-1 fw-bold">Título *</label>
             <?php
               echo "<input class='form-control' type='text' name='title' value='$title' required>";
               ?>
          </div>

          <div class="mb-3">
             <label class="mb-1 fw-bold">Contenido *</label>
             <?php
               echo "<textarea rows='8' class='form-control' type='text' name='content' required>$content</textarea>";
               ?>
          </div>

          <?php
            echo "<input type='hidden' name='id' value='$id'>";
            ?>

          <h4>Imagenes</h4>
          <div id="dropzone" class="dropzone p-5 mb-5 ">
             <div class="dz-message h4">Suelta las imagenes aquí</div>
          </div>

          <input class="btn btn-primary mb-3" type="submit" value="Actualizar">

          <span id="storage" data-report-id="<?php include('../funcs/path.php');
                                             echo $id; ?>" data-root-project-path="<?php echo $rootProjectPath; ?>" />
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
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/badWords.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
       Dropzone.autoDiscover = false;

       let myDropzone = new Dropzone(
          document.querySelector("div#dropzone"), {
             url: "./confirmUpdate.php",
             method: "post",
             // The configuration we've talked about above
             autoProcessQueue: false,
             uploadMultiple: true,
             parallelUploads: 100,
             maxFiles: 100,
             acceptedFiles: 'image/*',
             addRemoveLinks: true,
             init: function() {
                dzClosure = this;
                const titleInput = document.querySelector('input[name="title"]');
                const contentInput = document.querySelector('textarea[name="content"]');
                const reportId = document.getElementById('storage').getAttribute('data-report-id');

                dzClosure.on('removedfile', function(file) {
                   fetch(`./deleteImageAjax.php?id=${file.id}`);
                });

                document.querySelector('#report-form').addEventListener('submit', function(e) {
                   e.preventDefault();
                   e.stopPropagation();

                   if (containsBadWords(titleInput.value) || containsBadWords(contentInput.value)) {
                      Toastify({
                         text: "El contenido de la queja es inadecuado. Por favor, verifica su contenido.",
                         duration: 3000,
                         backgroundColor: "#B91646",
                         gravity: "bottom",
                         position: "right",
                      }).showToast();

                      return;
                   }


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
                   formData.append("id", reportId);
                   formData.append("title", titleInput.value);
                   formData.append("content", contentInput.value);
                });

                dzClosure.on('sendingmultiple', function(data, xhr, formData) {
                   formData.append("id", reportId);
                   formData.append("title", titleInput.value);
                   formData.append("content", contentInput.value);
                });

                dzClosure.on('successmultiple', function(files, response) {
                   Toastify({
                      text: "Actualización exitosa!",
                      duration: 3000,
                      backgroundColor: "#396EB0",
                      gravity: "bottom",
                      position: "right",
                   }).showToast();
                });

                dzClosure.on('errormultiple', function(files, response) {
                   Toastify({
                      text: "Actualización fallida!",
                      duration: 3000,
                      backgroundColor: "#B91646",
                      gravity: "bottom",
                      position: "right",
                   }).showToast();
                });

             },
          });

       window.onload = async function() {
          const reportId = document.getElementById('storage').getAttribute('data-report-id');
          const rootProjectPath = document.getElementById('storage').getAttribute('data-root-project-path');
          const data = await fetch(`./reportImagesAjax.php?reportId=${reportId}`);
          const dataJson = await data.json();

          for (let image of dataJson.results) {
             const imageData = {
                id: image.id,
                name: image.name,
                kind: 'image',
                url: image.url,
                dataURL: image.url,
                size: image.size,
             };

             myDropzone.files.push(imageData);
             myDropzone.emit('addedfile', imageData);
             myDropzone.createThumbnailFromUrl(imageData,
                myDropzone.options.thumbnailWidth,
                myDropzone.options.thumbnailHeight,
                myDropzone.options.thumbnailMethod, true,
                function(thumbnail) {
                   myDropzone.emit('thumbnail', imageData, thumbnail);
                });

             myDropzone.emit('complete', imageData);
          }
       }
    </script>
 </body>

 </html>