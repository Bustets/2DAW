$(document).ready(function () {

        
    
    $.ajax({

            url: '../controladores/getClientes.php',

            type: 'POST',

            dataType: 'json',

            success: function (respuesta) {
                for (var key in respuesta) {
                    $("#tabla_Clientes").append("<tr><td class='dni'>" + respuesta[key].dniCliente + "</td><td id='nombre'>" + respuesta[key].nombre +
                    "</td> <td><button class='editarCliente'>Editar</button><button class='borrarCliente'>Borrar</button></td></tr>");
                }
            },

            error: function (xhr, status) {
                alert('Disculpe, existió un problema');
            },
        });


    /*$(".editarCliente").click(function(){
        $(".editarCliente").after();
      });*/
      
      $.ajax({

        url: '../controladores/getPedidos.php',

        type: 'POST',

        dataType: 'json',

        success: function (respuesta) {
            for (var key in respuesta) {
                $("#tabla_Pedido").append("<tr><td class='id'>" + respuesta[key].idPedido + "</td><td id='dniCliente'>" + respuesta[key].dniCliente + "</td><td id='fecha'>" + respuesta[key].fecha + 
                "</td> <td><button class='detallePedido'>Detalle</button><button class='editarPedido'>Editar</button><button class='borrarPedido'>Borrar</button></td></tr>");///modificar
            }
        },

        error: function (xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });

});
