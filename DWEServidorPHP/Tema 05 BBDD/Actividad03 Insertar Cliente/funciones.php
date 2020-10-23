<?php

function existe($dni, $link){

    $Consulta = "SELECT * FROM CLIENTES WHERE dniCliente = $dni"; // revisar el nombre del campo minuscula o mayuscula
    $resultado = $link -> query($Consulta);
    return $resultado -> fetch_assoc();
}