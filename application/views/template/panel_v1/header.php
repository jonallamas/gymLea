<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	
	<title>GimnasioOnline | <?php echo $titulo; ?></title>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />

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

    <?php define('base_panel', base_url().'panel/'); ?>

    <style>
    	.mismalinea{
    		white-space: nowrap;
    	}

    	.menuInfoModulo h2{
    		margin-top: 0px;
    		margin-bottom: 0px;
    	}

    	.menuInfoModulo .menuBotones{
    		padding-top: 20px;
    	}
    </style>
</head>
<body>

	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_panel; ?>">Gimnasio<strong>Online</strong></a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class=""><a href="#" class="">Registrar horario</a></li>
					<li class="<?php if($seccion_menu == 'gimnasio_usuarios'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>usuarios">Usuarios</a></li>
					<li class="<?php if($seccion_menu == 'gimnasio_membresias'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>membresias">Membresías</a></li>
					
					<!-- Separador momentaneo -->
					<li><a></a></li>
					<!--  -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('usuario_nombre_completo'); ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_panel; ?>/salir">Cerrar sesión</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<div class="container">