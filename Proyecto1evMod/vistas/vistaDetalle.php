<?php

echo "Bienvenido ".$_SESSION['nombre']."<br>";

echo "<div style= 'width: 300px; display:inline-block; text-align:center;'><br><img src='../fotos/".$infoProducto['foto']."'width='100px'; height='120px';<br></div><div style= display:inline-block;>".$infoProducto['idProducto']."<br>".$infoProducto['nombre']."<br>".$infoProducto['origen']."<br>".$infoProducto['marca']."<br>".$infoProducto['categoria']."<br>".$infoProducto['peso']."<br>".$infoProducto['precio']."<br>";
echo "<form method=POST action=verCarrito.php>";
echo "<input name='idProducto' type='hidden' value=".$infoProducto['idProducto'].">";
echo "<input name='nombre' type='hidden' value=".$infoProducto['nombre'].">";
echo "<input name='precio' type='hidden' value=".$infoProducto['precio'].">";
echo "<input name='cantidad' type=number value=1 min='1'><br>";
echo "<input name='comprar' type=submit value=Comprar>";
echo "</form></div>";
