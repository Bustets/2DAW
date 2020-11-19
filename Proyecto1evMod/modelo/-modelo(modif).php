<?php

class Bd
{
	private $link;
	function __construct()
	{
		if (!isset($this->link)) {
			$this->link = new mysqli('localhost', 'root', '', 'virtualmarket');
			if ($this->link->connect_errno) {
				$dato = "Fallo al conectar a MySQL: ".$link->connect_error;
				require "vista/mostrar.php";
			} else $this->link->set_charset('utf-8');
		}
	}
	function __get($var)
	{
		return $this->$var;
	}
}
class Cliente
{

	private $dniCliente;
	private $nombre;
	private $direccion;
	private $email;
	private $pwd;
	private $administrador;

	static function getAll($link)
	{
		$consulta = "SELECT * FROM clientes";
		return $result = $link->query($consulta);
	}

	function __construct($dni, $nombre, $direccion, $email, $pwd, $administrador)
	{
		$this->dniCliente = $dni;
		$this->nombre = $nombre;
		$this->direccion = $direccion;
		$this->email = $email;
		$this->pwd = $pwd;
		$this->admin = $administrador;
	}
	function buscar($link)
	{
		$consulta = "SELECT * FROM clientes where dniCliente='$this->dniCliente'";
		$result = $link->query($consulta);
		return $result->fetch_assoc();
	}
	function autenticar($link)
	{
		$consulta = "SELECT nombre, administrador FROM clientes where dniCliente='$this->dniCliente' and pwd='$this->pwd'";
		$result = $link->query($consulta);
		return $result->fetch_assoc();
	}
	function insertar($link)
	{
		$consulta = "INSERT INTO clientes VALUES ('$this->dniCliente','$this->nombre','$this->direccion','$this->email','$this->pwd','$this->administrador')";
		return $link->query($consulta);
	}
	function modificar($link)
	{
		$consulta = "UPDATE clientes SET nombre='$this->nombre',  direccion='$this->direccion',  email='$this->email', pwd='$this->pwd', administrador='$this->administrador' WHERE dniCliente='$this->dniCliente'";
		return $link->query($consulta);
	}
	function borrar($link)
	{
		$consulta = "DELETE FROM clientes where dniCliente='$this->dniCliente'";
		return $link->query($consulta);
	}
}

/*class Carrito
{

	private $carrito;

	function __construct()
	{
		$this->carrito = array();
		//var_dump($this->carrito);
	}
	public function getCarrito()
	{
		return $this->carrito;
	}
	public function setCarrito($carrito)
	{
		$this->carrito = $carrito;
	}
	public function anyadirProducto($producto)
	{ 
		 $this->carrito->add($producto);
		//$id = $producto['idProducto'];
		//$carrito[$id] = $producto;
	}
	public function size()
	{
		return count($this->carrito);
	}
}*/

class Pedido
{
	private $idPedido;
	private $fecha;
	private $dirEntrega;
	private $nTarjeta;
	private $fechaCaducidad;
	private $matriculaRepartidor;
	private $dniCliente;
}
class LineasPedido
{

	private $idPedido;
	private $nLinea;
	private $idProducto;
	private $cantidad;

	static function getAll($link)
	{
		$consulta = "SELECT * FROM lineasPedidos";
		return $link->query($consulta);
	}

	function __construct($idPedido, $nLinea, $idProducto, $cantidad)
	{
		$this->idPedido = $idPedido;
		$this->nLineas = $nLinea;
		$this->idProducto = $idProducto;
		$this->cantidad = $cantidad;
	}
	//NO se si esta funcione esta bien
	function buscar($link)
	{
		$consulta = "SELECT * FROM lineasProducto where idPedido='$this->idPedido'";
		$result = $link->query($consulta);
		return $result->fetch_assoc();
	}
	function insertar($link)
	{
		$consulta = "INSERT INTO lineaProducto VALUES ('$this->idPedido','$this->nLinea','$this->idProducto','$this->cantidad')";
		return $link->query($consulta);
	}
}
class Producto
{

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

	static function getAll($link)
	{
		$consulta = "SELECT * FROM productos";
		return $result = $link->query($consulta);
	}

	function __construct($idProducto, $nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio)
	{
		$this->idProducto = $idProducto;
		$this->nombre = $nombre;
		$this->origen = $origen;
		$this->foto = $foto;
		$this->marca = $marca;
		$this->categoria = $categoria;
		$this->peso = $peso;
		$this->unidades = $unidades;
		$this->volumen = $volumen;
		$this->precio = $precio;
	}
	function buscar($link)
	{
		$consulta = "SELECT * FROM productos where idProducto='$this->idProducto'";
		$result = $link->query($consulta);
		return $result->fetch_assoc();
	}
	function insertar($link)
	{
		$consulta = "INSERT INTO productos VALUES ('$this->idProductos','$this->nombre','$this->origen','$this->foto','$this->marca','$this->categoria','$this->peso','$this->unidades','$this->volumen','$this->precio')";
		return $link->query($consulta);
	}
	function modificar($link)
	{
		$consulta = "UPDATE productos SET idProductos='$this->idProductos', nombre='$this->nombre', origen='$this->origen', foto='$this->foto', marca='$this->marca', categoria='$this->categoria', peso='$this->peso', unidades='$this->unidades', volumen='$this->volumen', precio='$this->precio')";
		return $link->query($consulta);
	}
	function borrar($link)
	{
		$consulta = "DELETE FROM productos where idProducto='$this->idProducto'";
		return $link->query($consulta);
	}
}