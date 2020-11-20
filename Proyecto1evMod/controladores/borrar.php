<?php
	require "../modelo/modelo.php";
	$link=new Bd();
	$cliente= new Cliente($_POST['dniCliente'],'','','','','');
	$dato=$cliente->borrar($link->link);
	
	echo json_encode($dato);


