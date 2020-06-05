<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planes extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Carga de los modelos
		$this->load->model('plan_model');
		$this->load->model('configuracion_model');

		//Configurando el data_header
		$this->data_header['titulo'] = 'Administración de planes';
		$this->data_header['seccion_menu'] = 'gimnasio_planes';

		if(!$this->session->userdata('conectado') || $this->session->userdata('usuario_tipo') != 1){
			redirect(base_url());
		}

		$this->data_header['configuracion'] = $this->configuracion_model->obtener();
	}

	public function index()
	{
		$this->data_header['planes'] = $this->plan_model->obtener_todos();
		$this->data_header['js_planes'] = $this->load->view('planes/_js/js_planes', $this->data_header, true);

		$this->load->view('template/panel_v1/header', $this->data_header);
		$this->load->view('planes/planes');
		$this->load->view('template/panel_v1/footer');
	}

	public function editar()
	{
		$plan_id = $this->uri->segment(3);
		$plan = $this->plan_model->obtener($plan_id);

		if($plan){
			$this->data_header['plan'] = $plan;

			$this->load->view('template/panel_v1/header', $this->data_header);
			$this->load->view('planes/editar');
			$this->load->view('template/panel_v1/footer');
		}else{
			redirect(base_url().'planes');
		}

	}

	public function guardar()
	{
		if(!$this->input->post()){
			redirect(base_url().'planes');
			exit();
		}

		$plan_id = $this->input->post('f_plan_id');

		if($plan_id)
		{
			$datos_plan = array(
				'nombre'		=> $this->input->post('f_plan_nombre'),
				'precio'		=> $this->input->post('f_plan_precio'),
				
				'actualizado' 	=> date('Y-m-d H:i:s')
			);

			if($this->plan_model->modifica($datos_plan, $plan_id)){
				// Alerta exitosa
			}
			else{
				// Alerta error
			}
		}else{
			$datos_plan = array(
				'nombre'		=> $this->input->post('f_plan_nombre'),
				'periodo'		=> $this->input->post('f_plan_periodo'),
				'precio'		=> $this->input->post('f_plan_precio'),

				'estado' 		=> 1,
				'creado'		=> date('Y-m-d H:i:s'),
				'actualizado' 	=> date('Y-m-d H:i:s')
			);

			if($this->plan_model->alta($datos_plan)){
				// Alerta exitosa
			}
			else{
				// Alerta error
			}
		}

		redirect(base_url().'planes');
	}
	
	public function lista()
	{
		$this->datatables->add_column('icono', '<i class="fa fa-circle"></i>', 'icono');
		$this->datatables->select('gimnasio_planes.id as id,
			gimnasio_planes.nombre as nombre,
			gimnasio_planes.periodo as periodo,
			gimnasio_planes.precio as precio,
			
			gimnasio_planes.estado as estado');
		$this->datatables->from('gimnasio_planes');
		$this->datatables->where('gimnasio_planes.estado !=', 2);

  		echo $this->datatables->generate();
	}
}
