<?php 
    class MdModelos extends CI_Model{
        function __construct()
        {
            parent::__construct();
        }
        public function listar($intMarcaId){
            $this->db->select("id,marca_id,nombre,CASE status WHEN 1 THEN 'Activo' WHEN 2 THEN 'Cancelado' ELSE 'Otro' END AS status");
            $this->db->from ('modelos');
            $this->db->where('marca_id',$intMarcaId);  
            $consulta=$this->db->get();
            return $consulta->result();
        }
    }    
?>