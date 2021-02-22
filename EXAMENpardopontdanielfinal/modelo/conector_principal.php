<?php
    class Conector {
        private $link;

        function __construct() {
            if(!isset($this->link)) {
                try {
                    $this->link = new PDO("mysql:dbname=empleos;host=localhost", "root", "");
                } catch(PDOException $e) {
                    $error = "ERROR al conectar con la base de datos: " . $e->getMessage();
                    require "vista/error.php";
                }
            }
        }

        function __get($var) {
            return $this->$var;
        }
    }