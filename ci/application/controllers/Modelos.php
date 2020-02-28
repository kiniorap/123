<?php
    class Modelos extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($intMarca=1){
            $intMarca=$this->input->post('intMarca');
            if($intMarca=='')$intMarca=0; 
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarca);
            $arrDatosDinamicos['intMarca']=$intMarca;
            $arrDatos['strActivo']='modelos';
            $arrDatos['strContenido']=$this->load->view('modelos/listar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }
?>