<?php
session_start();
require "../modelo/modelo.php";
		$link=new Bd;
		$cliente= new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],'','');
			if($cli->insertar($link->link)){
				$dato = true;
				echo json_encode($dato);
			}else{
				$dato = false;
				echo json_encode($dato);
			}
		$link->link->close();

