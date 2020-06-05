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
		$this->load->model('configuracion_model');

		//Configurando el data_header
		$this->data_header['titulo'] = 'Administración de usuarios';
		$this->data_header['seccion_menu'] = 'gimnasio_usuarios';

		// if(!$this->session->userdata('conectado') || $this->session->userdata('usuario_tipo') != 1){
		// 	redirect(base_url());
		// }

		$this->data_header['configuracion'] = $this->configuracion_model->obtener();
	}

	public function index()
	{	
		$this->data_header['modulo_editar'] = 0;
		$this->data_header['js_usuarios'] = $this->load->view('usuarios/_js/js_usuarios', $this->data_header, true);

		$this->data_header['planes'] = $this->plan_model->obtener_todos();

		$ultima_identificacion = $this->usuario_model->obtener_ultimo_identificador();
		$this->data_header['identificador'] = $ultima_identificacion->id + 1;

		$this->load->view('template/panel_v1/header', $this->data_header);
		$this->load->view('usuarios/usuarios');
		$this->load->view('template/panel_v1/footer');
	}

	public function editar()
	{	
		$usuario_id = $this->uri->segment(3);
		$usuario = $this->usuario_model->obtener($usuario_id);

		if($usuario){
			$this->data_header['modulo_editar'] = 1;
			$this->data_header['usuario'] = $usuario;
			$this->data_header['js_usuarios'] = $this->load->view('usuarios/_js/js_usuarios', $this->data_header, true);

			$this->data_header['planes'] = $this->plan_model->obtener_todos();

			$this->load->view('template/panel_v1/header', $this->data_header);
			$this->load->view('usuarios/editar');
			$this->load->view('template/panel_v1/footer');
		}else{
			redirect(base_url().'panel');
		}
	}

	public function obtener_usuario_x_dni()
	{
		$dni = $this->input->post('f_dni');
		$fecha = $this->input->post('f_fecha');
		$usuario = $this->usuario_model->obtener_x_dni($dni);

		// Tipo:
		// 1- Consulta de si posee una membresía activa
		// 2- Consulta de si posee una asistencia activa
		$tipo = $this->input->post('f_tipo');

		if($usuario){
			$membresias = $this->membresia_model->obtener_membresias_periodo($usuario->id, date('Y'));

			$estado_membresia = null;

			foreach ($membresias as $membresia) {
				if(date('Y-m-d') <= $membresia->fecha_vencimiento && date('Y-m-d') >= $membresia->fecha_inicio){
					$estado_membresia = $membresia->estado;
				}
			}
			
			if($tipo == 2){
				$this->load->model('asistencia_model');
				$asistencia_actual = $this->asistencia_model->obtener_asistencia_diaria($usuario->id, date('Y-m-d', strtotime($fecha)));
				
				$data = array(
					'error' => 0,
					'error_texto' => null,
					'usuario' => $usuario,
					'asistencia' => $asistencia_actual
				);
			}else{
				$data = array(
					'error' => 0,
					'error_texto' => null,
					'usuario' => $usuario,
					'membresia_estado' => $estado_membresia
				);
			}
		}else{
			$data = array(
				'error' => 1,
				'error_texto' => 'DNI no encontrado',
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

		if($tipo_id == 1){
			$correo = $this->input->post('f_usuario_correo');
			$password = md5($this->input->post('f_usuario_pass'));
		}else{
			$correo = null;
			$password = null;
		}

		if($usuario_id){
			$datos_usuario = array(
				'apellido'			=> $this->input->post('f_usuario_apellido'),
				'nombre'			=> $this->input->post('f_usuario_nombre'),
				'dni'				=> $this->input->post('f_usuario_dni'),
				'fecha_nacimiento'	=> date('Y-m-d', strtotime($this->input->post('f_usuario_fecha_nacimiento'))),

				'telefono'			=> $this->input->post('f_usuario_telefono'),
				'direccion'			=> $this->input->post('f_usuario_direccion'),
			
				'actualizado' 		=> date('Y-m-d H:i:s')
			);

			if($this->usuario_model->modifica($datos_usuario, $usuario_id)){
				redirect(base_url().'usuarios/editar/'.$usuario_id);
				// Alerta exitosa
			}
			else{
				// Alerta error
			}
		}else{
			$ultima_identificacion = $this->usuario_model->obtener_ultimo_identificador();

			$identificador = $ultima_identificacion->id + 1;

			$datos_usuario = array(
				'identificacion' 	=> 'M'.$identificador,
				'tipo'				=> $tipo_id,

				'apellido'			=> $this->input->post('f_usuario_apellido'),
				'nombre'			=> $this->input->post('f_usuario_nombre'),
				'dni'				=> $this->input->post('f_usuario_dni'),
				'fecha_nacimiento'	=> date('Y-m-d', strtotime($this->input->post('f_usuario_fecha_nacimiento'))),

				'telefono'			=> $this->input->post('f_usuario_telefono'),
				'direccion'			=> $this->input->post('f_usuario_direccion'),

				'correo'			=> $correo,
				'log_correo'		=> $correo,
				'log_pass'			=> $password,
				
				'validado'			=> 1,
				'estado' 			=> 1,
				'creado'			=> date('Y-m-d H:i:s'),
				'actualizado' 		=> date('Y-m-d H:i:s')
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
			gimnasio_usuarios.dni as dni,
			gimnasio_usuarios.identificacion as identificacion,

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
