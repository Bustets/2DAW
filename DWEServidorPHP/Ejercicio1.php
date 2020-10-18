<!DOCTYPE html>
<html>
<head>
	<title>Calcular valor factorial de un numero</title>
</head>
<body>
	Cualcular el valor factorial de un numero

	<?php
	$a = 3;
	$b=$a;
		for ($i=$a-1; $i > 1; $i--){
			$a*=$i;
		}
		echo "<table border='1'><tr><td>el factorial de</td><td> $b</td><td>es</td><td> $a</td></tr></table></br>";
	?>	

</body>
</html>