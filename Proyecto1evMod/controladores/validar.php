<?php

if(isset($_POST['enviar'])){
    $dni = $_POST['dni'];
    $pass = $_POST['pass'];
    
    require ('../modelo/modelo.php');
    $link = new Bd;
    $cliente = new Cliente($dni,'','','', $pass,'');
    $result = $cliente->autenticar($link->link);


    if($result == null){
        header ('Location: login.php');
        echo 'El usuario no existe';//no sale 
    }

    if($result['administrador']==1){
       header ('Location: ../vistas/administracion.php');
    }else{
        session_start();
        $_SESSION['nombre']=$result['nombre'];
        $_SESSION['dni']=$dni;
        $_SESSION['total']=0;
        header ('Location: principal.php');
    }


}


?>