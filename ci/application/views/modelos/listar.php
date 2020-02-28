<div class="card">
  <h5 class="card-header">Modelos<a href="<?= base_url()?>marcas" class="btn btn-secondary float-right">ATRAS</a></h5>
  <div class="card-body"> 
  <form action="<?= base_url()?>modelos/index" method="POST">
      <div class="form-group">
        <label for="cmbMarca">Marca</label>
        <select name="intMarca" id="cmbMarca" class="form-control" onchange="submit();" required>
          <option value="0">[Seleccione]</option>
          <?php foreach($arrMarcas as $objetos)  {?>
            <option value="<?=$objetos->id?>" <?php if($objetos->id == $intMarca) echo 'selected'?>><?=$objetos->nombre?></option>
          <?php } ?>
        </select>
      </div>
    </form>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <h5 class="card-header"><?php if(isset($registro) or set_value('intId')!='') echo 'Editar'; else echo 'Agregar';?> Modelo</h5>
          <div class="card-body">
            <form action="<?= base_url()?>marcas/guardar" method="POST">
              <div class="form-group">
                <label for="txtId">ID</label>
                <input type="text" name="intId" class="form-control" id="txtId" placeholder="[Nuevo]" readonly="" value="<?php echo set_value('intId') ?><?php if(isset($registro)) echo $registro->id;?>">
              </div>
              <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" name="strNombre" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" value="<?php echo set_value('strNombre')?><?php if(isset($registro)) echo $registro->nombre?>">
              </div>
              <?php echo form_error('strNombre')?>
              <div class="form-group">
                <label for="txtDescripcion">Descripcion</label>
                <textarea class="form-control" name="strDescripcion" id="txtDescripcion" placeholder="Ingrese una descripción"><?php echo set_value('strDescripcion')?><?php if(isset($registro)) echo $registro->descripcion?></textarea>
              </div>
              <div class="form-group">
                <label for="cmbEstatus">Estatus</label>
                <select class="form-control" name="intEstatus"  id="cmbEstatus">
                  <option value="0" <?php if(set_value('intEstatus')=='0' or (isset($registro) and $registro->status =='0')) echo "selected";?>>[Seleccione]</option>
                  <option value="1" <?php if(set_value('intEstatus')=='1' or (isset($registro) and $registro->status =='1')) echo "selected";?>>Activo</option>
                  <option value="2" <?php if(set_value('intEstatus')=='2' or (isset($registro) and $registro->status =='2')) echo "selected";?>>Cancelado</option>
                </select>
              </div>
              <?php echo form_error('intEstatus')?>        
              <button type="submit" class="btn btn-primary float-right">GUARDAR</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-6">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">NOMBRE</th>
                <th scope="col" width="120px">ESTATUS</th>
                <th scope="col">Precio</th>
                <th scope="col" width="100px">(OPCIONES)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arrModelos as $objetos)  {?>
                <tr>
                <th scope="row"><?=$objetos->id?></th>
                <td><?=$objetos->nombre?></td>
                <td><?=$objetos->status?></td>
                <td>$<?=$objetos->precio?></td>
                <th scope="col">
                    <a href="<?= base_url()?>marcas/editar/<?=$objetos->id?>" class="btn btn-secondary" width="100px">EDITAR</a>
                    <form action="<?= base_url()?>modelos/" method="post">
                      <input type="hidden" value="<?=$objetos->id?>" name="intId">
                      <button type="submit" class="btn btn-danger">ELIMINAR</button>
                    </form>
                </th>
                <?php } ?>
            </tbody>
        </table>
        <div class="row">
          <div class="col-12 d-flex justify-content-end">
            <p class="text-muted"><b><?php echo count($arrModelos); ?></b> Registros</p>
          </div>
        </div> 
      </div>
    </div>  
  </div>
</div>