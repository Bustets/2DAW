
$.validator.setDefaults({
    submitHandler: function(){
        alert("Formulario enviado");
    }
});

$(document).ready(function(){
  listar_peliculas();
  $("#modal").hide();
    $("#abrir_modal").on("click", function(){
        $("#modal").show();
    });
    $("#cerrar_modal").on("click", function(){
        $("#modal").hide();
    });
    // PORQUÉ EN ESTE METE ESTE .ADDMETHOD EN EL READY FUNCTION Y PORQUÉ NO EN EL EXAMEN. ADEMÁS EN EL EXAMEN B NO HACE EL SETDEFAULTS
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
     }, "Value must not equal arg.");
    $("#peliculas").validate({
        rules: {
            titulo: {
                required: true
            },
            fecha: {
             required: true,
             digits: true,
             max:2019,
             },
             director: {
                 required: true,
                 minlength: 5
             },
             genero: { 
                 valueNotEquals: "" 
             },
             
         },
         messages: {
             titulo: {
                 required: "No puedes dejar titulo vacio",
             },
             fecha: {
                 required: "indica la fecha",
                 digits: "Introduce valores",
                 max: "Fecha minima 2019"
             },
             director: {
                 required: "No puedes dejar directro vacio",
                 minlength: "Tamaño minimo 5"
             },
             genero: { 
                 valueNotEquals: "Por favor selecciona un item!" 
             },
         },
         submitHandler: function(form){
             alert("Enviando!");  
             guardarPelicula(); 
         }
    });
});
function guardarPelicula(){
    var objeto_dato={
        titulo:$("#titulo").val(),
        anyo:$("#anyo").val(), 
        director:$("#director").val(),
        genero:$(".genero:selected").val(),
        actor1:$("#actor1").val(),
        actor2:$("#actor2").val(),
    };
    console.log(objeto_dato);
    $.ajax({                     //llamada asincrona ajax 
        url: "php/envio_pelicula.php",
        type: "POST",
        data: pelicula,
        dataType: "json"
    }).done(function(data){  // la respuesta json la almaceno en data
        if(data == "error" ){
            alert("Peli Nok" + data);
        }else{
            alert("Peli ok "  + data);
            $("#lista_pelis").append("<div  id= "+ data + ">"+pelicula.titulo+"</div>");
            $("#"+data).append("<span>"+pelicula.anyo+"</span><span>"+pelicula.director+"</span><span>"+pelicula.genero+"</span><span>"+pelicula.actor2+"</span><span>"+pelicula.actor1+"</span>");
            $("#"+data).on("click",function(){
                $(this).remove();
        });
        }                    
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
         console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });
}
function anyadirPelicula(){
    $("#enviar_pelicula").on("click", function(){
        // CAMBIANDO EL INPUT TYPE SUBMIT POR BUTTON FUNCIONA SINO NO
        console.log("mojama1");
        // Aqui quiero hacer el validate del form
    });
}
function listar_peliculas(){
    
    $.ajax({
        // la URL para la petición
        url : 'php/listo_peliculas.php',
        // especifica si será una petición POST o GET
        type : 'GET',
        // el tipo de información que se espera de respuesta
        dataType : 'json',
        // código a ejecutar si la petición es satisfactoria;
        // la respuesta es pasada como argumento a la función
        success : function(respuesta) {
            for(var i in respuesta){// for (i=0;i<respuesta.length;i++)
                console.log(respuesta[i]);
                // SI EL APPEND LO HAGO CON UNA CLASE EN VEZ DE UNA ID NO FUNCIONA, PORQUÉ??
                $("#lista_pelis").append("<div  id=" + respuesta[i].id+ ">" +"</div>");
                $("#" + respuesta[i].id).append("<span>" + respuesta[i].titulo+ "</span>");
                $("#" + respuesta[i].id).append("<span>" + respuesta[i].anyo+ "</span>");
                $("#" + respuesta[i].id).append("<span>" + respuesta[i].director+ "</span>");
                $("#" + respuesta[i].id).append("<span>" + respuesta[i].genero+ "</span>");
                for(var j = 0 ; j<respuesta[i].actores.length ; j++){
                    $("#" + respuesta[i].id).append("<span>" + respuesta[i].actores[j]+ "</span>");
                }
                $("#" + respuesta[i].id).on("click", function(){
                    console.log("Cola de vaca");
                    borrar_pelicula($(this).attr("id"));
                    $(this).remove();
                });
            }
           
        },
    
        // código a ejecutar si la petición falla;
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    
    });
};
function borrar_pelicula(id_recibido){
    var objeto_id= {
        id:id_recibido,
    }
    $.ajax({

        url: "php/borro_pelicula.php",
        type:"POST",
        dataType:"json",
        data: objeto_id,

    }).done(function(respuesta){
           console.log(respuesta);
            if(respuesta){
                alert("La peli" + id_recibido + " ha sido borrado");
               
            }else{
               alert("Error al borrar")
           } 
        }).fail(function( jqXHR, textStatus, errorThrown ) {
           console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
        });
};