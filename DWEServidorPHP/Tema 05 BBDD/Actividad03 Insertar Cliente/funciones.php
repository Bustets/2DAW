<?php
function existe ($dni,$link){
    $consulta="SELECT * FROM clientes WHERE dniCliente='$dni'";
	//ejecutar la consulta
	$result=$link->query($consulta);
	//recorremos el resultado
    return $result->fetch_assoc();
}
function insertar ($dniCliente,$nombre,$direccion,$email,$pwd){
    global $link;
    $consulta="INSERT INTO clientes VALUES ('$dniCliente','$nombre','$direccion','$email','$pwd')";
	//ejecutar la consulta
	$link->query($consulta);
	//recorremos el resultado
    
}
