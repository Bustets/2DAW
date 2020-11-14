<?php

class Bd	
{
	private $link;
	function __construct()
	{
		if (!isset ($this->link)) {
			$this->link= new mysqli('localhost', 'root', '', 'virtualmarket');
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
class Cliente{

		private $dniCliente;
		private $nombre;
		private $direccion;
		private $email;
		private $pwd;
		private $admin;

		static function getAll($link){
			$consulta="SELECT * FROM clientes";
			return $result=$link->query($consulta);
		}

		function __construct($dni, $nombre, $direccion,$email,$pwd,$admin){
			$this->dniCliente=$dni;
			$this->nombre=$nombre;
			$this->direccion=$direccion;
			$this->email=$email;
			$this->pwd=$pwd;
			$this->admin=$admin;
		}
		function buscar ($link){
			$consulta="SELECT * FROM clientes where dniCliente='$this->dniCliente'";
			$result=$link->query($consulta);
			return $result->fetch_assoc();
		}
		function autenticar ($link){
			$consulta="SELECT nombre, administrador FROM clientes where dniCliente='$this->dniCliente' and pwd='$this->pwd'";
			//var_dump($consulta);
			$result=$link->query($consulta);
			//var_dump($result);
			return $result->fetch_assoc();
		}
		function insertar ($link){
			$consulta="INSERT INTO clientes VALUES ('$this->dniCliente','$this->nombre','$this->direccion','$this->email','$this->pwd')";
			return $link->query($consulta);
		}
		function modificar ($link){
			$consulta="UPDATE clientes SET nombre='$this->nombre',  direccion='$this->direccion',  email='$this->email', pwd='$this->pwd' WHERE dniCliente='$this->dniCliente'";
			return $link->query($consulta);
		}
		function borrar ($link){
			$consulta="DELETE FROM clientes where dniCliente='$this->dniCliente'";
			return $link->query($consulta);
		}
}
class Pedido{

	private $idPedido;
	private $fecha;
	private $dirEntrega;
	private $nTarjeta;
	private $fechaCacucidad;
	private $matriculaRepartidor;
	private $dniCliente;

}
class LineasPedido{	

	private $idPedido;
	private $nLinea;
	private $idProducto;
	private $cantidad;

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
		$consulta="SELECT * FROM productos";
		return $result=$link->query($consulta);
	}

	
}