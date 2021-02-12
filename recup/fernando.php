<?php

include "flm.php";

$base= new Base();

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  // Si le mandamos el id de Jugador
    if (isset($_GET['idJugador']))
    {
      //Mostrar un solo jugador
      $jug= new Jugador($_GET['idJugador'],'','','');
      $dato=$jug->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
    }
    // Si le mandamos id de Equipo
    if (isset($_GET['Equipo'])) {
      $dato=Jugador::getAllEquipo($base->link, $_GET['Equipo']);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	  }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>