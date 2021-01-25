<?php
foreach ($datos as $grupo) {
		
		foreach ($grupo as $informacion) {
			
			echo "<h1>".$informacion['strArtist']."</h1><br>";
			echo $informacion['strBiographyES']."<br>";
			echo "<img src='".$informacion['strArtistThumb']."'><br>";
			echo "<hr>";
			
		}
		
	}	
