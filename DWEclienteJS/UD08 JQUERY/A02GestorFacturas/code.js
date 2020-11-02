$(document).ready(function(){
    console.log("jquery ok");

    relleno_select();

    $("#productos").change(function(){
        var producto_sel=$("#producto :selected)".val());
        $("#puni").text(producto_sel);

    });
    $("#anyadir").click(function(){

        $("tabla tbody").append("<tr><td>"+$("#producto :selected").text()+"</td><td class='precio_fila'>"+$("#cantidad").val()+"</td><td>"+$("#puni").val()+"</td><td>"
        +($("#cantidad").val()*$("#puni").val())+"</td><td><button class='borrar'</td></tr>");

        $(".borrar").click(function(){
            $(this).parent().parent().remuve();
            recalcular();
        });

        recalcular();

    });


});

function recalcular(){
    var base = 0;
    $(".precio_fila").each(function(){
        base+=parseFloat($(this).text());
    });

    $("#base").text(base);
    $("#iva").text(base*(0.21));
    $("#total").text(base*(1.25));//no esta bien


}

function relleno_select(){

    $.ajax({
        // la URL para la petición
        url : 'productos.json',
    
        // especifica si será una petición POST o GET
        type : 'POST',
    
        // el tipo de información que se espera de respuesta
        dataType : 'json',
    
        // código a ejecutar si la petición es satisfactoria;
        // la respuesta es pasada como argumento a la función
        success : function(datos) {
            for(i=0; i<datos.productos.length;i++){
            $("#producto").append("<option value= '"+datos.productos[i].precio+"'>"+datos.productos[i].name+"</option>");
            }
        },
    
        // código a ejecutar si la petición falla;
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    
        // código a ejecutar sin importar si la petición falló o no
        complete : function(xhr, status) {
            alert('Petición realizada');
        }
    });

}