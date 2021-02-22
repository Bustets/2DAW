<?php
foreach ($datos as $discos) {
	echo "<h2> Discografia </h2><br>";	
		foreach ($discos as $disco) {
			
			foreach ($disco as $key => $valor) {
				echo "$key: $valor<br>";
			}
			echo "<hr>";
			
		}
		
	}	