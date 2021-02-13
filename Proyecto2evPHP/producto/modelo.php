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

class Producto{

	private $idProducto;
	private $nombre;
	private $origen;
	private $foto;
	private $marca;
	private $categoria;
	private $peso;
	private $unidades;
	private $volumen;
	private $precio;

	static function getAll($link){
		try{
			$consulta="SELECT * FROM productos";
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

	function __construct($idProducto, $nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio){
		$this->idProducto=$idProducto;
		$this->nombre=$nombre;
		$this->origen=$origen;
		$this->foto=$foto;
		$this->marca=$marca;
		$this->categoria=$categoria;
		$this->peso=$peso;
		$this->unidades=$unidades;
		$this->volumen=$volumen;
		$this->precio=$precio;
	}
	function __get($var){
		return $this->$var;
	}
	function buscar ($link){
		try{
			$consulta="SELECT * FROM productos where idProducto='$this->idProducto'";
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
	function getProducto($link, $params){
		try{
			$consulta="SELECT * FROM productos WHERE ".$params['key']."='".$params['value']."'";
			//echo $consulta;
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
	
	function buscarCampos ($link){
		try{
			$consulta="DESCRIBE productos"; //la sentencia DESCRIBRE devuelve los nombres de los campos de la estructura de la tabla
			//echo $consulta;
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

	function insertar ($link){
		try{
			$consulta="INSERT INTO productos VALUES (:idProducto,:nombre,:origen,:foto,:marca,:categoria,:peso,:unidades,:volumen,:precio)";
			$result=$link->prepare($consulta);
			$result->bindParam(':idProducto',$idProducto);
			$result->bindParam(':nombre',$nombre);
			$result->bindParam(':origen',$origen);
			$result->bindParam(':foto',$foto);
			$result->bindParam(':marca',$marca);
			$result->bindParam(':categoria',$categoria);
			$result->bindParam(':peso',$peso);
			$result->bindParam(':unidades',$unidades);
			$result->bindParam(':volumen',$volumen);
			$result->bindParam(':precio',$precio);
			$idProducto=$this->idProducto;
			$nombre=$this->nombre;
			$origen=$this->origen;
			$foto=$this->foto;
			$marca=$this->marca;
			$categoria=$this->categoria;
			$peso=$this->peso;
			$unidades=$this->unidades;
			$volumen=$this->volumen;
			$precio=$this->precio;
			$result->execute();
			return $result;
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}
	function buscarParcial ($link,$input){
		try{
			$fields = getParams($input);
			$consulta = "
				SELECT * FROM productos 
				WHERE $fields";
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
	function borrar ($link){
		try{
			$consulta="DELETE FROM productos where idProducto='$this->idProducto'";
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