<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php

	$valor['nombre']="";
	$error['nombre']="";

	if (empty($_post['nombre'])){
		$error['nombre']="No pude estar en blanco"; 
	}else $valor['nombre']=$_post['nombre'];

	echo "<td><input type=text value=".$valor['nombre']."name=nombre>".$error['nombre']."</td>";

	

	?>

</body>
</html>