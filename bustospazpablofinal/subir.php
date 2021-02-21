<?php

if (is_uploaded_file($_FILES['fichero']['tmp_name'])){
	$nombre=$_FILES['fichero']['name'];
	$partes=explode('.', $nombre);
	$npartes=count($partes);
	if (($npartes>0) && ($partes[$npartes-1] = "jpg")){
		$dir='foto/';
		if(!is_dir($dir)) mkdir($dir);
		if(is_file($dir.$nombre)){
			$idUnico=uniqid();		
			$nombre=$partes[0];
			for ($i=1; $i <$npartes-1 ; $i++) { 
				$nombre.=".".$partes[$i];
			}
			$nombre.="_".$idUnico.".".$partes[$npartes-1];
		}
		move_uploaded_file($_FILES['fichero']['tmp_name'], $dir.$nombre);
		$_GET['direccion'] = $dir.$nombre;
		
	}
	else echo "el archivo no tiene extension .jpg";
}else 
	echo "no se ha podido subir el fichero";
