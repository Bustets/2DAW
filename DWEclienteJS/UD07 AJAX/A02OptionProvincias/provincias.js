function funcion_ajax(){
    var conexion = new XMLHttpRequest();
    conexion.onreadystatechange = function(){
        if (conexion.readyState == 4 && conexion.status == 200) {
            var objetoRespuesta = JSON.parse(conexion.responseText);
            var miSelect  = document.createElement("select");
            for(var i in objetoRespuesta.provincias ){//hay un fallo
                var option_provincia = document.createElement("option");
                option_provincia.setAttribute("value", objetoRespuesta.provincias[i].cp);
                option_provincia.innerText = objetoRespuesta.provincias[i].nom;
                miSelect.appendChild(option_provincia);
            }

            miSelect.addEventListener("change", function(){
                console.log(select.options);
                //document.getElementById("cp").innerText = miSelect.options[this.selectedIndex].value; Una opcion al de la linea de abajo
                document.getElementById("cp").innerText =this.value;
            } );

            document.getElementById("contenido").appendChild(miSelect);

        }
    }
    conexion.open('GET', 'provincias.json', true);
    conexion.send();
}