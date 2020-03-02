<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= base_url()?>marcas">SISTEMA    </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item <?php if($strActivo=='marcas') echo 'active';?>">
                    <a class="nav-link" href="<?= base_url()?>marcas">Marcas</a>
                </li>
                <li class="nav-item <?php if($strActivo=='modelos') echo 'active';?>">
                    <a class="nav-link" href="<?= base_url()?>modelos">Modelos</a>
                </li>
                <li class="nav-item <?php if($strActivo=='pedidos') echo 'active';?>">
                    <a class="nav-link" href="<?= base_url()?>pedidos">Pedidos</a>
                </li>
                <li class="nav-item <?php if($strActivo=='resumen') echo 'active';?>">
                    <a class="nav-link" href="<?= base_url()?>resumen">Resumen</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <br>
        <?php
        if(isset($arrMensajes)){
            foreach($arrMensajes as $arrMensaje){
            ?>
            <div class="alert alert-<?php if($arrMensaje['intTipo'] == 1) echo 'success'; else echo 'danger'; ?> qlert-dismissible fade show" role="alert" >
                <strong>Que Bien!!! </strong><?php echo $arrMensaje['strMensaje'];?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php }
        }
        if(isset($strContenido)) 
            echo $strContenido;
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>