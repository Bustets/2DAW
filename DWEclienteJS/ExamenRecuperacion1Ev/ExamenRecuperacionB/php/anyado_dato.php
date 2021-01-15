<?php
$hora = $_POST["hora"];
$dir = $_POST["dir"];
$temp = $_POST["temp"];
$fza = $_POST["fza"];


$numeroAleatorio = rand(0, 10);
$respuesta = ($numeroAleatorio % 2 == 0)? "true" : "false";

  echo  json_encode($respuesta);

?>