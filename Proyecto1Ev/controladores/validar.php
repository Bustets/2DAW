<?php
 
 require ('bbdd.php');
 echo $_POST['dni'];
 $consulta= 'SELECT * FROM clientes where dniCliente = $_POST["dni"] and pwd = $_POST["pass"]';
 echo $consulta;
 //$result = consultabd($consulta);


?>