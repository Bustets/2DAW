<?php

require "formulario.html";

$a=$_POST['num1'];
$b=$_POST['num2'];
$c=$_POST['num3'];
$max=$a;
$min=$a;
if($b>$max){
    $max=$b;
}else{
    ($min=$b);
}
if($c>$max){
    $max=$c;
}else{
    ($min=$c);
}
echo "$min  $max";

?>