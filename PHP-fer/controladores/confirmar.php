<?php


require '../modelo.php';
require_once '../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$base = new Bd();

// Ver si ha logeado el usuario
if (!isset($_COOKIE['nombre'])) {
    header('Location: validar');
}else {
    /* 
        Añadir PEDIDO
    */
    // Sacar maximo idPedido
    $id = new Pedido('','','','');
    $idPedido = $id->sacarMaximoidPedido($base->link);
    $idPedidoMax = $idPedido + 1; // echo $idPedidoMax;
    // Fecha
    $date = date('Y-m-d');
    // Direccion
    $direc = new Cliente($_COOKIE['dni'],'','','','','');
    $direccion = $direc->sacarDireccion($base->link);
    $dirEntrega = $direccion["direccion"]; // echo $dirEntrega;
    // DNI Cliente
    $dniCliente = $_COOKIE['dni']; // echo $dniCliente;
    // Crear pedido
    $pedido = new Pedido($idPedidoMax,$date,$dirEntrega,$dniCliente);
    $crearPedido = $pedido->insertar($base->link);

    /* 
        Añadir Linea Pedido
    */
    $carrito = new Carrito('',$_COOKIE['carrito'], '','','','',$_COOKIE['dni']);
    $buscarCarrito = $carrito->buscar($base->link);
    $total = 0;
    $importeBruto = 0;
    $iva = 0;
    while($producto = $buscarCarrito->fetch(PDO::FETCH_ASSOC)){
        // Sacar maximo linea
        $nlinea = new LineaPedido($idPedidoMax,'','','');
        $nlineaMax = $nlinea->sacarMaximonLinea($base->link);
        $nlineaFinal = $nlineaMax + 1; // echo $nlineaFinal;
        // Crear linea de pedido
        $insertarnLinea = new LineaPedido($idPedidoMax, $nlineaFinal, $producto['idProducto'], $producto['cantidad']);
        $guardarnLinea = $insertarnLinea->insertar($base->link);

        $iva += $producto['precio']*0.21;
        $total += $producto['precio'] * $producto['cantidad'];
        $importeBruto +=  (($producto['precio'])-($producto['precio']*0.21))*$producto['cantidad'];
    }
}

// Mostrar lo que lleva carrito antes de eliminar
$carrito = new Carrito('',$_COOKIE['carrito'], '','','','',$_COOKIE['dni']);
$productos = $carrito->buscar($base->link);


if(isset($_POST['aceptar'])) {
    /* 
        Eliminar Carrito
    */
    $carrito = new Carrito('',$_COOKIE['carrito'], '','','','',$_COOKIE['dni']);
    $deleteCarrito = $carrito->borrar($base->link);

    /*
        Eliminar Cookies
    */
    setcookie('nombre','',time()-100);
    setcookie('carrito','',time()-100);   
    header('Location: principal');
}

