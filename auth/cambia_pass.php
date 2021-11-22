<?php

require '../funcs/conexion.php';
require '../funcs/funcs.php';

$id_user = null;
$token = null;

if (empty($_GET['id_user'])) {
	header('Location: ../index.php');
}
if (empty($_GET['token'])) {
	header('Location: ../index.php');
}
$id_user = $mysqli->real_escape_string($_GET['id_user']);
$token = $mysqli->real_escape_string($_GET['token']);

if (!verificaTokenPass($id_user, $token)) {
	echo 'No se pudo verificar los Datos';
	exit;
}

?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="../assets/css/styles2.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class='p-2'>
							<a href='../'>Ir a inicio</a>
						</div>

						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Cambia tu contraseña<?php echo ' ' . getValor('name', 'id_user', $id_user); ?></h1>
								</div>

								<form id="loginform" class="form-horizontal" role="form" action="guarda_pass.php" method="POST" autocomplete="off">

									<input type="hidden" id="id_user" name="id_user" value="<?php echo $id_user; ?>" />

									<input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />

									<div class="form-group">
										<label for="password" class="col-md-3 control-label">Nueva contraseña</label>
											<input type="password" name="password" placeholder="Ingresa tu nueva contraseña" class="form-control form-control-user" aria-describedby="emailHelp" required="true">
									</div>
									<br>
									<div class="form-group">
										<label for="con_password" class="col-md-3 control-label">Confirmar contraseña</label>
											<input type="password" name="con_password" placeholder="Repite tu nueva contraseña" class="form-control form-control-user" aria-describedby="emailHelp" required="true">
									</div>

									<div style="margin-top:10px" class="form-group">
										<div class="text-center mt-3 mb-3">
											<button id="btn-login" type="submit" class="btn btn-primary btn-user btn-block">Modificar</a>
										</div>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

</body>

</html>