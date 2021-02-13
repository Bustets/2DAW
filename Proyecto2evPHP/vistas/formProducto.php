<?php

    echo "<h2> Consulta </h2>";
    echo "<form action='' method='post'>";
    echo "Campo Producto: ".lista('http://localhost/Proyecto2evPHP/producto/producto/campos', 'productos')."<br>";
    echo "Valor: <input type='text' name='valor'><br>";
    echo "<input type='submit' name='enviar'></form>";
     

