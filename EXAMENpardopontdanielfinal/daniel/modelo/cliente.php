<?php
    class Cliente {
        private $nombre;

        function __construct($nombre) {
            $this->nombre = $nombre;
        }

        function __get($var) {
            return $this->$var;
        }

        function __set($var, $value) {
            $this->$var = $value;
        }

        static function get_all($conector) {
            try {
                $consulta = $conector->link->prepare("SELECT nombre FROM clientes");
                $consulta->execute();
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                return $consulta->fetchAll();
            } catch(PDOException $e) {
                return "ERROR al buscar todos: " . $e->getMessage() . "<br/>";
 				die();
            }
        }

        function buscar($conector) {
            try {
                $consulta = $conector->link->prepare("SELECT * FROM clientes WHERE nombre = '$this->nombre'");
                $consulta->execute();
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                return $consulta->fetchAll();
            } catch(PDOException $e) {
                return "ERROR al buscar por nombre: " . $e->getMessage() . "<br/>";
 				die();
            }
        }
    }