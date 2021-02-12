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
    //Mostrar un post
    $pedido=new Pedido($_GET['idPedido'], '','','','','','');
    $dato = $pedido->buscarPedido($base->link);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato);
    exit();
    }
  else {
    //Mostrar lista de post
    $dato = Pedido::getAll($base->link);
    $dato->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato->fetchAll());
    exit();
  }
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $pedido= new Pedido('',$_POST['fecha'],$_POST['dirEntrega'],$_POST['nTarjeta'],$_POST['fechaCaducidad'],$_POST['matriculaRepartidor'],$_POST['dniCliente']);
    $pedido->idPedido = $pedido->maxPedido($base->link);//calcular el id del pedido
    if(!$pedido->buscarPedido($base->link)){
      $pedido->insertarPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($_POST['idPedido']);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$idPedido = $_GET['idPedido'];
  $pedido= new Pedido($_GET['idPedido'],'','','','','','');
  if($dato=$pedido->borrarPedido($base->link)){
	 header("HTTP/1.1 200 OK");
   	 echo json_encode($idPedido);
	 exit();
  }
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{

  if(isset($_GET['idPedido'])){
    $pedido= new Pedido($_GET['idPedido'],'','','','','','');
    $error=$pedido->modificarParcial($base->link,$_GET);
    header("HTTP/1.1 200 OK");
    echo $_GET['idPedido'];
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
