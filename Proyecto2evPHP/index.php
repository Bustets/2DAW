<?php
$dato ="";
if (isset($_POST['enviar'])) {
	//var_dump($_POST);
	if($_POST['valor']!=null) {
		$productos=json_decode(file_get_contents('http://localhost/2DAW/Proyecto2evPHP/producto/'.$_POST['productos'].'/'.rawurlencode($_POST['valor']),TRUE));
		//var_dump($consulta);
		require "vistas/contenidoProducto.php";
	}else{
		$dato."No se encontraron datos";
	}
	$dato.="<a href='index.php'> Volver </a>";
		require "vistas/mensaje.php";
}else{
	require "funcion.php";
	require "vistas/formProducto.php";
}