<html>

<head>


</head>

<body>
   <?php
   include("../funcs/conexion.php");
   $id = $_GET['id_user'];
   echo "El id usuario es : $id";
   mysqli_query($conn, "DELETE FROM users WHERE id_user = '$id'");
   header("Location: borrarnew.php");
   ?> </body>