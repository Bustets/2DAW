function anadoFila(){
    var tabla_body = document.getElementById("cuerpo");

    var nombre = document.getElementById("producto").value;
    var cantidad = document.getElementById("cantidad").value;
    var precio_u = document.getElementById("precio").value;
    var precio_total = cantidad * precio_u;
    //falta algo 


    var fila = document.createElement("tr");

    var col1 = document.createElement("td");
    var col2 = document.createElement("td");
    var col3 = document.createElement("td");
    var col4 = document.createElement("td");
    var col5 = document.createElement("td");

    col1.innerHTML = nombre;
    col2.innerHTML = cantidad;
    col3.innerHTML = precio_u;
    col4.innerHTML = precio_total;
    col4.setAttribute("class","precio_total");

    fila.appendChild(col1);
    fila.appendChild(col2);
    fila.appendChild(col3);
    fila.appendChild(col4);
    tabla_body.appendChild(fila);
    calculoTotal();

}
function calculoTotal(){

    var precioTotales = document.getElementsByClassName("precio_total");
    var base=0;
    for(i=0; i<precioTotales.length; i++){

        base+=parseFloat(precioTotales[i].innerHTML);
    }

    document.getElementById("base").innerHTML = base;
}

function calcularIVA(){
    
}
