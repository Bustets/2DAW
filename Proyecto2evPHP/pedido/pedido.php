<?php

//cabeceras para evitar el error de CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
 
$method = $_SERVER['REQUEST_METHOD']; //obrtengo el metodo

if ($method == 'OPTIONS') {  // para metodo options, solo devuelvo una cabecera de ok. OJO, sin esto los servicios Angular dan un error
  header("HTTP/1.1 200 OK");
  exit;}

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
  if (isset($_POST['dniCliente'])) {
  $pedido = new Pedido('',$_POST['fecha'],$_POST['dirEntrega'],$_POST['nTarjeta'],$_POST['fechaCaducidad'],$_POST['matriculaRepartidor'],$_POST['dniCliente']);
  $pedido->idPedido=$pedido->calcularIdPedido($base->link);
  if(!$pedido->buscarPedido($base->link)){
    $pedido->insertarPedido($base->link);
    header("HTTP/1.1 200 OK");
    echo json_encode($pedido->idPedido);
    exit();
      }
    }else{
      $dato = json_decode(file_get_contents("php://input"));
      foreach ($dato as $key => $value) {
        $_POST[$key]=$value;
      }
      $pedido = new Pedido('',$_POST['fecha'],$_POST['dirEntrega'],$_POST['nTarjeta'],$_POST['fechaCaducidad'],$_POST['matriculaRepartidor'],$_POST['dniCliente']);
      $pedido->idPedido=$pedido->maxPedido($base->link);
      if(!$pedido->buscarPedido($base->link)){
        $pedido->insertarPedido($base->link);
        header("HTTP/1.1 200 OK");
        echo json_encode($pedido->idPedido);
        exit();
      }
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
    echo json_encode($_GET['idPedido']);
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
