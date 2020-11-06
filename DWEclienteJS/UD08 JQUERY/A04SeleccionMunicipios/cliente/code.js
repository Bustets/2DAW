$(document).ready(function(){
/////ajax inicial cargo select de provincias
    $.ajax({

        url : '../servidor/cargaProvinciasJSON.php',

        type : 'POST',
    
        dataType : 'json',
    
        success : function(respuesta){
            for(var key in respuesta){
            
                $("#provincias").append("<option value='"+key+"'>"+respuesta[key]+"</option>");

            }
        },
    
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });

/////cuando eligio provincia pasa esto 

    $("#provincias").change(function(){// cuando "Change" ---> llmada a aJAX

        var codigo_provincia = $("#provincias option:selected").val();
        var dato_enviar = {"provincia" : codigo_provincia};

        $.ajax({

            url : '../servidor/cargaMunicipiosJSON.php',
            
            type : 'POST',
            
            data: dato_enviar,
            
            dataType : 'json',
        
            success : function(respuesta){
               
                for(var key in respuesta){
                    $("#municipio").append("<option value='"+key+"'>"+respuesta[key]+"</option>");
                }
            },
        
            error : function(xhr, status) {
                alert('Disculpe, existió un problema2');
            },
        });

    });//cierrra el change de provincia

    $("#municipio").change(function(){
        var nom_provincia = $("#provincias option:selected").text();
        var nom_municipio = $("#municipio option:selected").text();

        $("#seleccion").html("Provincia: "+nom_provincia+", Municipio: "+nom_municipio);

    });

});//del documento.redy