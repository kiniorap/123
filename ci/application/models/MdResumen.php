<?php 
    class MdResumen extends CI_Model{
        function __construct()
        {
            parent::__construct();
        }
        public function listar(){
            $this->db->select("id,nombre_cliente,direccion,CASE estatus WHEN 1 THEN 'En proceso de envio' WHEN 2 THEN 'En ruta' WHEN 3 THEN 'Cancelado' ELSE 'Otro' END AS estatus");
            $this->db->from ('pedidos');
            $consulta=$this->db->get();
            return $consulta->result();
        }
    }
?>