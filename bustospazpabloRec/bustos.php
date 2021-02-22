<?php
include "dbs.php";
$base= new Bd();
$nombreUsuarios=json_decode(file_get_contents('http://localhost/2DAW/bustospazpabloRec/pablo/bustos') , true);


require "vistas/mensaje.php";