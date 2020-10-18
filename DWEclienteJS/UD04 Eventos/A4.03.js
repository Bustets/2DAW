document.onkeydown=calcularDNI;

function calcularDNI(evento){
    for(i=0; i<=9999;i++){
        if(letraDNI(i)==evento.key.toUpperCase()){
            console.log(evento)
            document.getElementById("Resultado").innerHTML+=i+" ; ";
        }
    }
    
}
function letraDNI(numeroDni){
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
    return letras[numeroDni%23];
}




