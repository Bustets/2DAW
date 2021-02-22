<?php
include "vistas/inicio.html";
require "modelo.php";
$link=new Bd;
$cli= new Cliente($_GET['dni'],'','','','');
$dato=$cli->buscar($link->link);
require "vistas/verDetalle.php";
$dato="<a href='index.php'>Volver</a>";
require "vistas/mensaje.php";
$link=NULL;
include "vistas/fin.html";