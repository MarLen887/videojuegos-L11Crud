<?php

include 'config.php';

class BaseDatos{
    //Declarar las variables
    private $host;
    private $user;
    private $pass;
    private $port;
    private $base;
    private $conexion;

    public function __construct(){
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->port = DB_PORT;
        $this->base = DB_NAME;
        $this->pass = DB_PASSWORD;
        //Establecer nombre y host de la base de datos
        $server = 'mysql:dbname='.$this->base.';host='.$this->host;
        //Establecer la conexión con la base de datos
        $this->conexion = new PDO($server, $this->user, $this->pass);
    }

    //Función para los juegos para extraear todos los juegos de la tabla de la base de datos
    function getJuegos(){
        //Esta es la consulta
        //Selecciona todas las columnas de la tabla juegos
        $query = "SELECT * FROM juegos";
        $registros = $this->conexion->query($query); //Consulta
        //También se puede escribir como: $juegos = $this->conexion->$query = "SELECT * FROM juegos";
        //Así se disminuye una línea de código
        //$stmt = $this->conexion->prepare($query);
        //$stmt->execute();
        $juegos = $registros->fetchAll();

        //$juegos = $registros ->fetchAll(); //Traerá todos los registros que hace la consulta
        return json_decode(json_encode($juegos)); //Convertir en un string para pasarlo a un formato JSON
    }

    function getJuego($id){
        $query = "SELECT * FROM juegos WHERE id = $id";
        $registros = $this->conexion->query($query);
        $juegos = $registros->fetchAll();
        return json_decode(json_encode($juegos));
    }

    function saveJuego($n,$g,$pl,$pr,$l,$i){
        $query = $this->conexion->prepare("INSERT INTO juegos(nombre, genero, plataforma, precio, 
        lanzamiento, imagen) VALUES(?,?,?,?,?,?)");
        //A la variable $query se le pasan los mismos parámetros que la función, pero en un array
        //Para que prepare la sintaxis y limpiar los parámetros para colocarlo en 'VALUES(?,?,?,?,?,?)'
        $query->execute([$n,$g,$pl,$pr,$l,$i]);
        $id = $this->conexion->lastInsertId(); //Se recoge el ID que se genera en la tabla, el cual es autoincrementable, así que se colocará de manera automática
        return $id;
    }

    function updateJuego($id,$n,$g,$pl,$pr,$l,$i){
        $setImg = '';
        $valores = [$n,$g,$pl,$pr,$l,$id]; //Array. Los valores van a cambiar si es que existe o no una imagen
        if($i != ''){
            $setImg = ', imagen=?';
    //=? es para asignarle un valor con el = y para el ?, es para asignarle los parámetros a una imagen. Se irán estableciendo en el orden en el que fueron escritos
            $valores = [$n,$g,$pl,$pr,$l,$i,$id];
        }
        $query = $this->conexion->prepare("UPDATE juegos SET nombre=?, genero=?, plataforma=?, precio=?,
        lanzamiento=? $setImg WHERE id=?");
        $query->execute($valores);
        return "Juego actualizado";
    }

    function deleteJuego($id){
        $query=$this->conexion->prepare("DELETE FROM juegos WHERE id=?");
        $query->execute([$id]);
        return "Juego eliminado";
    }
}
?>