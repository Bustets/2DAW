<?php

require "flm.php";
$base = new Base();
if(isset($_GET['enviarjugador'])){
    $modo = 0;
    if($_GET['idJugador']== ""){
        $Url = "http://localhost/2DAW/recup/fernando.php?Equipo=".$_GET['equipo'];
    }else{
        $modo = 1;
        $Url = "http://localhost/2DAW/recup/fernando/".$_GET['idJugador'];
    }

    $partida = new Partida($_GET['partida']);
    $idPartida = $partida->buscarId($base->link);
    $resultado = file_get_contents($Url);
    $dato=  json_decode($resultado, true);

    PartidaJugador::insertarTodas($base->link,$dato,$modo,$idPartida);
    require "fin.php";
}else{
    require "jugador.html";
}





