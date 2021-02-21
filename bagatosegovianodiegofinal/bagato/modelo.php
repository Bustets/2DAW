<?php

class Bd	
{
	private $link;
	function __construct()
	{
		if (!isset ($this->link)) {
			try{
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
class Jugadores
{
		private $idJugador;
		private $nombre;
		private $apellido;
		private $email;
		private $activo;

		function getNombres($link){
			try{
				$consulta="SELECT Nombre FROM jugadores";
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
		function __construct($dni, $nombre, $apellido,$email,$activo){
			$this->idJugador=$dni;
			$this->nombre=$nombre;
			$this->apellido=$apellido;
			$this->email=$email;
			$this->$activo=$activo;
		}
		function __get($var){
			return $this->$var;
			}
		function __set($property, $value){
			if(property_exists($this, $property)) {
				$this->$property = $value;
			}
		}

}