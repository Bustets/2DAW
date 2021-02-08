<?php


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'OPTIONS') {
  header("HTTP/1.1 200 ");
  exit;}


 
if ($method == 'GET')
{

  $ciclo1 = new stdClass();
  $ciclo1->nombreCiclo="1DAW";
  $ciclo1->horas=1000;
  $ciclo1->aula="020";
  $ciclo1->turno="mañana";

  $ciclo2 = new stdClass();
  $ciclo2->nombreCiclo="1ASIR";
  $ciclo2->horas=1000;
  $ciclo2->aula="021";
  $ciclo2->turno="mañana";

  $ciclo3 = new stdClass();
  $ciclo3->nombreCiclo="2DAW";
  $ciclo3->horas=1000;
  $ciclo3->aula="020";
  $ciclo3->turno="tarde";

  $ciclo4 = new stdClass();
  $ciclo4->nombreCiclo="2ASIR";
  $ciclo4->horas=1000;
  $ciclo4->aula="021";
  $ciclo4->turno="tarde";
  
  $ciclos = array();
    array_push ( $ciclos , $ciclo1 );
    array_push ( $ciclos , $ciclo2 );
    array_push ( $ciclos , $ciclo3 );
    array_push ( $ciclos , $ciclo4 );


      header("HTTP/1.1 200 OK");

      // echo json_encode($json_enviar);
      echo json_encode($ciclos);


      exit();
  }
  

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad request");


?>
