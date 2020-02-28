<?php 
    class MdProductos extends CI_Model{
        function __construct()
        {
            parent::__construct();
        }
        public function listar(){
            $this->db->select("id,marca_id,nombre,CASE status WHEN 1 THEN 'Activo' WHEN 2 THEN 'Cancelado' ELSE 'Otro' END AS status");
            $this->db->from ('modelos');
            $consulta=$this->db->get();
            return $consulta->result();
        }
        public function reporte(){
            $this->db->select("id_pedidos,id_modelos,cantidad,precio");
            $this->db->from ('resumen_pedidos');
            $consulta=$this->db->get();
            return $consulta->result();
        }
    }    
?>