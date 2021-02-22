<?php

	echo "<form action='paz.php' method='post'>";
    echo "jugador: ".lista($base->link, '', 'Nombre','','','')."<br>";
    echo "<input type='submit' name='enviar'></form>";