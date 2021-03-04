<?php

    /*$arrayHeader = ["País", "Capital", "Extension", "Habitantes"];
    $arrayAlemania = ["Alemania", "Berlin", "557046", "784200000"];
    $arrayAutria = ["Autria", "Viena", "83849", "7614000"];
    $arrayBelgica = ["Bélgica", "Bruselas", "30518", "9932000"];*/

    echo "Ejercio 1 Array";

    $arrayHeader = array("País", "Capital", "Extension", "Habitantes");
    $arrayAlemania = array("Alemania", "Berlin", "557046", "784200000");
    $arrayAutria = array("Autria", "Viena", "83849", "7614000");
    $arrayBelgica = array("Bélgica", "Bruselas", "30518", "9932000");



        echo "<table>";
        echo "<tr>"; 
        foreach ($arrayHeader as $value) {
            echo "<th>";    
            echo $value;
            echo "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($arrayAlemania as $value) {
            echo "<td>";    
            echo $value;
            echo "</td>";
        }
        echo "</tr>";
        foreach ($arrayAutria as $value) {
            echo "<td>";    
            echo $value;
            echo "</td>";
        }
        echo "<tr>";
        foreach ($arrayBelgica as $value) {
            echo "<td>";    
            echo $value;
            echo "</td>";
        }
        echo "</tr>";
        echo "</table>";



        echo "Ejercicio 2 array";

    
        $arrayPaises = array("Pais"=>array("Alemania","Austria","Bélgica"), 
                            "Capital"=>array("Berlin","Viena","Bruselas"), 
                            "Extensión"=>array("557046","83849","30518"), 
                            "Habitantes"=>array("78420000","7614000","9932000"));

        var_dump($arrayPaises);
       
       /*
        echo "<table>";
        echo "<tr>"; 
        echo "</tr>";
        echo "</table>";
        */

        foreach($arrayPaises as $pais){
            foreach($pais as $value){
                echo "$dato";
            }
            echo "<br>";
        }

?>