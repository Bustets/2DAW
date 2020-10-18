
var tablero = new Array("_","_","_","_","_","_","_","_","_");

function init() {
    for(celda in tablero){
        
        var nodo = document.createElement("img"); 
        nodo.setAttribute("src", "_.png");
        nodo.setAttribute("width", "256");
        nodo.setAttribute("height", "256");
        document.getElementById(celda).appendChild(nodo);
    }

    asignar(4,'o');

    start();

}


function asignar(casilla, valor) {
    
    tablero[casilla] = valor;
    document.getElementById(casilla).firstChild.src = valor+".png";
}

function start() {
    
}
