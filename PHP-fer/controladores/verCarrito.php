<?php

require '../modelo.php';
$base = new Bd();

$mostrarCarrito = new Carrito("",$_COOKIE['carrito'], "","","","",$_COOKIE['dni']);

// Si vengo desde detalle
if(isset($_POST['anyadirCarrito'])) {
    // Si tengo sesion abierta
    if(isset($_COOKIE['dni'])){
        $carrito = new Carrito("",$_COOKIE['carrito'], $_POST['idProducto'],$_POST['nombreProducto'],$_POST['precio'],$_POST['cantidad'],$_COOKIE['dni']);
    } else {
        $carrito = new Carrito("",$_COOKIE['carrito'], $_POST['idProducto'],$_POST['nombreProducto'],$_POST['precio'],$_POST['cantidad'],'');
    }
    // Busco si existe la linea, si existe me modifica la cantidad, si no me lo inserta
    if($cant = $carrito->buscarLinea($base->link)){
        $carrito->cantidad = $_POST['cantidad'] + $cant['cantidad'];
        $carrito->modificarCantidad($base->link);
    }else {
        $carr = $carrito->insertar($base->link);
    }
}

// Metodo para eliminar el producto deseado
if(isset($_GET['idProducto'])){
    $carrito = new Carrito('',$_COOKIE['carrito'],$_GET['idProducto'],'','','','');
    $dato = $carrito->eliminarProducto($base->link);
    header('Location: ../verCarrito');
}

// Metodo que me actualiza el carrito
if(isset($_POST['actualizar'])){
    $nlineas = new Carrito("",$_COOKIE['carrito'],'','','','',$_COOKIE['dni']);
    $fila = $nlineas->buscar($base->link)->fetch(PDO::FETCH_ASSOC);
    for($i = 0; $i<count($fila); $i++){
        $agregar = new Carrito("",$_COOKIE['carrito'],$_POST['idProducto'][$i],'','',$_POST['cantidadAct'][$i],'');
        $cambiar = $agregar->modificarCantidad($base->link);
    }
    header('Location: verCarrito');
}

$span = $mostrarCarrito->contarCantidad($base->link);
$productos = $mostrarCarrito->buscar($base->link);
require "../vistas/verCarrito.html";





