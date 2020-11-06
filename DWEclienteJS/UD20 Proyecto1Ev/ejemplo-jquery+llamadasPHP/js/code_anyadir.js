window.onload = function () {
    $("#anyadir").click(function(){
        anyadir_dato();
    });
}

function anyadir_dato(){
    var objeto_dato = {   //monto un objeto con los datos de la fila a insertar en la BD
            nombre:$('#nombre').val(),
            apellido:$('#apellido').val(),
            edad:$('#edad').val()
            };
    console.log(objeto_dato)
    
    $.ajax({
        url:"PHP/anyadir_dato.php",
        type:"POST",
        data: objeto_dato, // paso el dato por el post
        dataType:"json",
    }).done(function(respuesta){
        console.log(respuesta);  // recojo la respuesta, que sera true o false
       if(respuesta){
            alert("Dato insertado correctamente !!!!");//si es correcta, inserto los datos en una fila nueva
            $("#lista").append("<tr><td>"+objeto_dato.nombre+"</td><td>"+objeto_dato.apellido+"</td><td>"+objeto_dato.edad+"</td></tr>");
        }else{ 
            alert("Error en la insercion"); //si no es correcta no inserto nada
        } 
    }).fail(function( jqXHR, textStatus, errorThrown ) {
        console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });
    ;

}
