<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membresias extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Carga de los modelos
		$this->load->model('usuario_model');
		$this->load->model('membresia_model');
		$this->load->model('configuracion_model');

		//Configurando el data_header
		$this->data_header['titulo'] = 'Administración de membresías';
		$this->data_header['seccion_menu'] = 'gimnasio_membresias';

		if(!$this->session->userdata('conectado') || $this->session->userdata('usuario_tipo') != 1){
			redirect(base_url());
		}

		$this->data_header['configuracion'] = $this->configuracion_model->obtener();
	}

	public function index()
	{
		redirect(base_url().'panel');
		// $this->data_header['total_clientes']         	= $this->usuario_model->obtener_total_clientes();
		// $this->data_header['total_clientes_activos'] 	= count($this->membresia_model->obtener_total_clientes_activos());

		// $this->load->view('template/panel_v1/header', $this->data_header);
		// $this->load->view('membresias/membresias');
		// $this->load->view('template/panel_v1/footer');
	}

	public function cuenta()
	{
		$usuario_id = $this->uri->segment(3);
		$this->data_header['usuario'] = $this->usuario_model->obtener($usuario_id);

		if($this->data_header['usuario'])
		{
			$this->load->view('template/panel_v1/header', $this->data_header);
			$this->load->view('membresias/cuenta');
			$this->load->view('template/panel_v1/footer');
		}
		else{
			redirect(base_url().'membresias');
		}
	}

	public function pagar()
	{
		if(!$this->input->post()){
			redirect(base_url().'membresias');
			exit();
		}

		$membresia_id = $this->input->post('f_membresia_id_pagar');
		$membresia = $this->membresia_model->obtener_usuario_id($membresia_id);

		$membresia_renovada = array(
			'pago'	 				=> 1,
			'estado' 				=> 1,
			'actualizado' 			=> date('Y-m-d H:i:s')
		);

		if($this->membresia_model->modifica($membresia_renovada, $membresia_id))
		{
			$membresia_historial = array(
				'membresia_id' 				=> $membresia_id,
				'accion' 					=> 1,
				'estado' 					=> 1,
				'creado' 					=> date('Y-m-d H:i:s'),
				'actualizado_usuario_id' 	=> $this->session->userdata('usuario_id'),
				'actualizado' 				=> date('Y-m-d H:i:s')
			);

			$this->membresia_model->alta_historial($membresia_historial);
			// Alerta exitosa
		}
		else{
			// Alerta error
		}

		redirect(base_url().'membresias/cuenta/'.$membresia->usuario_cliente_id);
	}

	public function cancelar()
	{
		if(!$this->input->post()){
			redirect(base_url().'membresias');
			exit();
		}

		$membresia_id = $this->input->post('f_membresia_id_cancelar');
		$membresia = $this->membresia_model->obtener_usuario_id($membresia_id);

		$membresia_renovada = array(
			'pago'	 				=> 0,
			'estado' 				=> 0,
			'actualizado' 			=> date('Y-m-d H:i:s')
		);

		if($this->membresia_model->modifica($membresia_renovada, $membresia_id))
		{
			$membresia_historial = array(
				'membresia_id' 				=> $membresia_id,
				'accion' 					=> 0,
				'estado' 					=> 1,
				'creado' 					=> date('Y-m-d H:i:s'),
				'actualizado_usuario_id' 	=> $this->session->userdata('usuario_id'),
				'actualizado' 				=> date('Y-m-d H:i:s')
			);

			$this->membresia_model->alta_historial($membresia_historial);
			// Alerta exitosa
		}
		else{
			// Alerta error
		}

		redirect(base_url().'membresias/cuenta/'.$membresia->usuario_cliente_id);
	}

	public function lista()
	{
		$this->datatables->add_column('icono', '<i class="fa fa-circle"></i>', 'icono');
        $this->datatables->select('gimnasio_usuarios.id as id,
        	CONCAT(gimnasio_usuarios.apellido, " ", gimnasio_usuarios.nombre) as nombre_completo,
        	gimnasio_usuarios.apodo as apodo,
        	gimnasio_usuarios.identificacion as identificacion,
        	gimnasio_usuarios.estado as estado,

        	gimnasio_planes.nombre as plan_nombre,
        	
        	IF(CURDATE() > DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), 1, 0 ) as estado_vencimiento,
			IF(CURDATE() = DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), 1, 0 ) as estado_vencimiento_hoy');
        $this->datatables->group_by('gimnasio_usuarios_membresia.usuario_cliente_id');
        $this->datatables->from('gimnasio_usuarios');

        $this->datatables->join('gimnasio_usuarios_membresia', 'gimnasio_usuarios_membresia.usuario_cliente_id = gimnasio_usuarios.id');

        $this->datatables->join('gimnasio_planes', 'gimnasio_usuarios_membresia.plan_id = gimnasio_planes.id');
        $this->datatables->where('DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH) >= CURDATE()');

        $this->datatables->where('gimnasio_usuarios_membresia.estado =', 1);
		$this->datatables->where('gimnasio_usuarios.estado', 1);

  		echo $this->datatables->generate();
	}

	public function lista_vencidas()
	{
		$this->datatables->add_column('icono', '<i class="fa fa-circle"></i>', 'icono');
        $this->datatables->select('gimnasio_usuarios.id as id,
        	CONCAT(gimnasio_usuarios.apellido, " ", gimnasio_usuarios.nombre) as nombre_completo,
        	gimnasio_usuarios.apodo as apodo,
        	gimnasio_usuarios.identificacion as identificacion,
        	gimnasio_usuarios.estado as estado,

        	gimnasio_planes.nombre as plan_nombre,
        	
        	IF(CURDATE() > DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), 1, 0 ) as estado_vencimiento,
			IF(CURDATE() = DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), 1, 0 ) as estado_vencimiento_hoy');
        $this->datatables->group_by('gimnasio_usuarios_membresia.usuario_cliente_id');
        $this->datatables->from('gimnasio_usuarios');

        $this->datatables->join('gimnasio_usuarios_membresia', 'gimnasio_usuarios_membresia.usuario_cliente_id = gimnasio_usuarios.id');

        $this->datatables->join('gimnasio_planes', 'gimnasio_usuarios_membresia.plan_id = gimnasio_planes.id');
        $this->datatables->where('DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH) = CURDATE()');
        $this->datatables->where('gimnasio_usuarios_membresia.estado =', 2);

		$this->datatables->where('gimnasio_usuarios.estado', 1);

  		echo $this->datatables->generate();
	}

	public function lista_membresias_cuenta()
	{
    	$usuario_id = $this->input->post('f_usuario_id'); 

		$this->datatables->add_column('icono', '<i class="fa fa-circle"></i>', 'icono');
		$this->datatables->select('gimnasio_usuarios_membresia.*,

            gimnasio_planes.nombre as membresia_nombre,
            gimnasio_planes.precio as membresia_precio,

            DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH) as fecha_finalizacion,

            DATE_FORMAT(DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), "%d/%m/%Y") as fecha_finalizacion_formateado,
            DATE_FORMAT(gimnasio_usuarios_membresia.fecha_inicio, "%d/%m/%Y") as fecha_inicio_formateado,


			DATE_FORMAT(DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), "%d/%m/%Y") as vencimiento,
			IF(CURDATE() > DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), 1, 0 ) as estado_vencimiento,
			IF(CURDATE() = DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), 1, 0 ) as estado_vencimiento_hoy,

			DATE_FORMAT(gimnasio_usuarios_membresia.fecha_inicio, "%m") as periodo_num_formateado,
			DATE_FORMAT(gimnasio_usuarios_membresia.creado, "%d/%m/%Y") as creado_formateado,
			gimnasio_usuarios_membresia.estado as estado');
		$this->datatables->from('gimnasio_usuarios_membresia');
        $this->datatables->join('gimnasio_planes', 'gimnasio_usuarios_membresia.plan_id = gimnasio_planes.id');
        $this->datatables->where('gimnasio_usuarios_membresia.usuario_cliente_id', $usuario_id);

  		echo $this->datatables->generate();
	}
}
