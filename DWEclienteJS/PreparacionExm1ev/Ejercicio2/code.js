$(document).ready(function(){

    console.log("juary ok");

    cargo_preguntas()

    $("#ok").on("click", function(){
        comprouebo_preguntas();
    });

});


function cargo_preguntas(){

    ///llamada ajax, recojo preguntas.json

    $.ajax({
        url: "preguntas.json",
        type: "POST",
        dataType: "json",
    })
    .done(function(datos){

        console.log(datos);
        for(i=0; i<datos.preguntas.length; i++){
            $("#preguntas").append("<div>"+ datos.preguntas[i].pregunta + "</div>");
            console.log(datos.preguntas[i].pregunta);
            $.each(datos.preguntas[i].respuesta, function(key, value){
                console.log("key : " +key+ "Value :"+ value);
                var radio= "<input type = 'radio' classe='respuesta"+i+"' name= 'respuesta "+i+" ' value='"+key+"'>"+key+"=" + value +" </input>";
                $("#preguntas").append(radio);
            });
        }
    
        //con la respuesta itero
    //el json para montar la pgrunta + radio buttons de respuesta

    })
    .fail(function(jqXHR, textStatus, errorThrown){
        console.log("ERROR")
    })
    
}

function comprouebo_preguntas(){

    $.ajax({
        url: "preguntas.json",
        type: "POST",
        dataType: "json",
    })
    .done(function(datos){

        for(i=0; i<datos.preguntas.length; i++){
            console.log(datos.preguntas[i].correcta);
            console.log($(".respuesta"+i+":checked").val());
        }
        
        //determinar que ha elegido el usuario
        //comparar con el correcto
        //si es correcto --> verde, si no  --> rojo

    })
    .fail(function(jqXHR, textStatus, errorThrown){
        console.log("ERROR")
    })
}