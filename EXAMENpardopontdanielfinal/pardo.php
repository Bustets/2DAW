<?php
    require "modelo/conector_principal.php";
    require "modelo/dpp.php";
    require "vistas/inicio.html";

    if(!isset($_POST["boton_enviar"])) {
        require "vistas/formulario.html";
    } else {
        if(empty($_POST["nombre"])) {
            $error = "ERROR: El nombre no debe estar vacío.";
            require "vistas/error.php";
            require "vistas/formulario.html";
        } else {
            $url_servicio = "http://localhost/2DAW/EXAMENpardopontdanielfinal/daniel/daniel";
            $existe_nombre = json_decode(file_get_contents($url_servicio . "/" . $_POST["nombre"]));
            if(!$existe_nombre) {
                $lista_nombres = json_decode(file_get_contents($url_servicio), true);
                require "vistas/nombres.php";
            } else {
                if(!is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
                    $error = "ERROR: No se ha podido subir el fichero.";
                    require "vistas/error.php";
                    require "vistas/formulario.html";
                } else {
                    $nombre_empleado = $_POST["nombre"];

                    if($_FILES["imagen"]["type"] != "image/jpeg") {
                        $error = "ERROR: El formato del fichero no es correcto. Seleccione una imagen en formato .jpg.";
                        require "vistas/error.php";
                        require "vistas/formulario.html";
                    } else {
                        $nombre_fichero = $_FILES["imagen"]["name"];
                        if(file_exists("foto/" . $nombre_fichero)) {
                            $nombre_fichero = uniqid() . $nombre_fichero;
                        }
                        $ruta_fichero = "foto/$nombre_fichero";
                        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_fichero);

                        $empleado = new Empleado($nombre_empleado, $ruta_fichero);
                        $conector = new Conector();
                        if($empleado->insertar($conector)) {
                            require "vistas/confirmacion.php";
                        } else {
                            $error = "ERROR en la inserción en base de datos. Los datos son correctos pero la conexión ha fallado. Vuelve a intentarlo.";
                            require "vistas/error.php";
                            require "vistas/formulario.html";
                        }
                    }
                }
            }
        }
    }

    require "vistas/fin.html";