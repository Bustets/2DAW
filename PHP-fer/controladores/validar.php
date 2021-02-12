<?php
require "../modelo.php";	
$base = new Bd();
$error= "";
// Comprobar si esta la sesion iniciada
if(!isset($_COOKIE['nombre'])) {
    if(isset($_POST['login'])) {
        $dniCliente = $_POST['dniCliente'];
        $password = $_POST['password'];
        $cli = new Cliente($dniCliente,'','','',$password,'');
        if($usuario = $cli->buscar($base->link)){
            if(password_verify($password, $usuario['pwd'])) {
                setcookie('nombre', $usuario['nombre'], time()+(86400*30));
                setcookie('dni', $usuario['dniCliente'], time()+(86400*30));
                header('Location: principal');
            } else {
                $error = "Error";
                require "../vistas/validar.html";
            }
        } else {
            $error = "Error";
            require "../vistas/validar.html";
        }
    }else {
        require "../vistas/validar.html";
    }
}else {
    header('Location: principal');
}




