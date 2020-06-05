<div class="jumbotron">
	<div class="row menuInfoModulo">
		<div class="col-sm-6">
			<h2><?php echo $titulo; ?></h2>
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

<form action="<?php echo base_url(); ?>planes/guardar" method="post" id="f_plan">
<div class="row" id="moduloCarga" style="display: none;">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo plan</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-6 formGroup">
						<label for="f_plan_nombre">Nombre</label>
						<input type="text" name="f_plan_nombre" id="f_plan_nombre" class="form-control">
					</div>
					<div class="col-sm-3 formGroup">
						<label for="f_plan_periodo">Periodo</label>
						<select class="form-control" name="f_plan_periodo" id="f_plan_periodo">
							<option value="">Seleccione una opción</option>
							<option value="1">Mensual</option>
							<option value="3">Trimestral</option>
							<option value="6">Semestral</option>
							<option value="12">Anual</option>
						</select>
					</div>
					<div class="col-sm-3 formGroup">
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
			<div class="panel-heading" style="min-height: 40px">
				<h3 class="panel-title hidden-xs">Lista membresías</h3>
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

<?php echo $js_planes; ?>