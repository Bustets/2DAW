<?php
require "vistas/inicio.html";
if (isset($_POST['enviar'])) {
	require ('funciones.php');
	//conexion a la base de datos
	$link = new mysqli('localhost', 'root', '', 'virtualmarket'); 
	//comprobar errores de conexión
	if ( $link->connect_errno ){ 
		$mensaje= "Fallo al conectar a MySQL: ". $link->connect_error; 
		require ('vistas/mensaje.php');
	} else
		//no hay errores de conexión
		{
		// seleccionar charset
		$link->set_charset('utf-8');
		if (!existe($_POST['dniCliente'],$link)){
			insertar($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$_POST['pwd']);
			$mensaje="Se ha insertado correctamente";
			$mensaje.="<a href='controlador.php'>volver</a>";
			require ('vistas/mensaje.php');
		}else {
			require ('vistas/mensaje.php');
		}
	
		
		}
	
	$link->close(); 
}else require "vistas/formulario.php";
require "vistas/fin.html";