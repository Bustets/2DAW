<?php
	class Bd1	
    {
        private $link;
        function __construct()
        {
            if (!isset ($this->link)) {
                try{
                    $this->link = new PDO("mysql:host=localhost;dbname=casas", "root", "");
                    $this->link->exec("set names utf8mb4");
                }
                catch(PDOException $e){
                    $dato= "¡Error!: " . $e->getMessage() . "<br/>";
                     return $dato;
                     die();
                 }
             }
        }
            
        function __get($var){
            return $this->$var;
        }
    }
class Usuario{
        private $dni;
        private $Nombre; 
        private $edad;
		private $cod_pob;
		

        public function __construct($dni, $Nombre, $edad, $cod_pob){
            $this->dni = $dni;
            $this->Nombre = $Nombre;
            $this->edad = $edad;
            $this->cod_pob = $cod_pob;
        }
        static function getAll($link){
			try{
				$consulta = "SELECT * FROM usuario ";
				$result = $link->prepare($consulta);
				$result->execute();
				return $result;
			}
			catch(PDOException $e){
				$dato = "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
        function __get($var){
            return $this->$var;
            }

}