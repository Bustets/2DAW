<?php

include "utils.php";
include "modelo.php";

$base = new Bd1();

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  // el metodo OPTTION es utilizado para las llamadas
  header("HTTP/1.1 200 OK"); // no hacemos nada, pero devolvemos cabecera ok
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['usuario']))
     {
      $dato = Usuario::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>