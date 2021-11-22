<HTML>

<HEAD>
   <TITLE>Actualizar2.php</TITLE>
</HEAD>

<BODY>

   <?php
   include("../funcs/conexion.php");

   //Creamos la sentencia SQL y la ejecutamos
   $name = $_REQUEST['name'];
   $mail = $_REQUEST['mail'];
   $usertype = $_REQUEST['usertype'];
   $id = $_REQUEST['id'];
   echo "$name<br>";
   echo "$mail<br>";
   echo "$usertype<br>";
   echo "$id<br>";
   $sql = "UPDATE users SET name='$name', mail='$mail', usertype=$usertype WHERE id_user =$id";
   if ($conn->query($sql) === TRUE) {
   } else {
      echo "Error: " . $sql . "<br>" . $sql . $conn->error . "<br>";
   }
   header("Location: borrarnew.php");
   ?>

</BODY>

</HTML>