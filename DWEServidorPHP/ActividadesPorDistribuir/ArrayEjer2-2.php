<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio Array</title>
</head>
<body>

	<?php
	
	$Alemania = array ('Pais'=>Alemania,'Capital' => Berlin , 'Extension' =>57046, 'Habitantes'=> 78420000);
	$Austria = array('Pais' =>Austria, 'Capital' => Viena, 'Extension' => 83849, 'Habitantes' => 7614000);
	$Bélgica = array('Pais' =>Bélgica, 'Capital' => Bruselas, 'Extension' => 7614000, 'Habitantes' => 9932000);

	/*
	$Pais = array("Alemania", "Austria", "Bélgica");
	$Capital = array("Berlin", "Viena", "Bruselas");
	$Extension = array("57046", "83849", "30518");
	$Habitantes = array("78420000", "7614000", "9932000");
	*/
function tabla($array){
	
	foreach($Pais as $Paises){
	echo "<tabla>". $Paises; echo "<br>"
	}
	foreach($Capital as $Capitales){
	echo $Capitales; echo "<br>"
	}
}  

	?>

</body>
</html>