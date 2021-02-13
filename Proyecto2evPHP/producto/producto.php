<?php

include "utils.php";
include "modelo.php";

$base= new Bd();

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
//var_dump($_SERVER);
{
  if($_SERVER['QUERY_STRING']){
    $queryString = $_SERVER['QUERY_STRING'];
    parse_str($queryString, $params);
    
    if($params['accion']== 'getProduct'){
      $dato=Producto::getProducto($base->link, $params);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
    }

    else if($params['accion']== 'getCampos'){

        $dato=Producto::buscarCampos($base->link);
        $dato->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($dato->fetchAll());
        exit();
      }

  }else{
      //Mostrar lista de Producto
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
    $producto= new Producto($_POST['idProducto'],$_POST['nombre'],$_POST['origen'],$_POST['foto'],$_POST['marca'],$_POST['categoria'],$_POST['peso'],$_POST['unidades'],$_POST['volumen'],$_POST['precio']);
    if(!$producto->buscar($base->link)){
      $producto->insertar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($_POST['idProducto']);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$idProducto = $_GET['idProducto'];
  $producto= new Producto($_GET['idProducto'],'','','','','','','','','');
  if($dato=$producto->borrar($base->link)){
	 header("HTTP/1.1 200 OK");
   	 echo json_encode($idProducto);
	 exit();
  }
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{

  if(isset($_GET['idProducto'])){
    $producto= new Producto($_GET['idProducto'],'','','','','','','','','');
    $error=$producto->modificarParcial($base->link,$_GET);
    header("HTTP/1.1 200 OK");
    echo $_GET['dniCliente'];
    exit();
  }
}



//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
