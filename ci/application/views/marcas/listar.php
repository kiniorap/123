<div class="card">
  <h5 class="card-header">Marcas<a href="<?= base_url()?>marcas/agregar" class="btn btn-primary float-right">AGREGAR</a></h5>
  <div class="card-body">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">NOMBRE</th>
            <th scope="col" width="120px">ESTATUS</th>
            <th scope="col" width="200px">(OPCIONES)
            </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arrMarcas as $objetos)  {?>
            <tr>
            <th scope="row"><?=$objetos->id?></th>
            <td><?=$objetos->nombre?></td>
            <td><?=$objetos->status?></td>
            <th scope="col">
                <a href="<?= base_url()?>marcas/editar/<?=$objetos->id?>" class="btn btn-secondary" width="100px">EDITAR</a>
                <form action="<?= base_url()?>marcas/eliminar/" method="post">
                  <input type="hidden" value="<?=$objetos->id?>" name="intId">
                  <button type="submit" class="btn btn-danger">ELIMINAR</button>
                </form>
            </th>
            <?php } ?>
        </tbody>
    </table>
    <div class="row">
      <div class="col-12 d-flex justify-content-end">
        <p class="text-muted"><b><?php echo count($arrMarcas); ?></b> Registros</p>
      </div>
    </div>    
  </div>
</div>