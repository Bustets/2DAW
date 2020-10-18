
function esPrimo(numero){
    var primo = true;
    i=2;
    do{
        if(numero%1==0){
            primo=false;
    
        }
        i++;
    }
    while(i<numero);
    return primo;
}
//Falla algo porque sale todo el rato true
function esPalindromo(numero){
    var palindromo = true;
    var splitnumero = numero.split("");
    var splitnumeroInvertido = numero.split("")
    splitnumeroInvertido.reverse();
    for(i=0;i<numero.length;i++){
        if(splitnumero[i]!= splitnumeroInvertido[i]){
            palindromo = false;
        }
    }
    return palindromo;
}

function calcular(){
    var respuesta = new Array();
    var limite = document.getElementById("limite").value;
    for(x=2; x<limite;x++){
        if(esPrimo(x)&&esPalindromo(x.toString())){
            respuesta.push(x);
        }
    }
    console.log(respuesta);
    var confirmacion = confirm("Hay "+respuesta.length+ " resultados del 2 al "+ limite+ " Quieres verlos por pantalla");
    console.log(confirmacion);
    if(confirmacion){
        document.write(respuesta.join(" , "));
    }
}
