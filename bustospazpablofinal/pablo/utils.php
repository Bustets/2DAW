<?php

   //Obtener parametros para updates
 function getParams($input)
 {
   $filterParams = [];
    foreach($input as $param => $value)
    {
            $filterParams[] = "$param='$value'";
    }
    return implode(", ", $filterParams);
	}

  //Asociar todos los parametros a un sql
	