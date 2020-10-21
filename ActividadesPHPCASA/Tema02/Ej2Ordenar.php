<?php

	echo "Inicializar 3 variables por orden ascendente, con IF/Else <br>";

	$a = 100;
    $b = 50;
    $c = 300;

    if($a < $b ){
    	if($a < $c){
    		if($b < $c){
    			echo "1º " .$a. "<br>2º " .$b. "<br>3º ".$c. "<br>";
    		}else{
    			echo "1º " .$a. "<br>2º " .$c. "<br>3º ".$b. "<br>";
    		}
    	}else{
    		echo "1º " .$c. "<br>2º " .$a. "<br>3º ".$b. "<br>";
    	}
    }else{
    	if($b < $c){
    		if($a < $c){
    			echo "1º " .$b. "<br>2º " .$a. "<br>3º ".$c. "<br>";
    		}else{
    			echo "1º " .$b. "<br>2º " .$c. "<br>3º ".$a. "<br>";
    		}
    	}else{
    		echo "1º " .$c. "<br>2º " .$b. "<br>3º ".$a. "<br>";
    	}
    }


	echo "Inicializar 3 variables por orden ascendente, con array <br>";
		$array = array($a, $b, $c);
    	sort($array);
    	foreach ($array as $key => $value) {
    		echo $value. "<br>";
    	}
	?>
