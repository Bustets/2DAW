<?php
 require "vistas/iniciohtml.php";
    $operaciones=["2+5","3+4","5-2","7-6","5x2"];
    $resultados=[7,7,3,1,10];
    $numero=rand(1,5);
    if(isset($_POST["validar"])){
        if($_POST["operacion"]!=$resultados[intval($_POST["numero"])]){
            $msg="La operación no es correcta Intentelo de nuevo<br>";
            $msg.="<a href='index.php'> volver </a>";
           
        }
        else{
            require "modelo.php";
            $fecha=date("y-m-d");
            $bbdd=new BBDD;
            $email=new Email($_POST["email"],$_POST["nombre"],$_POST["comentario"],$fecha);
            $email->insertarEmail($bbdd->link);
            $msg=$email->enviarEmail();
            
        }
        
         require "vistas/msg.php";
         
    }
    else{
       
        require "vistas/formulario.php";

    }
require "vistas/cierrehtml.php";
?>