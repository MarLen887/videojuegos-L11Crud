<?php
//Declarar variables vacías
    $nom = '';
    $gen = '';
    $plat = '';
    $pre = '';
    $lan = '';
    $boton = 'guardar'; //para el nombre del botón
    $accion = 'formulario.php'; //para la acción que se hará en el formulario
    $required = 'required';

    require 'JuegosController.php';
    $controlador = new JuegosController();

    if (isset($_GET['v'])){
        $juego = $controlador -> show($_GET['v']);
        $nom = $juego[0]->nombre;
        $gen = $juego[0]->genero;
        $plat = $juego[0]->plataforma;
        $pre = $juego[0]->precio;
        $lan = $juego[0]->lanzamiento;
        $boton = 'editar';
        $accion = 'index.php';
        $required = '';
    }

if(isset($_REQUEST['guardar']) && isset($_POST['nombre']) && isset($_POST['genero']) && isset($_POST['plataforma'])
 && isset($_POST['precio']) && isset($_POST['lanzamiento']) && isset($_FILES['imagen'])){

    $respuesta = $controlador -> store($_POST['nombre'],$_POST['genero'],$_POST['plataforma'],$_POST['precio'],
    $_POST['lanzamiento'],$_FILES['imagen']);
    
    $msj = "Juego guardado";
}

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
            <div class="col-12">
                <div class="card shadow border border-primary">
                    <div class="card-header bg-success text-white">Crear Videojuego</div>
                    <div class="card-body">
                        <form action="<?=$accion?>" method="post" enctype="multipart/form-data">

                                <?php if(isset($_GET['v'])):?>
                                    <input type="hidden" name="id" value="<?=$_GET['v']?>">
                                <?php endif?>

                            <div class="input-group md-3 mb-3">
                                <span class="input-group-text"><i class="bi bi-controller"></i></span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" require value="<?=$nom?>">
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>

                            <div class="input-group md-3 mb-3">
                                <span class="input-group-text"><i class="bi bi-joystick"></i></span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="genero" id="genero" placeholder="Género" value="<?=$gen?>" require>
                                    <label for="genero">Género</label>
                                </div>
                            </div>

                            <div class="input-group md-3 mb-3">
                                <span class="input-group-text"><i class="bi bi-dpad-fill"></i></span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="plataforma" id="plataforma" placeholder="Plataforma" value="<?=$plat?>" required>
                                    <label for="plataforma">Plataforma</label>
                                </div>
                            </div>

                            <div class="input-group md-3 mb-3">
                                <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio" value="<?=$pre?>" require>
                                    <label for="precio">Precio</label>
                                </div>
                            </div>

                            <div class="input-group md-3 mb-3">
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="lanzamiento" id="lanzamiento" placeholder="Lanzamiento" value="<?=$lan?>" require>
                                    <label for="lanzamiento">Lanzamiento</label>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-images"></i></i></span>
                                <div class="form-floating">
                                    <input name="imagen" type="file" class="form-control" accept="image/*" id="imagen" placeholder="Imagen" <?=$required?> >
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-dark" name="<?=$boton?>"><i class="bi bi-floppy2-fill"></i>  Guardar</button>
                            </div>
                            <div class="mb-3 ms-5">
                                <a href="index.php" name="<?=$boton?>"><i class="bi bi-arrow-left-circle-fill"></i></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php

include 'footer.php';
?>
