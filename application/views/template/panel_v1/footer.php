	</div>

<div class="modal fade" id="registroAsistencia" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title">Registrar horario</h4>
	      	</div>
	      	<div class="modal-body">
	        	<div class="row">
	        		<div class="col-sm-12">
	        			<div class="busquedaDNI row">
	        				<div class="col-sm-10 col-sm-offset-1">
	        					<input class="form-control" id="f_asistencia_usuario_dni" name="f_usuario_dni" placeholder="Ingrese el DNI">
	        					<p class="errorDNI" style="display: none"></p>
	        				</div>
	        			</div>
						<div class="row alertaMembresiaPendiente" style="display:none;">
							<br>
							<div class="col-sm-10 col-sm-offset-1">
								<div class="alert  text-center" id="alertaMembresiaPendienteTexto" role="alert">
								</div>
							</div>
						</div>
						<form class="form-horizontal informacionAsistencia" style="display: none;" method="post" action="<?php echo base_url(); ?>asistencias/guardar">
		        			<p class="text-center" style="display: none">Le recordamos dadas las circunstancias de público conocimiento que únicamente es posible asistir al gimnasio 1 hora al día por persona. 
		        			<br></p>
		        			<div class="form-group">
								<label for="asistencia_cliente_nombre" class="col-sm-3 control-label">Cliente</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" id="asistencia_cliente_nombre" value="asistencia_cliente_nombre" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="asistencia_fecha_ingreso" class="col-sm-3 control-label">Fecha inicio</label>
								<div class="col-sm-9">
									<div class="input-group date" data-provide="datepicker" id="asistencia_fecha_ingreso">
									    <input type="text" class="form-control" name="f_asistencia_fecha_ingreso" id="f_asistencia_fecha_ingreso">
									    <div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
									    </div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="asistencia_hora_entrada" class="col-sm-3 control-label">Hora entrada</label>
								<div class="col-sm-9">
									<select class="form-control" id="asistencia_hora_entrada">
										<option value="">Seleccione una opción</option>
										<option value="8">8 am</option>
										<option value="9">9 am</option>
										<option value="10">10 am</option>
										<option value="11">11 am</option>
										<option value="12">12 am</option>
										<option value="13">13 pm</option>
										<option value="14">14 pm</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="asistencia_hora_salida" class="col-sm-3 control-label">Hora salida</label>
								<div class="col-sm-9">
									<input type="text" id="asistencia_hora_salida" disabled class="form-control">
								</div>
							</div>
							<div class="form-group" id="cantidadDisponibles">
								<div class="col-sm-offset-3 col-sm-9">
									<div class="checkbox">
									</div>
								</div>
							</div>
						</form>
	        		</div>
	        	</div>
	      	</div>
	      	<div class="modal-footer">
	      		<input type="hidden" name="asistencia_cliente_id" id="asistencia_cliente_id" value="">
	        	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
	        	<button type="submit" class="btn btn-primary btn-sm" id="btnReservaHorario" disabled style="display: none;">Reservar horario</button>
	      	</div>
    	</div>
  	</div>
