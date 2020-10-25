var circuloActivo = 10;//Numero distino al que se va a generar la primera vez. 
var intervalo = 3000;
var refTimeOut;
var tiempo = 0;
var refCronometro;
var clickContador = 0;
var nivel =0;

function init(){
    
    circuloActivo = circuloRandom();

    document.getElementById(circuloActivo).className="objetivo";
    document.getElementById(circuloActivo).addEventListener("click", cambioCirculo);
    document.getElementById("nivel").innerHTML="<p>Nivel: "+nivel+"</p></br><p>Intervalo: "+intervalo/1000+"</p>";
    document.getElementById("cronometro").innerHTML=tiempo;
 
}

function cambioCirculo(){
    clickContador++;
    if(tiempo == 0){
        refCronometro = setInterval(cronometro, 1000);
    }
    window.clearTimeout(refTimeOut);
    refTimeOut = window.setTimeout(gameOver, intervalo);
    nivelAvanced();//Primero que si tiene que actualizar el dato del intervalo o no. 
    document.getElementsByClassName("objetivo")[0].removeEventListener("click", cambioCirculo);//Primero quito el evento y luego quito la clase.
    document.getElementsByClassName("objetivo")[0].className="";
    //Recupero todos los nodos con la clase "objetivo", accedo al 1º elemento del array y lo pongo vacío, eliminado así la clase.  
    circuloActivo = circuloRandom();
    document.getElementById(circuloActivo).className="objetivo";
    document.getElementById(circuloActivo).addEventListener("click", cambioCirculo);

}
//Funcion para mejorar el programa;
function nivelAvanced(){
    var resto = clickContador % 5;//Se decide que sea un multiplo de 5.
    if(resto == 0){
        intervalo = intervalo - 500;
        nivel++;
        document.getElementById("nivel").innerHTML="<p>Nivel: "+nivel+"</p></br><p>Intervalo: "+intervalo/1000+"</p>";
    }

}

function cronometro(){

    tiempo++;
    document.getElementById("cronometro").innerHTML=tiempo;
}

function gameOver(){
    
    clearInterval(refCronometro);
    document.getElementsByClassName("objetivo")[0].removeEventListener("click", cambioCirculo);
    alert("Pasaron " +intervalo/1000+"s");
    alert("Tu tiempo de juego ha sido: "+tiempo);
    alert("GAME OVER");

}

function circuloRandom(){

    do{
        var id = Math.floor(Math.random()*9);
    }while(id==circuloActivo);
    var circulo = ("circulo_"+id);
    return circulo;

}