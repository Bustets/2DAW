window.onload = function () {
    $(".borrar").click(function(){
        var fila_borrar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
         console.log(fila_borrar);   
         var objeto_dato = { 
            dni:fila_borrar.find('.dni').text(), //dentro de la fila, busco el td de clase dni, y me quedo con el texto
        };
        console.log(objeto_dato)
    
         $.ajax({
             url:"PHP/borrar_dato.php",
             type:"POST",
             data: objeto_dato, // paso el dni para que se borre la fila de la BD
             dataType:"json",
         }).done(function(respuesta){
            console.log(respuesta);
             if(respuesta){
                 alert("Dato borrado correctamente !!!!");
                fila_borrar.remove(); // si se ha borrado la fila de la bd, borro de la pagina
             }else{
                alert("Error al borrar")
            } 
         }).fail(function( jqXHR, textStatus, errorThrown ) {
            console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
         });

    });//del click

}//del on load