</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>	
	<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

	<script>

		var estado_modulo = 0;
		function mostrar_ocultar_modulo(nombre_imput){
			if(estado_modulo == 0){
				$('#moduloInformacion').fadeOut('fast', function(){
					$('#moduloCarga').fadeIn();
					$('#'+nombre_imput).focus();
					estado_modulo = 1;
				});
			}else{
				$('#moduloCarga').fadeOut('fast', function(){
					$('#moduloInformacion').fadeIn();
					estado_modulo = 0;
				});
			}
		}

		var asistencia_fecha_ingreso = $('#asistencia_fecha_ingreso');
        asistencia_fecha_ingreso.datepicker({
            format: 'dd-mm-yyyy',
            language: 'es'
        });

		var setear_fecha = asistencia_fecha_ingreso.data('datepicker');
        setear_fecha.setDates('<?php echo date("d-m-Y") ?>');

		$('#registroAsistencia').on('shown.bs.modal', function () {
		  	$('#f_asistencia_usuario_dni').focus()
		});

		$('#registroAsistencia').on('hidden.bs.modal', function () {
		  	$('#f_asistencia_usuario_dni').val('')
		  	$('.informacionAsistencia').fadeOut('fast', function(){
		  		$('.busquedaDNI').fadeIn('fast');
		  	});
		  	setear_fecha.setDates('<?php echo date("d-m-Y") ?>');
		  	$('#asistencia_hora_entrada').val('');
		  	$('#asistencia_cliente_id').val('');
		  	$('#asistencia_cliente_nombre').val('');
		  	$('#asistencia_hora_salida').val('');
		  	$('#cantidadDisponibles .checkbox').html('');
		  	$('.alertaMembresiaPendiente').fadeOut('fast').removeClass('alert-danger alert-warning');
   			$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
		});

        $('#f_asistencia_fecha_ingreso').on('change', function(){
        	comprobarDisponibilidad();
        });

        $('#asistencia_hora_entrada').on('change', function(){
        	if(this.value != ''){
        		if(this.value >= 13){
        			$('#asistencia_hora_salida').val( Number(this.value)+1+' pm');
        		}else{
        			$('#asistencia_hora_salida').val( Number(this.value)+1+' am');
        		}
        	}
        	comprobarDisponibilidad();
        });

        function comprobarDisponibilidad(){
        	let fecha = $('#f_asistencia_fecha_ingreso').val();
        	let horario = $('#asistencia_hora_entrada').val();

        	if(fecha != '' && horario != ''){
	        	$.ajax({
					async:false,
					cache:false,
					type: 'POST',
					url: "asistencias/comprobar",
					data: {
						'f_usuario_id': $('#asistencia_cliente_id').val(),
						'f_fecha': fecha,
						'f_hora_entrada': horario
					},
					success:  function(data){
		            	var data = jQuery.parseJSON(data);
					  	console.log(data);
					  	if(data.error == 0){
				  			$('#cantidadDisponibles .checkbox').html('<strong style="color: #337ab7;">Quedan disponible '+data.total_disponibles+' plazas</strong>');
				  			$('#btnReservaHorario').fadeIn('fast').attr('disabled', false);
					  	}else{
					  		$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
					  	}
					}
	        	});
        	}
        }

        $('#f_asistencia_usuario_dni').keyup(function(e) {
        	if(e.which == 13) validar_usuario_dni_asistencia();
   		});

   		$('#btnReservaHorario').on('click', function(e){
   			e.preventDefault();
   			$('#registroAsistencia').modal('hide');
   		});

   		function validar_usuario_dni_asistencia(){
   			$('.alertaMembresiaPendiente').fadeOut('fast').removeClass('alert-danger alert-warning');
   			$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
   			let dni = $('#f_asistencia_usuario_dni').val();
   			if(dni != '' && $.isNumeric(dni)){
	        	$.ajax({
					async:false,
					cache:false,
					type: 'POST',
					url: "usuarios/obtener_usuario_x_dni",
					data: {
						'f_dni': dni
					},
					success:  function(data){
	            		var data = jQuery.parseJSON(data);
	            		if(data.error == 0){
	            			if(data.membresia.estado == 2){
	            				$('#alertaMembresiaPendienteTexto').removeClass('alert-danger').addClass('alert-warning').html('<strong>¡Atención!</strong> Debe estar al día para registrar un horario');
								$('.alertaMembresiaPendiente').fadeIn('fast');
	            			}else if(data.membresia.estado == 0){
	            				$('#alertaMembresiaPendienteTexto').removeClass('alert-warning').addClass('alert-danger').html('<strong>¡Atención!</strong> Su cuota ha sido cancelada');
	            				$('.alertaMembresiaPendiente').fadeIn('fast');
	            			}else{
							  	console.log(data);
							  	$('#asistencia_cliente_nombre').val(data.usuario.nombre_completo);
							  	$('#asistencia_cliente_id').val(data.usuario.id);
							  	$('.busquedaDNI').fadeOut('fast', function(){
							  		$('.informacionAsistencia').fadeIn('fast');
							  	})
	            			}
	            		}
					}
	        	});
	        }else{
	        	// Ocultar luego error al cerrar modal
	        	$('.errorDNI').fadeIn('fast').html('Por favor, agregue un DNI válido');
	        }
   		}
	</script>
</body>
</html>