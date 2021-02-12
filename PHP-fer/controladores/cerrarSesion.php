<?php

// Controlador para cerrar sesion
setcookie('nombre','',time()-100);
setcookie('dni','0',time()+360000);
header('Location: ../controladores/principal');

?>