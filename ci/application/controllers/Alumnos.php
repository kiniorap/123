<?php
    class Alumnos extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index(){}
        public function listar(){
            $this->load->model('MdAlumnos');
            $datos = $this->MdAlumnos->obtenerAlumnos();
            $data['datos']=$datos;
            //var_dump($datos);
            $this->load->view('listar',$data,FALSE);
        }
    }
?>