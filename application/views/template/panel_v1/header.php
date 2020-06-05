<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  	
	<title>GimnasioOnline | <?php echo $titulo; ?></title>

	<!-- FontAwesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/css/solid.min.css">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script> var base_url = '<?php echo base_url(); ?>'; </script>

	<!-- Script datatable -->
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/script_tablas/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/script_tablas/dataTables.bootstrap.min.js"></script>
    <link href="<?php echo base_url(); ?>scripts/script_tablas/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- Datepicker -->
    <script src="<?php echo base_url(); ?>scripts/script_datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>scripts/script_datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>scripts/script_datepicker/css/bootstrap-datepicker3.min.css"/>

    <!-- Timepicker -->
    <link href="<?php echo base_url(); ?>scripts/script_timepicker/pygments.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>scripts/script_timepicker/prettify.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>scripts/script_timepicker/timepicker.less" />

    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/script_timepicker/prettify.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/script_timepicker/bootstrap-timepicker.js"></script>

    <!-- Validate -->
    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/script_validate/validate.min.js"></script>

    <?php define('base_panel', base_url().'panel/'); ?>


	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/version_1/interface/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/web_1/css/styleModal.css" type="text/css">

</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<div class="dropdown pull-right navInfoPerfil">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url(); ?>assets/img/profile.png" class="imgPerfil">
						<?php echo $this->session->userdata('usuario_nombre'); ?> 
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_panel; ?>/salir">Cerrar sesión</a></li>
					</ul>
				</div>
				<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button> -->
				<a class="navbar-brand" href="<?php echo base_panel; ?>">
					<img src="<?php echo base_url(); ?>assets/img/logo.png" alt="">
				</a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<nav class="navbar-fixed-bottom navFixedBottom">
		<div class="contNav">
			<div class="itemNav <?php if($seccion_menu == 'gimnasio_configuraciones'){ echo 'active'; } ?>">
				<a href="<?php echo base_url(); ?>configuraciones">
					<i class="fas fa-cog"></i>
					<span>Config.</span>
				</a>
			</div>
			<div class="itemNav <?php if($seccion_menu == 'gimnasio_usuarios'){ echo 'active'; } ?>">
				<a href="<?php echo base_url(); ?>usuarios">
					<i class="fas fa-users"></i>
					<span>Usuarios</span>
				</a>
			</div>
			<div class="itemNav">
				<a href="#" data-toggle="modal" data-target="#registroHorario">
					<i class="fas fa-user-clock"></i>
					<span>Horario</span>
				</a>
			</div>
			<div class="itemNav">
				<a href="#" data-toggle="modal" data-target="#registroAsistencia">
					<i class="fas fa-user-check"></i>
					<span>Asistencia</span>
				</a>
			</div>
		</div>
	</nav>

	<div class="container">