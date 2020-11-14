<?php

var_dump($_POST);
if(isset($_POST['enviar'])){

    
require ('../modelo/modelo.php');
    $cliente = new Cliente();
    $cliente->autenticar();
}


?>