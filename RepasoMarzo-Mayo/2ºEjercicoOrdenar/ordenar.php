<?php

$num1 = 3;
$num2 = 2;
$num3 = 1;


$listaNumero = array($num1, $num2, $num3);
sort($listaNumero);
foreach ($listaNumero as $clave => $valor) {
    echo "Numeros Ordenados[" . $clave ."] = $valor<br>";
}



?>
