$.validator.addMethod("max_preferencias", function(value, element, arg){
     
    var numero_preferencias=parseInt($(".preferencia1:checked").val());
    numero_preferencias+=parseInt($(".preferencia2:checked").val());
    numero_preferencias+=parseInt($(".preferencia3:checked").val());
    if(numero_preferencias > arg){
        return false;
    }else{
        return true;
    }    
}, "Mas de 5 estrellas.");

$(document).ready(function(){
    console.log("jquery ok");
    pinto_cartas();
    $('#abrir_modal').on("click", function(){
        $('#modal_nueva_carta').show();
    });
    $('#cerrar_modal').on("click",function(){
        $('#modal_nueva_carta').hide();
    });
    $("#carta").validate({
		rules: {
           regalo1: {
               required: true,
               maxlength: 20,
           },
           regalo2: {
                required: true,
                maxlength: 20,
            },
            regalo3: {
                required: true,
                maxlength: 20,
            },
            preferencia1: {
                required: true,
                max_preferencias: 5,
            },
            preferencia2: {
                required: true,
                max_preferencias: 5,
            },
            preferencia3: {
                required: true,
                max_preferencias: 5,
            },
        },
        messages: {  
            regalo1: {
                required: "Elije un regalo",
                maxlength: "Pide algo mas corto",
             },
             regalo2: {
                required: "Elije un regalo",
                maxlength: "Pide algo mas corto",
            },
            regalo3: {
                required: "Elije un regalo",
                maxlength: "Pide algo mas corto",
            },
            preferencia1: {
                required: "Elije una estrella",
                max_preferencias: "No puedes elegir mas de 5 estrellas",
            },
            preferencia2: {
                required: "Elije una estrella",
                max_preferencias: "No puedes elegir mas de 5 estrellas",
            },
            preferencia3: {
                required: "Elije una estrella",
                max_preferencias: "No puedes elegir mas de 5 estrellas",
            },

        },
        submitHandler: function(form){  
            alert("Enviando!");
            envio_carta();     }
    })
});

function envio_carta(){
        var hoy = new Date();
        var hora=hoy.toLocaleTimeString();
        var dia= hoy.toLocaleDateString();
        var fecha=hora+' '+dia;

        carta = {   //monto un objeto con los datos de la fila a insertar en la BD
            r1:$('#regalo1').val(),
            p1:$('.preferencia1:checked').val(),
            r2:$('#regalo2').val(),
            p2:$('.preferencia2:checked').val(),
            r3:$('#regalo3').val(),
            p3:$('.preferencia3:checked').val(),
            fecha:fecha,
        };

        console.log(carta);


    $.ajax({                     //llamada asincrona ajax 
		url: "php/envio_carta.php",
        type: "POST",
        data: carta,
		dataType: "json"
	}).done(function(data){  // la respuesta json la almaceno en data
        if(data){
            alert("Carta enviada "+carta.fecha+" correcta");
            var div_carta = "<div class='carta'> <input class='fecha_carta' type='hidden' value="+carta.fecha+">";
            div_carta += carta.r1;
            switch(carta.p1){
                case '1':
                        div_carta += " - *";
                    break;
                case '2':
                        div_carta += " - **";
                    break;
                case '3':
                        div_carta += " - ***";
                    break;
            }
            div_carta +=  " - " +carta.r2;
            switch(carta.p2){
                case '1':
                        div_carta += " - *";
                    break;
                case '2':
                        div_carta += " - **";
                    break;
                case '3':
                        div_carta += " - ***";
                    break;
            }
            div_carta += " - " + carta.r3;
            switch(carta.p3){
                case '1':
                        div_carta += " - *";
                    break;
                case '2':
                        div_carta += " - **";
                    break;
                case '3':
                        div_carta += " - ***";
                    break;
            }
            
            div_carta += "</div>";
            $("#cartas").append(div_carta);
            $(".carta").on("mouseenter",function(){
                var fecha= $(this).find(".fecha_carta").val();
                $("#fecha").text(fecha);
            });
            $(".carta").on("mouseleave",function(){
            $("#fecha").text("");
            });

        }else{
            alert("Carta enviada "+carta.fecha+" incorrecto");
        }
								
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
         console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
	});

    }
function pinto_cartas(){
        $("#cartas").html("");
        $.ajax({
            url:"php/listo_cartas.php", // no paso ningun dato, solo recojo
            type:"POST",
            dataType:"json",
        }).done(function(array_cartas){
            for(var i in array_cartas){
                var div_carta = "<div class='carta'> <input class='fecha_carta' type='hidden' value="+array_cartas[i].fecha+">";
                div_carta += array_cartas[i].regalo1;
                switch(array_cartas[i].estrellas1){
                    case 1:
                            div_carta += " - *";
                        break;
                    case 2:
                            div_carta += " - **";
                        break;
                    case 3:
                            div_carta += " - ***";
                        break;
                }
                div_carta +=  " - " +array_cartas[i].regalo2;
                switch(array_cartas[i].estrellas2){
                    case 1:
                            div_carta += " - *";
                        break;
                    case 2:
                            div_carta += " - **";
                        break;
                    case 3:
                            div_carta += " - ***";
                        break;
                }
                div_carta += " - " + array_cartas[i].regalo3;
                switch(array_cartas[i].estrellas3){
                    case 1:
                            div_carta += " - *";
                        break;
                    case 2:
                            div_carta += " - **";
                        break;
                    case 3:
                            div_carta += " - ***";
                        break;
                }
                div_carta +=" - <button class='borrar'>Borrar</button> "
                div_carta += "</div>";
                $("#cartas").append(div_carta);
                $(".carta").on("mouseover",function(){
                    var fecha= $(this).find(".fecha_carta").val();
                    $("#fecha").text(fecha);
                });
                $(".borrar").on("click",function(){
                  $(this).parent().remove();
                });

                $(".carta").on("mouseleave",function(){
                $("#fecha").text("");
                });
             }
        }).fail(function( jqXHR, textStatus, errorThrown ) {
            console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
        });
    }       
