
var tablero = new Array("_","_","_","_","_","_","_","_","_");

for(celda in tablero){
    var nodo = document.createElement("img"); 
    nodo.setAttribute("src", "_.png");
    nodo.setAttribute("width", "256");
    nodo.setAttribute("height", "256");
    document.getElementById(celda).appendChild(nodo);
}
