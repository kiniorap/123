<div class="card">
  <h5 class="card-header">Agregar Producto<a href="<?= base_url()?>marcas" class="btn btn-secondary float-right">ATRAS</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <form id="frmAgregarCarrito" action="<?= base_url()?>pedidos/agregarCarrito" method="POST">
                    <div class="form-group">
                        <label for="txtId">NOMBRE:</label>
                        <input type="text" name="intId" class="form-control" id="txtId" placeholder="Ingrese el nombre">
                    </div>
                    <div class="form-group">
                        <label for="txtNombre">FECHA DE ENTREGA:</label>
                        <input type="date" name="intDate" class="form-control" id="dateFecha" >
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">DIRECCION DE ENTREGA:</label>
                        <textarea class="form-control" name="strDireccion" id="txtDireccion" placeholder="Ingrese su dirección"></textarea>
                    </div>
                    <button type="submit">Guardar</button>
                </form>  
                
        
                    <div class="form-group">
                        <label for="txtProducto">SELECCIONE LA MARCA:</label>
                        <div class="form-group">
                            <form id="frmCargarModelos" action="<?=base_url()?>pedidos" method="POST">    
                                <select name="intMarca" id="cmbMarca" class="form-control"  onchange="submit();">
                                <option value="0">[Marca]</option>
                                <?php foreach($arrMarcas as $objetos)  {?>
                                    <option value="<?=$objetos->id?>" <?php if($objetos->id == $intMarca) echo 'selected'?>><?=$objetos->nombre?></option>
                                <?php } ?>
                                </select>    
                            </form>
                        </div>
                    </div> 
                
                    <form id="frmAgregarCarrito" action="<?= base_url()?>pedidos/agregarCarrito" method="POST">  
                    <div class="form-group">
                        <label for="txtProducto">SELECCIONE EL MODELO:</label>
                        <div class="form-group">
                        <select name="intModelosId" id="cmbModelos" class="form-control" required>
                                <option value="0">[Modelos]</option>
                                <?php foreach($arrModelos as $objetosMod)  {?>
                                    <option value="<?=$objetosMod->id?>" <?php if($objetosMod->id == $intMarca) echo 'selected'?>><?=$objetosMod->nombre?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="txtProducto">CANTIDAD:</label>
                        <input type="number" class="form-control" name="intCantidad" id="txtCantidad" max="50" min="0">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($arrPedidos as $objPedidos)  {?>
                            <tr>
                                <td><?=$objPedidos->id ?></td>
                                <td><?=$objPedidos->nombre ?></td>
                                <td><?=$objPedidos->cantidad ?></td>
                                <td><?=$objPedidos->precio ?></td>
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
                        <td>$</td>
                    </tr>
                    <tr>
                        <td>Costo de envio</td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td>Iva</td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td>Total a Pagar</td>
                        <td>$</td>
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