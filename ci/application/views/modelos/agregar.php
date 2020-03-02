<div class="card">
  <h5 class="card-header"><?php if(isset($registro) or set_value('intId')!='') echo 'Editar'; else echo 'Agregar';?> Marca <a href="<?= base_url()?>marcas" class="btn btn-secondary float-right">ATRAS</a></h5>
    <div class="card-body">
        <form action="<?= base_url()?>marcas/guardar" method="POST">
            <input type="hidden" value="<?= $intMarcas?>">
            <div class="form-group">
                <label for="txtId">ID</label>
                <input type="text" name="intId" class="form-control" id="txtId" placeholder="[Nuevo]" readonly="" value="<?php echo set_value('intId') ?><?php if(isset($registro)) echo $registro->id;?>">
            </div>
            <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" name="strNombre" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" value="<?php echo set_value('strNombre')?><?php if(isset($registro)) echo $registro->nombre?> <?phpif($intMarcas==0) echo 'disabled'?>">
            </div>
            <?php echo form_error('strNombre')?>
            <div class="form-group">
                <label for="txtDescripcion">Descripcion</label>
                <textarea class="form-control" name="strDescripcion" id="txtDescripcion" placeholder="Ingrese una descripción"><?php echo set_value('strDescripcion')?><?php if(isset($registro)) echo $registro->descripcion; if($intMarcas==0) echo 'disabled'?></textarea>
            </div>
            <div class="form-group">
                <label for="cmbEstatus">Estatus</label>
                <select class="form-control" name="intEstatus"  id="cmbEstatus" <?php if($intMarcas==0) echo 'disabled'?>>
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
<?php

?>