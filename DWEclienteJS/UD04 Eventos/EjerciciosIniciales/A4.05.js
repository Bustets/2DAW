function cambiarColor(){
    document.body.bgColor="rgb("+numneroAleatorio(0,255)+","+numneroAleatorio(0,255)+","+numneroAleatorio(0,255)+")";
}

function numeroAleatorio(min,max){
    return Math.floor(Math.random()*(max-min)+min);
}
document.ondblclick=cambiarColor;