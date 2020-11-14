<?php

require ('../modelo/modelo.php');
$link = new Bd;
$productos = Producto::getAll($link->link);//Para llamar au un metodo static los puntos dobles.

require ('../vistas/cabecera.html');

foreach($productos as $producto){
    echo "<p>".$producto['nombre']."</p>";
}