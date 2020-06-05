<?php

class Asistencia_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function alta($data)
    {
        return $this->db->insert('gimnasio_usuarios_asistencia', $data);
    }

    public function alta_historial($data)
    {
        return $this->db->insert('gimnasio_usuarios_asistencia_historial', $data);
    }

    public function modifica($data, $id)
    {
        $this->db->where('gimnasio_usuarios_asistencia.id', $id);

        return $this->db->update('gimnasio_usuarios_asistencia', $data);
    }

    public function obtener_disponibles($fecha, $hora_ingreso)
    {
        $this->db->select('COUNT(gimnasio_usuarios_asistencia.id) as total');
        $this->db->from('gimnasio_usuarios_asistencia');
        $this->db->where('gimnasio_usuarios_asistencia.fecha =', $fecha);
        $this->db->where('gimnasio_usuarios_asistencia.hora =', $hora_ingreso);
        // $this->db->where('gimnasio_usuarios_asistencia.usuario_cliente_id =', $usuario_id);
        $this->db->where('gimnasio_usuarios_asistencia.estado !=', 0);

        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_asistencia_diaria($usuario_id, $fecha)
    {
        $this->db->select('gimnasio_usuarios_asistencia.*');
        $this->db->from('gimnasio_usuarios_asistencia');
        $this->db->where('gimnasio_usuarios_asistencia.fecha =', $fecha);
        $this->db->where('gimnasio_usuarios_asistencia.usuario_cliente_id =', $usuario_id);
        // $this->db->where('gimnasio_usuarios_asistencia.estado !=', 0);

        $query = $this->db->get();
        return $query->row();
    }

}
