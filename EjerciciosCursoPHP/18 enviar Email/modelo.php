<?php
    class BBDD{
        private $link;

        public function __construct(){
            if(!isset($this->link)){
                try{
                    $this->link=new PDO('mysql:host=localhost; dbname=id11972724_emails', 'id11972724_root', '123456');
                    $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e){
                    $error="Fallo al conectar con la BBDD "+$e->getMessage();
                    require "vistas/mensaje.php";
                    die();
                } 
            }
        }

        public function cerrarconexion(){
            $this->link=null;
        }

        public function __get($var){
            return $this->$var;
        }
    }

    class Email{
        private $email;
        private $nombre;
        private $comentario;
        private $fecha;

        public function __construct($email,$nombre,$comentario,$fecha){
            $this->email=$email;
            $this->nombre=$nombre;
            $this->comentario=$comentario;
            $this->fecha=$fecha;
        }
    
        public function insertarEmail($link){
            try{
                $consulta=$link->prepare("insert into emails (email,nombre,comentario,fecha) VALUES ('$this->email', '$this->nombre', '$this->comentario', '$this->fecha')");
                $consulta->execute();
            }
            catch(PDOException $e){
                $dato= "¡Error!: " . $e->getMessage() . "<br/>";
                echo $dato;
                 die();
             }
            
        }
        
        public function enviarEmail(){
            $headers = "From: dimoal01@gmail.com\r\n"; 
            $headers .= "Reply-To: dimoal01@gmail.com\r\n";
            $headers .= "BCC: dimoal01@gmail.com\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n"; 
            $headers .= 'Content-type: text/html; charset=iso-88591' . "\r\n"; 
            $mensaje="emai: $this->email<br>";
            $mensaje.="nombre: $this->nombre<br>";
            $mensaje.="comentario: $this->comentario<br>";
            $mensaje.="fecha: $this->fecha<br>";
            if ( mail("$this->email", "consulta", $mensaje, $headers) ) {
                $dato="Correo enviado!"; 
            } 
            else $dato="Correo no enviado!";
            return $dato;
        }
    
        public function __get($var){
            return $this->$var;
        }
    }

    
?>