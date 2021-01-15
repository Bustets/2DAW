<?php
$fecha = $_POST["n"];
$regalo1 = $_POST["c"];
$regalo2 = $_POST["fecha"];
$regalo3 = $_POST["max"];
$pref1 = $_POST["min"];


$numeroAleatorio = rand(0, 10);
/*$respuesta = ($numeroAleatorio % 2 == 0)? "true" : "false";*/
  $respuesta=true;
  echo  json_encode($respuesta);

?>