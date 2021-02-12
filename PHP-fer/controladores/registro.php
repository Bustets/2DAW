<?php
require "../modelo.php";	
$base = new Bd();
$error="";
// Cuando le envio los datos al servidor pulsando el submit
if(isset($_POST['registro'])) {
    if(!empty($_POST['dniCliente'])&& !empty($_POST['nombre'])&& !empty($_POST['direccion'])&& !empty($_POST['email'])&& !empty($_POST['password']) ){
        $cli = new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$_POST['password'],'');
        // Verifico si existe ya ese cliente
        if(!$usuario = $cli->buscar($base->link)){
            $pass = password_hash($_POST['password'],PASSWORD_BCRYPT);
            $usu = new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$pass,'');
            $usuarioNuevo = $usu->insertar($base->link);
            setcookie('nombre', $_POST['nombre'], time()+(86400*30));
            setcookie('dni', $_POST['dniCliente'], time()+(86400*30));
            header('Location: principal');
        } else {
            $error = "Error";
            require "../vistas/registro.html";
        }
    } else {
        $error = "NoVacio";
        require "../vistas/registro.html";
    }
}else {
    require "../vistas/registro.html";
}

