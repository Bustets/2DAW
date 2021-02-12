<?php

include "utils.php";
include "../modelo.php";
include "../cors.php";

$base= new Bd();

// Mostrar linea de pedidos segun su idPedido
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['idPedido']))
    {
      //Mostrar un post
      $prod= new LineaPedido($_GET['idPedido'],'','','');
      $consulta=$prod->buscar($base->link);
      $array = [];
      while($dato=$consulta->fetch(PDO::FETCH_ASSOC)){
        array_push($array, $dato);
      }
      echo json_encode($array);
      header("HTTP/1.1 200 OK");
      exit();
	  }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
  if (isset($_GET['idPedido'])&&isset($_GET['nlinea'])){
    $idPedido = $_GET['idPedido'];
    $nlinea = $_GET['nlinea'];
    $prod= new LineaPedido($idPedido,$nlinea,'','');
    if($dato=$prod->borrar($base->link)){
      header("HTTP/1.1 200 OK");
       echo json_encode($dato);
     exit();
    }
  }
  if(isset($_GET['idPedido'])) {
    $idPedido = $_GET['idPedido'];
    $prod= new LineaPedido($idPedido,'','','');
    if($dato=$prod->borrarAllLineaPedido($base->link)){
      header("HTTP/1.1 200 OK");
       echo json_encode($dato);
     exit();
    }
  }
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $inputJson = file_get_contents('php://input');
    $_POST = json_decode($inputJson,TRUE);
    $linea = new LineaPedido($_POST['idPedido'],$_POST['nlinea'],$_POST['idProducto'],$_POST['cantidad']);
    $dato=$linea->insertar($base->link);
    header("HTTP/1.1 200 OK");
    echo json_encode($dato);
    exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>