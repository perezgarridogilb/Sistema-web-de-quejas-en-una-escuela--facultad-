<HTML>
<HEAD>
<TITLE>Actualizar.php</TITLE>
</HEAD>
<BODY>
<h1>Actualizar un registro</h1>
<br>
<?php
   include("../conexion.php");  
   $id=$_GET['id_usuario'];
   //echo "<br> id Pelicula = $id";
echo '<FORM METHOD="POST" ACTION="actualiza2new.php">';

//Creamos la sentencia SQL y la ejecutamos
//$sSQL="Select titulo,director, actor From pelicula where id_pelicula='$id'";
//$result=mysql_query($sSQL);

$result = mysqli_query($conn, "select name,mail,usertype from users where id_user='$id'");
$row = mysqli_fetch_array($result);
$ti = $row["name"];
$di = $row["mail"];
$ac = $row["usertype"];

echo "Titulo  : <INPUT TYPE='text' NAME='name' value='$ti' SIZE='50'><br>";
echo "director: <INPUT TYPE='text' NAME='mail' value='$di' SIZE='50'><br>";
echo "Actor   : <INPUT TYPE='text' NAME='usertype' value='$ac' SIZE='50'><br>";
echo "<input type='hidden' name='id' value='$id'>";
?>
<br>
<hr>
 
<INPUT TYPE="SUBMIT" value="Actualizar">
</FORM>
</BODY>
</HTML> 