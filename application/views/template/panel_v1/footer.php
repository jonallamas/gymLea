	</div>

	<div class="modal fade" id="registroAsistencia" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Registrar asistencia</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<div class="busquedaDNI row">
        				<div class="col-sm-12 form-group">
        					<!-- <div class="form-search"> -->
        						<input class="formControl" id="f_registroAsistencia_usuario_dni" name="f_registroAsistencia_usuario_dni" placeholder="Ingrese el DNI">
        						<!-- <button type="button" class="btnBuscador btnBuscarUsuarioAsistencia"><i class="fas fa-search"></i></button> -->
        					<!-- </div> -->
        				</div>
                        <div class="col-xs-12 form-group">
                            <label for="registroAsistencia_fecha_ingreso" class="control-label">Fecha ingreso</label>
                            <div class="input-group date" data-provide="datepicker" id="registroAsistencia_fecha_ingreso">
                                <input type="text" class="formControl" name="f_registroAsistencia_fecha_ingreso" id="f_registroAsistencia_fecha_ingreso">
                                <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
        			</div>
					<div class="row alertaRegistroAsistencia" style="display:none;">
						<div class="col-sm-10 col-sm-offset-1 form-group">
							<div class="alert alert-warning text-center" id="alertaRegistroAsistenciaTexto" role="alert">
							</div>
						</div>
					</div>
                    <button type="button" class="c-btn btnBuscarUsuarioAsistencia">Buscar</button>
        			<div class="row informacionAsistencia" style="display: none">
        				<div class="col-sm-12">
        					<div>
	        					<h4 id="informacionAsistencia_nombre" style="display: inline;"></h4>
	        					<span class="pull-right"><strong>Ident.:</strong> <span id="informacionAsistencia_identificador"></span></span>
        					</div>
        					<hr>
        					<table class="table text-center">
								<thead>
									<tr>
										<th width="50%" class="text-center">Desde</th>
										<th width="50%" class="text-center">Hasta</th>
										<!-- <th width="1%">Acciones</th> -->
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="informacionAsistencia_desde"></td>
										<td id="informacionAsistencia_hasta" class="mismalinea"></td>
										<!-- <td id="informacionAsistencia_accion"></td> -->
									</tr>
								</tbody>
							</table>
                            <div id="informacionAsistencia_accion"></div>
        				</div>
        			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
                <button type="button" class="d-btn" data-dismiss="modal">Cancelar</button>
                <!-- <button type="button" class="btn btn-primary btnBlock btnBuscarUsuarioAsistencia">Buscar</button> -->
	      </div>
	    </div>
	  </div>
	</div>

    <div class="modal fade" id="registroHorario" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title">Registrar horario</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="busquedaDNI row">
                                <div class="col-sm-12">
                                    <div class="form-search">
                                        <input class="formControl" id="f_asistencia_usuario_dni" name="f_usuario_dni" placeholder="Ingrese el DNI">
                                        <button type="button" class="btnBuscador btnBuscarUsuario"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row alertaMembresiaPendiente" style="display:none;">
                                <div class="col-sm-12">
                                    <div class="alert alert-warning text-center" id="alertaMembresiaPendienteTexto" role="alert">
                                    </div>
                                </div>
                            </div>
                            <div class="informacionHorario row" style="display: none;" id="formRegistroHorario">
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_cliente_nombre" class="control-label">Cliente</label>
                                    <input class="formControl" type="text" id="asistencia_cliente_nombre" value="asistencia_cliente_nombre" disabled>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_fecha_ingreso" class="control-label">Fecha ingreso</label>
                                    <div class="input-group date" data-provide="datepicker" id="asistencia_fecha_ingreso">
                                        <input type="text" class="formControl" name="f_asistencia_fecha_ingreso" id="f_asistencia_fecha_ingreso">
                                        <div class="input-group-addon">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_hora_entrada" class="control-label">Hora entrada</label>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input id="asistencia_hora_entrada" type="text" class="formControl input-small" name="f_asistencia_hora_ingreso">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="asistencia_hora_salida" class="control-label">Hora salida</label>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" id="asistencia_hora_salida" disabled class="formControl input-small">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                                <div class="col-xs-12" id="cantidadDisponibles">
                                    <div class="checkbox text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="asistencia_cliente_id" id="asistencia_cliente_id" value="">
                    <button type="button" class="c-btn" disabled="disabled" style="display:none" id="btnReservaHorario">Reservar horario</button>
                    <button type="button" class="d-btn" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- <form action="<?php echo base_url(); ?>asistencia/cancelar" method="post"> -->
        <div class="modal fade" id="cancelarAsistencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body text-center">
                <h4 class="title-modal">¿Está seguro de querer cancelar la asistencia?</h4>
              </div>
              <div class="modal-footer mismalinea">
                <input type="hidden" name="f_asistencia_id" id="f_asistencia_id" value="">
                <button type="button" class="btn btn-default btnBlock" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btnBlock btnModalCancelarAsistencia">Confirmar</button>
              </div>
            </div>
          </div>
        </div>
    <!-- </form>   -->

	<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body text-center" id="modalConfirmacionInfo">
	      	<h2></h2>
	        <p></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="d-btn" data-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>	
	<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

	<script type="text/javascript">
		// Timepicker
		$('#asistencia_hora_entrada').timepicker({
			'showMeridian': false,
			'explicitMode': false,
			'maxHours': <?php echo $configuracion->hora_cierre; ?>,
			'minuteStep': 60,
			'defaultTime': false
		});
	</script>
	<script src="<?php echo base_url(); ?>assets/js/registroAsistencia.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/f_panel.js"></script>
</html>