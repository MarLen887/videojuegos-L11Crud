<?php

require 'JuegosController.php';
$controlador = new JuegosController();

$nom = '';
$gen = '';
$plat = '';
$pre = '';
$lan = '';
$boton = 'ver';
$accion = 'ver.php';

if (isset($_GET['v'])){
    $juego = $controlador -> show($_GET['v']);
    $nom = $juego[0]->nombre;
    $gen = $juego[0]->genero;
    $plat = $juego[0]->plataforma;
    $pre = $juego[0]->precio;
    $lan = $juego[0]->lanzamiento;
    $img = $juego[0]->imagen;
    $boton = 'ver';
    $accion = 'ver.php';
    $required = '';
}


    include 'header.php';
?>

        <div class="row mt-3">
            <div class="col-12 mt-2">
            <!-- Tarjeta -->
            <div class="card mb-3">
            <div class="card-header bg-dark text-white text-center fs-4"><i class="bi bi-joystick"></i> Detalles del videojuego</div>
                <div class="row g-0">
                    <div class="col-md-4 mt-3">

                    <img src="<?=$img?>" width="400px">                    
                    
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        
                        <ul class="list-group">
                            <li class="list-group-item active" aria-current="true">Nombre: <?=$nom?> </li>
                            <li class="list-group-item">Genero: <?=$gen?></li>
                            <li class="list-group-item">Plataforma: <?=$plat?></li>
                            <li class="list-group-item">Precio: <?=$pre?></li>
                            <li class="list-group-item">Lanzamiento: <?=$lan?></li>
                        </ul>

                        <div class="mb-6 mt-3"><p class="card-text text-center"><small class="text-body-secondary fst-italic">Encuéntrala en tu plataforma favorita</small></p></div>
                        
                        <div class="mb-3 ms-5">
                                <a href="index.php" name="<?=$boton?>"><i class="bi bi-arrow-left-circle-fill"></i></i></a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    include 'footer.php';
?>