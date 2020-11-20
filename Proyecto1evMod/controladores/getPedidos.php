<?php


require ('../modelo/modelo.php');
    $link = new Bd;

    $pedidos = Pedido::getAll($link->link);
    while($fila=$pedidos->fetch_assoc()){
        $dato[]=$fila;
    }
    echo json_encode($dato);