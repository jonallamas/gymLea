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

// Datepicker fecha - Registro de asistencia
var registroAsistencia_fecha_ingreso = $('#registroAsistencia_fecha_ingreso');
registroAsistencia_fecha_ingreso.datepicker({
    format: 'dd-mm-yyyy',
    language: 'es'
});

var setear_fecha = asistencia_fecha_ingreso.data('datepicker');
setear_fecha.setDates('<?php echo date("d-m-Y") ?>');

// Realizar focus al abrir modal
$('#registroAsistencia').on('shown.bs.modal', function () {
	var setear_fecha_registroAsistencia = registroAsistencia_fecha_ingreso.data('datepicker');
	setear_fecha_registroAsistencia.setDates('<?php echo date("d-m-Y") ?>');
  	$('#f_registroAsistencia_usuario_dni').focus()
});

// Setear valores por defecto al cerrar modal
$('#registroAsistencia').on('hidden.bs.modal', function () {
	setearValores();
});

$('.btnBuscarUsuarioAsistencia').on('click', function(){
	validar_usuario_dni_asistencia();
});

$('#f_registroAsistencia_usuario_dni').keyup(function(e) {
	if(e.which == 13) validar_usuario_dni_asistencia();
});

function validar_usuario_dni_asistencia(){
	let dni = $('#f_registroAsistencia_usuario_dni').val();
	let fecha = $('#f_registroAsistencia_fecha_ingreso').val();
	if(dni != '' && $.isNumeric(dni)){
		$.ajax({
			async:false,
			cache:false,
			type: 'POST',
			url: base_url+"usuarios/obtener_usuario_x_dni",
			data: {
				'f_dni': dni,
				'f_fecha': fecha,
				'f_tipo': 2
			},
			success:  function(data){
				$('.alertaRegistroAsistencia').fadeOut('fast');
	    		var data = jQuery.parseJSON(data);
				if(data.error == 0){
					if(data.asistencia == null){
						$('#alertaRegistroAsistenciaTexto').html('No posee asistencia para el día seleccionado');
						$('.alertaRegistroAsistencia').fadeIn('fast');
					}else{
						$('.busquedaDNI').fadeOut('fast', function(){
							$('.btnBuscarUsuarioAsistencia').fadeOut('fast');
					  		$('.informacionAsistencia').fadeIn('fast');
					  	});
					  	$('#informacionAsistencia_nombre').html(data.usuario.nombre_completo+' <small>('+data.usuario.edad+' años)</small>');
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
					  		$('#informacionAsistencia_accion').html('<span class="mismalinea"><button type="button" class="btn btnBlock btn-default btnCancelarAsistencia" data-asistencia="'+data.asistencia.id+'">Eliminar</button> <button type="button" class="btn btnBlock btn-primary btnConfirmarAsistencia" data-asistencia="'+data.asistencia.id+'">Confirmar</button></span>');
					  	}else if(data.asistencia.estado == 1){
					  		$('#informacionAsistencia_accion').html('<button type="button" class="btn btn-block btn-success" disabled="disabled">Asistencia confirmada</button>');
					  	}else{
					  		$('#informacionAsistencia_accion').html('<button type="button" class="btn btn-block btn-default" disabled="disabled">Asistencia eliminada</button>');
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

$('#informacionAsistencia_accion').delegate('.btnCancelarAsistencia', 'click', function(){
	let asistencia_id = $(this).data('asistencia');
	if(asistencia_id){
		$('#f_asistencia_id').val(asistencia_id);
		$('#registroAsistencia').modal('hide');
		$('#cancelarAsistencia').modal('show');
	}
});

$('.btnModalCancelarAsistencia').on('click', function(e){
	e.preventDefault();
	let asistencia_id = $('#f_asistencia_id').val();
	if(asistencia_id){
		confirmarCancelacionAsistencia(asistencia_id);
	}
})

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
			$('#modalConfirmacion').modal('show');
			if(data.error == 0){
				$('#modalConfirmacionInfo h2').html('<i class="fa fa-check"></i>');
				$('#modalConfirmacionInfo p').html(data.respuesta);
			}else{
				$('#modalConfirmacionInfo h2').html('<i class="fa fa-times"></i>');
				$('#modalConfirmacionInfo p').html(data.error_texto);
			}
		}
	});
}

function confirmarCancelacionAsistencia(asistencia_id){
	$.ajax({
		async:false,
		cache:false,
		type: 'POST',
		url: base_url+"asistencias/cancelar",
		data: {
			'f_asistencia_id': asistencia_id
		},
		success:  function(data){
    		var data = jQuery.parseJSON(data);
			$('#cancelarAsistencia').modal('hide');
			$('#modalConfirmacion').modal('show');
			if(data.error == 0){
				$('#modalConfirmacionInfo h2').html('<i class="fa fa-check"></i>');
				$('#modalConfirmacionInfo p').html(data.respuesta);
			}else{
				$('#modalConfirmacionInfo h2').html('<i class="fa fa-times"></i>');
				$('#modalConfirmacionInfo p').html(data.error_texto);
			}
		}
	});
}

function mostrarErrorValidate(id, msg){
	let parent = $('#'+id).parents('.formGroup');
	$('#'+id).addClass('has_input_error');
	parent.append('<span class="has_error">'+msg+'</span>');
}

function limpiarErroresValidate(id){
	$(id).find('.form-control').removeClass('has_input_error');
	$(id).find('.has_error').remove();
	return false;
}