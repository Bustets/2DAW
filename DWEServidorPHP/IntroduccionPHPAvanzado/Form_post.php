<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<?php

	$a = $_POST['num1']; 
	$b = $_POST['num2']; 
	$operaciones = $_POST['operaciones'];

	switch ($operaciones) {
		case 's':
			$c=$a+$b;
			echo "$a + $b = $c";
			# code...
			break;
		
		case 'r':
			$c=$a-$b;
			echo "$a - $b = $c";
			# code...
			break;
		
		case 'm':
			$c=$a*$b;
			echo "$a * $b = $c";
			# code...
			break;
		
		case 'd':
			if($b!=0){
				$c=$a/$b;
				echo "$a / $b = $c";
			}else{
				echo "No se puede dividir por 0";
			}
			# code...
			break;

		default:
			echo "No existe la opcion seleccionada";
			# code...
			break;
	}


	?>

</body>
</html>