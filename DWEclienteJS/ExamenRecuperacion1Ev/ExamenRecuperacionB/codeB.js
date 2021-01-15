$(document).ready(function () {

    listarDatos();

    $("#boton_modal").on("click",function(){
        $("#dato_modal").show();
        });
        $("#c_modal").on("click",function(){
        $("#dato_modal").hide();
        });

        //Esto no se si esta bien respecto a la pregunta 5 

        $("#viento").on("change",function(){  //
            var valor = $("#i_icono").val();   //
       });                                      //

       //

        $("#datos_form").validate({
            rules:{
                temp:{
                    required: true,
                    max: 50, 
                },
                f:{
                    required: true,
                    min: -1,
                },
                icono:{
                    valueNotEquals: "nada",
                    
                },
            },
            messages:{
                temp:{
                    required: "Introduzca una temperatura", 
                    max: "La temperatura no puede superar a 50ºC",
                },
                f:{
                    required: "Introduzca una temperatura",
                    max: "La fuerza no puede ser menos a 0 Km/h",
                },
                icono:{
                    valueNotEquals: "Por favor selecciona un item!",
                },
            },
            submitHandler: function(form){
                alert("Enviando!");  
                enviarFormulario(); 
            }
                
        })

});
function listarDatos(){

    $.ajax({

        url: 'php/listo_datos.php',

        type: 'POST',

        dataType: 'json',

        success: function (respuesta) {
           for (var key in respuesta){
               var img="img/";
               if(respuesta[key].dir == "n"){
                img += "1.svg";
             }
             if(respuesta[key].dir == "s"){
                 img += "2.svg";
             }       
             if(respuesta[key].dir == "e"){
                 img += "3.svg";
             }       
             if(respuesta[key].dir== "o"){
                 img += "4.svg";
             }
            $("#lista_datos").append("<div class='dato'>"+respuesta[key].hora+
                                                        "<span class = 'temp'>Temperatura: "+ respuesta[key].temp+
                                                        "</span><span class= 'viento'>Viento: <img src="+img+">"+respuesta[key].fza+" Km/h"+
                                                        "</span><button class= 'destaco'>Destacar</button></div>");
           }

           $(".destaco").on("click",function(){
               $(".destaco").parent().removeClass("destacado");
               $(this).parent().addClass("destacado");
           });

        },

        error: function (xhr, status) {
            alert('Disculpe, existió un problema1');
        }
    });

}

function enviarFormulario(){
    var hoy = new Date();
    var hora=hoy.toLocaleTimeString();
    var fecha=hora;

    var objeto={fecha:dia,  
                dir:$(".icono:selected").val(),
                temp:$("#temp").val(), 
                fza:$("#fuerza").val(),
                fecha:dia,  
            };

                 console.log("Estoy entrando aqui?"+objeto);


   $.ajax({

        url: 'php/anyado_dato.php',

        type: 'POST',

        data: objeto,

        dataType: 'json',

        success: function (respuesta) {
            if(respuesta == true){
                var img="img/";
               if(respuesta[key].dir == "n"){
                img += "1.svg";
             }
             if(respuesta[key].dir == "s"){
                 img += "2.svg";
             }       
             if(respuesta[key].dir == "e"){
                 img += "3.svg";
             }       
             if(respuesta[key].dir== "o"){
                 img += "4.svg";
             }
             $("#lista_datos").append("<div class='dato'>"+fecha+
             "<span class = 'temp'>Temperatura: "+ objeto.temp+
             "</span><span class= 'viento'>Viento: <img src="+img+">"+objeto.fza+
             "</span><button class= 'destaco'>Destacar</button></div>");
                
            }else{
                alert("Algo ha salido mal, no se ha podido añadir el nuevo dato.");
            }
        },
        error: function (xhr, status) {
            alert('Disculpe, existió un problema1');
        }
    });
}




           