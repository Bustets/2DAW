$.validator.setDefaults({
    submitHandler: function() {
        alert("formulario ok");
        envio_Carta();
    }
});
$(document).ready(function () {

    listarCartas();

    
    $(".borrar").on("click",function(){
        $(".carta").remove();
    });
    $("#abrir_modal").on("click",function(){
        $("#modal_nueva_carta").show();
    });
    $("#cerrar_modal").on("click",function(){
        $("#modal_nueva_carta").hide();
    });
    $(".carta").on("mouseleave",function(){
        $("#fecha_carta").show();
    });
    $(".carta").on("mouseover",function(){
        $("#fecha_carta").hide();
    });
    $("#enviar_carta").on("click",function(){
        validarFormulario();
    });

});


function listarCartas() {

    $.ajax({

        url: 'php/listo_cartas.php',

        type: 'POST',

        dataType: 'json',

        success: function (respuesta) {
            for (var key in respuesta){
              
                $("#cartas").append("<div class='carta'><input class='fecha_carta' type='hidden' value='"+respuesta[key].fecha+"'<span>"+respuesta[key].regalo1+"</span> <span>"+respuesta[key].estrellas1+"</span> <span>"+respuesta[key].regalo2+ "</span> <span>"+respuesta[key].estrellas2+ "</span> <span>"+respuesta[key].regalo3+ "</span> <span>"+respuesta[key].estrellas3+ "</span> <button class='borrar'>Borrar</button></div>");
             
            }
            

        },

        error: function (xhr, status) {
            alert('Disculpe, existió un problema1');
        }
    });
}

function envio_Carta(){
    var objeto={regalo1:$("#r1").val(), pref1:$("#p1").val(),regalo2:$("#r2").val(), pref2:$(".p2").val(),regalo3:$("#r3").val(), pref3:$("#p3").val()}

    $.ajax({

        url: 'php/envio_carta.php',

        type: 'POST',

        data: objeto,

        dataType: 'json',

        success: function (respuesta) {
            if(respuesta){
                $("#cartas").append("<div class='carta'><input class='fecha_carta' type='hidden' value='"+respuesta[key].fecha+"'<span>"+objeto.r1+"</span> <span>"+objeto.p1+"</span> <span>"+objeto.r2+ "</span> <span>"+objeto.p2+ "</span> <span>"+objeto.r3+ "</span> <span>"+objeto.p3+ "</span></div>");
            }else{
                alert("Algo ha salido mal, no se ha podido añadir la nueva pelicula.");
            }
        },
        error: function (xhr, status) {
            alert('Disculpe, existió un problema2');
        }
    });
}

function validarFormulario(){
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
       }, "Value must not equal arg.");
    $("#carta").validate({
		rules: {
            regalo1: {
               required: true,
               maxlength:15,
           },
           radioButton: {
            required: true,
            },
            regalo2: {
                required: true,
                maxlength:15,
            },
            radioButton: {
                required: true,
                },
             regalo3: {
                required: true,
                maxlength:15,
            },
            radioButton: {
                required: true,
                },
        },
        messages: {

            regalo1: {
                required: "rellene el campo",
                max: "maximo 15 caracteres"
            },
            radioButton: "Selecciona un radio button",
            regalo2: {
                required: "rellene el campo",
                max: "maximo 15 caracteres"
            },
            radioButton: "Selecciona un radio button",
            regalo3: {
                required: "rellene el campo",
                max: "maximo 15 caracteres"
            },
            radioButton: "Selecciona un radio button",
                max: "5 estrellas",
            
        }
            
    });
}