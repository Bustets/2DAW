$(document).ready(function () {

    $('.modalAnyadir').hide();
    $('.modalEditar').hide();
    $("#anyadirCliente").click(function () {
        $(".modalAnyadir").show();
    });
    $("#anyadirPedido").click(function () {
        $(".modalAnyadir").show();
    });


    $("#anyadirCli").click(function () {
        anyadirCliente();
    });


    /////Lo que va aqui lo pongo ahora 

    $("#anyadirPedido").click(function () {
        anyadirPedido();
    });

    $(".cerrarModal").click(function(){
        $(".modalAnyadir").hide();
    })

    ////entre estas es lo que añado ahora al codigo

    cargarClientes();
    cargarPedidos();
    /*borrarCliente();
    editarCliente();*/

});
function cargarClientes() {

    $.ajax({

        url: '../controladores/getClientes.php',

        type: 'POST',

        dataType: 'json',

        success: function (respuesta) {
            for (var key in respuesta) {
                $("#tabla_Clientes").append("<tr><td class='dniCliente'>" + respuesta[key].dniCliente + "</td><td id='nombre'>" + respuesta[key].nombre +
                    "</td> <td><button class='editarCliente'>Editar</button><button class='borrarCliente'>Borrar</button></td></tr>");
            
                $("#selectCliente").append("<option>"+ respuesta[key].dniCliente+"</option>");    
                }

            abrirFormularioanyadir();
            borrarCliente();
            editarCliente();
        },


        error: function (xhr, status) {
            alert('Disculpe, existió un problema1');
        }
    });
}

function cargarPedidos() {

    $.ajax({

        url: '../controladores/getPedidos.php',

        type: 'POST',

        dataType: 'json',

        success: function (respuesta) {
            console.log(respuesta);
            for (var key in respuesta) {
                $("#tabla_Pedidos").append("<tr><td class='idPedido'>" + respuesta[key].idPedido + "</td><td id='dni'>" + respuesta[key].dniCliente + "</td><td id='fecha'>" + respuesta[key].fecha +
                    "</td> <td><button class='detallePedido'>Detalle</button><button class='editarPedido'>Editar</button><button class='borrarPedido'>Borrar</button></td></tr>");
                
                    sumaValorIDpedido = parseInt(respuesta[key].idPedido) + 1;
                }

             /////Lo que va aqui lo pongo ahora 

    $("#anyadirPedidoNuevo").click(function () {
        anyadirPedido(sumaValorIDpedido);

    });

    borrarPedido();
    cargarLineaPedidos();
    

    ////entre estas es lo que añado ahora al codigo
        
        },

        error: function (xhr, status) {
            alert('Disculpe, existió un problema2');
        }

    });
}

