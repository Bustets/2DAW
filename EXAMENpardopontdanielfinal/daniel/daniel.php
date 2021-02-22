<?php
    require "modelo/conector_servicio.php";
    require "modelo/cliente.php";

    $conector = new Conector();

    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET" :
            if(isset($_GET["nombre"])) {
                $cliente = new Cliente($_GET["nombre"]);
                $respuesta = $cliente->buscar($conector);
            } else {
                $respuesta = Cliente::get_all($conector);
            }
            
            if(is_array($respuesta)) {
                header("HTTP/1.1 200 OK");
            } else {
                header("HTTP/1.1 500 Error interno");
            }
            break;
        default :
            header("HTTP/1.1 400 Bad Request");
            $respuesta = "No se reconoce el método HTTP";
    }

    echo json_encode($respuesta);