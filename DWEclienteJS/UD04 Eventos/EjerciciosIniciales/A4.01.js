

function mostrarPosicion(evento){
    document.getElementById("valorRaton").innerHTML="Posicion X:"+evento.clientX+"Posicion Y"+evento.clientY;//No es funcion si no un valor 
}
document.onmousemove=mostrarPosicion;