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
                $this->objDatosEnvio->nombre = "";
                $this->objDatosEnvio->fechaEntrega = "";
                $this->objDatosEnvio->direccion = "";
                $this->objDatosEnvio->costoEnvio = "";
                $this->objDatosEnvio->estatus = "";
                $this->session->set_userdata('objDatosEnvio',$this->objDatosEnvio);//asignar arrCarrito a una variable a sesion
            }//SESSION_DESTROY();
        }
        public function index(){ //Cargar a nivel funcion con el simbolo de $ + variable ejemplo $intId
            $intMarcaId = $this->input->post('intMarcaId');//obtener un valor por POST desde el formulario  CARGA LA MARCA
            if($intMarcaId == ''){//EVALUA QUE LA MARCA NO ESTE VACIO
                $intMarcaId = 0; //SI VINE VACIO EL MARCAID LE ASIGNA UN VALOR    
            }
            $dblCostoEnvio = $this->objDatosEnvio->costoEnvio;
            $strNombre = $this->objDatosEnvio->nombre;
            $strDireccion = $this->objDatosEnvio->direccion;
            $dateFechaEntrega = $this->objDatosEnvio->fechaEntrega;
            $intEstatus=$this->objDatosEnvio->estatus;
            if ($dblCostoEnvio == NULL) {
                $dblCostoEnvio = 0;
            }
            //echo var_dump($this->objDatosEnvio);
            $dblSubTotal = 0;//declaracion de variables a nivel funcion
            $dblIva=.16;//declaracion de variables a nivel funcion
            $dblSubTotalIva = 0;//declaracion de variables a nivel funcion
            $dblTotal = $dblCostoEnvio;//declaracion de variables a nivel funcion
            if(count($this->arrCarrito)!=0){ //EVALUA QUE EL CARRITO NO ESTE VACIO
                foreach ($this->arrCarrito as $objModelo) { //RECORRE CADA ELEMENTO DEL CARRITO
                    $dblSubTotal+=$objModelo->subTotal; //CALCULA LA SUMATORIA DEL SUBTOTAL
                    $dblSubTotalIva=$dblSubTotal * $dblIva; //CALCULA CUANTO ES EL IVA DE LA SUMATORIA DEL SUBTOTAL
                    $dblTotal=$dblSubTotal + $dblSubTotalIva + $dblCostoEnvio; //CALCULA EL TOTAL SUMANDO EL SUBTOTAL MAS EL IVA MAS EL COSTO DE ENVIO
                }
            }
            $arrDatosDinamicos['intMarcaId'] = $intMarcaId;
            $arrDatosDinamicos['dblSubTotal'] = $dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio'] = $dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva'] = $dblSubTotalIva;
            $arrDatosDinamicos['dblTotal'] = $dblTotal;
            $arrDatosDinamicos['strNombre'] = $strNombre;
            $arrDatosDinamicos['dateFechaEntrega'] = $dateFechaEntrega;
            $arrDatosDinamicos['strDireccion'] = $strDireccion;
            $arrDatosDinamicos['intEstatus'] = $intEstatus;
            $arrDatosDinamicos['arrCarrito'] = $this->arrCarrito;
            $arrDatosDinamicos['arrMarcas'] = $this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos'] = $this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo'] = 'pedidos';
            $arrDatos['strContenido'] = $this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function agregarCarrito(){
            $intMarcaId=$this->input->post('intMarcaId');//obtener por POST el valor desde el formulario
            $intModeloId=$this->input->post('intModeloId');//obtener por POST el valor desde el formulario
            $intCantidad=$this->input->post('intCantidad');//obtener por POST el valor desde el formulario
            $dblCostoEnvio=$this->objDatosEnvio->costoEnvio;
            $strNombre=$this->objDatosEnvio->nombre;
            $strDireccion=$this->objDatosEnvio->direccion;
            $dateFechaEntrega=$this->objDatosEnvio->fechaEntrega;
            $intEstatus=$this->objDatosEnvio->estatus;
            $bolExisteModelo=FALSE;

            if(count($this->arrCarrito)!=0){
                $dblSubTotal = 0;//declaracion de variables a nivel funcion
                $dblIva=.16;//declaracion de variables a nivel funcion
                $dblSubTotalIva = 0;//declaracion de variables a nivel funcion
                $dblTotal = 0;//declaracion de variables a nivel funcion
                if(count($this->arrCarrito)!=0){ //EVALUA QUE EL CARRITO NO ESTE VACIO
                    foreach ($this->arrCarrito as $objModelo) { //RECORRE CADA ELEMENTO DEL CARRITO
                        $dblSubTotal+=$objModelo->subTotal; //CALCULA LA SUMATORIA DEL SUBTOTAL
                        $dblSubTotalIva=$dblSubTotal * $dblIva; //CALCULA CUANTO ES EL IVA DE LA SUMATORIA DEL SUBTOTAL
                        $dblTotal=$dblSubTotal + $dblSubTotalIva + $dblCostoEnvio; //CALCULA EL TOTAL SUMANDO EL SUBTOTAL MAS EL IVA MAS EL COSTO DE ENVIO
                    }
                }
            }else {
                $dblSubTotal = 0;//declaracion de variables a nivel funcion
                $dblSubTotalIva = 0;//declaracion de variables a nivel funcion
                $dblTotal = 0;//declaracion de variables a nivel funcion
            }

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
                echo var_dump($arrModelos);
                if(count($arrModelos)!=0){
                    $objModelo=$arrModelos[0];//asignar el arreglo a un objeto
                    $objModelo->cantidad=$intCantidad;//asignarle el valor que que se obtuvo por post e ingresarlo al objeto
                    $dblSubTotal=$intCantidad * $objModelo->precio;//hacer un calculo de valores obtenidos por post
                    $objModelo->subTotal=$dblSubTotal;//ingresarlo al objeto
                    $this->arrCarrito[]=$objModelo;//array_push($this->carrito,$objModelo); //agregar elementos a un array
                }
            }
            $this->session->set_userdata('arrCarrito',$this->arrCarrito);//meter el carrito a session
            $dblSubTotal=0;//declaracion de variables a nivel funcion
            $dblIva=.16;//declaracion de variables a nivel funcion
            $dblTotal=0;//declaracion de variables a nivel funcion
            $dblSubTotalIva=0; 
            foreach ($this->arrCarrito as $objModelo) {
                $dblSubTotal+=$objModelo->subTotal;
                $dblSubTotalIva=$dblSubTotal * $dblIva;
                $dblTotal=$dblSubTotal + $dblSubTotalIva + $dblCostoEnvio;
            }
            $arrDatosDinamicos['intMarcaId'] = $intMarcaId;
            $arrDatosDinamicos['dblSubTotal'] = $dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio'] = $dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva'] = $dblSubTotalIva;
            $arrDatosDinamicos['dblTotal'] = $dblTotal;
            $arrDatosDinamicos['arrCarrito'] = $this->arrCarrito;
            $arrDatosDinamicos['arrMarcas'] = $this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos'] = $this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo'] = 'pedidos';
            $arrDatos['strContenido'] = $this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function eliminarCarrito(){
            $intMarcaId=$this->input->post('intMarcaId');//obtener por POST el valor desde el formulario
            $intModeloId=$this->input->post('intModeloId');//obtener por POST el valor desde el formulario
            $dblCostoEnvio=$this->objDatosEnvio->costoEnvio;
            $strNombre=$this->objDatosEnvio->nombre;
            $strDireccion=$this->objDatosEnvio->direccion;
            $dateFechaEntrega=$this->objDatosEnvio->fechaEntrega;
            $intEstatus=$this->objDatosEnvio->estatus;
            $arrTemp = [];
            foreach ($this->arrCarrito as $objModelo) {//recorrer el carrito                     -----------------------------------
                if ($objModelo->id != $intModeloId) {//evaluar si exite el ID                    ---- Esto Sirve para sustituir ----
                    $arrTemp[]=$objModelo;                                      //               ----         El Carrito        ----
                }                                                               //               -----------------------------------
            }
            $this->arrCarrito=$arrTemp;
            $this->session->set_userdata('arrCarrito',$arrTemp);//asignar arrCarrito a una variable a sesion
            $dblSubTotal = 0;//declaracion de variables a nivel funcion
            $dblIva=.16;//declaracion de variables a nivel funcion
            $dblSubTotalIva = 0;//declaracion de variables a nivel funcion
            $dblTotal = 0;//declaracion de variables a nivel funcion
            if(count($this->arrCarrito)!=0){ //EVALUA QUE EL CARRITO NO ESTE VACIO
                foreach ($this->arrCarrito as $objModelo) { //RECORRE CADA ELEMENTO DEL CARRITO
                    $dblSubTotal+=$objModelo->subTotal; //CALCULA LA SUMATORIA DEL SUBTOTAL
                    $dblSubTotalIva=$dblSubTotal * $dblIva; //CALCULA CUANTO ES EL IVA DE LA SUMATORIA DEL SUBTOTAL
                    $dblTotal=$dblSubTotal + $dblSubTotalIva + $dblCostoEnvio; //CALCULA EL TOTAL SUMANDO EL SUBTOTAL MAS EL IVA MAS EL COSTO DE ENVIO
                }
            }else {
            $dblSubTotal = 0;//declaracion de variables a nivel funcion
            $dblSubTotalIva = 0;//declaracion de variables a nivel funcion
            $dblTotal = $dblCostoEnvio;//declaracion de variables a nivel funcion
            }
            $arrDatosDinamicos['intMarcaId'] = $intMarcaId;
            $arrDatosDinamicos['dblSubTotal'] = $dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio'] = $dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva'] = $dblSubTotalIva;
            $arrDatosDinamicos['dblTotal'] = $dblTotal;
            $arrDatosDinamicos['strNombre'] = $strNombre;
            $arrDatosDinamicos['dateFechaEntrega'] = $dateFechaEntrega;
            $arrDatosDinamicos['strDireccion'] = $strDireccion;
            $arrDatosDinamicos['intEstatus'] = $intEstatus;
            $arrDatosDinamicos['arrCarrito'] = $this->arrCarrito;
            $arrDatosDinamicos['arrMarcas'] = $this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos'] = $this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo'] = 'pedidos';
            $arrDatos['strContenido'] = $this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function datosEnvio(){
            $intMarcaId = $this->input->post('intMarcaId');//obtener por POST el valor desde el formulario
            $this->session->set_userdata('arrCarrito',$this->arrCarrito);//meter el carrito a session
            $strNombre = $this->input->post('strNombre');
            $dateFechaEntrega = $this->input->post('dateFechaEntrega');
            $strDireccion = $this->input->post('strDireccion');
            $dblCostoEnvio = $this->input->post('dblCostoEnvio');
            $intEstatus = $this->input->post('intEstatus');
            $this->objDatosEnvio->nombre = $strNombre;//agregar las variables obtenidas por post al objeto
            $this->objDatosEnvio->fechaEntrega = $dateFechaEntrega;
            $this->objDatosEnvio->direccion = $strDireccion;
            $this->objDatosEnvio->costoEnvio = $dblCostoEnvio;
            $this->objDatosEnvio->estatus = $intEstatus;
            $this->session->set_userdata('objDatosEnvio',$this->objDatosEnvio);//asignar arrCarrito a una variable a sesion
            //echo var_dump($this->objDatosEnvio);
            if ($dblCostoEnvio == NULL) {
                $dblCostoEnvio = 0;
            }
            $dblSubTotal = 0;//declaracion de variables a nivel funcion
            $dblIva=.16;//declaracion de variables a nivel funcion
            $dblSubTotalIva = 0;//declaracion de variables a nivel funcion
            $dblTotal = $dblCostoEnvio;//declaracion de variables a nivel funcion
            if(count($this->arrCarrito)!=0){ //EVALUA QUE EL CARRITO NO ESTE VACIO
                foreach ($this->arrCarrito as $objModelo) { //RECORRE CADA ELEMENTO DEL CARRITO
                    $dblSubTotal+=$objModelo->subTotal; //CALCULA LA SUMATORIA DEL SUBTOTAL
                    $dblSubTotalIva=$dblSubTotal * $dblIva; //CALCULA CUANTO ES EL IVA DE LA SUMATORIA DEL SUBTOTAL
                    $dblTotal=$dblSubTotal + $dblSubTotalIva + $dblCostoEnvio; //CALCULA EL TOTAL SUMANDO EL SUBTOTAL MAS EL IVA MAS EL COSTO DE ENVIO
                }
            }
            $arrDatosDinamicos['intMarcaId'] = $intMarcaId;
            $arrDatosDinamicos['dblSubTotal'] = $dblSubTotal;
            $arrDatosDinamicos['dblCostoEnvio'] = $dblCostoEnvio;
            $arrDatosDinamicos['dblSubTotalIva'] = $dblSubTotalIva;
            $arrDatosDinamicos['dblTotal'] = $dblTotal;
            $arrDatosDinamicos['strNombre'] = $strNombre;
            $arrDatosDinamicos['dateFechaEntrega'] = $dateFechaEntrega;
            $arrDatosDinamicos['strDireccion'] = $strDireccion;
            $arrDatosDinamicos['intEstatus'] = $intEstatus;
            $arrDatosDinamicos['arrCarrito'] = $this->arrCarrito;
            $arrDatosDinamicos['arrMarcas'] = $this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos'] = $this->MdModelos->listar($intMarcaId);
            $arrDatos['strActivo'] = 'pedidos';
            $arrDatos['strContenido'] = $this->load->view('pedidos/agregar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function agregar($arrDatos=[]){
            $arrDatos['strActivo']='marcas';
            $arrDatos['strContenido']=$this->load->view('marcas/agregar',NULL,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function guardar(){
            $objDatosPedido = new stdClass();
            $objDatosPedido = $this->arrCarrito;
            $intId=$this->input->post('intId');
            echo var_dump($this->arrCarrito);
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
    }    
?>