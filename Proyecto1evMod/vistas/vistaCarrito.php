<?php
echo "Bienvenido ".$_SESSION['nombre']."<br>";

echo "<table>";
echo "<thead>";
echo "<tr><th>Id</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Importe</th></tr>";
echo "</thead>";
$carrito = $_SESSION['carrito'];
foreach($carrito as $producto){
    echo "<tr><td>".$producto['idProducto']."</td><td>".$producto['nombre']."</td><td>".$producto['precio']."</td><td>".$producto['cantidad']."</td><td>".$producto['precio']*$producto['cantidad']."</td></tr>";
    $precioTotal+=($producto['precio']*$producto['cantidad']);
}
echo "<tr><td></td><td></td><td></td><td>Total</td><td>".$precioTotal."</td></tr>";
echo "</table><br>";

echo "<a href='../controladores/confirmar.php'>Confirmar Pedido</a>";
echo "<a href='../controladores/principal.php' style= ***>Seguir Comprando</a>";//Falta darle forma de boton


