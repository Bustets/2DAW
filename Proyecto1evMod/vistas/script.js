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
      borrarCliente();//

});
function cargarClientes(){
      
    $.ajax({

        url: '../controladores/getClientes.php',

        type: 'POST',

        dataType: 'json',

        success: function (respuesta) {
            for (var key in respuesta) {
                $("#tabla_Clientes").append("<tr><td class='dniCliente'>" + respuesta[key].dniCliente + "</td><td id='nombre'>" + respuesta[key].nombre +
                    "</td> <td><button class='editarCliente'>Editar</button><button class='borrarCliente'>Borrar</button></td></tr>");
            }
            abrirFormularioanyadir();
            borrarCliente();
            $(".editarCliente").click(function(){
                $(".modalEditar").show();
            });
        },


        error: function (xhr, status) {
            alert('Disculpe, existió un problema1');
        }
    });
}

function cargarPedidos(){

    $.ajax({

      url: '../controladores/getPedidos.php',

      type: 'POST',

      dataType: 'json',

      success: function (respuesta) {
          console.log(respuesta);
          for (var key in respuesta) {
              $("#tabla_Pedidos").append("<tr><td class='idPedido'>" + respuesta[key].idPedido + "</td><td id='dni'>" + respuesta[key].dniCliente + "</td><td id='fecha'>" + respuesta[key].fecha + 
              "</td> <td><button class='detallePedido'>Detalle</button><button class='editarPedido'>Editar</button><button class='borrarPedido'>Borrar</button></td></tr>");
          }
      },

      error: function (xhr, status) {
          alert('Disculpe, existió un problema2');
      }
  });
}

 function anyadirCliente(){
        var objeto_Cliente = {
        dniCliente:$('#dni_anyadir').val(),
        nombre:$('#nombre_anyadir').val(),
        direccion:$('#direccion_anyadir').val(),
        email:$('#email_anyadir').val(),
        pwd:$('#pass_anyadir').val(),
        administrador:$('#admin_anyadir').val(),
    };


        $.ajax({

        url: '../controladores/insertar.php',

        type: 'POST',

        data: objeto_Cliente,

        dataType: 'json',

       

    }).done(function(respuesta){ 
       if(respuesta){
            alert("Dato insertado");
            $("#tabla_Clientes").append("<tr><td class='dniCliente'>"+objeto_Cliente.dniCliente+"</td><td calass='nombreCli'>"+objeto_Cliente.nombre+"</td> <td><button id='editarCliente'>Editar</button><button class='borrarCliente'>Borrar</button></td></tr>");

        }else{ 
            alert("Error en la insercion");
        } 
    }).fail(function( jqXHR, textStatus, errorThrown ) {
        console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });

    }
    function abrirFormularioanyadir(){
        $("#anyadirCli").click(function(){
            anyadirCliente();
        });
    }

    function borrarCliente(){
        $('.borrarCliente').click(function(){
            var borrarFila=$(this).parent().parent();
            var datos={dniCliente:borrarFila.find('.dniCliente').text(),};
        

        $.ajax({

            url: '../controladores/borrar.php',
    
            type: 'POST',
    
            data: datos,
    
            dataType: 'json',

        }).done (function(respuesta){
            if(respuesta){
                alert("Cliente Borrado");
                borrarFila.remove();
            }else{
                alert("Error Al Borrar");
            }
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
        });
    });

}