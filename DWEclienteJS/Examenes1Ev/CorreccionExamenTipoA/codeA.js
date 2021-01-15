$.validator.setDefaults({
    submitHandler: function(form) {
        alert("Enviando!");
        guardarPelicula();
    }
});
$(document).ready(function(){
    console.log("jquery ok");
    pintoPeliculas();

    $('#abrir_modal').on("click", function(){
        $('#modal').show();
    });
    $('#cerrar_modal').on("click",function(){
        $('#modal').hide();
    });

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
        genero: { valueNotEquals: "" }
        
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
        genero: { valueNotEquals: "Por favor selecciona un item!" }
    },
    submitHandler: function(form){
        alert("Enviando!");  
        guardarPelicula(); 
    }
        
})


});
function guardarPelicula(){

    var pelicula = { titulo:$("#titulo").val(),
                     anyo:$("#anyo").val(),
                     director:$("#director").val(),
                     genero:$(".genero:selected").val(),
                     actor1:$("#actor1").val(),
                     actor2:$("#actor2").val()
                    };

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
function pintoPeliculas(){
    console.log("ok");
    $.ajax({
        url:"php/listo_peliculas.php", // no paso ningun dato, solo recojo
        type:"POST",
        dataType:"json",
    }).done(function(peliculas){

    for(var i=0; i<peliculas.length; i++){
        $("#lista_pelis").append("<div  id= "+ peliculas[i].id + ">"+peliculas[i].titulo+"</div>");
        $("#"+peliculas[i].id).append("<span>"+peliculas[i].anyo+"</span><span>"+peliculas[i].director+"</span><span>"+peliculas[i].genero+"</span></div>");
       for(var j=0; j<peliculas[i].actores.length; j++){
            $("#"+peliculas[i].id).append("<span>"+peliculas[i].actores[j]+"</span>");
        }
        $("#"+peliculas[i].id).on("click",function(){
                borro_peli($(this).attr("id"));
                $(this).remove();


        });
    }
    }).fail(function( jqXHR, textStatus, errorThrown ) {
    console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });
}
function borro_peli(id){
    var peli_borrar = { id: id }
    $.ajax({
        url:"php/borro_pelicula.php", // no paso ningun dato, solo recojo
        type:"POST",
        data: peli_borrar,
        dataType:"json",
    }).done(function(respuesta){
        alert("He borrado peli con id :"+id);
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
    console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });
}

