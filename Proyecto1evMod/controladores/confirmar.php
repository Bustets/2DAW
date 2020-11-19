<?php
session_start();
require ('../modelo/modelo.php');
$precioTotal=0;
$dni=$_SESSION['dni'];
$carrito=$_SESSION['carrito'];
$link = new Bd;
$idPedidoCarro = Pedido::maxPedido($link->link);
$idPedido = $idPedidoCarro['idPedido']+1;
$hoy = date("Y-m-d"); 
$pedido = new Pedido($idPedido,$hoy,"","","","",$dni);

$pedido->insertar($link->link);

$nLinea = 1;
foreach($carrito as $producto){
    $lineaPedido = new LineasPedido($idPedido, $nLinea, $producto['idProducto'], $producto['cantidad']);
    $lineaPedido->insertar($link->link);
    $nLinea++;  
}




require ('../vistas/vistaConfirmar.php');


