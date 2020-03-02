<?php
    class Pedidos extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($intMarca=1){
            $intMarca=$this->input->post('intMarca');
            if($intMarca=='')$intMarca=0; 
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarca);
            $arrDatosDinamicos['intMarca']=$intMarca;
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function agregarCarrito(){
            $carrito=[];
            $producto=new stdClass();
            $producto->id='1';
            $producto->nombre='yo';
            $producto->cantidad='1';
            $producto->precio='15';
            $carrito[]=$producto;
            $arrDatosDinamicos['arrPedidos']=$carrito;
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }    
?>