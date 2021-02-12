<?php

include "utils.php";
include "../modelo.php";
include "../cors.php";

$base= new Bd();



/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['dniCliente']))
    {
      //Mostrar un post
      $cli= new Cliente($_GET['dniCliente'],'','','','','');
      $dato=$cli->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Mostrar lista de post
      $dato=Cliente::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $inputJson = file_get_contents('php://input');
  $_POST = json_decode($inputJson,TRUE);
  $pass = password_hash($_POST['pwd'],PASSWORD_BCRYPT);
  $cli= new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$pass,$_POST['admin']);
  if(!$cli->buscar($base->link)){
    $dato=$cli->insertar($base->link);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato);
    exit();
	} else {
    echo json_encode(false);
    exit();
  }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$dniCliente = $_GET['dniCliente'];
  $cli= new Cliente($dniCliente,'','','','','');
  if($dato=$cli->borrar($base->link)){
	  header("HTTP/1.1 200 OK");
   	echo json_encode($dato);
	 exit();
  }
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{

  if(isset($_GET['dniCliente'])){
    $input = $_GET;
    $nombre=NULL;
    $direccion=NULL;
    $email=NULL;
    $pwd=NULL;
    $admin=NULL;
    if(isset($_GET['nombre'])) $nombre=$_GET['nombre'];
    if(isset($_GET['direccion'])) $direccion=$_GET['direccion'];
    if(isset($_GET['email'])) $email=$_GET['email'];
    if(isset($_GET['pwd'])) $pwd=$_GET['pwd'];
    if(isset($_GET['admin'])) $admin=$_GET['admin'];
    $prod= new Cliente($_GET['dniCliente'],$nombre,$direccion,$email,$pwd,$admin);
    $dato=$prod->modificarParcial($base->link,$input);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato);
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
