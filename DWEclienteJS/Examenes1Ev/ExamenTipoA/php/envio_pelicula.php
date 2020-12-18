<?php

$titulo = $_POST["titulo"];
$anyo = $_POST["anyo"];
$director = $_POST["director"];
$genero = $_POST["genero"];
$actor1 = $_POST["actor1"];
$actor2 = $_POST["actor2"];

// El script devuelve alatoriamente 'error' o el 'id' de la nueva pelicula

$numeroAleatorio = rand(0, 10);
$numeroAleatorioId = $numeroAleatorio*10;
$respuesta = ($numeroAleatorio % 2 == 0)? $numeroAleatorioId : "error";

  echo  json_encode($respuesta);

?>