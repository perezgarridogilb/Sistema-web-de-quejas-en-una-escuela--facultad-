<?php
<<<<<<< HEAD

$conn = new mysqli("localhost", "root", "", "sistemaalumnos");

if ($conn->connect_errno) {
	echo "No hay conexión: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
=======
	
<<<<<<< HEAD
	$conn = new mysqli("localhost","root","root","sistemaalumnos");
=======
	$conn = new mysqli("localhost","root","","sistemaalumnos");
>>>>>>> 86d9ac7f980dd6991afba801696a9d4256ba81c4
	
	if($conn->connect_errno)
	{
		echo "No hay conexión: (" . $conn->connect_errno . ") " . $conn->connect_error;
		
	}
	
	?>
>>>>>>> rama
