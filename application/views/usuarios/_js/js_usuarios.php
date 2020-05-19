<script type="text/javascript">

	function validar_pass_panel(){
	    let pass        = $('#f_usuario_pass').val();
	    let pass_verif  = $('#f_usuario_pass_verificar').val();

	    if(pass != pass_verif){
	        $('.error_pass').fadeIn('fast', function(){
	            $('.error_pass').html('Contraseñas no coinciden');
	        });
	        $('#btn_guardar_usuario').prop('disabled', true);
	        return false;
	    }else{
	        $('.error_pass').fadeOut('fast', function(){
	            $('.error_pass').html('');
	        });
	        $('#btn_guardar_usuario').prop('disabled', false);
	        return true;
	    }
	}

	$(document).ready(function(){

		$('#f_usuario_tipo_id').change(function(){
			let valor = $(this).val();
			if(valor == 1){
				$('#contInfoUsuarioAdmin').fadeIn('fast');
			}else{
				$('#contInfoUsuarioAdmin').fadeOut('fast');

				$('#f_usuario_correo').val('');
				$('#f_usuario_pass').val('');
				$('#f_usuario_pass_verificar').val('');

	        	$('#btn_guardar_usuario').prop('disabled', false);
			}
		});

		var fecha_nacimiento = $('#fecha_nacimiento');
        fecha_nacimiento.datepicker({
            format: 'dd-mm-yyyy',
            language: 'es'
        });

        var valido_desde = $('#valido_desde');
        valido_desde.datepicker({
            format: 'dd-mm-yyyy',
            language: 'es'
        });

        var setear_fecha = valido_desde.data('datepicker');
        setear_fecha.setDates('<?php echo date("d-m-Y") ?>');

		// Datatable
		$('#tabla_usuarios').DataTable({
			"autoWidth": false,
			"language": {
				"url": base_url+"scripts/script_tablas/spanish.json"
			},
			serverSide: true,
			columns: [
				{ data: 'id', 'visible':false, 'orderable': true, 'searchable': false },
				{ data: 'icono', 'visible':true, 	'orderable': false, 'searchable': false },
				{ data: 'nombre',	'visible':true, 	'orderable': true, 'searchable': true, 'render': function(val, type, row) 
					{
						return row.nombre_completo;
					}
				},
				{ data: 'apellido',	'visible':false, 	'orderable': false, 'searchable': true },
				{ data: 'dni',	'visible':false, 	'orderable': false, 'searchable': true },
				{ data: 'identificacion',	'visible':false, 	'orderable': false, 'searchable': true },
				{ data: 'telefono',	'visible':true, 	'orderable': false, 'searchable': true, 'render': function(val, type, row) 
					{
						if(row.telefono != null){
							return row.telefono;
						}else{
							return '-';
						}
					}
				},
				{ data: 'tipo',	'visible':true, 	'orderable': false, 'searchable': false, 'render': function(val, type, row) 
					{
						if(row.tipo == 1){
							return 'Admin';
						}else{
							return 'Cliente';
						}
					}
				},
				{ data: 'id', 'visible':true, 'searchable':false, 'orderable': false, 'render': function (val, type, row)
          			{
            			var opciones = '<div class="mismalinea">';
						opciones += '<a href="membresias/cuenta/'+row.id+'" class="btn btn-sm btn-default">Cuotas</a> ';
						opciones += '<a href="usuarios/editar/'+row.id+'" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a> ';
            			opciones += '</div>';

			            return opciones;
			    	}
			    }
			],
			order: [
				[ 0, 'desc' ]
			],
			ajax: {
				url: 'usuarios/lista',
				type: 'POST'
			}
		});
	});

</script>