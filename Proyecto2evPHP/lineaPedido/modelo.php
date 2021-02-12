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
	function insertar ($link){
		try{
			$consulta="INSERT INTO lineaspedidos VALUES (:idPedido,:nLinea,:idProducto,:cantidad)";
			$result=$link->prepare($consulta);
			$result->bindParam(':idPedido',$idPedido);
			$result->bindParam(':nLinea',$nLinea);
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

	function buscar ($link){
		try{
			$consulta="SELECT * FROM lineaspedidos where idPedido='$this->idPedido'";
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
	function modificarParcial ($link,$input){
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
		function sacarMaxLinea ($link) {
			try{
				$consulta="SELECT MAX(nlinea) AS nlinea FROM lineaspedidos WHERE  idPedido='$this->idPedido'";
				$result=$link->prepare($consulta);
				$result->execute();
				$dato = $result->fetch(PDO::FETCH_ASSOC);
				return $dato['nlinea'];
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
	//borra solo un pedido en concreto
	function borrar ($link){
		try{
			$consulta="DELETE FROM lineaspedidos where idPedido='$this->idPedido' and nlinea='$this->nlinea'";
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
	function borrarTodasLineaPedio ($link){
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