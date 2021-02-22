<?php
if (is_uploaded_file($_FILES['fichero']['tmp_name'])){  
    
    $dir='img/';
    if(!is_dir($dir)) mkdir($dir);
    $nombre=$_FILES['fichero']['name'];
    $idUnico=uniqid();		
    $nombre=$idUnico.$nombre;
    move_uploaded_file($_FILES['fichero']['tmp_name'], $dir.$nombre);
    echo "el fichero $nombre se ha subido correctamente";
}else echo "no se ha podido subir el fichero";
		
	
	

