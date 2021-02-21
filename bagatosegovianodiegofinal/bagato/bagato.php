
<?php
include "modelo.php";

$base= new Bd();

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
      $jugador=new Jugadores('','','','','');
      $dato=$jugador->getNombres($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>