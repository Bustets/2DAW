<?php
$fecha = $_POST["fecha"];
$regalo1 = $_POST["r1"];
$regalo2 = $_POST["r2"];
$regalo3 = $_POST["r3"];
$pref1 = $_POST["p1"];
$pref2 = $_POST["p2"];
$pref3 = $_POST["p3"];


// Enviar carta a los reyes ......

// El script devuelve alatoriamente 'true' o 'false' para que la aplicacion
// cliente pueda comprobar los dos casos
$numeroAleatorio = rand(0, 10);
$respuesta = ($numeroAleatorio % 2 == 0)? "true" : "false";

  echo  json_encode($respuesta);

?>