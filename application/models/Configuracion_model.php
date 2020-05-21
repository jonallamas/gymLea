<?php

class Configuracion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function alta($data)
    {
        return $this->db->insert('gimnasio_configuraciones', $data);
    }

    public function modifica($data)
    {
        return $this->db->update('gimnasio_configuraciones', $data);
    }

    public function obtener()
    {
        $this->db->select('gimnasio_configuraciones.*');
        $this->db->from('gimnasio_configuraciones');

        $query = $this->db->get();
        return $query->row();
    }

}
