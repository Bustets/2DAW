
function creoChekbox(){

    for (i =10; i<100; i++){
    var chbx=document.createElement("input");
    var salto = document.createElement("br");
    chbx.type="checkbox";
    chbx.name="michbox";
    //chbx.value = 10;
    //chbx.checked=true;
    var etiqueta = document.createElement("label");
    var texto = document.createTextNode(Math.random());
    etiqueta.appendChild(texto);
    document.body.appendChild(salto);
    document.body.appendChild(chbx);
    document.body.appendChild(etiqueta);
    }
}

function todo(){
    var ckboxs = document.getElementsByTagName("input")
    console.log(ckboxs);
    for(i=0; i<ckboxs.length; i++){
        ckboxs[i].checked=true;
    }
}
function nada(){
    var ckboxs = document.getElementsByTagName("input")
    console.log(ckboxs);
    for(i=0; i<ckboxs.length; i++){
        ckboxs[i].checked=false;
    }
}