<?php
include "cvm.php";
$bd = new Bd;
$bd1 = new Bd1;
if (isset($_POST['enviar'])) {
    // Si existe el cliente lo introduzco en la base de datos
    
    $cli = new Cliente('',$_POST['cliente'],'','','');
    if($cli->buscar($bd->link)){
        include "subir.php";
        $empleado = new Empleado($_POST['cliente'], $_GET['direccion']);
        $empleado->insertar($bd1->link);
        require "vistas/vistafinal.php";
    }else{
        //sino muestro la lista de clientes
        require "vistas/usuarios.php";
    }

    
}else{
	
	require "vistas/formulario.php";
}