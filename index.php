<?php
    //Extraer los datos del archivo JuegosController.php
    require 'JuegosController.php';
    $controlador = new JuegosController();

    //var_dump($juegos); //Se imprime el array de objetos

    if(isset($_REQUEST['editar']) && isset($_POST['nombre']) && isset($_POST['genero']) && isset($_POST['plataforma'])
 && isset($_POST['precio']) && isset($_POST['lanzamiento']) && isset($_POST['id'])){

    $respuesta = $controlador->update($_POST['id'],$_POST['nombre'],$_POST['genero'],$_POST['plataforma'],$_POST['precio'],
    $_POST['lanzamiento'],$_FILES['imagen']);
    
    $msj = "Juego editado";

}

    if(isset($_REQUEST['eliminar']) && isset($_POST['id'])){
        $respuesta = $controlador->destroy($_POST['id']);
        $msj = "Juego eliminado";
    }
    $juegos = $controlador->index();

    include 'header.php';
?>

        <?php if(isset($msj)):?>
                <div class="row mt-3">
                    <div class="col-md-4 offset-md-4">
                        <div id="alerta" class="alert alert-success">
                            <?=$msj?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <a href="formulario.php" class="btn btn-dark"> <i class="bi bi-cloud-arrow-up-fill"></i> Añadir</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>GENERO</th>
                            <th>PLATAFORMA</th>
                            <th>PRECIO</th>
                            <th>LANZAMIENTO</th>
                            <th>IMAGEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($juegos as $i => $jue) : ?>
                            <tr>
                                <td><?= ($i+1) ?></td>
                                <td><?= $jue->nombre ?></td>
                                <td><?= $jue->genero ?></td>
                                <td><?= $jue->plataforma ?></td>
                                <td><?= $jue->precio ?></td>
                                <td><?= $jue->lanzamiento ?></td>
                                <td>
                                    <img src="<?= $jue->imagen ?>" width="80px">
                                </td>
                                <td>
                                    <a href="ver.php?v=<?=$jue->id?>" class="btn btn-primary"><i class="bi bi-info-square-fill"></i> Ver</a>
                                </td>
                                <td>
                                <a href="formulario.php?v=<?=$jue->id?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>
                                </td>
                                <td>
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="id" value="<?=$jue->id?>">
                                        <button name="eliminar" class="btn btn-danger"><i class="bi bi-trash3-fill" id="alarma"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
include 'footer.php';
?>

