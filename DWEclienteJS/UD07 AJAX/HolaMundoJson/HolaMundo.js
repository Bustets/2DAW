function ajax(){
    var conexion = new XMLHttpRequest();
    conexion.onreadystatechange = function(){
        if (conexion.readyState == 4 && conexion.status == 200) {
            var respuesta= conexion.responseText;
            var objeto_respuesta = JSON.parse(respuesta);
            document.getElementById("respuesta").innerHTML=objeto_respuesta.message;
        }
    }
    conexion.open('GET', 'HolaMundo.json', true);
    conexion.send();
}