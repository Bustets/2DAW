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


        echo "<br>";
        echo "Ejercicio 2 array";
        echo "<br>";

    
        $arrayPaises = array(
            array('País'=>'País','Capital'=>'Capital','Extensión'=>'Extensión','Habitantes'=>'Habitantes'),
            array('País'=>'Alemania','Capital'=>'Berlín','Extensión'=>'557046','Habitantes'=>'78420000'), 
            array('Pais'=>'Austria','Capital'=>'Viena','Extensión'=>'83849','Habitantes'=>'7614000'),
            array('País'=>'Bélgica','Capital'=>'Bruselas','Extensión'=>'30518','Habitantes'=>'9932000'));
            
       /*
        echo "<table>";
        echo "<tr>"; 
        echo "</tr>";
        echo "</table>";
        */
        /*echo "<table>";
        echo "<tr>";
        echo "<th>";
        foreach($arrayPaises as $arrayPaises =>$pais){
            echo "</th>";
            echo "<br>";
            echo "<td>";
            foreach($pais as $indice=>$value){
                echo "</td>";
                echo $value;
            }
            echo "<br>";
        }*/

        echo "<table>";
        echo "<tr>";
        foreach($arrayPaises as $arrayPaises=>$pais){
            foreach($pais as $indice=>$value){
                echo "<td>";
                echo "<br>";
                echo $value;
                echo "</td>";
            }
            echo "</tr>";
            echo "</table>";
            echo "<br>";
        }

        //no me separa los arrays 

?>