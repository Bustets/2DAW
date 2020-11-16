<?php
session_start();

require ('../modelo/modelo.php');
if (isset($_SESSION['nombre'])){
$link = new Bd;
$productos = Producto::getAll($link->link);//Para llamar au un metodo static los puntos dobles.

require ('../vistas/cabecera.html');

require ('../vistas/vistaProductos.php');

}else {
    header('Location:../vistas/login.php');
}