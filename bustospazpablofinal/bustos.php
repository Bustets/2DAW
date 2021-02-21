<?php
include "pbp.php";
$bd = new Bd;//casa
$bd1 = new Bd1;//juegos
$bd2 = new Bd2; //empleados

if (isset($_POST['enviar'])) {
    
    $empleado = new Empleado('', $_POST['Nombre'], $_GET['foto']);
    if($empleado->buscar($bd2->link)){
        include "subir.php";
        $usuario = new Usuario($_POST['Nombre'], $_GET['direccion']);
        $empleado->insertar($bd2->link);
        $jugador = new Jugador($_POST['Nombre'], $_GET['direccion']);
        $empleado->insertar($bd2->link);
        require "vistas/vistafinal.php";
    }else{
        
        require "vistas/usuarios.php";
    }

    
}else{
	
	require "vistas/formulario.php";
}
