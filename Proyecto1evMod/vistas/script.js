$(document).ready(function () {

    $('.modalAnyadir').hide();
    $('.modalEditar').hide();
    $("#anyadirCliente").click(function(){
        $(".modalAnyadir").show();
      });
      $("#anyadirPedido").click(function(){
        $(".modalAnyadir").show();
      });

    $("#anyadirCli").click(function(){
        anyadirCliente();
    });

      cargarClientes();
      cargarPedidos();

});
function cargarClientes(){
      
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
}

function cargarPedidos(){

    $.ajax({

      url: '../controladores/getPedidos.php',

      type: 'POST',

      dataType: 'json',

      success: function (respuesta) {
          for (var key in respuesta) {
              $("#tabla_Pedido").append("<tr><td class='idPedido'>" + respuesta[key].idPedido + "</td><td id='dniCliente'>" + respuesta[key].dniCliente + "</td><td id='fecha'>" + respuesta[key].fecha + 
              "</td> <td><button class='detallePedido'>Detalle</button><button class='editarPedido'>Editar</button><button class='borrarPedido'>Borrar</button></td></tr>");///modificar
          }
      },

      error: function (xhr, status) {
          alert('Disculpe, existió un problema');
      },
  });
}

 function anyadirCliente(){
        var objeto_Cliente = {
        dniCliente:$('#dni').val(),
        nombre:$('#nombre').val(),
        direccion:$('#direccion').val(),
        email:$('#email').val()};

        $.ajax({

        url: '../controladores/insertar.php',

        type: 'POST',

        data: objeto_Cliente,

        dataType: 'json',

       

    }).done(function(respuesta){ 
       if(respuesta){
            alert("Dato insertado");
            $("#tabla_Clientes tbody").append("<tr><td class='dniCliente'>"+objeto_dato.dniCliente+"</td><td calass='nombreCli'>"+objeto_dato.nombre+"</td> <td><button id='editarCliente'>Editar</button><button class='borrarCliente'>Borrar</button></td></tr>");

        }else{ 
            alert("Error en la insercion");
        } 
    }).fail(function( jqXHR, textStatus, errorThrown ) {
        console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });

    }