function anyadirCliente() {
    var objeto_Cliente = {
        dniCliente: $('#dni_anyadir').val(),
        nombre: $('#nombre_anyadir').val(),
        direccion: $('#direccion_anyadir').val(),
        email: $('#email_anyadir').val(),
        pwd: $('#pass_anyadir').val(),
        administrador: $('#admin_anyadir').val(),
    };


    $.ajax({

        url: '../controladores/insertar.php',

        type: 'POST',

        data: objeto_Cliente,

        dataType: 'json',



    }).done(function (respuesta) {
        if (respuesta) {
            alert("Dato insertado");
            $("#tabla_Clientes").append("<tr><td class='dniCliente'>" + objeto_Cliente.dniCliente + "</td><td calass='nombreCli'>" + objeto_Cliente.nombre + "</td> <td><button id='editarCliente'>Editar</button><button class='borrarCliente'>Borrar</button></td></tr>");

        } else {
            alert("Error en la insercion");
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("La solicitud ha fallado: " + textStatus + errorThrown);
    });

}
function abrirFormularioanyadir() {
    $("#anyadirCli").click(function () {
        anyadirCliente();
    });
}

function borrarCliente() {
    $('.borrarCliente').click(function () {
        var borrarFila = $(this).parent().parent();
        var datos = { dniCliente: borrarFila.find('.dniCliente').text(), };


        $.ajax({

            url: '../controladores/borrar.php',

            type: 'POST',

            data: datos,

            dataType: 'json',

        }).done(function (respuesta) {
            if (respuesta) {
                alert("Cliente Borrado");
                borrarFila.remove();
            } else {
                alert("Error Al Borrar");
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        });
    });
}
function editarCliente() {
    $(".editarCliente").click(function () {
        $(".modalEditar").show();
        var fila = $(this).parent().parent();
        var dni = fila.find('.dniCliente').text();
        console.log(dni);
        $.ajax({
            url: "../controladores/getClientes.php",
            type: "POST",
            dataType: "json",
            success: function (respuestaDatos) {
                console.log(respuestaDatos);
                for (var key in respuestaDatos) {
                    if (respuestaDatos[key].dniCliente == dni) {
                        $('#dniEditar').val(respuestaDatos[key].dniCliente);
                        $('#nombreEditar').val(respuestaDatos[key].nombre);
                        $('#direccionEditar').val(respuestaDatos[key].direccion);
                        $('#emailEditar').val(respuestaDatos[key].email);
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("La solicitud ha fallado: " + textStatus + errorThrown); //
            }
        });
        $("#editCli").click(function () {
            var objeto_mod = {
                dniCliente: $('#dniEditar').val(),
                nombre: $('#nombreEditar').val(),
                direccion: $('#direccionEditar').val(),
                email: $('#emailEditar').val(),
                pwd: $('#passEditar').val(),
                administrador: $('#adminEditar').val(),
            };
            $.ajax({
                url: "../controladores/modificar.php",
                type: "POST",
                data: objeto_mod,
                dataType: "json",
            }).done(function (respuesta) {
                if (respuesta) {
                    alert("Dato actualizado");
                    $(fila).after("<tr><td class='dniCliente'>" + objeto_mod.dniCliente + "</td><td calass='nombreCli'>" + objeto_mod.nombre + "</td> <td><button id='editarCliente'>Editar</button><button class='borrarCliente'>Borrar</button></td></tr>")
                    $(fila).remove();
                    $("#modalEditar").hide();
                } else {
                    alert("Error al acctualizar");
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log("La solicitud ha fallado: " + textStatus + errorThrown);
            });
        });
    });
}

//////////Nuevo desde Aqui//////////
function anyadirPedido(sumaValorIDpedido) {

    $(".modalAnyadir").show();

    $("#anyadirPedido").click(function(){

        var objeto_Pedido = {
            fecha: $('#fecha_Anyadir').val(),
            dniCliente: $('#selectCliente').val(),
            dirEntrega: $('#dirEntregaCli').val(),
            nTarjeta: $('nTarjetaCli').val(),
            fechaCaducidad: $('#fechaCaducidadCli').val(),
            matriculaRepartidor: $('#matriculaRepartidorCli').val(),
            idPedido: sumaValorIDpedido,
        };
    
    console.log(objeto_Pedido);
        $.ajax({
    
            url: '../controladores/insertarPedido.php',
    
            type: 'POST',
    
            data: objeto_Pedido,
    
            dataType: 'json',
    
    
    
        }).done(function (respuesta) {
            if (respuesta) {
                $("#tabla_Pedidos").append("<tr><td class='idPedido'>" + objeto_Pedido.idPedido + "</td><td id='selectCliente'>" + objeto_Pedido.dniCliente + "</td><td id='fecha'>" + objeto_Pedido.fecha  + "</td> <td><button id='detallePedido'>Detalle</button><button id='editarPedido'>Editar</button><button class='borrarPedido'>Borrar</button></td></tr>");
                sumaValorIDpedido++;
                alert("Dato insertado");
            } else {
                alert("Error en la insercion");
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        });
        borrarPedido();
        cargarLineaPedidos();
    });

}


function borrarPedido(){

    $('.borrarPedido').click(function(){
        var fila = $(this).parent().parent();
        var datos = { idPedido:fila.find('.idPedido').text(), };


        $.ajax({

            url: '../controladores/borrarPedido.php',

            type: 'POST',

            data: datos,

            dataType: 'json',

        }).done(function (respuesta) {
            if (respuesta) {
                alert("Cliente Borrado");
                fila.remove();
            } else {
                alert("Error Al Borrar");
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        });
    });
}

function cargarLineaPedidos(){
    $('.detallePedido').click(function (){
        var filaLineaPedido = $(this).parent().parent();
        var objeto ={ idPedido:filaLineaPedido.find('.idPedido').text()};
        $.ajax({
            url: "../controladores/lineaPedido.php", 
            type: "POST",
            data: objeto,
            dataType: "json",

            success: function (respuesta) {

                 console.log(respuesta);
                 filaLineaPedido.after("<table id=lineaPedidos><thead><tr><th>Linea</th><th>Cantidad</th><th>Producto</th><th>Acciones</th></tr></thead><tbody></tbody><table>");
                for (var key in respuesta) {

                        $('#lineaPedido').append("<tr><td id='idPedido' style='display:none'>" +respuesta[key].idPedido+ "</td><td id='nLinea'>" + respuesta[key].nlinea + "</td><td id='cantidad' >" + respuesta[key].cantidad + "</td><td id='nombre'>" +
                        respuesta[key].idProducto    + "</td><td> <button class='borrarLineaPedido'>Borrar</button></td></tr>");


                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("La solicitud ha fallado: " + textStatus + errorThrown);
            }
        });
        $('#lineaPedido').append("<tr><td></td><td></td><td></td><td> <button class='anyadirLineaPedido'>anyadir</button></td></tr>");
    });


}
