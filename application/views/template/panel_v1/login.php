<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<title>Panel de ingreso</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/version_1/login/css/style.css">

	<script> var base_url = '<?php echo base_url(); ?>'; </script>
</head>
<body>

	<style>
		.bgLogin{
			height: 100vh;
			width: 100%;
			display: table;
			background-color: #ddd;
		}
			.bgLogin .container{
				display: table-cell;
				vertical-align: middle;
			}
	</style>
	
	<div class="bgLogin">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<h3 class="text-center"><strong>Inicio de sesión</strong></h3>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<label for="f_login_correo">Correo electrónico</label>
								<input type="text" name="f_login_correo" id="f_login_correo" class="form-control">
							</div>
							<div class="form-group">
								<label for="f_login_pass">Contraseña</label>
								<input type="password" name="f_login_pass" id="f_login_pass" class="form-control">
							</div>
							<div class="form-control" id="alerta_login" style="display: none;margin-bottom: 10px;">
								
							</div>
							<button class="btn btn-primary btn-block" id="btnIngresar">Ingresar</button>
						</div>
					</div>
					<a href="<?php echo base_url(); ?>" class="text-center btn-link btn-block">Volver a la página principal</a>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>	

	<script>
		$(document).ready(function() {
	        $('#f_login_correo').focus();
	    });

	    $('#btnIngresar').on('click', function(e){
	    	e.preventDefault();

	    	let f_login_correo = $('#f_login_correo').val();
	    	let f_login_pass = $('#f_login_pass').val();

	    	$('#alerta_login').fadeOut('fast');

	    	if(f_login_correo == ''){
	    		$('#alerta_login').fadeIn('fast', function(){
	    			$('#alerta_login').html('<p><b>Atención:</b> Debe rellenar el correo</p>');
	    			$('#f_login_correo').focus();
	    		});
	    		return false;
	    	}

	    	if(validarCorreo(f_login_correo) == false){
	            $("#alerta_login").fadeIn('fast', function(){
		            $('#alerta_login').html("<p><b>Atención:</b> La dirección de email es incorrecta</p>");
		            $("#f_login_correo").focus();
	            });
	            return false;
	        }
	        if(f_login_pass == ''){
	            $("#alerta_login").fadeIn('fast', function(){
		            $('#alerta_login').html('<p><b>Atención:</b> Campo incompleto</p>');
		            $('#f_login_pass').focus();
	            });
	             return false;
	        }

	        $.ajax({
	            type: 'POST',
	            data: {
	                'f_login_correo': f_login_correo,
	                'f_login_pass'	: f_login_pass
	            },
	            url: base_url+'panel/ingreso',
	            success: function(data){
	            var data = jQuery.parseJSON(data);
	            console.log(data);
	            if(data.conectado == 1){
	            	if(data.usuario_tipo == 1){
		                $("#alerta_login").fadeOut('fast');
		                window.location.replace(base_url+'panel');
	            	}else{
	            		$("#alerta_login").fadeOut('fast');
		                window.location.replace(base_url);
	            	}
	            }
	            else{
	                if(data.error){
                        $("#alerta_login").fadeIn('fast');
                        $('#alerta_login').html('<p><b>Atención:</b> '+data.error_texto+'</p>');
	                }
	            }
	          }
	        });
	    });

	    function validarCorreo(valor) {
	        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	        if(reg.test(valor)) { return true; }else{ return false; }
	    }
	</script>
</body>
</html>