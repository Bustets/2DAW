<?php

require '../modelo.php';
$base = new Bd();
$productos = Producto::getAll($base->link);
$mostrarCarrito = new Carrito("",$_COOKIE['carrito'], "","","","","");

// Si no esta creado la cookie carrito, la creo con un id unico
if(!isset($_COOKIE['carrito'])){
    $idCarrito = uniqid(); // Genrero un id unico
    setcookie('carrito',$idCarrito,time()+360000);
    setcookie('dni','0',time()+360000);
    header('Location: principal');
}else {
    $idCarrito = $_COOKIE['carrito'];
}
if($_COOKIE['dni'] != '0') {
    $carrito = new Carrito("",$_COOKIE['carrito'], '','','','',$_COOKIE['dni']);
    $modCarrito = $carrito->modificarDNI($base->link);
}
if(isset($_POST['cerrarSesion'])){
    setcookie('dni','0',time()+360000);
}

$span = $mostrarCarrito->contarCantidad($base->link);
require '../vistas/principal.html';
?>