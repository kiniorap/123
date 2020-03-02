<?php
    class Modelos extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('MdModelos');
        }
        public function index(){
            $intMarcasId=$this->input->post('intMarcasId');
            if($intMarcasId=='')$intMarcasId=0; 
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcasId);
            $arrDatosDinamicos['intMarcasId']=$intMarcasId;
            $arrDatos['strActivo']='modelos';
            $arrDatos['strContenido']=$this->load->view('modelos/listar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function guardar(){
            $intId=$this->input->post('intId');
            if($intId==''){
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre',
                    'required|is_unique[modelos.nombre]',
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
                'intMarca', 'Marca',
                'required|integer',
                array(
                    'required'=>'Seleccione un %s.',
                    'integer'=>'El %s debe ser un número.'
                )
            );
            $this->form_validation->set_rules(
                'intEstatus', 'Estatus',
                'required|integer|greater_than[0]',
                array(
                    'required'=>'Ingrese un %s.',
                    'integer'=>'El %s debe ser un número.',
                    'greater_than'=>'Seleccione un %s'
                )
            );
            $this->form_validation->set_rules(
                'floatPrecio', 'Precio',
                'required|float|greater_than[0]',
                array(
                    'required'=>'Ingrese un %s.',
                    'float'=>'El %s debe ser un número.',
                    'greater_than'=>'Seleccione un %s'
                )
            );
            if ($this->form_validation->run() == FALSE){
                if($intId==''){                
                    $this->index();
                }else{
                    $this->editar($intId,TRUE);
                }
            }else{
                $intMarcasId=$this->input->post('intMarcasId');
                $strNombre=$this->input->post('strNombre');
                $strDescripcion=$this->input->post('strDescripcion');
                $intStatus=$this->input->post('intEstatus');
                $floatPrecio=$this->input->post('floatPrecio');
                $intResultado=0;
                if ($intId==''){
                    $intResultado=$this->MdMarcas->listar($strNombre,$strDescripcion,$intStatus,$floatPrecio);
                }else
                {
                    $intResultado=$this->MdMarcas->editar($intId,$strNombre,$strDescripcion,$intStatus,$floatPrecio);
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
            $this->listar($arrDatos);
        }
    }
?>