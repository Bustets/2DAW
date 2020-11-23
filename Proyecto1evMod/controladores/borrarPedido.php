<?php
	require "../modelo/modelo.php";
	$link=new Bd();
	$pedido= new Pedido($_POST['idPedido'],'','','','','','');
	$dato=$pedido->borrar($link->link);
	
	echo json_encode($dato);

	$link->link->close();