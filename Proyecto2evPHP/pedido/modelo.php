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
class Pedido{

	private $idPedido;
	private $fecha;
	private $dirEntrega;
	private $nTarjeta;
	private $fechaCaducidad;
	private $matriculaRepartidor;
	private $dniCliente;

	function __construct($idPedido, $fecha, $dirEntrega, $nTarjeta, $fechaCaducidad, $matriculaRepartidor, $dniCliente){
		$this->idPedido=$idPedido;
		$this->fecha=$fecha;
		$this->dirEntrega=$dirEntrega;
		$this->nTarjeta=$nTarjeta;
		$this->fechaCaducidad=$fechaCaducidad;
		$this->matriculaRepartidor=$matriculaRepartidor;
		$this->dniCliente=$dniCliente;
	}

	function __get($var){
		return $this->$var;
		}
	function __set($property, $value){
		if(property_exists($this, $property)) {
			$this->$property = $value;
			}
		}

	static function getAll($link){
		try{
			$consulta="SELECT * FROM pedidos";
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


	function buscarPedido($link){	
		try{
			$consulta="SELECT * FROM pedidos where idPedido='$this->idPedido'";
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
	function insertarPedido($link){
		try{
			$consulta="INSERT INTO pedidos VALUES (:idPedido,:fecha,:dirEntrega,:nTarjeta,:fechaCaducidad, :matriculaRepartidor, :dniCliente)";
			$result=$link->prepare($consulta);
			$result->bindParam(':idPedido',$idPedido);
			$result->bindParam(':fecha',$fecha);
			$result->bindParam(':dirEntrega',$dirEntrega);
			$result->bindParam(':nTarjeta',$nTarjeta);
			$result->bindParam(':fechaCaducidad',$fechaCaducidad);
			$result->bindParam(':matriculaRepartidor',$matriculaRepartidor);
			$result->bindParam(':dniCliente',$dniCliente);
			$idPedido=$this->idPedido;
			$fecha=$this->fecha;
			$dirEntrega=$this->dirEntrega;
			$nTarjeta=$this->nTarjeta;
			$fechaCaducidad=$this->fechaCaducidad;
			$matriculaRepartidor=$this->matriculaRepartidor;
			$dniCliente=$this->dniCliente;
			$result->execute();
			return $result;
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}
	function maxPedido($link){
		try{
            $consulta="SELECT Max(idPedido) as idPedido FROM pedidos";
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

	function borrarPedido($link){
        try{
			$consulta="DELETE FROM pedidos where idPedido='$this->idPedido'";
			$result=$link->prepare($consulta);
			return $result->execute();
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
			  UPDATE pedidos
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

}
