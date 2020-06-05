<div class="jumbotron">
	<div class="row menuInfoModulo">
		<div class="col-sm-6">
			<h2><?php echo $usuario->apellido.' '.$usuario->nombre; ?></h2>
			<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quia repudiandae, est placeat.</p> -->
		</div>
		<div class="col-sm-6 text-right">
			<div class="menuBotones">
			</div>
		</div>
	</div>
</div>

<br>

<div class="row" id="moduloInformacion">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Listado de cuotas</h3>
			</div>
			<table class="table table-striped display dt-responsive nowrap" id="tabla_cuotas" width="100%">
				<thead>
					<tr>
						<th width="1%"></th>
						<th width="1%" class="hidden-xs"></th>
						<th width="90%" class="hidden-xs">Tipo de membresía</th>
						<th width="1%"><span class="mismalinea">Periodo</span></th>
						<th width="1%" class="hidden-xs"><span class="mismalinea">Fecha inicio</span></th>
						<th width="1%">Vencimiento</th>
						<th width="0%"></th>
						<th width="1%" class="hidden-xs"><span class="mismalinea">Estado</span></th>
						<th width="1%" class="hidden-xs">Precio</th>
						<th width="1%"><span class="mismalinea">Pago</span></th>
						<th width="1%" class=""></th>
					</tr>
				</thead>
			</table>
		</div>

	</div>
</div>

