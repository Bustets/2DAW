<?php
include "vistas/inicio.html";
$dni=$_GET['dni'];
if (isset($_GET['validar'])){
    if( $_GET['validar']=='Si') {
        require "modelo.php";
        $link=new Bd;
        $cli= new Cliente($_GET['dni'],'','','','');
        $dato=$cli->borrar($link->link);
        $dato="El cliente se ha borrado correctamente<br>";
        $dato.="<a href='index.php'>Volver</a>";
        require "vistas/mensaje.php";
        $link->link->close();
    } else {
        $dato="El borrado ha sido cancelado";
        $dato.="<a href='index.php'>Volver</a>";
        require "vistas/mensaje.php";
    }
}else 
    echo "¿Estás seguro?<a href='borrar.php?validar=Si&dni=$dni'>Si</a> <a href='borrar.php?validar=no&dni=$dni'>No</a>";
include "vistas/fin.html";