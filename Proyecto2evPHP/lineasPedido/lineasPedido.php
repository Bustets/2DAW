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
{if (isset($_POST['idPedido'])) {
  $lineaPedido= new LineasPedido($_POST['idPedido'],'',$_POST['idProducto'],$_POST['cantidad']);
  $lineaPedido->nLinea=$lineaPedido->generarMaxLinea($base->link);
  if(!$lineaPedido->buscarLinea($base->link)){
    $lineaPedido->insertar($base->link);
    header("HTTP/1.1 200 OK");
    echo json_encode("$lineaPedido->nLinea");
    exit();
  }
} else{
    $dato = json_decode(file_get_contents("php://input"));
    foreach ($dato as $key => $value) {
      $_POST[$key]=$value;
    }
    $lineaPedido= new LineasPedido($_POST['idPedido'],'',$_POST['idProducto'],$_POST['cantidad']);
    $lineaPedido->nLinea=$lineaPedido->generarMaxLinea($base->link);
    if(!$lineaPedido->buscarLinea($base->link)){
      $lineaPedido->insertar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode("$lineaPedido->nLinea");
      exit();
    }
   }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$idPedido = $_GET['idPedido'];
  $dato= new LineasPedido($idPedido,$_GET['nlinea'],'','');
  if($dato->borrar($base->link)){
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
