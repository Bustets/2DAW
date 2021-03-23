<meta charset="utf-8"/>

<?php

$contador = 2;
$numero = 1;
while ($contador <= 20 ) {
    $numero *= $contador;

    echo $numero."<br/>";

    $contador++;
}

echo "El resultado de multiplicar los 20 primero  numeros es: ".$numero;


?>