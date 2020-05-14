<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Carga de los modelos
		$this->load->model('usuario_model');
		$this->load->model('plan_model');
		$this->load->model('membresia_model');
		$this->load->model('contratacion_model');

		//Configurando el data_header
		$this->data_header['titulo'] = 'Administración de usuarios';
		$this->data_header['seccion_menu'] = 'tienda_usuarios';

		if(!$this->session->userdata('conectado') || $this->session->userdata('usuario_tipo') != 1){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->data_header['planes'] = $this->plan_model->obtener_todos();

		$ultima_identificacion = $this->usuario_model->obtener_ultimo_identificador();
		$this->data_header['identificador'] = $ultima_identificacion->id + 1;

		$this->load->view('template/panel_v1/header', $this->data_header);
		$this->load->view('usuarios/usuarios');
		$this->load->view('template/panel_v1/footer');
	}

	public function obtener_usuario_x_dni()
	{
		$dni = $this->input->post('f_dni');
		$usuario = $this->usuario_model->obtener_x_dni($dni);

		if($usuario){
			$estado_membresia = $this->membresia_model->obtener_estado_membresia_periodo($usuario->id, date('Y-m'));
			
			$data = array(
				'error' => 0,
				'error_texto' => null,
				'usuario' => $usuario,
				'membresia' => $estado_membresia
			);
		}else{
			$data = array(
				'error' => 1,
				'error_texto' => 'No se ha encontrado usuario con ese DNI',
			);
		}

		echo json_encode($data);
	}

	public function guardar()
	{
		if(!$this->input->post()){
			redirect(base_url().'usuarios');
			exit();
		}

		$usuario_id = $this->input->post('f_usuario_id');
		$tipo_id = $this->input->post('f_usuario_tipo_id');
		
		if($usuario_id)
		{
			// $datos_usuario = array(
			// 	'apellido'		=> $this->input->post('f_usuario_apellido'),
			// 	'nombre'		=> $this->input->post('f_usuario_nombre'),
			// 	'apodo'			=> $this->input->post('f_usuario_apodo'),
			// 	'telefono'		=> $this->input->post('f_usuario_telefono'),
			// 	'correo'		=> $this->input->post('f_usuario_correo'),

			// 	'log_correo'	=> $this->input->post('f_usuario_correo'),
			// 	'log_pass'		=> md5($this->input->post('f_usuario_pass')),

			// 	'tipo'			=> $tipo_id,
				
			// 	'actualizado' 	=> date('Y-m-d H:i:s')
			// );

			// if($this->usuario_model->modifica($datos_usuario, $usuario_id)){
			// 	// Alerta exitosa
			// }
			// else{
			// 	// Alerta error
			// }
		}else{
			$ultima_identificacion = $this->usuario_model->obtener_ultimo_identificador();

			$identificador = $ultima_identificacion->id + 1;

			$datos_usuario = array(
				'identificacion' => 'M'.$identificador,
				'apellido'		=> $this->input->post('f_usuario_apellido'),

				'nombre'		=> $this->input->post('f_usuario_nombre'),
				'apodo'			=> $this->input->post('f_usuario_apodo'),

				'telefono'		=> $this->input->post('f_usuario_telefono'),
				'direccion'		=> $this->input->post('f_usuario_direccion'),

				'correo'		=> $this->input->post('f_usuario_correo'),
				'log_correo'	=> $this->input->post('f_usuario_correo'),
				'log_pass'		=> md5($this->input->post('f_usuario_pass')),
				
				'validado'		=> 1,
				'tipo'			=> $tipo_id,

				'estado' 		=> 1,
				'creado'		=> date('Y-m-d H:i:s'),
				'actualizado' 	=> date('Y-m-d H:i:s')
			);

			if($this->usuario_model->alta($datos_usuario)){ 
				if($tipo_id == 2){
					$usuario_id = $this->db->insert_id();

					$cant_meses_restantes = 12 - date('m', strtotime($this->input->post('f_membresia_valido_desde')));

					for ($i = 0; $i <= $cant_meses_restantes; $i++) {
						$dato_membresia = array(
							'usuario_cliente_id'	=> $usuario_id,
							'plan_id'				=> $this->input->post('f_membresia_plan_id'),
							'fecha_inicio'			=> date('Y-m-d', strtotime($this->input->post('f_membresia_valido_desde')." + ".$i." month")),
							'pago' 					=> 2,
							
							'estado'				=> 2,
							'creado'				=> date('Y-m-d H:i:s'),
							'actualizado_usuario_id' => $this->session->userdata('usuario_id'),
							'actualizado' 			=> date('Y-m-d H:i:s')
						);

						$this->membresia_model->alta($dato_membresia);
					}

				}

				redirect(base_url().'membresias/cuenta/'.$usuario_id);

				// Alerta exitosa
			}
			else{
				// Alerta error
			}
		}
	}

	public function lista()
	{
		$this->datatables->add_column('icono', '<i class="fa fa-circle"></i>', 'icono');
		$this->datatables->select('gimnasio_usuarios.id as id,
			gimnasio_usuarios.apellido as apellido,
			gimnasio_usuarios.nombre as nombre,
			gimnasio_usuarios.telefono as telefono,
			gimnasio_usuarios.correo as correo,
			gimnasio_usuarios.validado as validado,
			gimnasio_usuarios.tipo as tipo,

			CONCAT(gimnasio_usuarios.apellido, " ", gimnasio_usuarios.nombre) as nombre_completo,

			gimnasio_usuarios.creado as creado,
			DATE_FORMAT(gimnasio_usuarios.creado, "%d/%m/%Y") as creado_formateado,
			gimnasio_usuarios.estado as estado');
		$this->datatables->from('gimnasio_usuarios');
		$this->datatables->where('gimnasio_usuarios.estado !=', 2);

  		echo $this->datatables->generate();
	}
}
