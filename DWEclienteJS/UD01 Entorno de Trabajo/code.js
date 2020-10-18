
var tablero = new Array;
tablero[0] = ["_","_","_"];
tablero[1] = ["_","0","_"];
tablero[2] = ["_","_","_"];

console.log(tablero);
function pinto_tablero(){
    
    for(i=0; i<=tablero.length; i++){
        for(j=0; j<=tablero.length; j++){
            var id_casilla="casilla_"+i+j;
            document.getElementById(id_casilla).value=tablero[i][j];
            
        }
    }
}
function leoTablero(){
    //leer todos los valores de los imputs y meterlos en tableros
    for(i=0; i<=tablero.length; i++){
        for(j=0; j<=tablero.length; j++){
        var id_casilla="casilla_"+i+j;
        tablero[i][j]=document.getElementById(id_casilla).value;

        if((tablero[i][j]!="0")&&(tablero[i][j]!="_")){
            tablero[i][j]="x";
        }

    comprobarGanador();
    tiradaMaquina();
        }
    }
}

function tiradaMaquina(){
    //aleatorio para añadir 0

    jugada_x = Math.floor(Math.random()*3);
    jugada_y = Math.floor(Math.random()*3);

    if(tablero[jugada_x][jugada_y]="_"){
        tablero[jugada_x][jugada_y]="0";
        pinto_tablero();
    }else{
        tiradaMaquina();
        console.log(tablero);//comprobar que este bien
    }
}

function comprobarGanador(){
    //comprobar si hay condiciones de victoria
    //Revisar el codigo para que coincida con las casillas:
    if((tablero[0][0]==tablero[1][0])&&(tablero[1][0]==tablero[2][0])&&(tablero[0][0]!="_")){
        alert("Has ganado");
        location.reload();
    }
    if((tablero[0][1]==tablero[1][1])&&(tablero[1][1]==tablero[2][1])&&(tablero[0][1]!="_")){
        alert("Has ganado");
        location.reload();
    }
    if((tablero[0][2]==tablero[1][2])&&(tablero[1][2]==tablero[2][2])&&(tablero[0][2]!="_")){
        alert("Has ganado");
        location.reload();
    }
    if((tablero[1][0]==tablero[1][1])&&(tablero[1][1]==tablero[1][2])&&(tablero[1][0]!="_")){
        alert("Has ganado");
        location.reload();
    }//hasta aqui bien
    if((tablero[1][1]==tablero[1][2])&&(tablero[1][2]==tablero[2][2])&&(tablero[0][2]!="_")){
        alert("Has ganado");
        location.reload();
    }
    if((tablero[1][2]==tablero[1][2])&&(tablero[1][2]==tablero[2][2])&&(tablero[0][2]!="_")){
        alert("Has ganado");
        location.reload();
    }
    if((tablero[2][0]==tablero[1][2])&&(tablero[1][2]==tablero[2][2])&&(tablero[0][2]!="_")){
        alert("Has ganado");
        location.reload();
    }
    if((tablero[2][1]==tablero[1][2])&&(tablero[1][2]==tablero[2][2])&&(tablero[0][2]!="_")){
        alert("Has ganado");
        location.reload();
    }
    if((tablero[2][2]==tablero[1][2])&&(tablero[1][2]==tablero[2][2])&&(tablero[0][2]!="_")){
        alert("Has ganado");
        location.reload();
    }
}