<?php
echo "Bienvenido ".$_SESSION['nombre']."<br>";
echo "El sigueinte pedido ha sido realizado: "."<br>";

echo "<table>";
echo "<thead>";
echo "<tr><th>Id</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Importe</th></tr>";
echo "</thead>";
if(isset($_SESSION['carrito'])){
    $carrito = $_SESSION['carrito'];
    foreach($carrito as $producto){
        echo "<tr><td>".$producto['idProducto']."</td><td>".$producto['nombre']."</td><td>".$producto['precio']."</td><td>".$producto['cantidad']."</td><td>".$producto['precio']*$producto['cantidad']."</td></tr>";
        $precioTotal+=($producto['precio']*$producto['cantidad']);
    }
}
echo "<tr><td></td><td></td><td></td><td>Total</td><td>".$precioTotal."</td></tr>";
echo "</table><br>";
session_destroy();
echo "<a href='../vistas/login.php' class=****>Terminar</a>";
