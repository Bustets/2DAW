<?php
session_start();

require ('../modelo/modelo.php');
if (isset($_SESSION['nombre'])){
    $link = new Bd;
    $idPedido = $_GET['idPedido'];
    $pedido = new LineasPedido($idPedido,'','','');
    //
    //$infoPedido = $pedido->buscar($link->link); nos falta la funcion en el constructor 
    //
    require ('../vistas/vistaCarrito.php');

}else{
    require header('Location:../vistas/login.php');
}