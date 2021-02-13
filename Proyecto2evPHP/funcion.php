<?php

function lista ($url,$tabla){
    $consulta=json_decode(file_get_contents($url),TRUE);
    var_dump($consulta);
    $string= "<select name='$tabla'>";
    foreach ($consulta as $key => $fila) {
    	$string.= "<option value='".$fila."'>".$fila."</option>";
  	} 
    $string.= "</select>";
    return $string;
}
