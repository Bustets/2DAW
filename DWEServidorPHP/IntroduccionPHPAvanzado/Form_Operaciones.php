<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulario PHP operaciones</title>
</head>
<body>

	<?php

	$a=$_POST['num1'];
	$b=$_POST['num2'];

	$suma = $a + $b;
	$resta = $a - $b;
	$mult = $a * $b;
	$div = $a / $b;

	$operacion = $_POST['suma'];
	$operacion = $_POST['resta'];
	$operacion = $_POST['mult'];
	$operacion = $_POST['div'];


	?>

</body>
</html>