<?php
if (isset($_POST['enviar'])){
	// construimos la url para llamar a la api en formato correcto a partir del texto que nos llega por el formulario
	// esta llamada solicita la información del grupo o músico
	$url="https://theaudiodb.com/api/v1/json/1/search.php?s=".urlencode($_POST['nombre']);
	$datos=json_decode(file_get_contents($url), true);
	// cuando no hay información del artista devuelve un array asociativo con el indice a NULL $datos['artists']!=NULL
	if($datos['artists']!=NULL) {
		// mostramos la información del grupo
		require ("vistas/vergrupo.php");
		// preparamos la url para pedir la discografia igual que antes.
		$url="https://theaudiodb.com/api/v1/json/1/discography.php?s=".urlencode($_POST['nombre']);
		$datos=json_decode(file_get_contents($url), true);
		//mostramos la discografia. En este caso damos por supuesto que si existe el artista existira algo en la discografia.
		require ("vistas/verdiscos.php");
	} else echo "el nombre no existe o está vacio";
	require ("vistas/vinculo.php");
}else require ("vistas/formulario.php");
