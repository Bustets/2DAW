function inicio(){
    document.getElementById("Comenzar").onclick=iniciarSaludos;
    document.getElementById("Parar").onclick=pararSaludos;
}

var estado = 0;

function iniciarSaludos(){
    if(estado == 0){
    estado = setInterval("alert('Hola')",5000);
    }else{
    alert("Ya hay un saludo en marcha");
    }
}


function pararSaludos(){
    if(estado == 0){
        alert("Nop hay nada que parar")
    }else{
        clearInterval(estado);
        estado = 0;
    }
}


