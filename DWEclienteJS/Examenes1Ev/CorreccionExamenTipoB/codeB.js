$(document).ready(function(){
    console.log("pepito");
    $("#modal_nueva_carta").hide();
    $("#abrir_modal").click(function(){
        $("#modal_nueva_carta").show();
    });
    $("#cerrar_modal").click(function(){
        $("#modal_nueva_carta").hide();
    });
    mostrarCarta();

});
function mostrarFecha(){
    // Muy importante acordarse del find
    // DIFERENCIAS ENTRE .TEXT Y .HTML
    
    $(".carta").mouseover(function(){
        $("#fecha").html($(this).find(".carta_fecha").val());
    });
    $(".carta").mouseleave(function(){
        $("#fecha").html("");
    });
}
function borrarCarta(){
    $(".borrar").click(function(){
        console.log($(this).parent());// div class carta
        console.log($(this).parent().parent()); //div id cartas
        $(this).parent().remove();
    });
}
function mostrarCarta(){
    var divCarta;
    $.ajax({
        url:"php/listo_cartas.php", 
        type:"POST",
        dataType:"json",
    }).done(function(respuesta){
        // console.log(respuesta); 
        for(var i in respuesta){
            divCarta = "<div class = 'carta'>" + 
            "<input type='hidden' class='carta_fecha' value="+respuesta[i].fecha+">";
            divCarta += respuesta[i].regalo1;
            if(respuesta[i].estrellas1 == 1){
                divCarta += " - * - ";
            }
            if(respuesta[i].estrellas1 == 2){
                divCarta += " - ** - ";
            }
            if(respuesta[i].estrellas1 == 3){
                divCarta += " - *** - ";
            }
            divCarta += respuesta[i].regalo2;
            if(respuesta[i].estrellas2 == 1){
                divCarta += " - * - ";
            }
            if(respuesta[i].estrellas2 == 2){
                divCarta += " - ** - ";
            }
            if(respuesta[i].estrellas2 == 3){
                divCarta += " - *** - ";
            }
            divCarta += respuesta[i].regalo3;
            if(respuesta[i].estrellas3 == 1){
                divCarta += " - * - ";
            }
            if(respuesta[i].estrellas3 == 2){
                divCarta += " - ** - ";
            }
            if(respuesta[i].estrellas3 == 3){
                divCarta += " - *** - ";
            }
            divCarta += "<button class='borrar'>Borrar</button>";
            divCarta += "</div>";
            $("#cartas").append(divCarta);
            borrarCarta();
            mostrarFecha();
      }
      
    }).fail(function( jqXHR, textStatus, errorThrown ) {
        console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });
}