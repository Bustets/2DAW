function insertar(){
    var nuevoElemento=document.createElement("UL");
    var texto=document.createTextNode(Math.random());
    nuevoElemento.appendChild(texto);
    document.getElementById("miLista").appendChild(nuevoElemento);
}