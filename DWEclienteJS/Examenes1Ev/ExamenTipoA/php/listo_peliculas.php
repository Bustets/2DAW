<?php

$actores1 = array("Antonio Banderas", "Hector Alterio");

$objeto1 = new stdClass();
$objeto1->id = "120";
$objeto1->titulo = "Dolor y gloria";
$objeto1->anyo = 2019;
$objeto1->actores = $actores1;
$objeto1->director = "Pedro Almodovar";
$objeto1->genero="Drama";
$objeto1->puntuacion = 3;
$datos[]=$objeto1;

$actores2 = array("Karra Elejalde", "Eduard Fernandez","Santi Prego");

$objeto2 = new stdClass();
$objeto2->id = "121";
$objeto2->titulo = "Mientras dure la guerra";
$objeto2->anyo = 2019;
$objeto2->actores = $actores2;
$objeto2->director = "Alejandor Amenabar";
$objeto2->genero="Drama";
$objeto2->puntuacion = 4;
$datos[]=$objeto2;

$actores3 = array("Emma Suárez", "Adriana Ozores", "Nathalie Poza");

$objeto3 = new stdClass();
$objeto3->id = "122";
$objeto3->titulo = "Invisibles";
$objeto3->anyo = 2020;
$objeto3->actores = $actores3;
$objeto3->director = "Gracia Querejeta";
$objeto3->genero="Drama";
$objeto3->puntuacion = 3;
$datos[]=$objeto3;

header('Content-Type: application/json');	
echo json_encode($datos);



?>