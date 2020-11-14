<?php
function consultabd($consulta){
    $result = null;
    //conexion a la base de datos
    $link = new mysqli('localhost', 'root', '', 'virtualmarket');
    //comprobar errores de conexión
    if ( $link->connect_errno ){ 
		$mensaje= "Fallo al conectar a MySQL: ". $link->connect_error; 
		require ('vistas/mensaje.php');
	} else{
        $result=$link->query($consulta);
    }
    return $result;
}