<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function __construct(){
		parent::__construct();

		// Carga de los modelos
		$this->load->model('usuario_model');

		//Configurando el data_header
		$this->data_header['titulo'] = 'Panel';
		$this->data_header['seccion_menu'] = 'gimnasio_principal';
	}

	public function index()
	{
		if($this->session->userdata('conectado')){

			$this->load->model('configuracion_model');
			$this->data_header['configuracion'] = $this->configuracion_model->obtener();

			if(!$this->data_header['configuracion']){
				$datos_configuracion = array(
					'cant_personas_x_hora'	=> 10,
					'hora_apertura'			=> 9,
					'hora_cierre'			=> 21,
					
					'actualizado_usuario_id' => $this->session->userdata('usuario_id'),
					'actualizado' 			 => date('Y-m-d H:i:s')
				);

				$this->configuracion_model->alta($datos_configuracion);
			}

			$this->load->view('template/panel_v1/header', $this->data_header);
			$this->load->view('principal');
			$this->load->view('template/panel_v1/footer');
		}else{
			redirect(base_url().'panel/ingresar');
		}
	}

	public function ingresar()
	{
		if($this->session->userdata('conectado')){
			redirect(base_url().'panel');
		}else{
			$this->load->view('template/panel_v1/login');
		}
	}

	public function ingreso()
	{
		$login_correo 	= $this->input->post('f_login_correo');
		$login_pass 	= $this->input->post('f_login_pass');
		$login_pass 	= md5($login_pass);

		$validacion = $this->usuario_model->login($login_correo, $login_pass);

		if($validacion){
			$data_session = array(
				'conectado' 				=> 1,
				'usuario_id' 				=> $validacion->id,
				'usuario_nombre' 			=> $validacion->nombre,
				'usuario_apellido' 			=> $validacion->apellido,
				'usuario_nombre_completo' 	=> $validacion->apellido.' '.$validacion->nombre,
				'usuario_tipo' 				=> $validacion->tipo
			);

			$this->session->set_userdata($data_session);

			$data = array(
				'conectado' 	=> 1,
				'usuario_tipo' 	=> $validacion->tipo,
				'error' 		=> 0,
				'error_texto' 	=> NULL
			);

			echo json_encode($data);
			exit();
		}
		else{
			$data = array(
				'conectado' 	=> 0,
				'error' 		=> 1,
				'error_texto' 	=> 'Información incorrecta'
			);

			echo json_encode($data);
			exit();
		}
	}

	public function salir()
	{
		$this->session->sess_destroy();
		redirect(base_url().'panel/ingresar');
	}
}
