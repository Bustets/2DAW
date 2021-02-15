<?php
	class Bd	
    {
        private $link;
        function __construct()
        {
            if (!isset ($this->link)) {
                try{
                    $this->link = new PDO("mysql:host=localhost;dbname=virtualmarket", "root", "");
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
class Cliente{
        private $dniCliente;
        private $nombre; 
        private $direccion;
		private $email;
		private $pwd;

        public function __construct($dni, $nom, $direccion, $email, $pwd){
            $this->dniCliente = $dni;
            $this->nombre = $nom;
            $this->direccion = $direccion;
            $this->email = $email;
            $this->pwd = $pwd;
        }
        static function getAll($link){
			try{
				$consulta = "SELECT * FROM clientes";
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
        function buscar ($link){
            try{
                    $consulta = "SELECT * FROM clientes where dniCliente='$this->dniCliente'";
                    $result = $link->prepare($consulta);
                    $result->execute();
                    return $result->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                    $dato = "¡Error!: " . $e->getMessage() . "<br/>";
                    return $dato;
                    die();
            }
        }

}