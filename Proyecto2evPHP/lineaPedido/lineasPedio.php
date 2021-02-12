<?php

include "utils.php";
include "modelo.php";

$base= new Bd();

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['idPedido']))
    {
      //Mostrar un nLinea
      $nLinea= new LineasPedido($_GET['idPedido'],'','','');
      $dato=$nLinea->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Mostrar lista de nLinea
      $dato=LineasPedido::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $nLinea= new LineasPedido($_POST['idPedido'],$_POST['nLinea'],$_POST['idProducto'],$_POST['cantidad']);
    if(!$nLinea->buscar($base->link)){
      $nLinea->insertar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($_POST['idPedido']);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$idPedido = $_GET['idPedido'];
  $nLinea= new LineasPedido($idPedido,'','','');
  if($dato=$nLinea->borrar($base->link)){
	 header("HTTP/1.1 200 OK");
   	 echo json_encode($idPedido);
	 exit();
  }
}
//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{

  if(isset($_GET['idPedido'])){
    $nLinea= new LineasPedido($_GET['idPedido'],'','','');
    $error=$nLinea->modificarParcial($base->link,$_GET);
    header("HTTP/1.1 200 OK");
    echo $_GET['dniCliente'];
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
