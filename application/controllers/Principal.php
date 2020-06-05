<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('configuracion_model');
	}

	public function index()
	{
		$this->data_header['configuracion'] = $this->configuracion_model->obtener();
		$this->load->view('web/index', $this->data_header);
	}

}