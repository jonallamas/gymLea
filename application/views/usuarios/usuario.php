<div class="jumbotron">
	<div class="row menuInfoModulo">
		<div class="col-sm-6">
			<h2>Edición de usuario</h2>
			<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quia repudiandae, est placeat.</p> -->
		</div>
		<div class="col-sm-6 text-right">
			<div class="menuBotones">
				<a href="<?php echo base_url(); ?>usuarios" class="btn btn-sm btn-default"><i class="fas fa-angle-left"></i> Volver</a>
				<!-- <button type="button" class="btn btn-sm btn-primary" onclick="mostrar_ocultar_modulo('')"><i class="fas fa-plus"></i> Nuevo</button> -->
			</div>
		</div>
	</div>
</div>

<form action="<?php echo base_url(); ?>usuarios/guardar" method="post">
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Editar usuario</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-12">
						<legend style="margin-top: 20px; margin-bottom: 10px; font-size: 18px;">Información personal</legend>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="f_usuario_apellido">Apellido/s</label>
						<input type="text" name="f_usuario_apellido" id="f_usuario_apellido" class="form-control" value="<?php echo $usuario->apellido; ?>">
					</div>
					<div class="col-sm-3">
						<label for="f_usuario_nombre">Nombre</label>
						<input type="text" name="f_usuario_nombre" id="f_usuario_nombre" class="form-control" value="<?php echo $usuario->nombre; ?>">
					</div>
					<div class="col-sm-3">
						<label for="f_usuario_dni">Núm de DNI</label>
						<input type="text" name="f_usuario_dni" id="f_usuario_dni" class="form-control" value="<?php echo $usuario->dni; ?>">
					</div>
					<div class="col-sm-3">
						<label for="fecha_nacimiento">Fecha nacimiento</label>
						<div class="input-group date" data-provide="datepicker" id="fecha_nacimiento">
						    <input type="text" class="form-control" name="f_usuario_fecha_nacimiento" value="<?php echo date("d-m-Y", strtotime($usuario->fecha_nacimiento)) ?>">
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
					<div class="col-sm-3">
						<label for="f_usuario_telefono">Teléfono</label>
						<input type="text" name="f_usuario_telefono" id="f_usuario_telefono" class="form-control" value="<?php echo $usuario->telefono; ?>">
					</div>
					<div class="col-sm-9">
						<label for="f_usuario_direccion">Dirección</label>
						<input type="text" name="f_usuario_direccion" id="f_usuario_direccion" class="form-control" value="<?php echo $usuario->direccion; ?>">
					</div>
				</div>
				<div id="contInfoUsuarioAdmin" style="display: none;">
					<div class="form-group">
						<div class="col-sm-12">
							<legend style="margin-top: 20px; margin-bottom: 10px; font-size: 18px;">Información de ingreso</legend>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label for="f_usuario_correo">Correo electrónico</label>
							<input class="form-control" name="f_usuario_correo" id="f_usuario_correo" value="<?php echo $usuario->log_correo; ?>">
						</div>
						<div class="col-sm-3">
							<label for="f_usuario_pass">Contraseña</label>
							<input class="form-control" onkeyup="validar_pass_panel()" name="f_usuario_pass" id="f_usuario_pass">
						</div>
						<div class="col-sm-3">
							<label for="f_usuario_pass_verificar">Verificar contraseña</label>
							<input class="form-control" onkeyup="validar_pass_panel()" name="f_usuario_pass_verificar" id="f_usuario_pass_verificar">
							<div class="error_pass" style="display: none;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<input type="hidden" id="f_usuario_id" name="f_usuario_id" value="<?php echo $usuario->id; ?>">
				<button type="button" class="btn btn-sm btn-default" onclick="mostrar_ocultar_modulo()">Cancelar</button>
				<button type="submit" class="btn btn-sm btn-primary" id="btn_guardar_usuario">Guardar</button>
			</div>
		</div>
	</div>
</div>
</form>

<?php echo $js_usuarios; ?>