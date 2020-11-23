<?php
session_start();
require "../modelo/modelo.php";
$link= new Bd();
$lineaPedido=new LineasPedido($_POST['idPedido'],'','','');
$lineas=$lineaPedido->buscar($link->link);
while($fila=$lineas->fetch_assoc()){
    $dato[]=$fila;
}
echo json_encode($dato);

$link->link->close();