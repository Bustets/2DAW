<?php

include "utils.php";
include "modelo.php";

$base = new Bd();

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  // el metodo OPTTION es utilizado para las llamadas
  header("HTTP/1.1 200 OK"); // no hacemos nada, pero devolvemos cabecera ok
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['jugadores']))
    /*{
      //Mostrar un clientes
      $cli = new Cliente('',$_GET['Nombre'],'','','','');
      $dato = $cli->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }*/
     {
      //Mostrar lista de clientes
      $dato = Jugador::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>