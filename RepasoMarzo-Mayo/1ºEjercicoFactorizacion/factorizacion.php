<?php

$num = 2 ; 
$factorial = 1;


for ($i=$num; $i > 1 ; $i--) { 
    $factorial=$factorial*$i;
}

echo "El factorial del $num  es  $factorial";

?>