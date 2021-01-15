$(document).ready(function () {

   listarMunicipios();

   $("#a_modal").on("click",function(){
    $("#modal").show();
    });
    $("#c_modal").on("click",function(){
    $("#modal").hide();
    });
    $("#cielo").on("change",function(){///esto es una puta mierda ejer numero 5 
         var valor = $(".icono").val();
    });

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
     }, "Value must not equal arg.");
     $.validator.addMethod("TemperaturaMEnor", function(value, element, arg){
     
        var temperaturaMax=$("#max").val();
        
        if(arg>temperaturaMax  ){
            return false;
        }else{
            return true;
        }    
    }, "Temperatura Inferior");  
    $("#municipio_form").validate({
        rules:{
            nombre:{
                required: true,
                maxlength: 20,
            },
            cielo:{
                valueNotEquals: "nada",
                
            },
            maxima:{
                required: true,
                max: 50,
                TemperaturaMEnor: $("#min").val(), 
            },
            minima:{
                required: true,
                min: -40,
            },
        },
        messages:{
            nombre:{
                required: "Introduzca un nombre",
            },
            cielo:{
                valueNotEquals: "Por favor selecciona un item!",
            },
            maxima:{
                required: "Introduzca una temperatura", 
                max: "La temperatura no puede superar a 50ºC",
                TemperaturaMEnor: "La temperatura ha de ser mayor que la minima",
            },
            minima:{
                required: "Introduzca una temperatura",
                max: "La temperatura no puede superar a -40ºC",
            },
        },
        submitHandler: function(form){
            alert("Enviando!");  
            enviarFormulario(); 
        }
            
    })

 

});

function listarMunicipios(){

    $.ajax({

        url: 'php/listo_municipio.php',

        type: 'POST',

        dataType: 'json',

        success: function (respuesta) {
           for (var key in respuesta){
               var img="img/";
               switch(respuesta[key].c){
                    case 0:
                        img = img.concat("sol.png");
                        break;
                    case 1:
                        img = img.concat("nubes.png");
                        break;
                    case 2:
                        img = img.concat("lluvia.png");
                        break;
                    case 3:
                        img = img.concat("nieve.png");
                        break;
               }
            $("#municipios").append("<div class='municipio'>"+respuesta[key].fecha+" - "+respuesta[key].n+"<img src="+img+"><span class = 'max'> Max:"+respuesta[key].max+"</span><span class = 'min'> Min:"+respuesta[key].min+"</span></div>");
           }

           $(".municipio").on("click",function(){
               $(".municipio").removeClass("destacado");
               $(this).addClass("destacado");
           });

        },

        error: function (xhr, status) {
            alert('Disculpe, existió un problema1');
        }
    });

}


function enviarFormulario(){
    console.log("Yadira es Amable y Buena persona");
    var hoy = new Date();
        var dia= hoy.toLocaleDateString();

    var objeto={n:$("#municipio").val(),  
                c:$(".icono:selected").val(),
                fecha:dia,  
                max:$("#max").val(), 
                min:$("#min").val(),
            };

                 console.log(objeto);


   $.ajax({

        url: 'php/anyado_municipio.php',

        type: 'POST',

        data: objeto,

        dataType: 'json',

        success: function (respuesta) {
            if(respuesta == true){
                var img="img/";
                if(objeto.c == 0){
                   img += "sol.png";
                }
                if(objeto.c == 1){
                    img += "nubes.png";
                }       
                if(objeto.c == 2){
                    img += "lluvia.png";
                }       
                if(objeto.c== 3){
                    img += "nieve.png";
                }
                $("#municipios").append("<div class='municipio'>"+objeto.fecha+" - "+objeto.n+"<img src="+img+"><span class = 'max'> Max:"+objeto.max+"</span><span class = 'min'> Min:"+objeto.min+"</span></div>");
                
            }else{
                alert("Algo ha salido mal, no se ha podido añadir la nueva pelicula.");
            }
        },
        error: function (xhr, status) {
            alert('Disculpe, existió un problema1');
        }
    });
}