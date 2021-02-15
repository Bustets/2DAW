<?php

include "utils.php";
include "modelo.php";
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
$base = new Bd();

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  // el metodo OPTTION es utilizado para las llamadas
  header("HTTP/1.1 200 OK"); // no hacemos nada, pero devolvemos cabecera ok
  exit;
}
/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['cliente']))
    {
      //Mostrar un clientes
      $cli = new Cliente('',$_GET['cliente'],'','','','');
      $dato = $cli->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Mostrar lista de clientes
      $dato = Cliente::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
