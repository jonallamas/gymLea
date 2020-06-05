<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Activitar Template">
    <meta name="keywords" content="Activitar, unica, creative, html">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MarcialGym | Gimnasio</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/css/solid.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/web_1/css/style.css" type="text/css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>scripts/script_datepicker/css/bootstrap-datepicker3.min.css"/>

    <!-- Timepicker -->
    <link href="<?php echo base_url(); ?>scripts/script_timepicker/pygments.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>scripts/script_timepicker/prettify.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>scripts/script_timepicker/timepicker.less" />

    <?php 

    if($_SERVER['SERVER_ADDR'] == "::1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1"){ ?>
        <script> var base_url = "<?php echo base_url(); ?>" </script>
    <?php }
    else{ ?>
        <script> var base_url = "http://192.168.0.13/proyectosCodeIgniter/gymLea/"; </script>
    <?php }

    ?>
    

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/web_1/css/styleModal.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="logo">
                <a href="./index.html">
                    <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="">
                </a>
            </div>
            <div class="top-social">
                <a href="https://www.facebook.com/MarcialGymSobrecarga/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                <a href="https://www.instagram.com/marcial.gym/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="set-bg spad" data-setbg="<?php echo base_url(); ?>assets/plantillas/web_1/img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="breadcrumb-text">
                        <h2>Precausiones de cuarentena</h2>
                        <p>Debido al problema de público conocimiento, solo está permitido asistir al gimnasio un número limitado de personas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb End -->

    <!-- Cta Section Begin -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-text">
                        <h3>Registro de asistencias</h3>
                        <p>Ingresa con tu DNI y reserva tu lugar en el gimnasio.</p>
                        <p>Te recordamos que sólo es posible asistir durante <strong>1 hora al día</strong> momentáneamente.</p>
                    </div>
                    <button type="button" class="primary-btn cta-btn" data-toggle="modal" data-target="#registroHorario">Reservar</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Cta Section End -->

    <!-- Choseus Section Begin -->
    <section class="chooseus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Por qué nos eligen</h2>
                        <p>Nuestros profesionales deportivos son la combinación perfecta.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="choose-item">
                        <img src="<?php echo base_url(); ?>assets/plantillas/web_1/img/icons/chose-icon-2.png" alt="">
                        <h5>Expertos especializados</h5>
                        <p>Lleva tu cuerpo al siguiente nivel con los consejos y la calidad de nuestros expertos en el ámbito.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="choose-item">
                        <img src="<?php echo base_url(); ?>assets/plantillas/web_1/img/icons/chose-icon-3.png" alt="">
                        <h5>Sesiones personalizadas</h5>
                        <p>Sesiones completamente personalizadas para que puedas lograr los cambios que tanto quieres encontrar.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="choose-item">
                        <img src="<?php echo base_url(); ?>assets/plantillas/web_1/img/icons/chose-icon-5.png" alt="">
                        <h5>Aprovecha el tiempo</h5>
                        <p>Con tu membresía tendrás acceso de lunes a viernes para disfrutar de nuestra instalación y todas sus máquinas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Choseus Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-logo-item">
                        <div class="f-logo">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt=""></a>
                        </div>
                        <p><strong>MarcialGym</strong> un espacio de acondicionamiento físico que fusiona dos grandes disciplinas como son las artes marciales y la musculación.</p>
                        <div class="social-links">
                            <h6>Síguenos en...</h6>
                            <a href="https://www.facebook.com/MarcialGymSobrecarga/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                            <a href="https://www.instagram.com/marcial.gym/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-offset-5">
                    <div class="footer-widget">
                        <h5>Más información</h5>
                        <ul class="footer-info">
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>Teléfono:</span>
                                (260) 400-5709
                            </li>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Dirección</span>
                                Ortiz de Rosas Nº 168, <br> San Rafael, Mendoza
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="ct-inside">
                        	<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> MarcialGym | <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> 
						</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Modal -->
    <div class="modal fade" id="registroHorario" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title">Registrar horario</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="busquedaDNI row">
                                <div class="col-sm-12">
                                    <div class="form-search">
                                        <input class="formControl" id="f_asistencia_usuario_dni" name="f_usuario_dni" placeholder="Ingrese el DNI">
                                        <button type="button" class="btnBuscador btnBuscarUsuario"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row alertaMembresiaPendiente" style="display:none;">
                                <div class="col-sm-12">
                                    <div class="alert alert-warning text-center" id="alertaMembresiaPendienteTexto" role="alert">
                                    </div>
                                </div>
                            </div>
                            <div class="informacionHorario row" style="display: none;" id="formRegistroHorario">
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_cliente_nombre" class="control-label">Cliente</label>
                                    <input class="formControl" type="text" id="asistencia_cliente_nombre" value="asistencia_cliente_nombre" disabled>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_fecha_ingreso" class="control-label">Fecha ingreso</label>
                                    <div class="input-group date" data-provide="datepicker" id="asistencia_fecha_ingreso">
                                        <input type="text" class="formControl" name="f_asistencia_fecha_ingreso" id="f_asistencia_fecha_ingreso">
                                        <div class="input-group-addon">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_hora_entrada" class="control-label">Hora entrada</label>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input id="asistencia_hora_entrada" type="text" class="formControl input-small" name="f_asistencia_hora_ingreso">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_hora_salida" class="control-label">Hora salida</label>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" id="asistencia_hora_salida" disabled class="formControl input-small">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                                <div class="col-xs-12" id="cantidadDisponibles">
                                    <div class="checkbox text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="asistencia_cliente_id" id="asistencia_cliente_id" value="">
                    <button type="button" class="c-btn" disabled="disabled" style="display:none" id="btnReservaHorario">Reservar horario</button>
                    <button type="button" class="d-btn" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmacionAsistencia" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center" id="confirmacionAsistenciaInfo">
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-btn" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Js Plugins -->
    <script src="<?php echo base_url(); ?>assets/plantillas/web_1/js/jquery-3.3.1.min.js"></script>	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>	
    <!-- <script src="<?php echo base_url(); ?>assets/plantillas/web_1/js/mixitup.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/plantillas/web_1/js/jquery.nice-select.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/plantillas/web_1/js/masonry.pkgd.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/plantillas/web_1/js/main.js"></script>

    <script src="<?php echo base_url(); ?>scripts/script_datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>scripts/script_datepicker/locales/bootstrap-datepicker.es.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/script_timepicker/prettify.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/script_timepicker/bootstrap-timepicker.js"></script>

    <script type="text/javascript">
        // Timepicker
        $('#asistencia_hora_entrada').timepicker({
            'showMeridian': false,
            'explicitMode': false,
            'maxHours': <?php echo $configuracion->hora_cierre; ?>,
            'minuteStep': 60,
            'defaultTime': false
        });
    </script>
    <script src="<?php echo base_url(); ?>assets/js/registroAsistencia.js"></script>
    <script type="text/javascript">
        var setear_fecha = asistencia_fecha_ingreso.data('datepicker');
        setear_fecha.setDates('<?php echo date("d-m-Y") ?>');
    </script>
</body>

</html>