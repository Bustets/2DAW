<?php
    class Empleado {
        private $nombre;
        private $foto;

        function __construct($nombre, $foto) {
            $this->nombre = $nombre;
            $this->foto = $foto;
        }

        function __get($var) {
            return $this->$var;
        }

        function __set($var, $value) {
            $this->$var = $value;
        }

        function insertar($conector) {
            try {
                $instruccion = $conector->link->prepare("INSERT INTO empleados (nombre, foto) VALUES ('$this->nombre', '$this->foto')");
                $instruccion->execute();
                if($instruccion) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } catch(PDOException $e) {
                $dato= "ERROR en la inserción: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
            }
        }
    }