<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio Array</title>
</head>
<body>

	<?php
	
	$Encabezado = array('Pais', 'Capital', 'Extensión', 'Habitantes' );
	$Alemania = array ('Alemania','Berlin','57046', '78420000');
	$Austria = array('Austria', 'Viena ', '83849', '7614000');
	$Bélgica = array('Bélgica',' Bruselas', '7614000', '9932000');

echo "<table border='1'>"; 

	mostrar($Encabezado);
	mostrar($Alemania);
	mostrar($Austria);
	mostrar($Bélgica);
	
echo "</table>";

function mostrar($Pais){
	echo "<tr>";
	foreach($Pais as $value){
		echo "<td> $value </td>";
	}
	echo "</tr>";
}  


	?>

</body>
</html>