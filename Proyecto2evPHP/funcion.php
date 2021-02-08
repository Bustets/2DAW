<?php

function lista ($link,$url,$tabla, $nomid, $mostrar){
	$url="http://localhost/Proyecto2evPHP/".$url.$tabla;
    $consulta=json_decode(file_get_contents($url),TRUE);
    $string= "<select name='$tabla'>";
    foreach ($consulta as $fila) {
    	$string.= "<option value='".$fila[$nomid]."'>".$fila[$mostrar]."</option>";
   
  	} $string.= "</select>";
    return $string;
}
