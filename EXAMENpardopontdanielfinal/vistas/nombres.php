<?php
    echo "<h2>Éstos son los nombres disponibles:</h2>";

    echo "<ul style='list-style-type:none;'>";
    foreach($lista_nombres as $nombre) {
        echo "<li>" . $nombre["nombre"] . "</li>";
    }
    echo "</ul>";

    echo "<a href='pardo.php'>Volver</a>";