<script type="text/javascript">
	$(document).ready(function(){
		var validator = new FormValidator('f_plan', [{
		    name: 'f_plan_nombre',
		    display: 'required',
		    rules: 'required'
		},{
		    name: 'f_plan_periodo',
		    display: 'required',
		    rules: 'required'
		},{
		    name: 'f_plan_precio',
		    display: 'required',
		    rules: 'required'
		}], function(errors, event) {
			limpiarErroresValidate('#f_plan');
		    if (errors.length > 0) {
		        $('#'+errors[0].id).focus();
		        errors.map((error) => {
		        	mostrarErrorValidate(error.id, error.message);
		        });
		    }
		});

		// Datatable
		$('#tabla_planes').DataTable({
			"autoWidth": false,
			"language": {
				"url": base_url+"scripts/script_tablas/spanish.json"
			},
			serverSide: true,
			columns: [
				{ data: 'id', 'visible':false, 'orderable': true, 'searchable': false },
				{ data: 'icono', 'visible':true, 	'orderable': false, 'searchable': false, 'className': 'hidden-xs' },
				{ data: 'nombre',	'visible':true, 	'orderable': true, 'searchable': true, 'render': function(val, type, row) 
					{
						return row.nombre;
					}
				},
				{ data: 'periodo',	'visible':true, 	'orderable': true, 'searchable': false, 'className': 'hidden-xs', 'render': function(val, type, row) 
					{
						switch(row.periodo){
							case '1':
								return 'Mensual';
							case '3':
								return 'Trimestral';
							case '6':
								return 'Semestral';
							case '12':
								return 'Anual';
						}
					}
				},
				{ data: 'precio',	'visible':true, 	'orderable': true, 'searchable': false, 'render': function(val, type, row) 
					{
						return '$'+row.precio;
					}
				},
				{ data: 'id', 'visible':true, 'searchable':false, 'orderable': false, 'render': function (val, type, row)
          			{
            			var opciones = '<div class="mismalinea">';
						opciones += '<a href="planes/editar/'+row.id+'" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a> ';
            			opciones += '</div>';

			            return opciones;
			    	}
			    }
			],
			order: [
				[ 0, 'desc' ]
			],
			ajax: {
				url: 'planes/lista',
				type: 'POST'
			}
		});
	});
</script>