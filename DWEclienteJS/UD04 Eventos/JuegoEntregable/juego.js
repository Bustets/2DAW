var circuloActivo = 10;//Numero distino al que se va a generar la primera vez. 
var intervalo = 3000;
var refTimeOut;
var tiempo = 0;
var refCronometro;

function init(){
    
    circuloActivo = circuloRandom();

    document.getElementById(circuloActivo).className="objetivo";
    document.getElementById(circuloActivo).addEventListener("click", cambioCirculo);
    document.getElementById("cronometro").innerHTML=tiempo;
 
}

function cambioCirculo(){
    
    if(tiempo == 0){
       refCronometro = window.setInterval(cronometro, 1000);
    }
    window.clearTimeout(refTimeOut);
    refTimeOut = window.setTimeout(gameOver, intervalo);
    document.getElementsByClassName("objetivo")[0].removeEventListener("click", cambioCirculo);//Primero quito el evento y luego quito la clase.
    document.getElementsByClassName("objetivo")[0].className="";
    //Recupero todos los nodos con la clase "objetivo", accedo al 1º elemento del array y lo pongo vacío, eliminado así la clase.  
    circuloActivo = circuloRandom();
    document.getElementById(circuloActivo).className="objetivo";
    document.getElementById(circuloActivo).addEventListener("click", cambioCirculo);

}
function cronometro(){

    tiempo++;
    document.getElementById("cronometro").innerHTML=tiempo;
}

function gameOver(){
    
    document.getElementsByClassName("objetivo")[0].removeEventListener("click", cambioCirculo);
    window.clearInterval(refCronometro);
    alert("Pasaron" +intervalo/1000+"s, GAME OVER");

}

function circuloRandom(){

    do{
        var id = Math.floor(Math.random()*9);
    }while(id==circuloActivo);
    var circulo = ("circulo_"+id);
    return circulo;

}