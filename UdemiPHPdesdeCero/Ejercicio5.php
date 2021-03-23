<?php



if(isset($_GET["numero"])&& is_numeric($_GET["numero"])){ //si o si con este parametro siempre tiene que ser numerico si le ponemos un string nos sacaria el por defecto.
    $numero = $_GET["numero"];
}else{
    $numero = 5;//por defecto
    echo "<p>Numero por defecto</p>";
}

echo "<h2>Tabla de multiplicar del ".$numero."</h2>";

for ($i=1; $i <=10 ; $i++) { 
    echo $i." x ".$numero."=".($i*$numero)."<br/>";
}

?>