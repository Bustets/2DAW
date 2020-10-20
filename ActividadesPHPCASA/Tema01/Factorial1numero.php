<?php

    $num = 5;
    $fact = 1;
    
    for ($i=$num; $i > 1; $i--) {
        $fact = $fact*$i;
    }
    
    echo "El  factorial de $num es: $fact";

?>