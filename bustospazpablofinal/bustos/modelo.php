<?php
	class Bd	
    {
        private $link;
        function __construct()
        {
            if (!isset ($this->link)) {
                try{
                    $this->link = new PDO("mysql:host=localhost;dbname=juegos", "root", "");
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