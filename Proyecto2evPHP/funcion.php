<?php

function lista ($url,$tabla){

    $campos=json_decode(file_get_contents($url),TRUE);
    //var_dump($productos);
    $string= "<select name='$tabla'>";
    foreach ($campos as $campo) {
    	$string.= "<option value='".$campo['Field']."'>".$campo['Field']."</option>";
  	} 
    $string.= "</select>";
    return $string;
}

function getRecetasYoutube($producto){

  $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=%s&maxResults=%s&order=viewCount&key=%s";
  $api_key = "AIzaSyBr229Ngx0NlGceVqezBuyYa5GkByglijw";
  $query = "Receta ".$producto;
  $max_result = 5;

  $url_encoded = sprintf($url, rawurlencode($query), $max_result, $api_key);
  $campos=json_decode(file_get_contents($url_encoded),TRUE);

  $recetas = array();
  $videos = array();
  $miniaturas = array();

  foreach($campos['items'] as $item){

    $video = sprintf("https://www.youtube.com/watch?v=%s", $item['id']['videoId']);
    $miniatura = $item['snippet']['thumbnails']['default'];

    array_push($videos, $video);
    array_push($miniaturas, $miniatura);
    
  }
  array_push($recetas, $videos, $miniaturas);
  //var_dump($recetas);
  return $recetas;
  //var_dump($recetas);
}
