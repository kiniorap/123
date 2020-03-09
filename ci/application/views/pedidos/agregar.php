<div class="card">
  <h5 class="card-header">Agregar Producto<a href="<?= base_url()?>marcas" class="btn btn-secondary float-right"*/>ATRAS</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <form id="frmDatosEnvio" action="<?= base_url()?>pedidos/datosEnvio" method="POST">
                <input type="hidden" name="intMarcaId" value="<?=$intMarcaId?>" > 
                    <div class="form-group">
                        <label for="txtNombre">NOMBRE:</label>
                        <input type="text" name="strNombre" class="form-control" id="strNombre" onchange="submit();" placeholder="Ingrese el nombre" value="<?php echo $this->objDatosEnvio->nombre?>">
                    </div>
                    <div class="form-group">
                        <label for="txtFecha">FECHA DE ENTREGA:</label>
                        <input type="date" name="dateFechaEntrega" class="form-control" id="dateFechaEntrega" onchange="submit();" value="<?php echo $this->objDatosEnvio->fechaEntrega?>">
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">DIRECCION DE ENTREGA:</label>
                        <textarea class="form-control" name="strDireccion" id="strDireccion" onchange="submit();" placeholder="Ingrese su dirección"><?php echo $this->objDatosEnvio->direccion?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtCostoEnvio">COSTO DE ENVIO:</label>
                        <input type="text" name="dblCostoEnvio" class="form-control" id="dblCostoEnvio" onchange="submit();" placeholder="Ingrese el Costo de Envío" value="<?php echo $this->objDatosEnvio->costoEnvio?>">
                    </div>
                    <div class="form-group">
                        <label for="txtEstatus">ESTATUS:</label>
                        <select name="intEstatus" id="cmbEstatus" class="form-control" onchange= "submit();">
                            <option value="0">[Seleccion el Estatus]</option>
                            <option value="1"<?php if($intEstatus == 1) echo 'selected'?>>En Proceso</option>
                            <option value="2"<?php if($intEstatus == 2) echo 'selected'?>>En Camino</option>
                            <option value="3"<?php if($intEstatus == 3) echo 'selected'?>>Cancelado</option>
                        </select>
                    </div>
                </form>  
                    <div class="form-group">
                        <label for="txtProducto">SELECCIONE LA MARCA:</label>
                        <div class="form-group">
                            <form id="frmCargarModelos" action="<?=base_url()?>pedidos" method="POST">    
                                <select name="intMarcaId" id="cmbMarca" class="form-control"  onchange="submit();">
                                <option value="0">[Marca]</option>
                                <?php foreach($arrMarcas as $objMarcas)  {?>
                                    <option value="<?=$objMarcas->id?>" <?php if($objMarcas->id == $intMarcaId) echo 'selected'?>><?=$objMarcas->nombre?></option>
                                <?php } ?>
                                </select>    
                            </form>
                        </div>
                    </div> 
                <form id="frmAgregarCarrito" action="<?=base_url()?>pedidos/agregarCarrito" method="POST">  
                    <input type="hidden" name="intMarcaId" value="<?=$intMarcaId?>" > 
                    <div class="form-group">
                        <label for="txtProducto">SELECCIONE EL MODELO:</label>
                        <div class="form-group">
                        <select name="intModeloId" id="cmbModelos" class="form-control" required>
                                <option value="0">[Modelos]</option>
                                <?php foreach($arrModelos as $objModelos)  {?>
                                    <option value="<?=$objModelos->id?>" <?php if($objModelos->id == $intMarcaId) echo 'selected'?>><?=$objModelos->nombre?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="txtProducto">CANTIDAD:</label>
                        <input type="number" class="form-control" name="intCantidad" id="txtCantidad" max="50" min="1" value="1">
                    </div>
                    <button type="button" class="btn btn-info float-right" onclick="submit();" >AGREGAR PRODUCTO</button>   
                </form>
            </div>
            <div class="col-6">
                <div class="tab-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col" width="120px">Cantidad</th>
                                <th scope="col" width="200px">Precio</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($arrCarrito as $objModelo)  {?>
                            <tr>
                                <td><?=$objModelo->id ?></td>
                                <td><?=$objModelo->nombre ?></td>
                                <td><?=$objModelo->cantidad ?></td>
                                <td><?=$objModelo->precio ?></td>
                                <td><?=$objModelo->subTotal ?></td>
                                <td>
                                    <form action="<?= base_url()?>pedidos/eliminarCarrito/" method="post">
                                        <input type="hidden" value="<?=$objModelo->id?>" name="intModeloId">
                                        <button type="submit" class="btn btn-danger">ELIMINAR</button>
                                    </form>
                                </td>
                            </tr>
                            <?php }?>
                            
                        </tbody>
                    </table> 
                </div>       
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-4">
                <table class="table" border="1">
                    <tr>
                        <td>SubTotal</td>
                        <td>$ <?= $dblSubTotal?></td>
                    </tr>
                    <tr>
                        <td>Costo de envio</td>
                        <td>$ <?= $this->objDatosEnvio->costoEnvio?></td>
                    </tr>
                    <tr>
                        <td>Iva</td>
                        <td>$ <?= $dblSubTotalIva?></td>
                    </tr>
                    <tr>
                        <td>Total a Pagar</td>
                        <td>$ <?= $dblTotal?></td>
                    </tr>
                </table> 
            </div>
        </div>
    </div>
</div>
<br>
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">CONCLUIR PEDIDO</button>
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="ModalLabel">LISTO!!!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            Se realizó de manera correcta
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>
        </div>
        </div>
    </div>
</div>      
<?php

?>