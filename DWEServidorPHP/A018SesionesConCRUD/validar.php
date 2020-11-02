<?php
session_start();
// comprobar los argumentos recibidos
if ($_POST["dniCliente"]=="prueba" && $_POST["pwd"]=="1234") {
    // usuario validado correctamente.
    // Meter en sesión y enviar a la página de inicio
    $_SESSION["usuario"] = $_POST["username"];
    header ("Location: inicio.php");
} else {
    //usuario o contraseña incorrectos.
    // Presentar mensaje de error
    echo "dniCliente";
}