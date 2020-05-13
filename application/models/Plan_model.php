<?php

class Plan_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function alta($data)
    {
        return $this->db->insert('gimnasio_planes', $data);
    }

    public function modifica($data, $id)
    {
        $this->db->where('gimnasio_planes.id', $id);

        return $this->db->update('gimnasio_planes', $data);
    }

    public function obtener($id)
    {
        $this->db->select('gimnasio_planes.*');
        $this->db->from('gimnasio_planes');
        $this->db->where('gimnasio_planes.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_todos()
    {
        $this->db->select('gimnasio_planes.*,
            DATE_FORMAT(gimnasio_planes.creado, "%d/%m/%Y") as creado_format');
        $this->db->from('gimnasio_planes');
        $this->db->where('gimnasio_planes.estado', 1);

        $query = $this->db->get();
        return $query->result();
    }

}
