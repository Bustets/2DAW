<?php

echo "Bienvenido ".$_SESSION['nombre']."<br>";

echo "<div style= 'width: 300px; display:inline-block; text-align:center;'><br><img src='../fotos/".$infoProducto['foto']."'width='100px'; height='120px';<br></div><div style= display:inline-block;>".$infoProducto['idProducto']."<br>".$infoProducto['nombre']."<br>".$infoProducto['origen']."<br>".$infoProducto['marca']."<br>".$infoProducto['categoria']."<br>".$infoProducto['peso']."<br>".$infoProducto['precio']."<br><form><input type=number value=1 min='1'><br><input type=submit value=Comprar></form></div>";
