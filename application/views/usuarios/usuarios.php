<div class="jumbotron">
	<div class="row menuInfoModulo">
		<div class="col-xs-12 col-sm-6">
			<h2><?php echo $titulo; ?></h2>
		</div>
		<div class="col-xs-12 col-sm-6 text-right">
			<div class="menuBotones">
				<a href="<?php echo base_url(); ?>planes" class="btn btn-sm btn-default">Planes</a>
				<button type="button" class="btn btn-sm btn-primary" onclick="mostrar_ocultar_modulo('')"><i class="fas fa-plus"></i> Nuevo</button>
			</div>
		</div>
	</div>
</div>

<form action="<?php echo base_url(); ?>usuarios/guardar" method="post" id="f_usuario">
<div class="row" id="moduloCarga" style="display: none;">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo usuario</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-3 formGroup">
						<label for="f_usuario_tipo_id">Tipo de usuario</label>
						<select name="f_usuario_tipo_id" id="f_usuario_tipo_id" class="form-control">
							<option value="">Seleccione una opción</option>
							<option value="1">Administrador</option>
							<option value="2" selected>Cliente</option>
						</select>
					</div>
					<div class="col-sm-2 formGroup">
						<label for="f_usuario_identificacion">Identificador</label>
						<input class="form-control" name="f_usuario_identificacion" id="f_usuario_identificacion" value="M<?php echo $identificador; ?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<legend style="margin-top: 20px; margin-bottom: 10px; font-size: 18px;">Información personal</legend>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3 formGroup">
						<label for="f_usuario_apellido">Apellido/s</label>
						<input type="text" name="f_usuario_apellido" id="f_usuario_apellido" class="form-control">
					</div>
					<div class="col-sm-3 formGroup">
						<label for="f_usuario_nombre">Nombre</label>
						<input type="text" name="f_usuario_nombre" id="f_usuario_nombre" class="form-control">
					</div>
					<div class="col-sm-3 formGroup">
						<label for="f_usuario_dni">Núm de DNI</label>
						<input type="text" name="f_usuario_dni" id="f_usuario_dni" class="form-control">
					</div>
					<div class="col-sm-3 formGroup">
						<label for="fecha_nacimiento">Fecha nacimiento</label>
						<div class="input-group date" data-provide="datepicker" id="fecha_nacimiento">
						    <input type="text" class="form-control" id="f_usuario_fecha_nacimiento" name="f_usuario_fecha_nacimiento">
						    <div class="input-group-addon">
						        <i class="far fa-calendar-alt"></i>
						    </div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<legend style="margin-top: 20px; margin-bottom: 10px; font-size: 18px;">Información de contacto</legend>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3 formGroup">
						<label for="f_usuario_telefono">Teléfono</label>
						<input type="text" name="f_usuario_telefono" id="f_usuario_telefono" class="form-control">
					</div>
					<div class="col-sm-9 formGroup">
						<label for="f_usuario_direccion">Dirección</label>
						<input type="text" name="f_usuario_direccion" id="f_usuario_direccion" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<legend style="margin-top: 20px; margin-bottom: 10px; font-size: 18px;">Información de membresía</legend>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3 formGroup">
						<label for="f_membresia_plan_id">Plan</label>
						<select class="form-control" name="f_membresia_plan_id" id="f_membresia_plan_id">
							<option value="">Seleccione una opción</option>
							<?php foreach ($planes as $plan) { ?>
								<option value="<?php echo $plan->id; ?>"><?php echo $plan->nombre; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-3 formGroup">
						<label for="valido_desde">Fecha ingreso</label>
						<div class="input-group date" data-provide="datepicker" id="valido_desde">
						    <input type="text" class="form-control" name="f_membresia_valido_desde">
						    <div class="input-group-addon">
						        <i class="far fa-calendar-alt"></i>
						    </div>
						</div>
					</div>
				</div>
				<div id="contInfoUsuarioAdmin" style="display: none;">
					<div class="form-group">
						<div class="col-sm-12">
							<legend style="margin-top: 20px; margin-bottom: 10px; font-size: 18px;">Información de ingreso</legend>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6 formGroup">
							<label for="f_usuario_correo">Correo electrónico</label>
							<input class="form-control" name="f_usuario_correo" id="f_usuario_correo">
						</div>
						<div class="col-sm-3 formGroup">
							<label for="f_usuario_pass">Contraseña</label>
							<input class="form-control" onkeyup="validar_pass_panel()" name="f_usuario_pass" id="f_usuario_pass">
						</div>
						<div class="col-sm-3 formGroup">
							<label for="f_usuario_pass_verificar">Verificar contraseña</label>
							<input class="form-control" onkeyup="validar_pass_panel()" name="f_usuario_pass_verificar" id="f_usuario_pass_verificar">
							<div class="error_pass" style="display: none;"></div>
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
				<h3 class="panel-title hidden-xs">Lista usuarios</h3>
			</div>
			<table class="table table-striped" id="tabla_usuarios" width="100%">
				<thead>
					<tr>
						<th width="1%"></th>
						<th width="1%"></th>
						<th width="90%">Nombre completo</th>
						<th width="0%"></th>
						<th width="0%"></th>
						<th width="0%"></th>
						<th width="1%" class="hidden-xs">Teléfono</th>
						<th width="1%" class="hidden-xs">Tipo</th>
						<th width="1%"></th>
					</tr>
				</thead>
			</table>
		</div>

	</div>
</div>

<?php echo $js_usuarios; ?>
