<?php
     $url = "http://localhost/2DAW/bustospazpablofinal/bustos/bustos";
     $consulta = json_decode(file_get_contents($url),TRUE);
     echo "Estos son los nombres disponibles: <br>";
    foreach ($consulta as $key => $value) {
       echo $value['nombre']."<br>";
    }