
function pintoTabla(){
var tabla = document.createElement("tabla");

for(i=0; i<100; i++){
    var fila = document.createElement("tr");
    for(j=0; j<100; j++){
        var celda=document.createElement("td");
        var texto=document.createTextNode("x");
        celda.appendChild(texto);
        celda.style.backgroundColor="Yellow"
        fila.appendChild(celda);

    }
    tabla.appendChild(fila);
}

document.body.appendChild(tabla);
}