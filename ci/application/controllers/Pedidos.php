<?php
    class Pedidos extends CI_Controller{
        function __construct(){//cargar propiedades a nivel clase con el conector $this
            parent::__construct();
            $this->load->model('MdModelos');//cargar un modelo a nivel clase
            $this->load->model('MdMarcas');//cargar un modelo a nivel clase
            //$this->session->set_userdata('arrCarrito',[]);//meter el carrito a session
            if($this->session->has_userdata('arrCarrito')){//verificar si existe carrito
                $this->arrCarrito=$this->session->arrCarrito;//obterner de sesion
            }else{
                $this->arrCarrito=[];
                $this->session->set_userdata('arrCarrito',$this->arrCarrito);//asignar arrCarrito a una variable a sesion
            }
            if($this->session->has_userdata('objDatosEnvio')){//verificar si existe carrito
                $this->objDatosEnvio=$this->session->objDatosEnvio;//obterner de sesion
            }else{
                $this->objDatosEnvio=new stdClass();//declarar objeto
                $this->session->set_userdata('objDatosEnvio',$this->objDatosEnvio);//asignar arrCarrito a una variable a sesion
            }
        }
        public function index(){ //Cargar a nivel funcion con el simbolo de $ + variable ejemplo $intId
            $intMarcaId=$this->input->post('intMarcaId');//obtener un valor por POST desde el formulario
            if($intMarcaId=='')$intMarcaId=0;
            $dblSubTotal=0;//declaracion de variables a nivel funcion
            $dblCostoEnvio=0;//declaracion de variables a nivel funcion
            $dblSubTotalIva=0;//declaracion de variables a nivel funcion
            $dblTotal=0;//declaracion de variables a nivel funcion
            $arrDatos['strActivo']='pedidos';
            $arrDatosDinamicos['dblSubTotal']=$dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio']=$dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva']=$dblSubTotalIva;
            $arrDatosDinamicos['dblTotal']=$dblTotal; 
            $arrDatosDinamicos['intMarcaId']=$intMarcaId;
            $arrDatosDinamicos['arrCarrito']=$this->arrCarrito;
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);//mandar el arreglo a una vista
            $this->load->view('principal',$arrDatos);//mandar los valores a una vista
        }
        public function agregarCarrito(){
            $intMarcaId=$this->input->post('intMarcaId');//obtener por POST el valor desde el formulario
            $intModeloId=$this->input->post('intModeloId');//obtener por POST el valor desde el formulario
            $intCantidad=$this->input->post('intCantidad');//obtener por POST el valor desde el formulario
            $bolExisteModelo=FALSE;
            foreach ($this->arrCarrito as $objModelo) {//recorrer el carrito
                if ($objModelo->id == $intModeloId) {//evaluar si existe ID
                    $objModelo->cantidad += $intCantidad;
                    $dblSubTotal=$objModelo->cantidad * $objModelo->precio;
                    $objModelo->subTotal=$dblSubTotal;
                    $bolExisteModelo = TRUE;
                }
            }

            if ($bolExisteModelo == FALSE) {
                $arrModelos=$this->MdModelos->buscar($intModeloId);//asignar el arreglo que manda el metodo del modelo
                if(count($arrModelos)!=0){
                    $objModelo=$arrModelos[0];//asignar el arreglo a un objeto
                    $objModelo->cantidad=$intCantidad;//asignarle el valor que que se obtuvo por post e ingresarlo al objeto
                    $dblSubTotal=$intCantidad * $objModelo->precio;//hacer un calculo de valores obtenidos por post
                    $objModelo->subTotal=$dblSubTotal;//ingresarlo al objeto
                    $this->arrCarrito[]=$objModelo;//array_push($this->carrito,$objModelo); //agregar elementos a un array
                }
            }
            $this->session->set_userdata('arrCarrito',$this->arrCarrito);//meter el carrito a session
            //echo var_dump($objModelo);
            $dblSubTotal=0;//declaracion de variables a nivel funcion
            $dblCostoEnvio=0;//declaracion de variables a nivel funcion
            $dblIva=.16;//declaracion de variables a nivel funcion
            $dblTotal=0;//declaracion de variables a nivel funcion
            $dblSubTotalIva=0;
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
            $arrDatosDinamicos['dblSubTotal']=$dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio']=$dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva']=$dblSubTotalIva;
            $arrDatosDinamicos['dblTotal']=$dblTotal;
            $arrDatosDinamicos['arrCarrito']=$this->arrCarrito;
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function eliminarCarrito(){
            $intMarcaId=$this->input->post('intMarcaId');//obtener por POST el valor desde el formulario
            $intModeloId=$this->input->post('intModeloId');//obtener por POST el valor desde el formulario
            $arrTemp = [];
            foreach ($this->arrCarrito as $objModelo) {//recorrer el carrito                     -----------------------------------
                if ($objModelo->id != $intModeloId) {//evaluar si exite el ID                    ---- Esto Sirve para sustituir ----
                    $arrTemp[]=$objModelo;                                      //               ----         El Carrito        ----
                }                                                               //               -----------------------------------
            }
            $this->arrCarrito=$arrTemp;
            $this->session->set_userdata('arrCarrito',$arrTemp);//asignar arrCarrito a una variable a sesion
            $dblSubTotal=0;//declaracion de variables a nivel funcion
            $dblCostoEnvio=0;//declaracion de variables a nivel funcion
            $dblIva=.16;//declaracion de variables a nivel funcion
            $dblTotal=0;//declaracion de variables a nivel funcion
            $dblSubTotalIva=0;
            foreach ($this->arrCarrito as $objModelo) {
                $dblSubTotal+=$objModelo->subTotal;//calculo de una sumatoria de la variable subtotal que pertenece al objModelo
            }
            foreach ($this->arrCarrito as $objModelo) {
                $dblSubTotalIva=$dblSubTotal * $dblIva;//calculo de la variable IVA subtotal*IVA
            }
            foreach ($this->arrCarrito as $objModelo) {
                $dblTotal=$dblSubTotal + $dblSubTotalIva;//calculo dell total  
            }
            $arrDatosDinamicos['intMarcaId']=$intMarcaId;
            $arrDatosDinamicos['dblSubTotal']=$dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio']=$dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva']=$dblSubTotalIva;
            $arrDatosDinamicos['dblTotal']=$dblTotal;
            $arrDatosDinamicos['intMarcaId']=$intMarcaId;
            $arrDatosDinamicos['arrCarrito']=$this->arrCarrito;
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function datosEnvio(){
            $intMarcaId=$this->input->post('intMarcaId');//obtener por POST el valor desde el formulario
            $this->session->set_userdata('arrCarrito',$this->arrCarrito);//meter el carrito a session
            $strNombre=$this->input->post('strNombre');
            $dateFechaEntrega=$this->input->post('dateFechaEntrega');
            $strDireccion=$this->input->post('strDireccion');
            $dblCostoEnvio=$this->input->post('dblCostoEnvio');
            $this->objDatosEnvio->nombre=$strNombre;//agregar las variables obtenidas por post al objeto
            $this->objDatosEnvio->fechaEntrega=$dateFechaEntrega;
            $this->objDatosEnvio->direccion=$strDireccion;
            $this->objDatosEnvio->costoEnvio=$dblCostoEnvio;
            $this->session->set_userdata('objDatosEnvio',$this->objDatosEnvio);//asignar arrCarrito a una variable a sesion
            $dblSubTotal=0;//declaracion de variables a nivel funcion
            $dblCostoEnvio=0;//declaracion de variables a nivel funcion
            $dblIva=.16;//declaracion de variables a nivel funcion
            $dblTotal=0;//declaracion de variables a nivel funcion
            $dblSubTotalIva=0;
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
            $arrDatosDinamicos['dblSubTotal']=$dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio']=$dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva']=$dblSubTotalIva;
            $arrDatosDinamicos['dblTotal']=$dblTotal;
            $arrDatosDinamicos['strNombre']=$strNombre;
            $arrDatosDinamicos['dateFechaEntrega']=$dateFechaEntrega;
            $arrDatosDinamicos['strDireccion']=$strDireccion;
            $arrDatosDinamicos['dblCostoEnvio']=$dblCostoEnvio; 
            $arrDatosDinamicos['arrCarrito']=$this->arrCarrito;
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo']='pedidos';
            $arrDatos['strContenido']=$this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }    
?>