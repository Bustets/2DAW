<?php
include "dbs.php";
$base= new Bd();
$nombreCasas=json_decode(file_get_contents('http://localhost/bagatosegovianodiegofinal/diego/diego') , true);
$nombreJugadores=json_decode(file_get_contents('http://localhost/bagatosegovianodiegofinal/bagato/bagato') , true);
$dato="";
	$empleado = new Empleado('','','');
	foreach ($nombreCasas as $key => $value) {
		foreach ($value as $key2 => $value2) {
			$empleado->nombre=$value2;
			$empleado->insertarEmpleado($base->link);
			$dato.="$value2<br>";
		}
	   }
	   foreach ($nombreJugadores as $key => $value) {
		foreach ($value as $key2 => $value2) {
			$empleado->nombre=$value2;
			$empleado->insertarEmpleado($base->link);
			$dato.="$value2<br>";
		}
	   }

require "vistas/mensaje.php";