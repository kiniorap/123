<?php
    class Marcas extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        public function index($arrDatos=[]){
            $arrDatosDinamico['arrMarcas']=$this->MdMarcas->listar();
            foreach($arrDatosDinamico['arrMarcas']as $marca){
                //$marca->strId=$this->encrypt->encode($marca->id);
                $marca->strId=$marca->id;
            }
            $arrDatos['strActivo']='marcas';
            $arrDatos['strContenido']=$this->load->view('marcas/listar',$arrDatosDinamico,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function agregar($arrDatos=[]){
            $arrDatos['strActivo']='marcas';
            $arrDatos['strContenido']=$this->load->view('marcas/agregar',NULL,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function guardar(){
            $intId=$this->input->post('intId');
            if($intId==''){
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre',
                    'required|is_unique[marcas.nombre]',
                    array(
                        'required'=>'Ingrese un %s.',
                        'is_unique'=>'El %s ya existe, ingrese uno distinto.'
                    )
                ); 
            }else{
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre','required',
                    array(
                        'required'=>'Ingrese un %s.',
                    )
                );    
            }
            $this->form_validation->set_rules(
                'intEstatus', 'Estatus',
                'required|integer|greater_than[0]',
                array(
                    'required'=>'Ingrese un %s.',
                    'integer'=>'El %s debe ser un número.',
                    'greater_than'=>'Seleccione un %s'
                )
            );
            if ($this->form_validation->run() == FALSE){
                if($intId==''){                
                    $this->agregar();
                }else{
                    $this->editar($intId,TRUE);
                }
            }else{
                $strNombre=$this->input->post('strNombre');
                $strDescripcion=$this->input->post('strDescripcion');
                $intStatus=$this->input->post('intEstatus');
                $intResultado=0;
                if ($intId==''){
                    $intResultado=$this->MdMarcas->agregar($strNombre,$strDescripcion,$intStatus);
                }else
                {
                    $intResultado=$this->MdMarcas->editar($intId,$strNombre,$strDescripcion,$intStatus);
                }
                if($intResultado==1){
                    $arrDatos['arrMensajes']=[array ('intTipo'=>1,'strMensaje'=>'El registro fue guardado')]; 
                    $this->index($arrDatos);
                }else{
                    $arrDatos['arrMensajes']=[array ('intTipo'=>2,'strMensaje'=>'error al guardar')]; 
                    $this->agregar($arrDatos);
                }
            }       
        }   
        public function editar($intId,$EsEditarGuardar=FALSE){
            if(!$EsEditarGuardar){$arrDatos['registro']= $this->MdMarcas->buscar($intId);}
            $arrDatos['strActivo']='marcas';
            $arrDatos['strContenido']=$this->load->view('marcas/agregar',$arrDatos,TRUE);
            $this->load->view('principal',$arrDatos); 
        }
        public function eliminar(){
            $intId=$this->input->post('intId');
            if($intId!=''){
                //$intId=$this->encrypt->decode($strId);
                if($this->MdMarcas->eliminar($intId)==1){
                    $arrDatos['arrMensajes']=[array ('intTipo'=>1,'strMensaje'=>'El registro fue eliminado')]; 
                }else{
                    $arrDatos['arrMensajes']=[array ('intTipo'=>2,'strMensaje'=>'Error al eliminar')]; 
                }
            }else{
                $arrDatos['arrMensajes']=[array ('intTipo'=>2,'strMensaje'=>'Error no se debe eliminar así')]; 
            }
            $this->index($arrDatos);
        }
    }
?>