<?php

	class Bd	
{
	private $link;
	function __construct()
	{
		if (!isset ($this->link)) {
			try{
				$this->link= new PDO("mysql:host=localhost;dbname=virtualmarket", "root", "");
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

	/**
	* 
	*/
	
	class Producto{
		static function getall($link){
			$consulta = $link->prepare("SELECT * FROM productos");
			$consulta->execute();
			return $consulta;
			
		}
	}
	