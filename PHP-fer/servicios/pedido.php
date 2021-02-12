<?php

include "utils.php";
include "../modelo.php";
include "../cors.php";

$base= new Bd();

// Mostrar los pedidos
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['idPedido']))
    {
      //Mostrar un post
      $prod= new Pedido($_GET['idPedido'],'','','');
      $dato=$prod->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Mostrar lista de post
      $dato=Pedido::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$idPedido = $_GET['idPedido'];
  $prod= new Pedido($idPedido,'','','');
  if($dato=$prod->borrar($base->link)){
	 header("HTTP/1.1 200 OK");
   	 echo json_encode($dato);
	 exit();
  }
} 

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
  if(isset($_GET['idPedido'])){
    $input = $_GET;
    $fecha=NULL;
    $dirEntrega=NULL;
    $dniCliente=NULL;
    if(isset($_GET['fecha'])) $fecha=$_GET['fecha'];
    if(isset($_GET['dirEntrega'])) $dirEntrega=$_GET['dirEntrega'];
    if(isset($_GET['dniCliente'])) $dniCliente=$_GET['dniCliente'];
    $prod= new Pedido($_GET['idPedido'],$fecha,$dirEntrega,$dniCliente);
    $dato=$prod->modificarParcial($base->link,$input);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato);
    exit();
  }
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $inputJson = file_get_contents('php://input');
  $_POST = json_decode($inputJson,TRUE);
  $pedi = new Pedido($_POST['idPedido'],$_POST['fecha'],$_POST['dirEntrega'],$_POST['dniCliente']);
  $dato = $pedi->insertar($base->link);
  header("HTTP/1.1 200 OK");
  echo json_encode($dato);
  exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
