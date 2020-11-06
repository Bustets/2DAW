$(document).ready(function(){
	$("#caja-modal1").hide();
	$("#caja-modal2").hide();
	

	$("#ver-caja1").click(function(){
		$("#caja-modal1").show();
	})
	$("#ver-caja2").click(function(){
		$("#caja-modal2").show();
	})
	
	$("#ocultar-caja").click(function(){
		$("#caja-modal1").hide();
		$("#caja-modal2").hide();
	})

	


});


