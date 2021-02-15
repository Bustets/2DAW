<?php
class Bd
{
    private $link;
    function __construct()
    {
        if (!isset($this->link)) {
            try {
                $this->link = new PDO("mysql:host=localhost;dbname=videoclub", "root", "");
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
class Bd1
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
class Cliente{
    private $dniCliente;
    private $nombre; 
    private $direccion;
    private $email;
    private $pwd;

    public function __construct($dni, $nom, $direccion, $email, $pwd){
        $this->dniCliente = $dni;
        $this->nombre = $nom;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->pwd = $pwd;
    }
    static function getAll($link){
        try{
            $consulta = "SELECT * FROM clientes";
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
                $consulta = "SELECT * FROM clientes where nombre='$this->nombre'";
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
class Empleado{

    private $nombre;
    private $foto;

    public function __construct($nombre, $foto){
        $this->nombre = $nombre;
        $this->foto = $foto;
    }
    function insertar ($link){
        try{
            $consulta = "INSERT INTO empleados VALUES (:nombre,:foto)";
            $result = $link->prepare($consulta);
            $result->bindParam(':nombre',$nombre);
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
}