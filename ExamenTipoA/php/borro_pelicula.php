<?php

$id = $_POST["id"];


// El script devuelve alatoriamente 'error' o el 'id' de la nueva pelicula

$numeroAleatorio = rand(0, 10);
$respuesta = ($numeroAleatorio % 2 == 0)? $id : "error";

echo  json_encode($respuesta);

?>