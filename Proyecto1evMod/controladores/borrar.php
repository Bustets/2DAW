<?php
session_start();
include "vistas/login.html";
if (isset($_SESSION['nombre'])){
	require "../modelo/modelo.php";
	$link=new Bd;
	$cliente= new Cliente($_GET['dni'],'','','','');
	$dato=$cliente->borrar($link->link);
	$dato="El cliente se ha borrado correctamente<br>";
	$dato.="<a href='login.php'>Volver</a>";
	require "vistas/mensaje.php";
	$link->link->close();
}else {
	$dato="Es necesario estar registrado<br>";
	$dato.="<a href='login.php'> Volver </a>";
	require "vistas/mensaje.php";
}
//include "vistas/fin.html";
