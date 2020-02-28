<?php
class Hola extends CI_Controller{
    var $hola='';
    public function __construct(){
        parent::__construct();
        $this->hola='Iniciando';
    }
    public function index(){
        $data['srtHola']=$this->hola;
        $data['srtEjemplo']=100;
        $this->load->view('hola',$data,FALSE);
    }
    public function dos(){
        echo '<h1>Hola CI!!!x2</h1>';
        echo $this->hola;
    }
    public function saludar($nombre=''){
        $data['nombre']=$nombre;
        $this->load->view('saludo',$data);
    }    
}
?>