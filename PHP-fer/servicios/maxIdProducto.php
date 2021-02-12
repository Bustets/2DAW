<?php

include "utils.php";
include "../modelo.php";
include "../cors.php";

$base= new Bd();

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
      $cli= new Producto('','','','','','','','','');
      $dato=$cli->sacarMaximoidProducto($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>