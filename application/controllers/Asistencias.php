<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistencias extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Carga de los modelos
		$this->load->model('asistencia_model');

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
		$hora_ingreso = $this->input->post('f_hora_entrada');

		$asistio_hoy = $this->asistencia_model->obtener_asistencia_diaria($usuario_id, $fecha);
		if($asistio_hoy){
			$data = array(
				'error' => 1,
				'error_texto' => 'Ya ha registrado una asistencia hoy'
			);
		}else{
			$total_disponibles = $this->asistencia_model->obtener_disponibles($usuario_id, $fecha, $hora_ingreso);
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
		$hora_ingreso = $this->input->post('f_hora_entrada');

		$datos_asistencia = array(
			'usuario_cliente_id'=> $usuario_id,
			'fecha' 			=> $fecha,
			'hora' 				=> $hora_ingreso,
			'estado' 			=> 1,
			'creado' 			=> date('Y-m-d H:i:s'),
			'actualizado' 		=> date('Y-m-d H:i:s')
		);

		if($this->asistencia_model->alta($datos_asistencia))
		{
			$data = array(
				'error' => 0,
				'error_texto' => null,
				'fecha' => $fecha,
				'hora' => $hora_ingreso
			);
		}
		else{
			$data = array(
				'error' => 1,
				'error_texto' => 'No se pudo registrar la asistencia'
			);
		}

		echo json_encode($data);
	}
}
