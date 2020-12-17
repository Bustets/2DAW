window.onload=function(){
  var boton_enviar=document.getElementById("enviar");
  boton_enviar.addEventListener("click",function(evento){validarFormulario(evento)});
  
}; //del window onload

function validarFormulario(evento){

    evento.preventDefault();///NO hagas lo que sueles hacer con este evento 

    var form_of=true
    ///validar campos ---> form_ok=false
    var txtNombre = document.getElementById('nombre').value;

    if(txtNombre == null || txtNombre.length == 0){
        alert("ERROR: El nombre no puede estar vacio");
        form_ok == false;
    }

    var txtEdad=document.getElementById('edad').value;

    if (txtEdad == null || txtEdad.length == 0 ) {
        alert("ERROR: La edad no puede estar vacio");
        form_ok == false;
    }
    else if(txtEdad < 0 || txtEdad > 100){
        alert("ERROR: La edad es incorrecta, tiene que estar entre 0 y 100");
        form_ok == false;
    }

    var txtEmail = document.getElementById('correo').value;

    if(!(/\S+@\S+\.\S+/.test(txtEmail))) {
        alert("ERROR: Debe escribir un correo valido");
        form_ok == false;
      }

    var txtUsuario = document.getElementById('usuario').value;

    if(txtUsuario == null || txtNombre.length == 0){
        alert("ERROR: El usuario no puede estar vacio");
        form_ok == false;
    }

    //var fecha = document.getElementById('').value;



    var chkEstado = document.getElementById('').value;

    if (!chkEstado.checked) {
        alert("debe seleccionar el chekbox");
        form_ok == false;
    }

    //mirar el valiar de chk booton 

    var rbtEstado = document.getElementById().value;
    
    //da fallo no se porque 
   // if (var i=0; i < rbtEstado.length; i++) {
   //     if(rbtEstado[i].checked){
   //         banderaRBTN = true;
   //     }
   // }

    if (!banderaRBTN) {
        alert("ERROR: Debe elegir una opcion de radio button");
        form_ok=false;
    }



    console.log(form_ok);


    if(form_ok){
        alert ("Datos OK");
        var formulario=document.getElementById("formulario");
        formulario.submit();
    } // del if

} //de la funcion