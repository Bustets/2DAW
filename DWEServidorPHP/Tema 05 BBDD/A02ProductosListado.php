<?php
//conexion a la base de datos
$link = new mysqli('localhost', 'root', '', 'virtualmarket'); 
//comprobar errores de conexión
if ( $link->connect_errno ){ 
	echo "Fallo al conectar a MySQL: ". $link->connect_error; 
} else
//no hay errores de conexión
{
	// seleccionar charset
	$link->set_charset('utf-8'); 
	//crear string de la consulta
	$consulta="SELECT * FROM productos ";
	//ejecutar la consulta
	$result=$link->query($consulta);
    //recorremos el resultado
    echo "<table border='1'>
    <tr>
    <td>DNI</td>
    <td>nombre</td>
    <td>direccion</td>
    <td>email</td>
    <td>pwd</td>
    </tr>";
	while ($fila=$result->fetch_assoc()){
        echo "<tr>";
        foreach ($fila as $value){
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
	$result->free();
	$link->close(); 
}
