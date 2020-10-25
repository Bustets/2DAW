function init(){
    var circulo = circuloRandom()
    document.getElementById(circulo).className="objetivo";
    document.getElementById(circulo).addEventListener("click", juego);
}
function circuloRandom(){
    
    var random = Math.floor(Math.random()*8);
    var circuloRandom = ("circulo_"+random);

    return circuloRandom;
}
var contador =0;
function juego(){

    
    this.classList.remove("objetivo");
    this.removeEventListener("click", juego);
    var circulo = circuloRandom();
    document.getElementById(circulo).className="objetivo";
    contador++;
    document.getElementById(circulo).addEventListener("click", juego);


}