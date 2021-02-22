<?php
require "modelo.php";
$base= new Base();
if (isset($_COOKIE['idProducto'])){
	try{	
		$base->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$base->link->beginTransaction();
		$pedido= new Pedido($_COOKIE['idPedido'],$_COOKIE['fecha'], $_COOKIE['dniCliente']);
		$pedido->insertar($base->link);
		$dato= Linea::insertarTodas($base->link);
		$base->link->commit();
		Linea::borrarCookies();
	}catch (Exception $e){
	$base->link->rollback();
	$dato="Fallo: ".$e->getMessage();	
	}
} else $dato="No se han insertado lineas";
Pedido::borrarCookies();
$dato.="<br><a href=index.php> volver</a>";
require"vistas/mensaje.php";
