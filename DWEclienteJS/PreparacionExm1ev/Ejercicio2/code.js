$(document).ready(function(){

    console.log("juary ok");

    cargo_preguntas() // cargo preguntas

    $("#ok").on("click", function(){ // si ok 
        compruebo_preguntas(); // compruebo preguntas
        clearTimeout(temporizador); //paro temporizador
    });
    $("#borrar").on("click",function(){ // borrar todo
        $("#preguntas").html(""); // impio articles
        $("#acertadas").html(""); // 
        cargo_preguntas(); // cargo preguntas de nuevo
    });
    var temp=0;
    var temporizador = setInterval(function(){ // creo el temporizador
    temp++;
    $("#tiempo").html("Tiempo : " + temp);
    },100);

});


function cargo_preguntas(){

    ///llamada ajax, recojo preguntas.json

    $.ajax({
        url: "preguntas.json",
        type: "POST",
        dataType: "json",
    })
    .done(function(datos){

        for(i=0; i<datos.preguntas.length; i++){ // añado un id para cambiar color
            $("#preguntas").append("<div id='pregunta"+i+"'> "+ datos.preguntas[i].pregunta + "</div>"); 
            $.each(datos.preguntas[i].respuesta, function(key, value){ // itero por clave valor
                var radio= "<input type = 'radio' class='respuesta"+i+"' name= 'respuesta "+i+" ' value='"+key+"'>"+key+"=" + value +" </input>";
                $("#preguntas").append(radio);// añado una clase 
            });
        }
    
        //con la respuesta itero
    //el json para montar la pgrunta + radio buttons de respuesta

    })
    .fail(function(jqXHR, textStatus, errorThrown){
        console.log("ERROR")
    })
    
}

function compruebo_preguntas(){

    $.ajax({
        url: "preguntas.json",
        type: "POST",
        dataType: "json",
    })
    .done(function(datos){
        var correctas = 0;
        for(i=0; i<datos.preguntas.length; i++){
            var correcta = datos.preguntas[i].correcta; // correcta
            var elegida = ($(".respuesta"+i+":checked").val());
            if (correcta == elegida){
                $("#pregunta"+i).css({"background-color" : "green"});
                correctas++;
            }else{
                $("#pregunta"+i).css({"background-color" : "red"});
            }
        };
        $("#acertadas").html("Acertadas : " + correctas);
        
        //determinar que ha elegido el usuario
        //comparar con el correcto
        //si es correcto --> verde, si no  --> rojo

    })
    .fail(function(jqXHR, textStatus, errorThrown){
        console.log("ERROR")
    });
}