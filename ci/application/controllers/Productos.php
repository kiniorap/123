<?php
    class Productos extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($intMarca=1){
            $intMarca=$this->input->post('intMarca');
            if($intMarca=='')$intMarca=0; 
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdProductos->listar($intMarca);
            $arrDatosDinamicos['intMarca']=$intMarca;
            $arrDatos['strActivo']='productos';
            $arrDatos['strContenido']=$this->load->view('productos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }    
?>