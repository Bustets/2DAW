<?php

$objeto1 = new stdClass();
$objeto1->fecha = "20-11-2020-11:45:38";
$objeto1->regalo1 = "Ordenador";
$objeto1->estrellas1 = 2;
$objeto1->regalo2 = "Reloj";
$objeto1->estrellas2 = 2;
$objeto1->regalo3 = "Pijama";
$objeto1->estrellas3 = 1;
$datos[]=$objeto1;

$objeto2 = new stdClass();
$objeto2->fecha = "26-11-2020-13:36:01";
$objeto2->regalo1 = "Raqueta";
$objeto2->estrellas1 = 1;
$objeto2->regalo2 = "Zapatillas";
$objeto2->estrellas2 = 2;
$objeto2->regalo3 = "Gorra";
$objeto2->estrellas3 = 1;
$datos[]=$objeto2;

$objeto3 = new stdClass();
$objeto3->fecha = "02-12-2020-10:15:16";
$objeto3->regalo1 = "PS5";
$objeto3->estrellas1 = 3;
$objeto3->regalo2 = "Cascos";
$objeto3->estrellas2 = 1;
$objeto3->regalo3 = "Ratón";
$objeto3->estrellas3 = 1;
$datos[]=$objeto3;

header('Content-Type: application/json');	
echo json_encode($datos);



?>