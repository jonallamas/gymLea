<?php

class Usuario_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function alta($data)
    {
        return $this->db->insert('gimnasio_usuarios', $data);
    }

    public function modifica($data, $codigo)
    {
        $this->db->where('gimnasio_usuarios.id', $id);

        return $this->db->update('gimnasio_usuarios', $data);
    }

    public function obtener($id)
    {
        $this->db->select('gimnasio_usuarios.*');
        $this->db->from('gimnasio_usuarios');
        $this->db->where('gimnasio_usuarios.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_x_dni($dni)
    {
        $this->db->select('gimnasio_usuarios.id as id,
            CONCAT(gimnasio_usuarios.apellido, " ", gimnasio_usuarios.nombre) as nombre_completo,
            gimnasio_usuarios.dni as dni,
            gimnasio_usuarios.estado');
        $this->db->from('gimnasio_usuarios');
        $this->db->where('gimnasio_usuarios.dni', $dni);

        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_ultimo_identificador()
    {
        $this->db->select('gimnasio_usuarios.id');
        $this->db->from('gimnasio_usuarios');
        $this->db->order_by('gimnasio_usuarios.id', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_total_clientes()
    {
        $this->db->select('COUNT(gimnasio_usuarios.id) as total');
        $this->db->from('gimnasio_usuarios');
        $this->db->where('gimnasio_usuarios.estado', 1);
        $this->db->where('gimnasio_usuarios.tipo', 2);

        $query = $this->db->get();
        return $query->row();
    }
    
    public function login($correo, $password)
    {
        $this->db->select('gimnasio_usuarios.id as id,
            gimnasio_usuarios.apellido as apellido,
            gimnasio_usuarios.nombre as nombre,
            gimnasio_usuarios.tipo as tipo');
        $this->db->from('gimnasio_usuarios');
        $this->db->where('gimnasio_usuarios.log_correo', $correo);
        $this->db->where('gimnasio_usuarios.log_pass', $password);
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

}
