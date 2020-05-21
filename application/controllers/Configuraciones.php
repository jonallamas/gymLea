<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Carga de los modelos
		$this->load->model('configuracion_model');

		//Configurando el data_header
		$this->data_header['titulo'] = 'Administración de configuraciones';
		$this->data_header['seccion_menu'] = 'gimnasio_configuraciones';

		if(!$this->session->userdata('conectado') || $this->session->userdata('usuario_tipo') != 1){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->view('template/panel_v1/header', $this->data_header);
		$this->load->view('configuraciones/configuraciones');
		$this->load->view('template/panel_v1/footer');
	}

	public function guardar()
	{
		if(!$this->input->post()){
			redirect(base_url().'configuraciones');
			exit();
		}

		$datos_configuracion = array(
			'cant_personas_x_hora'	=> 10,
			'hora_apertura'			=> 9,
			'hora_cierre'			=> 21,
			
			'actualizado_usuario_id' 	=> $this->session->userdata('usuario_id'),
			'actualizado' 	=> date('Y-m-d H:i:s')
		);

		if($this->configuracion_model->modifica($datos_configuracion)){
			// Alerta exitosa
		}
		else{
			// Alerta error
		}

		redirect(base_url().'configuraciones');
	}
}
