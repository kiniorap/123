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
            $dblSubTotal=$producto->cantidad * $producto->precio;
            $producto->subTotal=$dblSubTotal;
            $this->carrito[]=$producto;
            $this->load->model('MdModelos');
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
            $intModeloId=$this->input->post('intModeloId');
            $intCantidad=$this->input->post('intCantidad');
            $arrModelos=$this->MdModelos->buscar($intModeloId);
            $objModelo=$arrModelos[0];
            $objModelo->cantidad=$intCantidad;
            $dblSubTotal=$objModelo->cantidad * $objModelo->precio;
            $objModelo->subTotal=$dblSubTotal;
            $this->carrito[]=$objModelo;
            //array_push($this->carrito,$objModelo);
            echo var_dump($objModelo);
            $dblSubTotal=0;
            $dblCostoEnvio=0;
            $dblIva=0;
            $dblTotal=0;
            foreach ($this->carrito as $objModelo) {
                $dblSubTotal+=$objModelo->subTotal;
            }
            $arrDatosDinamicos['dblSubTotal']=$dblSubTotal;
            $arrDatosDinamicos['arrPedidos']=$this->carrito;
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }    
?>