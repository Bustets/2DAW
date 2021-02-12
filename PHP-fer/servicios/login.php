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
    if (isset($_GET['admin']))
    {
       //Mostrar un post
       $prod= new Cliente('','','','','',$_GET['admin']);
       $dato=$prod->login($base->link);
       header("HTTP/1.1 200 OK");
       echo json_encode($dato);
       exit();
    }
}