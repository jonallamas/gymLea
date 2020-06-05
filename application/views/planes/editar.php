<div class="jumbotron">
	<div class="row">
		<div class="col-sm-6">
			<h2>Edición de plan</h2>
			<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quia repudiandae, est placeat.</p> -->
		</div>
		<div class="col-sm-6 text-right">
			<div class="menuBotones">
				<a href="<?php echo base_url(); ?>planes" class="btn btn-sm btn-default"><i class="fas fa-angle-left"></i> Volver</a>
				<!-- <button type="button" class="btn btn-sm btn-primary" onclick="mostrar_ocultar_modulo('')"><i class="fas fa-plus"></i> Nuevo</button> -->
			</div>
		</div>
	</div>
</div>

<pre>
	<?php print_r($plan); ?>
</pre>

<form action="<?php echo base_url(); ?>planes/guardar" method="post">
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Editar plan</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-9 formGroup">
						<label for="f_plan_nombre">Nombre</label>
						<input type="text" name="f_plan_nombre" id="f_plan_nombre" class="form-control" value="<?php echo $plan->nombre; ?>">
					</div>
					<div class="col-sm-3 formGroup">
						<label for="f_plan_precio">Precio</label>
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" name="f_plan_precio" id="f_plan_precio" class="form-control" value="<?php echo $plan->precio; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<input type="hidden" id="f_plan_id" name="f_plan_id" value="<?php echo $plan->id; ?>">
				<a href="<?php echo base_url(); ?>planes" class="btn btn-sm btn-default">Cancelar</a>
				<button type="submit" class="btn btn-sm btn-primary">Guardar</button>
			</div>
		</div>
	</div>
</div>
</form>