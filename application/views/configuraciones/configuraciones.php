<div class="jumbotron">
	<div class="row">
		<div class="col-sm-6">
			<h2>Información de configuración</h2>
			<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quia repudiandae, est placeat.</p> -->
		</div>
		<div class="col-sm-6 text-right">
			<div class="menuBotones">

			</div>
		</div>
	</div>
</div>

<form action="<?php echo base_url(); ?>configuraciones/guardar" method="post" id="f_configuracion">
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Editar configuración</h3>
			</div>
			<div class="panel-body">
				<!-- Información de configuración -->
				<div class="form-group">
					<div class="col-sm-4 formGroup">
						<label for="f_config_cant_personas_hora">Cant personas x hora</label>
						<input class="form-control" name="f_config_cant_personas_hora" id="f_config_cant_personas_hora" value="<?php echo $configuracion->cant_personas_x_hora; ?>">
					</div>
					<div class="col-sm-4 formGroup">
						<label for="f_config_hora_apertura">Hora de apertura</label>
						<input class="form-control" name="f_config_hora_apertura" id="f_config_hora_apertura" value="<?php echo $configuracion->hora_apertura; ?>" placeholder="8">
					</div>
					<div class="col-sm-4 formGroup">
						<label for="f_config_hora_cierre">Hora de cierre</label>
						<input class="form-control" name="f_config_hora_cierre" id="f_config_hora_cierre" value="<?php echo $configuracion->hora_cierre; ?>" placeholder="21">
					</div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<button type="submit" class="btn btn-sm btn-primary">Guardar</button>
			</div>
		</div>
	</div>
</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		var validator = new FormValidator('f_configuracion', [{
		    name: 'f_config_cant_personas_hora',
		    display: 'required',
		    rules: 'required'
		},{
		    name: 'f_config_hora_apertura',
		    display: 'required',
		    rules: 'required'
		},{
		    name: 'f_config_hora_cierre',
		    display: 'required',
		    rules: 'required'
		}], function(errors, event) {
			limpiarErroresValidate('#f_configuracion');
		    if (errors.length > 0) {
		        $('#'+errors[0].id).focus();
		        errors.map((error) => {
		        	mostrarErrorValidate(error.id, error.message);
		        });
		    }
		});
	});
</script>