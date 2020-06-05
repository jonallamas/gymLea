'use strict'

$('#asistencia_hora_entrada').timepicker().on('changeTime.timepicker', function(e) {
	$('#asistencia_hora_salida').val(e.time.hours + 1+':00');
	comprobarDisponibilidad();
});

// Seteo de fechas para modal de registro de horario
var asistencia_fecha_ingreso = $('#asistencia_fecha_ingreso');
asistencia_fecha_ingreso.datepicker({
    format: 'dd-mm-yyyy',
    language: 'es'
});

$('#registroHorario').on('shown.bs.modal', function () {
  	$('#f_asistencia_usuario_dni').focus()
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
  	$('.alertaMembresiaPendiente').fadeOut('fast');
	$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
	$('.btnBuscarUsuarioAsistencia').fadeIn('fast');
}

// Comprobar disponibilidad al cambiar fecha
$('#f_asistencia_fecha_ingreso').on('change', function(){
	comprobarDisponibilidad();
});

function comprobarDisponibilidad(){
	let fecha = $('#f_asistencia_fecha_ingreso').val();
	let horario = $('#asistencia_hora_entrada').val();
	let horario_format = horario.split(':', 1);

	if(fecha != '' && horario_format[0] != ''){
    	$.ajax({
			async:false,
			cache:false,
			type: 'POST',
			url: base_url+"asistencias/comprobar",
			data: {
				'f_usuario_id': $('#asistencia_cliente_id').val(),
				'f_fecha': fecha,
				'f_hora_entrada': horario_format[0]
			},
			success:  function(data){
            	var data = jQuery.parseJSON(data);
			  	if(data.error == 0){
		  			$('#cantidadDisponibles .checkbox').html('<strong style="color: #BD142C;">Quedan disponible '+data.total_disponibles+' plazas</strong>');
		  			$('#btnReservaHorario').fadeIn('fast').attr('disabled', false);
			  	}else{
			  		$('#cantidadDisponibles .checkbox').html('<strong style="color: #BA0CC9;">'+data.error_texto+'</strong>');
			  		$('#btnReservaHorario').fadeOut('fast').attr('disabled', true);
			  	}
			}
    	});
	}
}

$('.btnBuscarUsuario').on('click', function(){
	validar_usuario_dni_horario();
})

$('#f_asistencia_usuario_dni').keyup(function(e) {
	if(e.which == 13) validar_usuario_dni_horario();
});

function validar_usuario_dni_horario(){
	$('.alertaMembresiaPendiente').fadeOut('fast');
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
	    		if(data.error == 0){
	    			if(data.membresia_estado == null){
	    				$('#alertaMembresiaPendienteTexto').html('Debe poseer una membresía activa');
						$('.alertaMembresiaPendiente').fadeIn('fast');
	    			}else{
	        			if(data.membresia_estado == 2){
	        				$('#alertaMembresiaPendienteTexto').html('Debe estar al día para registrar un horario');
							$('.alertaMembresiaPendiente').fadeIn('fast');
	        			}else if(data.membresia_estado == 0){
	        				$('#alertaMembresiaPendienteTexto').html('Su cuota ha sido cancelada');
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
					$('#alertaMembresiaPendienteTexto').html(data.error_texto);
					$('.alertaMembresiaPendiente').fadeIn('fast');
	    		}
			}
		});
	}else{
		$('#alertaMembresiaPendienteTexto').html('Por favor, agregue un DNI válido');
		$('.alertaMembresiaPendiente').fadeIn('fast');
	}
}

$('#btnReservaHorario').on('click', function(e){
	guardarAsistencia();
});

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
					$('#confirmacionAsistenciaInfo').html(`
						<img src="${base_url}assets/plantillas/web_1/img/icons/check.png" width="75px">
						<h5>Asistencia registrada</h5>
						<p>${data.respuesta}</p>
					`);
				}else{
					$('#confirmacionAsistenciaInfo').html(`
						<img src="${base_url}assets/plantillas/web_1/img/icons/cancel.png" width="75px">
						<h5>¡Ups! Algo salió mal</h5>
						<p>${data.error_texto}</p>
					`);
				}
			}
		});
	}else{
		$('#cantidadDisponibles .checkbox').html('<strong style="color: #BA0CC9;">Por favor, rellene correctamente los campos</strong>');
	}
}