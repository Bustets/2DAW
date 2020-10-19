
function pintoTabla(){
    var tabla = document.createElement("tabla");
    
    var numero = 1;
    for(i=0; i<20; i++){
        var fila = document.createElement("tr");
        for(j=0; j<20; j++){
            var celda=document.createElement("td");
            var texto=document.createTextNode(numero);
            celda.appendChild(texto);
            if(esCasiPrimo(numero)){
            celda.style.backgroundColor="Yellow"
            }
            fila.appendChild(celda);
            numero++;
    
        }
        tabla.appendChild(fila);
    }
    
    document.body.appendChild(tabla);
    }

    function esCasiPrimo(  n  ){
    
        var oportunidad=0;
        for(i=2;i<n;i++){
            if(n%i==0){
                oportunidad++;
                if(oportunidad>1){
                    return false;
                }
            }
        }
        
        if(oportunidad==1)
            return true;
        else
            return false;
    }