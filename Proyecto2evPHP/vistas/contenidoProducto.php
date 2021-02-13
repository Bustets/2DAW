<?php
    require "funcion.php";
    echo "filtrado por: ".$_POST['productos']." = ".$_POST['valor']."<br>";
    //var_dump(count($productos));
    if(count($productos)>0){
      
      $header = $productos[0];
      //var_dump($header);
      echo "<table>";

      foreach ($header as $key => $value) {
        echo "<th>".$key."</th>";
      }

      foreach ($productos as $producto){
        echo "<tr>";
        //var_dump($producto->nombre);
        $recetasYoutube = getRecetasYoutube($producto->nombre);
        foreach ($producto as $campo => $valor){
        
          if($campo == 'foto'){
            echo "<td><img width='100' height='100' src='fotos/".$valor."'/></td>";
          }else{
            echo "<td>".$valor."</td>";
          }
        }
        echo "</tr>";
        echo "<tr><td colspan=3><b>Recetas API Youtube</b></td></tr>";
        echo "<tr>";
        $videos = $recetasYoutube[0];
        $minis = $recetasYoutube[1];
        for ($i = 0; $i < count($recetasYoutube[0]); $i++) {
       
          echo "<td><a href='".$videos[$i]."'><img src='".$minis[$i]['url']."' height='".$minis[$i]['height']."' width='".$minis[$i]['width']."' ></a></td>";
        }
        echo "</tr>";
      }
      echo "</table>";
    }
    else{
      echo "No se encontraron productos con esos parámetros";
    }
    

