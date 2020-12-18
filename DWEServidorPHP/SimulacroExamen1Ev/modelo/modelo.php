<?php

class Bd	
{
	private $link;
	function __construct()
	{
		if (!isset ($this->link)) {
			$this->link= new mysqli('localhost', 'root', '', 'examendaw1eval');
			if ( $this->link->connect_errno ){ 
			$dato= "Fallo al conectar a MySQL: ". $link->connect_error; 
 			require "vista/mostrar.php";
			}else $this->link->set_charset('utf-8'); 
		}
	}
	function __get($var){
		return $this->$var;
	}
}

class Alquiler{

	private $idClientes;
	private $fecha;
	private $pelicula;
	private $cliente;
	private $empleado;

	static function getAll($link){
		$consulta="SELECT * FROM idAlquiler";
		return $result=$link->query($consulta);
	}

	function __construct($idClientes, $fecha, $pelicula, $cliente, $empleado){
		$this->idClientes=$idClientes;
		$this->fecha=$fecha;
		$this->pelicula=$pelicula;
		$this->cliente=$cliente;
		$this->empleado=$empleado;
	}
	function buscar ($link){
		$consulta="SELECT * FROM productos where idProducto='$this->idProducto'";
		$result=$link->query($consulta);
		return $result->fetch_assoc();
	}
	function insertar ($link){
		$consulta="INSERT INTO productos VALUES ('$this->idProductos','$this->nombre','$this->origen','$this->foto','$this->marca','$this->categoria','$this->peso','$this->unidades','$this->volumen','$this->precio')";
		return $link->query($consulta);
	}
	function modificar ($link){
		$consulta="UPDATE productos SET idProductos='$this->idProductos', nombre='$this->nombre', origen='$this->origen', foto='$this->foto', marca='$this->marca', categoria='$this->categoria', peso='$this->peso', unidades='$this->unidades', volumen='$this->volumen', precio='$this->precio')";
		return $link->query($consulta);
	}
	function borrar ($link){
		$consulta="DELETE FROM productos where idProducto='$this->idProducto'";
		return $link->query($consulta);
	}
	
}