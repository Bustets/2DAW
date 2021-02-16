<?php
class Bd
{
    private $link;
    function __construct()
    {
        if (!isset($this->link)) {
            try {
                $this->link = new PDO("mysql:host=localhost;dbname=juegos", "root", "");
                $this->link->exec("set names utf8mb4");
            } catch (PDOException $e) {
                $dato = "¡Error!: " . $e->getMessage() . "<br/>";
                return $dato;
                die();
            }
        }
    }
    public function __get($link){
        if(property_exists(__CLASS__, $link)){
            return $this->$link;
        }
        return NULL;
    }
}
class Jugador{
    private $idJugador;
    private $Nombre; 
    private $Apellido;
    private $Email;
    private $Activo;
    

    public function __construct($idJugador, $Nombre, $apellido, $Email, $Activo){
        $this->idJugador = $idJugador;
        $this->Nombre = $Nombre;
        $this->Apellido = $Apellido;
        $this->Email = $Email;
        $this->Activo = $Activo;
    }
    static function getAll($link){
        try{
            $consulta = "SELECT * FROM Jugadores where Nombre='$this->Nombre'";
            $result = $link->prepare($consulta);
            $result->execute();
            return $result;
        }
        catch(PDOException $e){
            $dato = "¡Error!: " . $e->getMessage() . "<br/>";
             return $dato;
             die();
         }
    }
    function __get($var){
        return $this->$var;
        }
}
class Bd1
{
    private $link;
    function __construct()
    {
        if (!isset($this->link)) {
            try {
                $this->link = new PDO("mysql:host=localhost;dbname=casas", "root", "");
                $this->link->exec("set names utf8mb4");
            } catch (PDOException $e) {
                $dato = "¡Error!: " . $e->getMessage() . "<br/>";
                return $dato;
                die();
            }
        }
    }
    public function __get($link){
        if(property_exists(__CLASS__, $link)){
            return $this->$link;
        }
        return NULL;
    }
}
class Usuario{
    private $dni;
    private $Nombre; 
    private $edad;
    private $cod_pob;
    

    public function __construct($dni, $Nombre, $edad, $cod_pob){
        $this->dni = $dni;
        $this->Nombre = $Nombre;
        $this->edad = $edad;
        $this->cod_pob = $cod_pob;
    }
    static function getAll($link){
        try{
            $consulta = "SELECT * FROM usuario ";/*where Nombre='$this->Nombre'*/
            $result = $link->prepare($consulta);
            $result->execute();
            return $result;
        }
        catch(PDOException $e){
            $dato = "¡Error!: " . $e->getMessage() . "<br/>";
             return $dato;
             die();
         }
    }
    function __get($var){
        return $this->$var;
        }
    public function __set($propiedad, $var){
        if(property_exists(__CLASS__, $propiedad)){
            $this->$propiedad = $var;
        }
    }

}
class Bd2
{
    private $link;
    function __construct()
    {
        if (!isset($this->link)) {
            try {
                $this->link = new PDO("mysql:host=localhost;dbname=empleos", "root", "");
                $this->link->exec("set names utf8mb4");
            } catch (PDOException $e) {
                $dato = "¡Error!: " . $e->getMessage() . "<br/>";
                return $dato;
                die();
            }
        }
    }
    public function __get($link){
        if(property_exists(__CLASS__, $link)){
            return $this->$link;
        }
        return NULL;
    }
}

class Empleado{

    private $nombre;
    private $foto;

    public function __construct($nombre, $foto){
        $this->nombre = $nombre;
        $this->foto = $foto;
    }
    function insertar ($link){
        try{
            $consulta = "INSERT INTO empleados VALUES (:Nombre,:foto)";
            $result = $link->prepare($consulta);
            $result->bindParam(':Nombre',$nombre);
            $result->bindParam(':foto',$foto);
            $nombre = $this->nombre;
            $foto = $this->foto;
            $result->execute();
            return $result;
        }
        catch(PDOException $e){
                $dato = "¡Error!: " . $e->getMessage() . "<br/>";
                return $dato;
                die();
        }
    }
    public function __set($propiedad, $var){
        if(property_exists(__CLASS__, $propiedad)){
            $this->$propiedad = $var;
        }
    }
    public function __get($propiedad){
        if(property_exists(__CLASS__, $propiedad)){
            return $this->$propiedad;
        }
    }

    function buscar ($link){
        try{
                $consulta = "SELECT * FROM empleados where Nombre='$this->nombre'";
                $result = $link->prepare($consulta);
                $result->execute();
                return $result;
        }
        catch(PDOException $e){
                $dato = "¡Error!: " . $e->getMessage() . "<br/>";
                return $dato;
                die();
        }
    }
}