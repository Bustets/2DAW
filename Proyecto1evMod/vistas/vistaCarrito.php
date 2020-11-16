<?php
echo "Bienvenido ".$_SESSION['nombre']."<br>";

echo "<table>";
echo "<tr>Id<td></td></tr>";
echo "<tr>Nombre<td></td></tr>";
echo "<tr>Precio<td></td></tr>";
echo "<tr>Cantidad<td></td></tr>";
echo "<tr>Importe<td></td></tr>";
echo "<tr>Precio Total<td></td></tr>";
echo "</table><br>";
echo "<input type=button value='Procesar Pedido'>";
echo "<input type=button value='Seguir Comprando'>";