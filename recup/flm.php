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
    private $Equipo;

	// Constructor
    function __construct($idJugador, $Nombre, $Apellido, $Equipo){
        $this->idJugador = $idJugador;
        $this->Nombre = $Nombre;
        $this->Apellido = $Apellido;
        $this->Equipo = $Equipo;
	}
	
	// Metodo para mostrar todos los jugadores por el equipo
	static function getAllEquipo($link, $datos){
        try{
			$consulta="SELECT * FROM jugadores where Equipo=$datos";
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

	// Metodos GET y SET mágicos
	function __get($var){
		return $this->$var;
		}

	public function __set($name, $value){
		return $this->$name = $value;
	}

	// Metodo para buscar jugadores por IdJugador
    function buscar($link){
        try{
            $consulta="SELECT * FROM jugadores where idJugador='$this->idJugador'";
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

// Clase Partida
class Partida{

	// Variables Privadas
    private $Nombre;
	
	// Constructor
    function __construct($Nombre){
        $this->Nombre=$Nombre;
	}

	// Metodo para buscar el ID mediante el nombre
	function buscarId($link){
        try{
            $consulta="SELECT idPartida FROM partidas where Nombre='$this->Nombre'";
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

	// Metodos GET y SET magicos
	function __get($Nombre){
		return $this->$Nombre;
	}

	public function __set($Nombre, $value){
		return $this->$Nombre = $value;
	}
}

// Clase Partida Jugador
class PartidaJugador{
    static function insertarTodas($link, $datos, $modo, $idPartida){
		if ($modo==1){
			try{
				$consulta="INSERT INTO partidasjugadores VALUES ('',:idJugador,:idPartida)";
				$result=$link->prepare($consulta);
				$result->bindParam(':idJugador',$datos['idJugador']);
				$result->bindParam(':idPartida',$idPartida);
				$result->execute();
				return $result;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				 require "vista/mostrar.php";
				 die();
			 }
		}else{
			foreach ($datos as $key => $value) {
				try{
					$consulta="INSERT INTO partidasjugadores VALUES ('',:idJugador,:idPartida)";
					$result=$link->prepare($consulta);
					$result->bindParam(':idJugador',$value['idJugador']);
					$result->bindParam(':idPartida',$idPartida);
					$result->execute();
				}
				catch(PDOException $e){
					$dato= "¡Error!: " . $e->getMessage() . "<br/>";
					 require "vista/mostrar.php";
					 die();
				}
			}
		}
	}
}