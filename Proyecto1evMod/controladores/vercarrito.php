<?php
session_start();
require ('../modelo/modelo.php');
$precioTotal=0;
if (isset($_POST)){
    if(isset($_POST['comprar'])){
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $producto = array ( //He creado un array asociativo  dado que van todos ligados en la misma sesion del post 
        "idProducto" => $idProducto,
        "nombre" => $nombre,
        "precio" => $precio,
        "cantidad" => $cantidad
    );


    if(isset($_SESSION['carrito'])){
        $carrito = $_SESSION['carrito'];
        $carrito[] = $producto;
        $_SESSION['carrito'] = $carrito;
        

    }else{
        $carrito[] = $producto;
        $_SESSION['carrito'] = $carrito;
    }
    $total = $_SESSION['total'] + $producto['precio'];
    $_SESSION['total'] = $total;

    }
    require ('../vistas/vistaCarrito.php');

}else{
    require header('Location:../vistas/login.php');
}