<?php

class Membresia_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function alta($data)
    {
        return $this->db->insert('gimnasio_usuarios_membresia', $data);
    }

    public function alta_historial($data)
    {
        return $this->db->insert('gimnasio_usuarios_membresia_historial', $data);
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

    public function obtener_usuario_id($id)
    {
        $this->db->select('gimnasio_usuarios_membresia.id as id,
            gimnasio_usuarios_membresia.usuario_cliente_id as usuario_cliente_id');
        $this->db->from('gimnasio_usuarios_membresia');
        $this->db->where('gimnasio_usuarios_membresia.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_estado_membresia_periodo($usuario_id, $periodo)
    {
        $this->db->select('gimnasio_usuarios_membresia.id,
            gimnasio_usuarios_membresia.estado,
            gimnasio_usuarios_membresia.usuario_cliente_id,
            gimnasio_usuarios_membresia.fecha_inicio,
            
            DATE_FORMAT(gimnasio_usuarios_membresia.fecha_inicio, "%m") as periodo_num_formateado,
            IF(CURDATE() = DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH), 1, 0 ) as estado_vencimiento_hoy');
        $this->db->from('gimnasio_usuarios_membresia');
        $this->db->join('gimnasio_planes', 'gimnasio_planes.id = gimnasio_usuarios_membresia.plan_id');
        $this->db->where('gimnasio_usuarios_membresia.usuario_cliente_id =', $usuario_id);
        $this->db->where('DATE_FORMAT(gimnasio_usuarios_membresia.fecha_inicio, "%Y-%m") =', $periodo);
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_todos()
    {
        $this->db->select('gimnasio_usuarios_membresia.*,
            DATE_FORMAT(gimnasio_usuarios_membresia.creado, "%d/%m/%Y") as creado_format');
        $this->db->from('gimnasio_usuarios_membresia');
        $this->db->where('gimnasio_usuarios_membresia.estado', 1);

        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_total_clientes_activos()
    {
        $this->db->select('COUNT(gimnasio_usuarios.id) as total');
        $this->db->group_by('gimnasio_usuarios_membresia.usuario_cliente_id');
        $this->db->from('gimnasio_usuarios');
        
        $this->db->join('gimnasio_usuarios_membresia', 'gimnasio_usuarios_membresia.usuario_cliente_id = gimnasio_usuarios.id');

        $this->db->join('gimnasio_planes', 'gimnasio_usuarios_membresia.plan_id = gimnasio_planes.id');
        $this->db->where('DATE_ADD(gimnasio_usuarios_membresia.fecha_inicio, INTERVAL gimnasio_planes.periodo MONTH) >= CURDATE()');
        $this->db->where('gimnasio_usuarios_membresia.estado =', 1);
        
        $this->db->where('gimnasio_usuarios.estado', 1);

        $query = $this->db->get();
        return $query->result();
    }

}
