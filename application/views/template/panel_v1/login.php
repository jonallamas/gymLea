<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<title>Panel de ingreso</title>

	<!-- FontAwesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/css/solid.min.css">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/version_1/login/css/style.css">

	<script> var base_url = '<?php echo base_url(); ?>'; </script>
</head>
<body>
	
	<div class="bgLogin">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<h3 class="text-center"><strong>Inicio de sesión</strong></h3>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<input type="text" name="f_login_correo" id="f_login_correo" class="formControl" placeholder="Correo electrónico">
							</div>
							<div class="form-group">
								<input type="password" name="f_login_pass" id="f_login_pass" class="formControl" placeholder="Contraseña">
							</div>
							<div class="alerta_login" id="alerta_login" style="display: none;margin-bottom: 10px;">
								
							</div>
							<button class="c-btn" id="btnIngresar">Ingresar</button>
						</div>
					</div>
					<a href="<?php echo base_url(); ?>" class="text-center btn-link btn-block">Volver a la página principal</a>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>	
	<script src="<?php echo base_url(); ?>assets/js/f_login.js"></script>
</body>
</html>