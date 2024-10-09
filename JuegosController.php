<?php

    //Es el equivalente al crud de las canciones, es decir, al archivo operacioens.php
    require 'BaseDatos.php';

    class JuegosController{
        //El nombre de este archivo debe de coincidir con el nombre de la clase

        function index(){
            $bd = new BaseDatos(); //Objeto
            $juegos = $bd->getJuegos(); //Invoca al método del archivo Base de Datos, para traer todos los registros
            return $juegos;
        }

        function store($n,$g,$pl,$pr,$l,$i){
            //Aquí sólo se guardará el registro del formulario, más no la imagen
            $bd = new BaseDatos();
            $img = microtime(true).'.'.pathinfo($i['name'], PATHINFO_EXTENSION);
            //microtime() dejará una marca de tiempo para que sea el nombe de la imagen, por lo que las imágenes no se llamarán igual
            $ub = __DIR__.'/img/'.$img;
            $save = $bd->saveJuego($n,$g,$pl,$pr,$l,'img/'.$img);
            $this->guardarImagen($i,$ub);
            return $save;
        }

        function guardarImagen($img,$ubicacion) : void{
            //$ubicacion = __DIR__.'/.../img/'.$nombre_img;
            copy($img['tmp_name'],$ubicacion);
        }

        function eliminarImagen($id){
            $j = $this->show($id); //se busca la imagen
            $ubi = __DIR__.'/'.$j[0]->imagen; //se busca el directorio de la imagen
            unlink($ubi);//se manda a traer la imagen buscada
        }

        function show($id){
            $bd = new BaseDatos();
            $juegos = $bd->getJuego($id);
            return $juegos;
        }

        function update($id,$n,$g,$pl,$pr,$l,$i){
            $bd = new BaseDatos();
            $img = '';
    //Se iniciará vacío para que se pueda aplicar el IF; no lleva un espacio entre comillas, o si no, ya no sería vacío
            if($i['name'] != ''){//Si hay un nombre de imagen, es decir, si es diferente a vacío
                $this->eliminarImagen($id);
                $img = microtime(true).'.'.pathinfo($i['name'], PATHINFO_EXTENSION);
                $ub = __DIR__.'/img/'.$img;
                $this->guardarImagen($i,$ub);
                $img = 'img/'.$img;
            }
            $update = $bd->updateJuego($id,$n,$g,$pl,$pr,$l,$img);
            return $update;
        }

        function destroy($id){
            $bd = new BaseDatos();
            $this->eliminarImagen($id);
            $del = $bd->deleteJuego($id);
            return $del;
        }

    }

?>