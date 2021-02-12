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
    if (isset($_GET['idProducto']))
    {
      //Mostrar un post
      $prod= new Producto($_GET['idProducto'],'','','','','','','','');
      $dato=$prod->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Mostrar lista de post
      $dato=Producto::getAll($base->link);
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
  $prod = new Producto($_POST['idProducto'],$_POST['nombre'],$_POST['origen'],$_POST['foto'],$_POST['marca'],$_POST['categoria'],$_POST['peso'],$_POST['unidades'],$_POST['precio']);
  if(!$prod->buscar($base->link)){
    $dato=$prod->insertar($base->link);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato);
    exit();
	}
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$idProducto = $_GET['idProducto'];
  $prod= new Producto($idProducto,'','','','','','','','');
  if($dato=$prod->borrar($base->link)){
	 header("HTTP/1.1 200 OK");
   	 echo json_encode($dato);
	 exit();
  }
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{

  if(isset($_GET['idProducto'])){
    $input = $_GET;
    $nombre=NULL;
    $origen=NULL;
    $foto=NULL;
    $marca=NULL;
    $categoria=NULL;
    $peso=NULL;
    $unidades=NULL;
    $precio=NULL;
    if(isset($_GET['nombre'])) $nombre=$_GET['nombre'];
    if(isset($_GET['origen'])) $origen=$_GET['origen'];
    if(isset($_GET['foto'])) $foto=$_GET['foto'];
    if(isset($_GET['marca'])) $marca=$_GET['marca'];
    if(isset($_GET['categoria'])) $categoria=$_GET['categoria'];
    if(isset($_GET['peso'])) $peso=$_GET['peso'];
    if(isset($_GET['unidades'])) $pwd=$_GET['unidades'];
    if(isset($_GET['precio'])) $pwd=$_GET['precio'];
    $prod= new Producto($_GET['idProducto'],$nombre,$origen,$foto,$marca,$categoria,$peso,$unidades,$precio);
    $dato=$prod->modificarParcial($base->link,$input);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato);
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
