<?php
// Consulta a la base de datos
class Bd	
{
	private $link;
	function __construct()
	{

		if (!isset ($this->link)) {
			try{
				// Consulta mediante PDO
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

//Clase de cliente
class Cliente
{
		private $dniCliente;
		private $nombre;
		private $direccion;
		private $email;
		private $pwd;
		private $admin;
		
		//Metodo para mostrar todos los clientes (GET)
		static function getAll($link){
			try{
				$consulta="SELECT * FROM clientes where admin=0" ;
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

		function __construct($dni, $nombre, $direccion,$email,$pwd,$admin){
			$this->dniCliente=$dni;
			$this->nombre=$nombre;
			$this->direccion=$direccion;
			$this->email=$email;
			$this->pwd=$pwd;
			$this->admin=$admin;
		}

		function __get($var){
		return $this->$var;
		}

		// Metodo para buscar cliente por dniCliente
		function buscar ($link){
			try{
				$consulta="SELECT * FROM clientes where dniCliente='$this->dniCliente'";
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

		// Metodo que me saca el usuario Admin para mostrarlo en Angular (GET)
		function login ($link){
			try{
				$consulta="SELECT * FROM clientes where admin='$this->admin'";
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
	
		//Metodo para insertar cliente(POST)
		function insertar ($link){
			try{
				$consulta="INSERT INTO clientes VALUES (:dniCliente,:nombre,:direccion,:email,:pwd,:admin)";
				$result=$link->prepare($consulta);
				$result->bindParam(':dniCliente',$dniCliente);
				$result->bindParam(':nombre',$nombre);
				$result->bindParam(':direccion',$direccion);
				$result->bindParam(':email',$email);
				$result->bindParam(':pwd',$pwd);
				$result->bindParam(':admin',$admin);
				$dniCliente=$this->dniCliente;
				$nombre=$this->nombre;
				$direccion=$this->direccion;
				$email=$this->email;
				$pwd=$this->pwd;
				$admin=$this->admin;
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		// Metodo de modificarPARCIAL cliente (PUT)
		function modificarParcial ($link,$input){
			try{
				$fields = getParams($input);
				$consulta = "
          		UPDATE clientes
          		SET $fields
          		WHERE dniCliente='$this->dniCliente'";
          		$result=$link->prepare($consulta);
				bindAllValues($result,$input);
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
		//Metodo para borrar cliente (DELETE)
		function borrar ($link){
			try{
				$consulta="DELETE FROM clientes where dniCliente='$this->dniCliente'";
				$result=$link->prepare($consulta);
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
		//Metodo para sacarme la direccion del cliente dependiendo de su dni
		function sacarDireccion($link){
			try{
				$consulta="SELECT direccion FROM clientes where dniCliente='$this->dniCliente'";
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
}

// Clase de producto
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
		private $precio;

		// Metodo que llamaremos para llamar a todos los productos (GET)
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

		// CONSTRUCTOR
		function __construct($idProducto, $nombre, $origen,$foto,$marca,$categoria,$peso,$unidades,$precio){
			$this->idProducto=$idProducto;
			$this->nombre=$nombre;
			$this->origen=$origen;
			$this->foto=$foto;
			$this->marca=$marca;
			$this->categoria=$categoria;
			$this->peso=$peso;
			$this->unidades=$unidades;
			$this->precio=$precio;
		}

		function __get($var){
		return $this->$var;
		}

		// Metodo de busqueda mediante idProducto
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

		// Metodo para insertar productos (POST)
		function insertar ($link){
			try{
				$consulta="INSERT INTO productos VALUES (:idProducto,:nombre,:origen,:foto,:marca,:categoria,:peso,:unidades,:precio)";
				$result=$link->prepare($consulta);
				$result->bindParam(':idProducto',$idProducto);
				$result->bindParam(':nombre',$nombre);
				$result->bindParam(':origen',$origen);
				$result->bindParam(':foto',$foto);
				$result->bindParam(':marca',$marca);
				$result->bindParam(':categoria',$categoria);
				$result->bindParam(':peso',$peso);
				$result->bindParam(':unidades',$unidades);
				$result->bindParam(':precio',$precio);
				$idProducto=$this->idProducto;
				$nombre=$this->nombre;
				$origen=$this->origen;
				$foto=$this->foto;
				$marca=$this->marca;
				$categoria=$this->categoria;
				$peso=$this->peso;
				$unidades=$this->unidades;
				$precio=$this->precio;
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		// Metodo de modificarPARCIAL (PUT)
		function modificarParcial ($link,$input){
			try{
				$fields = getParams($input);
				$consulta = "
          		UPDATE productos
          		SET $fields
          		WHERE idProducto='$this->idProducto'";
          		$result=$link->prepare($consulta);
				bindAllValues($result,$input);
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		// Metodo para borrar productos (DELETE)
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

		// Metodo para sacar el maximo Nlinea (GET)
		function sacarMaximoidProducto ($link) {
			try{
				$consulta="SELECT MAX(idProducto) AS idProducto FROM productos";
				$result=$link->prepare($consulta);
				$result->execute();
				$dato = $result->fetch(PDO::FETCH_ASSOC);
				return $dato['idProducto'];
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				return $dato;
				die();
			}
		}
}

//Clase de Pedido
class Pedido
{
		private $idPedido;
		private $fecha;
		private $dirEntrega;
		private $dniCliente;

		//Metodo para mostrar todos los clientes (GET)
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

		function __construct($idPedido, $fecha, $dirEntrega,$dniCliente){
			$this->idPedido=$idPedido;
			$this->fecha=$fecha;
			$this->dirEntrega=$dirEntrega;
			$this->dniCliente=$dniCliente;
		}

		function __get($var){
		return $this->$var;
		}

		// Metodo para buscar por idPedido (GET)
		function buscar ($link){
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

		//Metodo para borrar pedido (DELETE)
		function borrar ($link){
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

		// Metodo para modificar pedido (PUT)
		function modificarParcial ($link,$input){
			try{
				$fields = getParams($input);
				$consulta = "
          		UPDATE pedidos
          		SET $fields
          		WHERE idPedido='$this->idPedido'";
          		$result=$link->prepare($consulta);
				bindAllValues($result,$input);
				return $result->execute();;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		// Metodo para sacar el maximo Nlinea (GET)
		function sacarMaximoidPedido ($link) {
			try{
				$consulta="SELECT MAX(idPedido) AS idPedido FROM pedidos";
				$result=$link->prepare($consulta);
				$result->execute();
				$dato = $result->fetch(PDO::FETCH_ASSOC);
				return $dato['idPedido'];
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				return $dato;
				die();
			}
		}

		//Metodo para insertar Pedido(POST)
		function insertar ($link){
			try{
				$consulta="INSERT INTO pedidos VALUES (:idPedido,:fecha,:dirEntrega,:dniCliente)";
				$result=$link->prepare($consulta);
				$result->bindParam(':idPedido',$idPedido);
				$result->bindParam(':fecha',$fecha);
				$result->bindParam(':dirEntrega',$dirEntrega);
				$result->bindParam(':dniCliente',$dniCliente);
				$idPedido=$this->idPedido;
				$fecha=$this->fecha;
				$dirEntrega=$this->dirEntrega;
				$dniCliente=$this->dniCliente;
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
}

//Clase de Pedido
class LineaPedido
{
		private $idPedido;
		private $nlinea;
		private $idProducto;
		private $cantidad;

		function __construct($idPedido, $nlinea, $idProducto,$cantidad){
			$this->idPedido=$idPedido;
			$this->nlinea=$nlinea;
			$this->idProducto=$idProducto;
			$this->cantidad=$cantidad;
		}

		function __get($var){
		return $this->$var;
		}

		// Metodo para buscar por idPedido (GET)
		function buscar ($link){
			try{
				$consulta="SELECT * FROM lineaspedidos where idPedido='$this->idPedido'";
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

		// Metodo para buscar por idPedido (GET)
		function buscarLinea ($link){
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

		//Metodo para borrar pedido (DELETE)
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

		// Metodo para borrar todas las lineas de pedido al borrar pedido
		function borrarAllLineaPedido ($link) {
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

		// Metodo para modificar pedido (PUT)
		function modificarParcial ($link,$input){
			try{
				$fields = getParams($input);
				$consulta = "
          		UPDATE lineaspedidos
          		SET $fields
          		WHERE idPedido='$this->idPedido'";
          		$result=$link->prepare($consulta);
				bindAllValues($result,$input);
				return $result->execute();;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		// Metodo para sacar el maximo Nlinea
		function sacarMaximonLinea ($link) {
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

		//Metodo para insertar Pedido(POST)
		function insertar ($link){
			try{
				$consulta="INSERT INTO lineaspedidos VALUES (:idPedido,:nlinea,:idProducto,:cantidad)";
				$result=$link->prepare($consulta);
				$result->bindParam(':idPedido',$idPedido);
				$result->bindParam(':nlinea',$nlinea);
				$result->bindParam(':idProducto',$idProducto);
				$result->bindParam(':cantidad',$cantidad);
				$idPedido=$this->idPedido;
				$nlinea=$this->nlinea;
				$idProducto=$this->idProducto;
				$cantidad=$this->cantidad;
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
}

//Clase de cliente
class Carrito
{
		private $id;
		private $idCarrito;
		private $idProducto;
		private $nombreProducto;
		private $precio;
		private $cantidad;
		private $dniCliente;

		//Metodo para mostrar todos los carritos (GET)
		static function getAll($link){
			try{
				$consulta="SELECT * FROM carrito" ;
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

		function __construct($id,$idCarrito, $idProducto,$nombreProducto,$precio,$cantidad,$dniCliente){
			$this->id=$id;
			$this->idCarrito=$idCarrito;
			$this->idProducto=$idProducto;
			$this->nombreProducto=$nombreProducto;
			$this->precio=$precio;
			$this->cantidad=$cantidad;
			$this->dniCliente=$dniCliente;
		}

		function __get($var){
		return $this->$var;
		}

		public function __set($name, $value){
			return $this->$name = $value;
		}

		// Metodo para buscar cliente por dniCliente
		function buscar ($link){
			try{
				$consulta="SELECT * FROM carrito where idCarrito='$this->idCarrito' AND dniCliente='$this->dniCliente'";
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

		// Metodo para buscar la linea de carrito donde sea igual al idCarrito y idProducto
		function buscarLinea ($link){
			try{
				$consulta="SELECT * FROM carrito where idCarrito='$this->idCarrito' AND idProducto='$this->idProducto'";
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
		
		// Metodo para modificar cantidad del carrito
		function modificarCantidad ($link){
			try{
				$consulta="UPDATE carrito set cantidad='$this->cantidad' WHERE idCarrito='$this->idCarrito' AND idProducto='$this->idProducto'";
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

		// Metodo para modificar el dni
		function modificarDNI ($link){
			try{
				$consulta="UPDATE carrito set dniCliente='$this->dniCliente' WHERE idCarrito='$this->idCarrito'";
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

		// Metodo para el SPAN para mostrar el carrito
		function contarCantidad($link) {
			try{
				$consulta="SELECT cantidad FROM carrito where idCarrito='$this->idCarrito'";
				$result=$link->prepare($consulta);
				$result->execute();
				$total=0;
				while($fila=$result->fetch(PDO::FETCH_ASSOC)) {
					$total += $fila['cantidad'];
				}
				return $total;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		//Metodo para borrar cliente (DELETE)
		function eliminarProducto ($link){
			try{
				$consulta="DELETE FROM carrito where idCarrito='$this->idCarrito' AND idProducto='$this->idProducto'";
				$result=$link->prepare($consulta);
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		//Metodo para insertar carrito(POST)
		function insertar ($link) {
			try{
				$consulta="INSERT INTO carrito VALUES (:id,:idCarrito,:idProducto,:nombreProducto,:precio,:cantidad,:dniCliente)";
				$result=$link->prepare($consulta);
				$result->bindParam(':id',$id);
				$result->bindParam(':idCarrito',$idCarrito);
				$result->bindParam(':idProducto',$idProducto);
				$result->bindParam(':nombreProducto',$nombreProducto);
				$result->bindParam(':precio',$precio);
				$result->bindParam(':cantidad',$cantidad);
				$result->bindParam(':dniCliente',$dniCliente);
				$id=$this->id;
				$idCarrito=$this->idCarrito;
				$idProducto=$this->idProducto;
				$nombreProducto=$this->nombreProducto;
				$precio=$this->precio;
				$cantidad=$this->cantidad;
				$dniCliente=$this->dniCliente;
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				return $dato;
				die();
			}
		}
		
		// Metodo que me saca el usuario Admin para mostrarlo en Angular (GET)
		function login ($link){
			try{
				$consulta="SELECT * FROM clientes where admin='$this->admin'";
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


		// Metodo de modificarPARCIAL cliente (PUT)
		function modificarParcial ($link,$input){
			try{
				$fields = getParams($input);
				$consulta = "
          		UPDATE carrito
          		SET $fields
          		WHERE idCarrito='$this->idCarrito'";
          		$result=$link->prepare($consulta);
				bindAllValues($result,$input);
				return $result->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		//Metodo para borrar cliente (DELETE)
		function borrar ($link){
			try{
				$consulta="DELETE FROM carrito where idCarrito='$this->idCarrito' AND dniCliente='$this->dniCliente'";
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