if(isset($_POST['generar'])) {
    // Introducimos HTML
    $html = "<html lang='es'>";
    $html .= "<head>
        <meta charset='UTF-8'>
            <title>Ver Carrito</title>
            <link rel='stylesheet' href='../lib/css/bootstrap.min.css'>
            <script src='../lib/js/jquery-3.4.1.min.js'>
            </script><script src='../lib/js/bootstrap.min.js'>
            </script><link rel='stylesheet' type='text/css' href='../css/style.css' />
            <link rel='icon' type='image/x-icon' href='../.img/logo.png'>
        </head>
        <body>
            <div class='col-12'>
                <div class='row  mt-sm-3'>
                    <img src='../img/logo.png' alt='No se muestra el logo' class='img-thumbnail logo mt-3 ml-sm-4'>
                </div>
                <div class='row col-12 text-right'>
                    <strong>N&uacute;mero de albar&aacute;n: </strong></br>
                </div>
                <div class='row col-12 text-right'>
                    <span>".$_COOKIE['carrito']."</span>
                </div>
                <div class='row'>
                    <p class='card-text col-12 text-left'>
                        <strong>Vendedor: </strong> Moto Road <br> 
                        <strong>Direcci&oacute;n: </strong> C/ Dolores Marques nº 42 <br>
                        <strong>Poblaci&oacute;n: </strong> Valencia <br>
                        <strong>CP: </strong> 46020 <strong> Tel&eacute;fono: </strong> 963698427 <br>
                    </p>
                </div>
                <div class='row mb-4'>
                    <p class='card-text col-12 text-right'>
                        <strong>Cliente: </strong>".$_COOKIE['nombre']." <br>
                        <strong>Con DNI/CIF: </strong>".$_COOKIE['dni']." <br>
                        <strong>Direcci&oacute;n: </strong>".$dirEntrega." <br>
                        <strong>Poblaci&oacute;n: </strong> Valencia <strong>CP: </strong> 46020 <br>
                        <strong>Tel&eacute;fono: </strong> 662128394 <br>
                    </p>
                </div>
                <div class='row mb-sm-4 mt-sm-4'>
                    <p class='card-text col-sm-12 text-center'>
                        <strong>N&uacute;mero de pedido: </strong>".$idPedidoMax." <br>
                        <strong>Fecha de envio: </strong>".$date."<br>
                        <strong>Direcci&oacute;n de entrega: </strong>".$dirEntrega." <br>
                    </p>
                </div>
                <div class='row'>
                    <div class='card-text col-sm-12 text-center table-responsive mb-sm-4'>
                        <table class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th scope='col'>Ref.</th>
                                    <th scope='col'>Articulo</th>
                                    <th scope='col'>Cantidad</th>
                                    <th scope='col'>Precio</th>
                                    <th scope='col'>Importe</th>
                                </tr>
                            </thead>
                            <tbody>";
    //Generamos bucle para mostrar los productos que hemos comprado
    while($producto = $productos->fetch(PDO::FETCH_ASSOC)){
        // Para sacar el precio sin iva de la unidad
        $precio = $producto['precio']-$producto['precio']*0.21;
        // Para sacar el importe total sin iva multiplicado por la cantidad
        $importe = ($producto['precio']-$producto['precio']*0.21)*$producto['cantidad'];
        $html .= "              <tr>
                                    <th scope='row'>".$producto['idProducto']."</th>
                                    <td>".$producto['nombreProducto']."</td>
                                    <td>".$producto['cantidad']."</td>
                                    <td>".$precio."</td>
                                    <td>".$importe."</td>
                                </tr>";
    }
    $html .= "                  <tr>
                                    <th scope='row' colspan='4' class='text-left'>Importe bruto</th>
                                    <td><strong>".$importeBruto."</strong></td>
                                </tr>
                                <tr>
                                    <th scope='row' colspan='3' class='text-left'>Descuento %</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope='row' colspan='4' class='text-right'>Base imponible</th>
                                    <td>".$importeBruto."</td>
                                </tr>
                                <tr>
                                    <th scope='row' colspan='3' class='text-right'>IVA</th>
                                    <td>21%</td>
                                    <td>".$iva."</td>
                                </tr>
                                <tr>
                                    <th scope='row' colspan='4' class='text-right'>Total factura</th>
                                    <td><strong>".$total."</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </body>
        </html>";
    // Instanciamos un objeto de la clase DOMPDF.
    $dompdf = new Dompdf();
    // Cargamos el contenido HTML.
    $dompdf->load_html($html);
    // Definimos el tamaño y orientación del papel que queremos.
    $dompdf->set_paper("A4", "portrait");
    // Renderizamos el documento PDF.
    $dompdf->render();
    $pdf = $dompdf->output();
    // Enviamos el fichero PDF al navegador.
    $dompdf->stream("factura_".$_COOKIE['carrito'].".pdf");
}

require "../vistas/confirmar.html";


?>