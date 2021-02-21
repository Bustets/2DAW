<?php
class Bd	
{
	private $link;
	function __construct()
	{
		if (!isset ($this->link)) {
			try{
				$this->link= new PDO("mysql:host=localhost;dbname=empleos", "root", "");
				$this->link->exec("set names utf8mb4");
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
 		}
	}
		
	function __get($var){
		return $this->$var;
	}
}

    class Empleado{
        private $idEmpleado;
        private $nombre;
        private $foto;
        
        static function getAll($link){
            try{
                $consulta="SELECT * FROM empleados";
                $result=$link->prepare($consulta);
                $result->execute();
                return $result;
            }
            catch(PDOException $e){
                $dato= "¡Error!: " . $e->getMessage() . "<br/>";
                 return $dato;
                 die();
             }
        }
    
        function __construct($idEmpleado,$nombre,$foto){
            $this->idEmpleado=$idEmpleado;
            $this->nombre=$nombre;
            $this->foto=$foto;
        }
        function __get($var){
            return $this->$var;
            }
        function __set($property, $value){
            if(property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
         function insertarEmpleado ($link){
            try{
                $consulta="INSERT INTO empleados VALUES (:idEmpleado,:nombre,:foto)";
                $result=$link->prepare($consulta);
                $result->bindParam(':idEmpleado',$idEmpleado);
                $result->bindParam(':nombre',$nombre);
                $result->bindParam(':foto',$foto);
                $idEmpleado=$this->idEmpleado;
                $nombre=$this->nombre;
                $foto=$this->foto;
                $result->execute();
                return $result;
            }
            catch(PDOException $e){
                $dato= "¡Error!: " . $e->getMessage() . "<br/>";
                 return $dato;
                 die();
             }
        }
        function buscarEmpleado ($link){
            try{
                $consulta="SELECT * FROM empleados where idEmpleado='$this->idEmpleado'";
                $result=$link->prepare($consulta);
                $result->execute();
                return $result->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                $dato= "¡Error!: " . $e->getMessage() . "<br/>";
                 return $dato;
                 die();
             }
        }
    }
