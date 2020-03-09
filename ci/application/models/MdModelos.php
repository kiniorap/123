<?php 
    class MdModelos extends CI_Model{
        function __construct()
        {
            parent::__construct();
        }
        public function listar($intMarcaId){
            $this->db->select("id,marca_id,nombre,precio,CASE status WHEN 1 THEN 'Activo' WHEN 2 THEN 'Cancelado' ELSE 'Otro' END AS status");
            $this->db->from ('modelos');
            $this->db->where('marca_id',$intMarcaId);  
            $consulta=$this->db->get();
            return $consulta->result();
        }
        public function buscar($intModelosId){
            $this->db->select("id,marca_id,nombre,precio");
            $this->db->from ('modelos');
            $this->db->where('id',$intModelosId);  
            $consulta=$this->db->get();
            return $consulta->result();
        }
        public function agregar($strNombre,$strDireccion,$intEstatus,$intFechaCaptura,$intFechaEntrega,$intCostoEnvio){
            $this->db->set('nombre_cliente',$strNombre);
            $this->db->set('direccion',$strDireccion);
            $this->db->set('estatus',$intEstatus);  
            $this->db->set('fecha_captura',$intFechaCaptura);  
            $this->db->set('fecha_entrega',$intFechaEntrega);  
            $this->db->set('costo_envio',$intCostoEnvio); 
            $this->db->insert('pedidos');
            return $this->db->affected_rows();
        }
    }    
?>