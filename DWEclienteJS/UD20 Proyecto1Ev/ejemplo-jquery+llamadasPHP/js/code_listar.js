window.onload = function () {
        lista_datos();
}

function lista_datos(){
    $.ajax({
        url:"PHP/lista_datos.php", // no paso ningun dato, solo recojo
        type:"POST",
        dataType:"json",
    }).done(function(respuesta){
        console.log(respuesta); // array de objetos, lo itero y pinto una fila por cada objeto
        for(var i in respuesta){
            console.log(i);
            $(".contenedor").append("<tr><td>"+respuesta[i].nombre+"</td><td>"+respuesta[i].apellido+"</td><td>"+respuesta[i].edad+"</td></tr>");
        }
    }).fail(function( jqXHR, textStatus, errorThrown ) {
        console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });
    ;

}
