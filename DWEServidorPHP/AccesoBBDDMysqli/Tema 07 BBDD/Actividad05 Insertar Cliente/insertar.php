<?php
include "vistas/inicio.html";
require "modelo.php";
if (isset($_POST['enviar'])) {
	$base=new Bd;
	$cli= new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$_POST['pwd']);
	if($cli->buscar($base->link)){
		$dato="El cliente ya existe<br>";
		$dato.="<a href='insertar.php'>Volver</a>";
		require "vistas/mensaje.php";
	}else {
		if($cli->insertar($base->link)){
			$dato="El cliente se ha insertado correctamente<br>";
			$dato.="<a href='insertar.php'>Volver</a>";
			require "vistas/mensaje.php";}
	}
	$base->link->close();
}else require "vistas/formulario.php";
include "vistas/fin.html";