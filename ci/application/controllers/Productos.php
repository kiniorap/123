<?php
    class Productos extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($intMarca=1){
            $intMarca=$this->input->post('intMarca');
            if($intMarca=='')$intMarca=0; 
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarca);
            $arrDatosDinamicos['intMarca']=$intMarca;
            $arrDatos['strActivo']='productos';
            $arrDatos['strContenido']=$this->load->view('productos/agregar',$arrDatosDinamicos,TRUE);
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
            
            $arrDatosDinamicos['arrProductos']=$carrito;
            $arrDatos['strActivo']='productos';
            $arrDatos['strContenido']=$this->load->view('productos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        

        }
    }    
?>