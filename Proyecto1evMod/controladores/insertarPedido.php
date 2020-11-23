<?php
session_start();
require "../modelo/modelo.php";
		$link=new Bd();
		$pedido= new Pedido($_POST['idPedido'],$_POST['fecha'],$_POST['dirEntrega'],'',$_POST['fechaCaducidad'], $_POST['matriculaRepartidor'], $_POST['dniCliente']);
			$dato=$pedido->insertar($link->link);
			echo json_encode($dato);
		$link->link->close();