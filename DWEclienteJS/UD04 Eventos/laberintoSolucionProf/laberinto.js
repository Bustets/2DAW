function init(){
    document.getElementById("salida").addEventListener("mouseleave", inicio_juego); 
}

var tiempo= 0;

function inicio_juego(){
    console.log("inicio");

    document.getElementById("pared_0").addEventListener("mouseover", fallo);
    document.getElementById("pared_1").addEventListener("mouseover", fallo);
    document.getElementById("pared_2").addEventListener("mouseover", fallo);
    document.body.addEventListener("mouseleave", fallo);//Porque en este body es el mismo que id=tablero en el html
    document.getElementById("final").addEventListener("mouseover", victoria);
    var intervalo = setInterval(cronometro, 100);

}

function fallo(){
    alert("has fallado");
}

function victoria(){
    alert("Has tardado "+tiempo+" decimas de segundo");
    document.getElementById("pared_0").removeEventListener("mouseover", fallo);
    document.getElementById("pared_1").removeEventListener("mouseover", fallo);
    document.getElementById("pared_2").removeEventListener("mouseover", fallo);
    document.body.removeEventListener("mouseleave", fallo);//Porque en este body es el mismo que id=tablero en el html
    document.getElementById("final").removeEventListener("mouseover", victoria);
}

function cronometro(){

    tiempo++;

}