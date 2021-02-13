<?php
    
    echo "filtrado por: ".$_POST['productos']."=".$_POST['valor']."<br>";
    echo "<table>";
    foreach ($consulta as $key => $value){
      echo "<tr>";
    foreach ($value as $campo => $valor){
      echo "<td><b>$campo</b>->$valor </td>";
    }
    echo "</tr>";
    }
    echo "</table>";

