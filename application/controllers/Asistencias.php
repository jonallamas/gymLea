<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistencias extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Carga de los modelos
		$this->load->model('asistencia_model');
		$this->load->model('membresia_model');

		if(!$this->session->userdata('conectado') || $this->session->userdata('usuario_tipo') != 1){
			redirect(base_url());
		}
	}

	public function comprobar()
	{
		if(!$this->input->post()){
			redirect(base_url().'planes');
			exit();
		}

		$usuario_id = $this->input->post('f_usuario_id');
		$fecha = date('Y-m-d', strtotime($this->input->post('f_fecha')));
		if($fecha < date('Y-m-d')){
			$data = array(
				'error' => 1,
				'error_texto' => 'No se permite registrar fechas antiguas'
			);

			echo json_encode($data);
			exit();
		}

		$hora_ingreso = date('G:i:s', strtotime($this->input->post('f_hora_entrada').':00:00'));

		$asistio_hoy = $this->asistencia_model->obtener_asistencia_diaria($usuario_id, $fecha);
		
		$membresias = $this->membresia_model->obtener_membresias_periodo($usuario_id, date('Y'));
		$estado_membresia = null;
		foreach ($membresias as $membresia) {
			if($fecha <= $membresia->fecha_vencimiento && $fecha >= $membresia->fecha_inicio){
				$estado_membresia = $membresia->estado;
			}
		}

		if($estado_membresia == null){
			$data = array(
				'error' => 1,
				'error_texto' => 'Por favor, seleccione una fecha acorde a su cuota'
			);
		}else{
			if($asistio_hoy){
				$data = array(
					'error' => 1,
					'error_texto' => 'Solo es permitido una asistencia diaria por usuario'
				);
			}else{
				$total_disponibles = $this->asistencia_model->obtener_disponibles($fecha, $hora_ingreso);
				if($total_disponibles->total >= 10){
					$data = array(
						'error' => 1,
						'error_texto' => 'Plazas agotadas. Por favor elija otro horario'
					);
				}else{
					$data = array(
						'error' => 0,
						'error_texto' => null,
						'total_disponibles' => 10 - $total_disponibles->total
					);
				}
			}
		}

		echo json_encode($data);
	}

	public function guardar()
	{
		if(!$this->input->post()){
			redirect(base_url());
			exit();
		}

		$usuario_id = $this->input->post('f_usuario_id');
		$fecha = date('Y-m-d', strtotime($this->input->post('f_fecha')));
		if($fecha < date('Y-m-d')){
			$data = array(
				'error' => 1,
				'error_texto' => 'No se permite registrar fechas antiguas'
			);

			echo json_encode($data);
			exit();
		}

		$hora_ingreso = $this->input->post('f_hora_entrada');

		$membresias = $this->membresia_model->obtener_membresias_periodo($usuario_id, date('Y'));
		$estado_membresia = null;
		foreach ($membresias as $membresia) {
			if($fecha <= $membresia->fecha_vencimiento && $fecha >= $membresia->fecha_inicio){
				$estado_membresia = $membresia->estado;
			}
		}

		if($estado_membresia == null){
			$data = array(
				'error' => 1,
				'error_texto' => 'No fue posible registrar la asistencia'
			);
		}else{
			$datos_asistencia = array(
				'usuario_cliente_id'=> $usuario_id,
				'fecha' 			=> $fecha,
				'hora' 				=> $hora_ingreso,
				'estado' 			=> 2,
				'creado' 			=> date('Y-m-d H:i:s'),
				'actualizado' 		=> date('Y-m-d H:i:s')
			);

			if($this->asistencia_model->alta($datos_asistencia))
			{
				$data = array(
					'error' => 0,
					'respuesta' => 'Se registró la asistencia para el día '.$this->input->post('f_fecha').' a las '.$this->input->post('f_hora_entrada').':00'.' hs',
				);
			}
			else{
				$data = array(
					'error' => 1,
					'error_texto' => 'No fue posible registrar la asistencia'
				);
			}
		}

		echo json_encode($data);
	}

	public function confirmar()
	{
		if(!$this->input->post()){
			redirect(base_url());
			exit();
		}

		$asistencia_id = $this->input->post('f_asistencia_id');

		$datos_asistencia = array(
			'estado' 			=> 1,
			'actualizado' 		=> date('Y-m-d H:i:s')
		);

		if($this->asistencia_model->modifica($datos_asistencia, $asistencia_id)){
			$asistencia_historial = array(
				'asistencia_id' 			=> $asistencia_id,
				'estado' 					=> 1,
				'creado' 					=> date('Y-m-d H:i:s'),
				'actualizado_usuario_id' 	=> $this->session->userdata('usuario_id'),
				'actualizado' 				=> date('Y-m-d H:i:s')
			);

			$this->asistencia_model->alta_historial($asistencia_historial);

			$data = array(
				'error' => 0,
				'error_texto' => null,
				'respuesta' => 'Asistencia confirmada con éxito'
			);
		}
		else{
			$data = array(
				'error' => 1,
				'error_texto' => 'No fue posible guardar la asistencia'
			);
		}

		echo json_encode($data);
	}
}
