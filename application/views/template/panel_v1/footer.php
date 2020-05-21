	</div>

	<div class="modal fade" id="registroAsistencia" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Registrar asistencia</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<div class="busquedaDNI row">
        				<div class="col-sm-10 col-sm-offset-1">
        					<input class="form-control" id="f_registroAsistencia_usuario_dni" name="f_registroAsistencia_usuario_dni" placeholder="Ingrese el DNI">
        				</div>
        			</div>
					<div class="row alertaRegistroAsistencia" style="display:none;">
						<br>
						<div class="col-sm-10 col-sm-offset-1">
							<div class="alert alert-warning text-center" id="alertaRegistroAsistenciaTexto" role="alert">
							</div>
						</div>
					</div>
        			<div class="row informacionAsistencia" style="display: none">
        				<div class="col-sm-12">
        					<div>
	        					<h4 id="informacionAsistencia_nombre" style="display: inline;"></h4>
	        					<span class="pull-right"><strong>Ident.:</strong> <span id="informacionAsistencia_identificador"></span></span>
        					</div>
        					<hr>
        					<table class="table">
								<thead>
									<tr>
										<th width="48%">Desde</th>
										<th width="48%">Hasta</th>
										<th width="1%">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="informacionAsistencia_desde"></td>
										<td id="informacionAsistencia_hasta" class="mismalinea"></td>
										<td id="informacionAsistencia_accion"></td>
									</tr>
								</tbody>
							</table>
        				</div>
        			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
	        <!-- <button type="button" class="btn btn-primary btn-sm">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="registroHorario" tabindex="-1" role="dialog">
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
		        				</div>
		        			</div>
							<div class="row alertaMembresiaPendiente" style="display:none;">
								<br>
								<div class="col-sm-10 col-sm-offset-1">
									<div class="alert  text-center" id="alertaMembresiaPendienteTexto" role="alert">
									</div>
								</div>
							</div>
							<div class="form-horizontal informacionHorario" style="display: none;" id="formRegistroHorario">
			        			<p class="text-center" style="display: none">Le recordamos dadas las circunstancias de público conocimiento que únicamente es posible asistir al gimnasio 1 hora al día por persona. 
			        			<br></p>
			        			<div class="form-group">
									<label for="asistencia_cliente_nombre" class="col-sm-3 control-label">Cliente</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="asistencia_cliente_nombre" value="asistencia_cliente_nombre" disabled>
									</div>
								</div>
								<div class="form-group">
									<label for="asistencia_fecha_ingreso" class="col-sm-3 control-label">Fecha ingreso</label>
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
										<select class="form-control" id="asistencia_hora_entrada" name="f_asistencia_hora_ingreso">
											<option value="" selected>Seleccione una opción</option>
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
							</div>
		        		</div>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
					<input type="hidden" name="asistencia_cliente_id" id="asistencia_cliente_id" value="">
		        	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
		        	<button type="button" class="btn btn-primary btn-sm" disabled="disabled" style="display:none" id="btnReservaHorario">Reservar horario</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	<div class="modal fade" id="confirmacionAsistencia" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body text-center" id="confirmacionAsistenciaInfo">
	      	<h2></h2>
	        <p></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>	
	<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

	<script>

		// Switch entre datatables y la carga de elementos
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

		// Seteo de fechas para modal de registro de horario
		var asistencia_fecha_ingreso = $('#asistencia_fecha_ingreso');
        asistencia_fecha_ingreso.datepicker({
            format: 'dd-mm-yyyy',
            language: 'es'
        });

		var setear_fecha = asistencia_fecha_ingreso.data('datepicker');
        setear_fecha.setDates('<?php echo date("d-m-Y") ?>');

        // Realizar focus al abrir modal
        $('#registroAsistencia').on('shown.bs.modal', function () {
		  	$('#f_registroAsistencia_usuario_dni').focus()
		});

		$('#registroHorario').on('shown.bs.modal', function () {
		  	$('#f_asistencia_usuario_dni').focus()
		});

		// Setear valores por defecto al cerrar modal
		$('#registroAsistencia').on('hidden.bs.modal', function () {
			setearValores();
		});

		$('#registroHorario').on('hidden.bs.modal', function () {
			setearValores();
		});

		function setearValores(){
			$('#f_registroAsistencia_usuario_dni').val('');
		  	$('#f_asistencia_usuario_dni').val('');
		  	$('.busquedaDNI').fadeIn('fast');
		  	$('.informacionAsistencia').fadeOut('fast');
		  	$('.informacionHorario').fadeOut('fast');
		  	setear_fecha.setDates('<?php echo date("d-m-Y") ?>');
		  	$('#asistencia_hora_entrada').val('');
		  	$('#asistencia_cliente_id').val('');
		  	$('#asistencia_cliente_nombre').val('');
		  	$('#asistencia_hora_salida').val('');
		  	$('#cantidadDisponibles .checkbox').html('');
   			$('.alertaRegistroAsistencia').fadeOut('fast');
		  	$('.alertaMembresiaPendiente').fadeOut('fast').removeClass('alert-danger alert-warning');
   			$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
		}

		// Comprobar disponibilidad al cambiar fecha
        $('#f_asistencia_fecha_ingreso').on('change', function(){
        	comprobarDisponibilidad();
        });

        // Comprobar disponibilidad al cambiar hora y mostrar horario de salida
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
					url: base_url+"asistencias/comprobar",
					data: {
						'f_usuario_id': $('#asistencia_cliente_id').val(),
						'f_fecha': fecha,
						'f_hora_entrada': horario
					},
					success:  function(data){
		            	var data = jQuery.parseJSON(data);
					  	if(data.error == 0){
				  			$('#cantidadDisponibles .checkbox').html('<strong style="color: #337ab7;">Quedan disponible '+data.total_disponibles+' plazas</strong>');
				  			$('#btnReservaHorario').fadeIn('fast').attr('disabled', false);
					  	}else{
					  		$('#cantidadDisponibles .checkbox').html('<strong style="color: #d9534f;">'+data.error_texto+'</strong>');
					  		$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
					  	}
					}
	        	});
        	}
        }

        $('#f_registroAsistencia_usuario_dni').keyup(function(e) {
        	if(e.which == 13) validar_usuario_dni_asistencia();
   		});

   		$('#f_asistencia_usuario_dni').keyup(function(e) {
        	if(e.which == 13) validar_usuario_dni_horario();
   		});

   		$('#btnReservaHorario').on('click', function(e){
   			guardarAsistencia();
   		});

   		function validar_usuario_dni_asistencia(){
   			let dni = $('#f_registroAsistencia_usuario_dni').val();
   			if(dni != '' && $.isNumeric(dni)){
   				$.ajax({
					async:false,
					cache:false,
					type: 'POST',
					url: base_url+"usuarios/obtener_usuario_x_dni",
					data: {
						'f_dni': dni,
						'f_tipo': 2
					},
					success:  function(data){
   						$('.alertaRegistroAsistencia').fadeOut('fast');
	            		var data = jQuery.parseJSON(data);
						if(data.error == 0){
							if(data.asistencia == null){
								$('#alertaRegistroAsistenciaTexto').html('<strong>¡Atención!</strong> El cliente no posee asistencia para el día de hoy');
								$('.alertaRegistroAsistencia').fadeIn('fast');
							}else{
								$('.busquedaDNI').fadeOut('fast', function(){
							  		$('.informacionAsistencia').fadeIn('fast');
							  	});
							  	$('#informacionAsistencia_nombre').html(data.usuario.nombre_completo+' <small>'+data.usuario.edad+' años</small>');
							  	$('#informacionAsistencia_edad').html(data.usuario.edad+' años');
							  	$('#informacionAsistencia_identificador').html(data.usuario.identificacion);
							  	if(data.asistencia.hora > 12){
							  		$('#informacionAsistencia_desde').html(data.asistencia.hora+':00 pm');
							  	}else{
							  		$('#informacionAsistencia_desde').html(data.asistencia.hora+':00 am');
							  	}
							  	let hora_hasta = Number(data.asistencia.hora) + 1; 
							  	if(hora_hasta > 12){
							  		$('#informacionAsistencia_hasta').html(hora_hasta+':00 pm');
							  	}else{
							  		$('#informacionAsistencia_hasta').html(hora_hasta+':00 am');
							  	}

							  	if(data.asistencia.estado == 2){
							  		$('#informacionAsistencia_accion').html('<button type="button" class="btn btn-sm btn-primary btnConfirmarAsistencia" data-asistencia="'+data.asistencia.id+'">Confirmar</button>');
							  	}else{
							  		$('#informacionAsistencia_accion').html('<button type="button" class="btn btn-sm btn-success" disabled="disabled">Confirmada</button>');
							  	}
							}
						}else{
							$('#alertaRegistroAsistenciaTexto').html('<strong>¡Atención!</strong> '+data.error_texto);
							$('.alertaRegistroAsistencia').fadeIn('fast');
						}
					}
	        	});
   			}else{
				$('#alertaRegistroAsistenciaTexto').html('Por favor, agregue un DNI válido');
				$('.alertaRegistroAsistencia').fadeIn('fast');
   			}
   		}

   		$('#informacionAsistencia_accion').delegate('.btnConfirmarAsistencia', 'click', function(){
			let asistencia_id = $(this).data('asistencia');
			if(asistencia_id){
				confirmarAsistencia(asistencia_id);
			}
		});

		function confirmarAsistencia(asistencia_id){
			$.ajax({
				async:false,
				cache:false,
				type: 'POST',
				url: base_url+"asistencias/confirmar",
				data: {
					'f_asistencia_id': asistencia_id
				},
				success:  function(data){
            		var data = jQuery.parseJSON(data);
        			$('#registroAsistencia').modal('hide');
					$('#confirmacionAsistencia').modal('show');
					if(data.error == 0){
						$('#confirmacionAsistenciaInfo h2').html('<i class="fa fa-check" style="color: #337ab7;"></i>');
						$('#confirmacionAsistenciaInfo p').html(data.respuesta);
					}else{
						$('#confirmacionAsistenciaInfo h2').html('<i class="fa fa-times" style="color: #d9534f;"></i>');
						$('#confirmacionAsistenciaInfo p').html(data.error_texto);
					}
				}
        	});
		}

   		function validar_usuario_dni_horario(){
   			$('.alertaMembresiaPendiente').fadeOut('fast').removeClass('alert-danger alert-warning');
   			$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
   			let dni = $('#f_asistencia_usuario_dni').val();
   			if(dni != '' && $.isNumeric(dni)){
	        	$.ajax({
					async:false,
					cache:false,
					type: 'POST',
					url: base_url+"usuarios/obtener_usuario_x_dni",
					data: {
						'f_dni': dni,
						'f_tipo': 1
					},
					success:  function(data){
	            		var data = jQuery.parseJSON(data);
	            		console.log(data);
	            		if(data.error == 0){
	            			if(data.membresia_estado == null){
	            				$('#alertaMembresiaPendienteTexto').removeClass('alert-danger').addClass('alert-warning').html('<strong>¡Atención!</strong> Debe poseer una membresía activa');
								$('.alertaMembresiaPendiente').fadeIn('fast');
	            			}else{
		            			if(data.membresia_estado == 2){
		            				$('#alertaMembresiaPendienteTexto').removeClass('alert-danger').addClass('alert-warning').html('<strong>¡Atención!</strong> Debe estar al día para registrar un horario');
									$('.alertaMembresiaPendiente').fadeIn('fast');
		            			}else if(data.membresia_estado == 0){
		            				$('#alertaMembresiaPendienteTexto').removeClass('alert-warning').addClass('alert-danger').html('<strong>¡Atención!</strong> Su cuota ha sido cancelada');
		            				$('.alertaMembresiaPendiente').fadeIn('fast');
		            			}else{
								  	$('#asistencia_cliente_nombre').val(data.usuario.nombre_completo);
								  	$('#asistencia_cliente_id').val(data.usuario.id);
								  	$('.busquedaDNI').fadeOut('fast', function(){
								  		$('.informacionHorario').fadeIn('fast');
								  	})
		            			}
	            			}
	            		}else{
            				$('#alertaMembresiaPendienteTexto').removeClass('alert-danger').addClass('alert-warning').html('<strong>¡Atención!</strong> '+data.error_texto);
							$('.alertaMembresiaPendiente').fadeIn('fast');
	            		}
					}
	        	});
	        }else{
				$('#alertaMembresiaPendienteTexto').removeClass('alert-danger').addClass('alert-warning').html('Por favor, agregue un DNI válido');
				$('.alertaMembresiaPendiente').fadeIn('fast');
	        }
   		}

   		function guardarAsistencia(){
   			let fecha_ingreso = $('#f_asistencia_fecha_ingreso').val();
   			let hora_ingreso = $('#asistencia_hora_entrada').val();

   			if(fecha_ingreso != '' || hora_ingreso != ''){
	   			$.ajax({
	   				async: false,
					cache:false,
					type: 'POST',
					url: base_url+"asistencias/guardar",
					data: {
						'f_usuario_id': $('#asistencia_cliente_id').val(),
						'f_fecha': fecha_ingreso,
						'f_hora_entrada': hora_ingreso
					},
					success:  function(data){
		            	var data = jQuery.parseJSON(data);

	   					$('#registroHorario').modal('hide');
						$('#confirmacionAsistencia').modal('show');
						if(data.error == 0){
							$('#confirmacionAsistenciaInfo h2').html('<i class="fa fa-check" style="color: #337ab7;"></i>');
							$('#confirmacionAsistenciaInfo p').html(data.respuesta);
						}else{
							$('#confirmacionAsistenciaInfo h2').html('<i class="fa fa-times" style="color: #d9534f;"></i>');
							$('#confirmacionAsistenciaInfo p').html(data.error_texto);
						}
					}
	   			})
   			}else{
   				$('#cantidadDisponibles .checkbox').html('<strong style="color: #d9534f;">Por favor, rellene correctamente los campos</strong>');
   			}
   		}
	</script>
</body>
</html>