<!-- Modal -->
<form action="<?php echo base_url(); ?>membresias/pagar" method="post">
	<div class="modal fade" id="confirmarPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body text-center">
	        <h4 class="title-modal">¿Está seguro de querer confirmar el pago de la cuota?</h4>
	      </div>
	      <div class="modal-footer mismalinea">
	      	<input type="hidden" name="f_membresia_id_pagar" id="f_membresia_id_pagar" value="">
	        <button type="button" class="btn btn-default btnBlock" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary btnBlock">Confirmar</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<form action="<?php echo base_url(); ?>membresias/cancelar" method="post">
	<div class="modal fade" id="cancelarPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body text-center">
	        <h4 class="title-modal">¿Está seguro de querer cancelar la cuota?</h4>
	      </div>
	      <div class="modal-footer mismalinea">
	      	<input type="hidden" name="f_membresia_id_cancelar" id="f_membresia_id_cancelar" value="">
	        <button type="button" class="btn btn-default btnBlock" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary btnBlock">Confirmar</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<script type="text/javascript">

	$(document).ready(function(){

		// Pagar cuota
		$('#tabla_cuotas').delegate('.btnPagarCuota', 'click', function(){
			let cuota_id = $(this).data('cuota');
			$('#f_membresia_id_pagar').val(cuota_id);
		});

		$('#confirmarPago').on('hidden.bs.modal', function (e) {
			$('#f_membresia_id_pagar').val('');
		});

		// Cancelar cuota
		$('#tabla_cuotas').delegate('.btnCancelarCuota', 'click', function(){
			let cuota_id = $(this).data('cuota');
			console.log(cuota_id);
			$('#f_membresia_id_cancelar').val(cuota_id);
		});

		$('#cancelarPago').on('hidden.bs.modal', function (e) {
			$('#f_membresia_id_cancelar').val('');
		});

		// Datatable
		$('#tabla_cuotas').DataTable({
			"responsive": true,
			"searching": false,
			"paging":   false,
			"ordering": false,
			"autoWidth": false,
			"language": {
				"url": base_url+"scripts/script_tablas/spanish.json"
			},
			serverSide: true,
			columns: [
				{ data: 'id', 'visible':false, 'orderable': true, 'searchable': false },
				{ data: 'icono', 'visible':true, 	'orderable': false, 'searchable': false, 'className': 'hidden-xs' },
				{ data: 'membresia_nombre',	'visible':true, 	'orderable': false, 'searchable': true, 'className': 'hidden-xs', 'render': function(val, type, row) 
					{
						return row.membresia_nombre;
					}
				},
				{ data: 'periodo_num_formateado',	'visible':true, 	'orderable': false, 'searchable': false, 'render': function(val, type, row) 
					{	
						switch(row.periodo_num_formateado){
							case "01":
								return 'Enero';
							case "02":
								return 'Febrero';
							case "03":
								return 'Marzo';
							case "04":
								return 'Abril';
							case "05":
								return 'Mayo';
							case "06":
								return 'Junio';
							case "07":
								return 'Julio';
							case "08":
								return 'Agosto';
							case "09":
								return 'Septiembre';
							case "10":
								return 'Octubre';
							case "11":
								return 'Noviembre';
							case "12":
								return 'Diciembre';
						}

					}
				},
				{ data: 'fecha_inicio_formateado', 'visible':true, 	'orderable': false, 'searchable': false, 'className': 'hidden-xs' },
				{ data: 'fecha_finalizacion_formateado', 'visible':true, 	'orderable': false, 'searchable': false },
				{ data: 'fecha_finalizacion', 'visible':false, 	'orderable': false, 'searchable': false },
				{ data: 'estado',	'visible':true, 	'orderable': false, 'searchable': true, 'className': 'hidden-xs', 'render': function(val, type, row) 
					{	
						if(row.estado == 0){
			              	return '<span class="label label-default">Cancelado</span>';
						}else if(row.estado == 2){
							if(row.estado_vencimiento == 1){
	              				return '<span class="label label-danger">Vencido</span>';
	            			}else if(row.estado_vencimiento_hoy == 1){
	              				return '<span class="label label-warning">Vence hoy</span>';
	             			}else{
				              	return '<span class="label label-success">Activo</span>';
				            }
						}else{
			              	return '<span class="label label-primary">Renovado</span>';
						}

					}
				},
				{ data: 'membresia_precio',	'visible':true, 	'orderable': false, 'searchable': true, 'className': 'hidden-xs', 'render': function(val, type, row) 
					{
						return '$'+row.membresia_precio;
					}
				},
				{ data: 'pago',	'visible':true, 	'orderable': false, 'searchable': true, 'render': function(val, type, row) 
					{
						if(row.pago == 1){
							return '<span class="label label-primary">Realizado</span>';
						}else if(row.pago == 0){
							return '<span class="label label-default">Cancelado</span>';
						}else{
							if(row.estado_vencimiento == 1){
	              				return '<span class="label label-danger">Vencido</span>';
	            			}else{
								return '<span class="label label-default">Pendiente</span>';
	             			}
						}
					}
				},
				{ data: 'id', 'visible':true, 'searchable':false, 'orderable': false, 'className': 'text-right', 'render': function (val, type, row)
          			{
            			var opciones = '';
						if(row.estado == 2){
							opciones += '<div class="dropdown">';
							opciones += '	<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-cog"></i></button>';
							opciones += '	<ul class="dropdown-menu dropdown-menu-right">';
							opciones += '		<li><a href="#" data-toggle="modal" data-target="#confirmarPago" class="btnPagarCuota" data-cuota="'+row.id+'">Pagar</a></li>';
							opciones += '		<li><a href="#" data-toggle="modal" data-target="#cancelarPago" class="btnCancelarCuota" data-cuota="'+row.id+'">Cancelar</a></li>';
							opciones += '	</ul>';
							opciones += '</div>';
						}else{
							// opciones += '<button type="button" class="btn btn-sm btn-default" disabled>Pagar</button> ';	
							// opciones += '<button type="button" class="btn btn-sm btn-default" disabled>Cancelar</button> ';	
						}
						// opciones += '</div>';

			            return opciones;
			    	}
			    }
			],
			order: [
				[ 3, 'asc' ]
			],
			ajax: {
				url: '../lista_membresias_cuenta',
				type: 'POST',
				data: {
					'f_usuario_id': <?php echo $usuario->id; ?>
				}
			}
		});
	});

</script>