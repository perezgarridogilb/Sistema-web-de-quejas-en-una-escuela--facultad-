<html>
<head>


</head>
<body>
<?php 
   include("../conexion.php");  
   $id=$_GET['id_usuario'];
   echo "El id usuario es : $id";  
   mysqli_query($conn, "DELETE FROM users WHERE id_usuario = '$id'"); 
   header("Location: borrarnew.php"); 
?> 
</body>
