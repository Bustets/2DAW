<?php

require '../modelo.php';
$base = new Bd();

$idProducto = $_GET['idProducto'];
$productos = new Producto($idProducto,'','','','','','','','');

// Para contar la cantidad en el elemento carrito
$mostrarCarrito = new Carrito("",$_COOKIE['carrito'], "","","","","");
$span = $mostrarCarrito->contarCantidad($base->link);

// Busco el producto para mostrarlo
if($producto = $productos->buscar($base->link)) {
    require "../vistas/detalle.html";
}

?>