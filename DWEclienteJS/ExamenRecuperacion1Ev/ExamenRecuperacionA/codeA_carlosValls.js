$(document).ready(function(){
    console.log("jquery ok");
    $("#a_modal").on("click", function(){
        $("#modal").show();
    })
    $("#c_modal").on("click", function(){
        $("#modal").hide();
    })
    listar_Municipios();
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
            enviarMunicipio(); 
        }
            
    })
});
function enviarMunicipio(){
    var hoy = new Date();
    var hora=hoy.toLocaleTimeString();
    var dia= hoy.toLocaleDateString();
    var fecha=hora+' '+dia;

    var municipio = {
    n:$("#municipio").val(),
    c:$('.icono:selected').val(),
    fecha:fecha,
    max:$("#max").val(),
    min:$("#min").val(),
   };

   console.log(municipio);
   $.ajax({
    type:"post",
    dataType:"json",
    url:"php/anyado_municipio.php",
    data : municipio,
  }).done(function(datos){  
      if(datos=="error"){
        alert("Datos incorrectos" + datos);
       
      }else{
            
        alert("Datos correctos "  + datos);
        var divNuevo="<div class= 'municipio'>";
        divNuevo+=municipio.fecha+ " - " + municipio.n;
        if(municipio.c == 0){
          divNuevo+="<img src='img/sol.png'>";
      }
      if(municipio.c == 1){
          divNuevo+="<img src='img/nubes.png'>";
      }       
      if(municipio.c == 2){
          divNuevo+= "<img src='img/lluvia.png'>";
      }       
      if(municipio.c== 3){
          divNuevo+="<img src='img/nieve.png'>";
      }
      divNuevo+="<span class='max'>Max: "+ municipio.max+ "</span>";
      divNuevo+="<span class='min'>Max: "+ municipio.min+ "</span>";
      divNuevo+="</div>";
        $("#municipios").append(divNuevo);
        $(".municipio").on("click", function(){
         
          $(this).addClass("destacado");


      });
      }
  }).fail(function( jqXHR, textStatus, errorThrown ) {
     console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
   });
}
function listar_Municipios(){
    $.ajax({
        url:"php/listo_municipio.php", // no paso ningun dato, solo recojo
        type:"POST",
        dataType:"json",
    }).done(function(respuesta){

    
        console.log(respuesta)
        
        for(var i=0; i<respuesta.length; i++){

            var divMunicipio= "<div class='municipio'> ";
            divMunicipio+= respuesta[i].fecha+ " - " + respuesta[i].n ;
        if(respuesta[i].c == 0){
            divMunicipio+="<img src='img/sol.png'>";
        }
        if(respuesta[i].c == 1){
            divMunicipio+="<img src='img/nubes.png'>";
        }       
        if(respuesta[i].c == 2){
            divMunicipio+= "<img src='img/lluvia.png'>";
        }       
        if(respuesta[i].c == 3){
            divMunicipio+="<img src='img/nieve.png'>";
        }
         divMunicipio+="<span class='max'>Max: "+ respuesta[i].max+ "</span>";
         divMunicipio+="<span class='min'>Max: "+ respuesta[i].min+ "</span>";
         divMunicipio+="</div>";
       
         $("#municipios").append(divMunicipio);
        
         $(".municipio").on("click", function(){
           
            $(this).addClass("destacado");
//      FALTA REMOVER LQA CLASE DEL ANTERIOR DIV

        });

     
    }
 
    
    }).fail(function( jqXHR, textStatus, errorThrown ) {
    console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);
    });
}