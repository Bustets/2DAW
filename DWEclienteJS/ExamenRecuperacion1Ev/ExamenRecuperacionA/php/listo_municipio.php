<?php

$objeto1 = new stdClass();
$objeto1->n = "Valencia";
$objeto1->c= 1;
$objeto1->max= 14;
$objeto1->min= 5;
$objeto1->fecha='14/1/2021';
$datos[]=$objeto1;

$objeto2 = new stdClass();
$objeto2->n = "Requena";
$objeto2->c= 3;
$objeto2->max= 6;
$objeto2->min= -3;
$objeto2->fecha='14/1/2021';
$datos[]=$objeto2;

$objeto3 = new stdClass();
$objeto3->n = "Bunyol";
$objeto3->c= 2;
$objeto3->max= 9;
$objeto3->min= 0;
$objeto3->fecha='14/1/2021';
$datos[]=$objeto3;

$objeto4 = new stdClass();
$objeto4->n = "Gandia";
$objeto4->c=0 ;
$objeto4->max= 15;
$objeto4->min= 6;
$objeto4->fecha='14/1/2021';
$datos[]=$objeto4;

header('Content-Type: application/json');	
echo json_encode($datos);



?>