<?php
session_start();
require ('../modelo/modelo.php');
$precioTotal=0;
$dni=$_SESSION['dni'];
$carrito=$_SESSION['carrito'];



require ('../vistas/vistaConfirmar.php');

