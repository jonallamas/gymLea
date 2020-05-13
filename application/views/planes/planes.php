<div class="jumbotron">
	<div class="row menuInfoModulo">
		<div class="col-sm-6">
			<h2><?php echo $titulo; ?></h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quia repudiandae, est placeat.</p>
		</div>
		<div class="col-sm-6 text-right">
			<div class="menuBotones">
				<a href="<?php echo base_url(); ?>usuarios" class="btn btn-sm btn-default">Usuarios</a>
				<button type="button" class="btn btn-sm btn-primary" onclick="mostrar_ocultar_modulo('')"><i class="fa fa-plus"></i> Nuevo</button>
			</div>
		</div>
	</div>
</div>

<br>

<form action="<?php echo base_url(); ?>planes/guardar" method="post">
<div class="row" id="moduloCarga" style="display: none;">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo plan</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-6">
						<label for="f_plan_nombre">Nombre</label>
						<input type="text" name="f_plan_nombre" id="f_plan_nombre" class="form-control">
					</div>
					<div class="col-sm-3">
						<label for="f_plan_periodo">Periodo</label>
						<select class="form-control" name="f_plan_periodo" id="f_plan_periodo">
							<option value="">Seleccione una opción</option>
							<option value="1">Mensual</option>
							<option value="3">Trimestral</option>
							<option value="6">Semestral</option>
							<option value="12">Anual</option>
						</select>
						<!-- <div class="input-group">
							<input type="text" name="f_plan_periodo" id="f_plan_periodo" class="form-control">
							<div class="input-group-addon">Días</div>
						</div> -->
					</div>
					<div class="col-sm-3">
						<label for="f_plan_precio">Precio</label>
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" name="f_plan_precio" id="f_plan_precio" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<button type="button" class="btn btn-sm btn-default" onclick="mostrar_ocultar_modulo()">Cancelar</button>
				<button type="submit" class="btn btn-sm btn-primary" id="btn_guardar_usuario">Guardar</button>
			</div>
		</div>
	</div>
</div>
</form>

<div class="row" id="moduloInformacion">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Lista membresías</h3>
			</div>
			<table class="table table-striped" id="tabla_planes" width="100%">
				<thead>
					<tr>
						<th width="1%"></th>
						<th width="1%"></th>
						<th width="99%">Nombre</th>
						<th width="1%">Periodo</th>
						<th width="1%">Precio</th>
						<th width="1%"></th>
					</tr>
				</thead>
			</table>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		// Datatable
		$('#tabla_planes').DataTable({
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
						return row.nombre;
					}
				},
				{ data: 'periodo',	'visible':true, 	'orderable': true, 'searchable': false, 'render': function(val, type, row) 
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
						opciones += '<a href="usuarios/editar/'+row.codigo+'" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></a> ';
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
