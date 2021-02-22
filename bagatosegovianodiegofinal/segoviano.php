<?php
include "dbs.php";
$base= new Bd();
$dir="foto/";
if (isset($_POST['enviar'])) {
    $nombre=$_FILES['fichero']['name'];
    $empleado=new Empleado ($_POST['idEmpleado'],'', $nombre);
    if ($empleado->buscarEmpleado($base->link)) {
        if (is_uploaded_file($_FILES['fichero']['tmp_name'])){
            move_uploaded_file($_FILES['fichero']['tmp_name'], $dir.$nombre);
            $dato="el fichero $nombre se ha subido correctamente";
            require "vistas/mensaje.php"; 
        }else{
            $dato="el fichero no se ha podido subido correctamente";
            require "vistas/mensaje.php";
        }      
    }else{
        $dato="el empleado no existe";
        require "vistas/mensaje.php";
    }
}else{
    require "vistas/formulario.html";
}