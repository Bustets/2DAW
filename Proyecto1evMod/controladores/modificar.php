<?php
	require "../modelo/modelo.php";
		$link=new Bd();
		$cliente= new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$_POST['pwd'],$_POST['administrador']);		
		$dato=$cliente->modificar($link->link);
		echo json_encode($dato);
		$link->link->close();
	
