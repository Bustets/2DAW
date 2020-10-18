function crear_ventana(x,y){

    var opciones = "width=400 height=400, toolbar=0, scrollbars=0, left"+x+"top"+y;
    var ventana = window.open("http://iesconselleria.edu.gva.es/","",opciones);
    return ventana;
}
var ventana_cerrar = crear_ventana(0,0);
setTimeout("cerrarVentana()", 3000);

for(i=0; i<2; i++){
    var alea1 = Math.floor(Math.random()*600);
    var alea2 = Math.floor(Math.random()*400);
    crear_ventana(alea1,alea2);
}

function cerrarVentana(){
    ventana_cerrar.close();
}