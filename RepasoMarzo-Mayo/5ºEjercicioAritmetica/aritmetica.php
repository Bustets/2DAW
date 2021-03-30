<?php

require "index.html";

$a = $_POST["num1"];
$b = $_POST["num2"];


$suma= $a+$b;
$resta=  $a-$b;
$multiplicacion=  $a*$b;
$division=  $a/$b;


if($suma){
    echo $suma;
}else if($resta){
    echo $resta;
}else if($multiplicacion){
    echo $multiplicacion;
}else{
    echo $division;
}

//solo me funciona la suma hay que mirar los demas procesos 



?>