<div class="card">
  <h5 class="card-header">Agregar Producto<a href="<?= base_url()?>marcas" class="btn btn-secondary float-right"*/>ATRAS</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <form id="frmInformacionPedido" action="<?= base_url()?>pedidos" method="POST">
                    <div class="form-group">
                        <label for="txtNombre">NOMBRE:</label>
                        <input type="text" name="strNombre" class="form-control" id="strNombre" placeholder="Ingrese el nombre" value="<?php echo set_value('strNombre')?>">
                    </div>
                    <div class="form-group">
                        <label for="txtFecha">FECHA DE ENTREGA:</label>
                        <input type="date" name="dateFechaEntrega" class="form-control" id="dateFechaEntrega" value="<?php echo set_value('dateFechaEntrega')?>">
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">DIRECCION DE ENTREGA:</label>
                        <textarea class="form-control" name="strDireccion" id="strDireccion" placeholder="Ingrese su dirección"><?php echo set_value('strDireccion')?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtId">COSTO DE ENVIO:</label>
                        <input type="text" name="intCostoEnvio" class="form-control" id="intCostoEnvio" placeholder="Ingrese el Costo de Envío" value="<?php echo set_value('intCostoEnvio')?>">
                    </div>
                    <button type="submit" >Guardar</button>
                </form>  
                    <div class="form-group">
                        <label for="txtProducto">SELECCIONE LA MARCA:</label>
                        <div class="form-group">
                            <form id="frmCargarModelos" action="<?=base_url()?>pedidos" method="POST">    
                                <select name="intMarcaId" id="cmbMarca" class="form-control"  onchange="submit();">
                                <option value="0">[Marca]</option>
                                <?php foreach($arrMarcas as $objetos)  {?>
                                    <option value="<?=$objetos->id?>" <?php if($objetos->id == $intMarcaId) echo 'selected'?>><?=$objetos->nombre?></option>
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
                                <?php foreach($arrModelos as $objetosMod)  {?>
                                    <option value="<?=$objetosMod->id?>" <?php if($objetosMod->id == $intMarcaId) echo 'selected'?>><?=$objetosMod->nombre?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="txtProducto">CANTIDAD:</label>
                        <input type="number" class="form-control" name="intCantidad" id="txtCantidad" max="50" min="0" placeholder="Ingrese la cantidad del producto">
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
                        <td>$</td>
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