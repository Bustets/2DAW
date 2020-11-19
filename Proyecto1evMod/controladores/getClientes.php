<?php


require ('../modelo/modelo.php');
    $link = new Bd;

    $clientes = Cliente::getAll($link->link);
    while($fila=$clientes->fetch_assoc()){
        $dato[]=$fila;
    }
    echo json_encode($dato);