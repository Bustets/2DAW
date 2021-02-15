<?php
     $url = "http://localhost/DWES/vallsmorenocarlosfinal/carlos/carlos";
     $consulta = json_decode(file_get_contents($url),TRUE);
     echo "Estos son los nombres disponibles: <br>";
    foreach ($consulta as $key => $value) {
       echo $value['nombre']."<br>";
    }