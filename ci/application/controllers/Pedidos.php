<?php
    class Pedidos extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->carrito=[];
            $producto=new stdClass();
            $producto->id='1';
            $producto->nombre='yo';
            $producto->cantidad='1';
            $producto->precio='15';
            $this->carrito[]=$producto;
        }
        public function index($intMarca=1){
            $intMarca=$this->input->post('intMarca');
            if($intMarca=='')$intMarca=0; 
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarca);
            $arrDatosDinamicos['arrPedidos']=$this->carrito;
            $arrDatosDinamicos['intMarca']=$intMarca;
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function agregarCarrito(){
            $arrDatosDinamicos['arrPedidos']=$this->carrito;
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }    
?>