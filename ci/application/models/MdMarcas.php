<?php
  class MdMarcas extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    public function index(){}
    public function listar(){
      $this->db->select("id,nombre,CASE status WHEN 1 THEN 'Activo' WHEN 2 THEN 'Cancelado' ELSE 'Otro' END AS status");
      $this->db->from ('marcas');  
      $consulta=$this->db->get();
      return $consulta->result();
    }
    public function agregar($strNombre,$strDescripcion,$intStatus){
      $this->db->set('nombre',$strNombre);
      $this->db->set('descripcion',$strDescripcion);
      $this->db->set('status',$intStatus);  
      $this->db->insert('marcas');
      return $this->db->affected_rows();
    }
    public function editar($intId,$strNombre,$strDescripcion,$intStatus){
      $this->db->set('nombre',$strNombre);
      $this->db->set('descripcion',$strDescripcion);
      $this->db->set('status',$intStatus);  
      $this->db->where('id',$intId);
      $this->db->update('marcas');
      return ($this->db->affected_rows() or $this->db->error()['code']==0);
    }
    public function buscar($intId){
      $this->db->select("id,nombre,descripcion,status");
      $this->db->from ('marcas');
      $this->db->where('id',$intId);  
      $consulta=$this->db->get();
      return $consulta->row();
    }
    public function eliminar($intId){  
      $this->db->where('id',$intId);
      $this->db->delete('marcas');
      return ($this->db->affected_rows() or $this->db->error()['code']==0);
    }
    public function buscarActivos(){
      $this->db->select("id,nombre");
      $this->db->from ('marcas');  
      $this->db->where ('status',1);  
      $consulta=$this->db->get();
      return $consulta->result();
    }
  }
?>