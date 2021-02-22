<?php
// Consulta a la base de datos
class Base	
{
	private $link;
	function __construct()
	{

		if (!isset ($this->link)) {
			try{
				// Consulta mediante PDO
				$this->link= new PDO("mysql:host=localhost;dbname=juegos", "root", "");
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
// Clase jugador
class Jugador {

	// Variables privadas
	private $idJugador;
    private $Nombre;
    private $Apellido;

	// Constructor
    function __construct($idJugador, $nombre, $apellido){
        $this->idJugador = $idJugador;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
	}
	
	static function getAllEquipo($link){
        try{
			$consulta="SELECT * FROM jugadores where Nombres";
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

    function insertarjugador($link){
        try{
            $consulta="INSERT INTO jugadores VALUES (:Nombre)";//(:idJugador,:Nombre,:apellido)
            $result=$link->prepare($consulta);
            //$result->bindParam(':idJugador',$idJugador);
            $result->bindParam(':Nombre',$nombre);
            //$result->bindParam(':apellido',$apellido);
            $idJugador=$this->idJugador;
            $nombre=$this->nombre;
            $apellido=$this->apellido;
            $result->execute();
            return $result;
        }
        catch(PDOException $e){
            $dato= "¡Error!: " . $e->getMessage() . "<br/>";
             return $dato;
             die();
         }
    }
}