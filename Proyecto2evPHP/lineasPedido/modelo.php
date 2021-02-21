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
class LineasPedido{	

	private $idPedido;
	private $nLinea;
	private $idProducto;
	private $cantidad;

	static function getAll($link){
		try{
			$consulta="SELECT * FROM lineaspedidos";
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
	
	function __set($property, $value){
		if(property_exists($this, $property)) {
			$this->$property = $value;
		}
	}

	function __construct($idPedido, $nLinea, $idProducto, $cantidad){
		$this->idPedido=$idPedido;
		$this->nLinea=$nLinea;
		$this->idProducto=$idProducto;
		$this->cantidad=$cantidad;
	}
	function __get($var){
		return $this->$var;
		}
	function getLineas($link){
		$consulta="SELECT * FROM lineaspedidos where idPedido='$this->idPedido'";
		$result=$link->prepare($consulta);
		return $result->fetch(PDO::FETCH_ASSOC);
	}
	function insertar($link){
		try{
			$consulta="INSERT INTO lineaspedidos VALUES (:idPedido,:nlinea,:idProducto,:cantidad)";
			$result=$link->prepare($consulta);
			$result->bindParam(':idPedido',$idPedido);
			$result->bindParam(':nlinea',$nLinea);
			$result->bindParam(':idProducto',$didProducto);
			$result->bindParam(':cantidad',$cantidad);
			$idPedido=$this->idPedido;
			$nLinea=$this->nLinea;
			$idProducto=$this->idProducto;
			$cantidad=$this->cantidad;
			$result->execute();
			return $result;
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}

	function buscar($link){
		try{
			$consulta="SELECT * FROM lineaspedidos where idPedido='$this->idPedido'";
			$result=$link->prepare($consulta);
			$result->execute();
			$result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetchAll();
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}
	function buscarLinea($link){
		try{
			$consulta="SELECT * FROM lineaspedidos where idPedido='$this->idPedido' and nlinia='$this->nLinea'";
			$result=$link->prepare($consulta);
			$result->execute();
			$result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetchAll();
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}
	function modificarParcial($link,$input){
		try{
			$fields = getParams($input);
			$consulta = "
			  UPDATE lineapedidos
			  SET $fields
			  WHERE idPedido='$this->idPedido'";
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
		function generarMaxLinea($link) {
			try{
				$consulta="SELECT Max(nlinea) as nlinea FROM lineaspedidos where idPedido='$this->idPedido'";
				$result=$link->prepare($consulta);
				$result->execute(); 
				foreach ($result->fetch(PDO::FETCH_ASSOC) as $key => $value) {
						return $value+1;
				}
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				 return $dato;
				 die();
			 }
		}
	//borra solo un pedido en concreto
	function borrar($link){
		try{
			$consulta="DELETE FROM lineaspedidos where idPedido='$this->idPedido' and nlinea='$this->nLinea'";
			$result=$link->prepare($consulta);
			return $result->execute();
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}
	//borra todas las lineas de pedido
	function borrarTodasLineaPedio($link){
		try{
			$consulta="DELETE FROM lineaspedidos where idPedido='$this->idPedido'";
			$result=$link->prepare($consulta);
			return $result->execute();
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}
	

}