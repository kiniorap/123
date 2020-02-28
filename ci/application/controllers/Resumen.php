<?php
    class Resumen extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){
            $arrDatosDinamico['arrPruebas']=$this->MdMarcas->listar();
            $arrDatos['strActivo']='resumen';
            $arrDatos['strContenido']=$this->load->view('productos/resumen',$arrDatosDinamico,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }    
?>