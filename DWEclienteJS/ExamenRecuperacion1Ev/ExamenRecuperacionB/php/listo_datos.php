<?php

$objeto1 = new stdClass();
$objeto1->hora = "10:00:00";
$objeto1->temp= 1;
$objeto1->dir= "n";
$objeto1->fza= 5;
$datos[]=$objeto1;

$objeto2 = new stdClass();
$objeto2->hora = "11:00:00";
$objeto2->temp= 3;
$objeto2->dir= "e";
$objeto2->fza= 6;
$datos[]=$objeto2;

$objeto3 = new stdClass();
$objeto3->hora = "12:00:00";
$objeto3->temp= 7;
$objeto3->dir= "n";
$objeto3->fza= 9;
$datos[]=$objeto3;

$objeto4 = new stdClass();
$objeto4->hora = "13:00:00";
$objeto4->temp= 9;
$objeto4->dir= "s";
$objeto4->fza= 2;
$datos[]=$objeto4;


header('Content-Type: application/json');	
echo json_encode($datos);



?>