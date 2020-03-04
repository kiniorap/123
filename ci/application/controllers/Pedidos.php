<?php
    class Pedidos extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('MdModelos');
            $this->load->model('MdMarcas');
            if($this->session->has_userdata('arrCarrito')){
                $this->arrCarrito=$this->session->arrCarrito;//obterner de sesion
            }else{
                $this->arrCarrito=[];
                $this->session->set_userdata('arrCarrito',$this->arrCarrito);//asignar arrCarrito a una variable a sesion
            }
        }
        public function index(){ 
            $intMarcaId=$this->input->post('intMarcaId');
            if($intMarcaId=='')$intMarcaId=0; 
            $arrDatosDinamicos['intMarcaId']=$intMarcaId;
            //$intCostoEnvio=$this->input->post('intCostoEnvio');
            $arrDatosDinamicos['arrCarrito']=$this->arrCarrito;
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $this->datosEnvio();
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function agregarCarrito(){
            
            $intMarcaId=$this->input->post('intMarcaId');
            $intModeloId=$this->input->post('intModeloId');
            $intCantidad=$this->input->post('intCantidad');
            $arrModelos=$this->MdModelos->buscar($intModeloId);
            $objModelo=$arrModelos[0];
            $objModelo->cantidad=$intCantidad;
            $dblSubTotal=$objModelo->cantidad * $objModelo->precio;
            $objModelo->subTotal=$dblSubTotal;
            $this->arrCarrito[]=$objModelo;
            $this->session->set_userdata('arrCarrito',$this->arrCarrito);
            //array_push($this->carrito,$objModelo);
            //echo var_dump($objModelo);
            $dblSubTotal=0;
            $dblCostoEnvio=0;
            $dblIva=.16;
            $dblTotal=0;
            foreach ($this->arrCarrito as $objModelo) {
                $dblSubTotal+=$objModelo->subTotal;
            }
            foreach ($this->arrCarrito as $objModelo) {
                $dblSubTotalIva=$dblSubTotal * $dblIva;
            }
            foreach ($this->arrCarrito as $objModelo) {
                $dblTotal=$dblSubTotal + $dblSubTotalIva;
            }
            $arrDatosDinamicos['intMarcaId']=$intMarcaId;
            //$intCostoEnvio=$this->input->post('intCostoEnvio');
            $arrDatosDinamicos['dblSubTotal']=$dblSubTotal;
            $arrDatosDinamicos['dblSubTotalIva']=$dblSubTotalIva;
            $arrDatosDinamicos['dblTotal']=$dblTotal;
            $arrDatosDinamicos['arrCarrito']=$this->arrCarrito;
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function datosEnvio(){
            $strNombre=$this->input->post('strNombre');
            $dateFechaEntrega=$this->input->post('dateFechaEntrega');
            $strDireccion=$this->input->post('strDireccion');
            $intCostoEnvio=$this->input->post('intCostoEnvio');
            $arrDatosDinamicos['strNombre']=$strNombre;
            $arrDatosDinamicos['dateFechaEntrega']=$dateFechaEntrega;
            $arrDatosDinamicos['strDireccion']=$strDireccion;
            $arrDatosDinamicos['intCostoEnvio']=$intCostoEnvio;
        }
    }    
?>