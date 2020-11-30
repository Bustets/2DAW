$(document).ready(function(){

    $("#formulario").validate({

        rules: {
            nombre: {
                required: true,
            },
            edad:{
                required:true,
                max: 100,
                min: 18
            }
        },//fin rules
        messages: {
            nombre: {
                required: "Dime tu nombre",
            },
            edad: {
                required:"Añade una edad",
                max: "Demasiado alto",
                min: "Demasiado bajo"
            }
        }//Fin messages

    });//fin validate 
});

$.validator.setDefaults({
    submitHandler: function() { alert ("Enviado")}
});