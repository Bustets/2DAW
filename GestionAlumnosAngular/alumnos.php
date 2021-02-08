<?php

//cabeceras para evitar el error de CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
 
$method = $_SERVER['REQUEST_METHOD']; //obrtengo el metodo

if ($method == 'OPTIONS') {  // para metodo options, solo devuelvo una cabecera de ok. OJO, sin esto los servicios Angular dan un error
  header("HTTP/1.1 200 OK");
  exit;}

 
if ($method == 'GET') {

  $alumno1 = new stdClass();
    $alumno1->nombre = "jesus";
    $alumno1->dni = "3333335w";
    $alumno1->fechaNacimiento = "Mon Feb 01 1999 00:00:00 GMT+0100 (hora estándar de Europa central)";
    $alumno1->email = "jjj@gmail.com";
    $alumno1->telefono = "654987321";
    $alumno1->ciclo = "2DAM";

    $alumno2 = new stdClass();
    $alumno2->nombre = "OTRO";
    $alumno2->dni = "55555555w";
    $alumno2->fechaNacimiento = "Mon Feb 01 1987 00:00:00 GMT+0100 (hora estándar de Europa central)";
    $alumno2->email = "jjj@gmail.com";
    $alumno2->telefono = "654987321";
    $alumno2->ciclo = "1DAM";

    $alumno3 = new stdClass();
    $alumno3->nombre = "OTRO";
    $alumno3->dni = "55645646g";
    $alumno3->fechaNacimiento = "Mon Feb 01 1987 00:00:00 GMT+0100 (hora estándar de Europa central)";
    $alumno3->email = "aaa@gmail.com";
    $alumno3->telefono = "6666666";
    $alumno3->ciclo = "1ASIR";
		
    $alumnos = array();   // supongo que alumnos lo obtengo de la base de datos
    array_push ( $alumnos , $alumno1 );
    array_push ( $alumnos , $alumno2 );
    array_push ( $alumnos , $alumno3 );
   
     header("HTTP/1.1 200 OK");  // devuelvo la cabecera de ok

     echo json_encode($alumnos); // devuelvo el array de alumnos
      exit();
  }
  
  if ($method == 'POST'){  //metodo post para añadir alumno

  $inputJson = file_get_contents('php://input');  //recojo el post
  $_POST = json_decode($inputJson,TRUE);
  $nombre=$_POST['nombre'];
  $dni=$_POST['dni'];
  $fechaNacimiento=$_POST['fechaNacimiento'];
  $email=$_POST['email'];
  $telefono=$_POST['telefono'];
  $ciclo=$_POST['ciclo'];

  //Guardo en base de datos .....

  $aleatorio = (bool)rand(0,1);  // simulo errors en la insercion 
  //si todo es ok:
  if($aleatorio){    // simulo insercion ok
    header("HTTP/1.1 200 OK");  //cabecera de ok --> 
    echo json_encode("insercion ok");     //la respuesta va a  respuesta => this.anyadoAlumno.emit(this.nuevoAlumno), // Success function
    exit();
  }else{ // simulo que hay un error
     header("HTTP/1.1 500 Error interno"); //cabecera de error, para que se capture como un error interno
      echo json_encode("Error interno");  //mensaje de error, se captura en       error => alert("Error en la insercion:" + error.message + error.statusText), // Error function  
      exit();
    }
  }//del POST
  
  if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){ // metodo delete para borrar
    $dniAlumno = $_GET['dniAlumno'];  // para el dni a borrar

    $aleatorio = (bool)rand(0,1);  // simulo errors en la insercion 
    //si todo es ok:
    if($aleatorio){    // simulo insercion ok
      header("HTTP/1.1 200 OK");  //cabecera de ok --> 
      echo json_encode("borrado ok");     //la respuesta va a  respuesta => 
      exit();
    }else{ // simulo que hay un error
       header("HTTP/1.1 500 Error interno"); //cabecera de error, para que se capture como un error interno
        echo json_encode("Error interno");  //mensaje de error, se captura en error => alert("Error en la insercion:" + error.message + error.statusText), // Error function  
        exit();
      }
     exit();
  }



//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad request");


?>
