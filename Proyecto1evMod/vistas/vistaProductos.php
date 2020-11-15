<?php
echo "<div style= 'float:right;'><a href='vercarrito.php'><img src='../fotos/carrito.jpg' width=50px; ></a></div><div style='width: 1000px;'>";
foreach($productos as $producto){
    echo "<div style= 'width: 150px; display:inline-block; text-align:center;'>".$producto['nombre']."<br><img src='../fotos/".$producto['foto']."'width=100px; height=120px;><br>".$producto['precio']."<br><a href='detalle.php'>Detalle</a></div>";
}
echo "</div>";