<?php

/*$arrayHeader = ["País", "Capital", "Extension", "Habitantes"];
$arrayAlemania = ["Alemania", "Berlin", "557046", "784200000"];
$arrayAutria = ["Autria", "Viena", "83849", "7614000"];
$arrayBelgica = ["Bélgica", "Bruselas", "30518", "9932000"];*/

$arrayHeader = ["País", "Capital", "Extension", "Habitantes"];
$arrayAlemania = ["Alemania", "Berlin", "557046", "784200000"];
$arrayAutria = ["Autria", "Viena", "83849", "7614000"];
$arrayBelgica = ["Bélgica", "Bruselas", "30518", "9932000"];

    foreach ($arrayHeader as $headers) {
        foreach ($arrayAlemania as $arrayAlemania){
            echo "$arrayAlemania <br>"
        }
        echo "$headers <br>";
    }

?>