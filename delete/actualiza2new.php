<HTML>

<HEAD>
   <TITLE>Actualizar2.php</TITLE>
</HEAD>

<BODY>

   <?php
   include("../conexion.php");

   //Creamos la sentencia SQL y la ejecutamos
   $ti = $_REQUEST['titulo'];
   $di = $_REQUEST['director'];
   $ac = $_REQUEST['actor'];
   $id = $_REQUEST['id'];
   echo "$ti<br>";
   echo "$di<br>";
   echo "$ac<br>";
   echo "$id<br>";
   $SQL = "UPDATE users SET name='$ti',mail='$di',usertype='$ac' WHERE id_user ='$id'";
   mysqli_query($conn, $SQL);
   header("Location: borrarnew.php");
   ?>

</BODY>

</HTML>