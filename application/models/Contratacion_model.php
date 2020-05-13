<?php

class Contratacion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function alta($data)
    {
        return $this->db->insert('gimnasio_usuarios_membresia', $data);
    }

    public function modifica($data, $id)
    {
        $this->db->where('gimnasio_usuarios_membresia.id', $id);

        return $this->db->update('gimnasio_usuarios_membresia', $data);
    }

    public function obtener($id)
    {
        $this->db->select('gimnasio_usuarios_membresia.*');
        $this->db->from('gimnasio_usuarios_membresia');
        $this->db->where('gimnasio_usuarios_membresia.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

}
