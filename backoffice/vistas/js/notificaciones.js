
$(".mensaje").click(function(){

	idMensaje = $(this).attr("idMensaje");

	var datos = new FormData();
	datos.append("mensajeVisualizar", idMensaje);

	$.ajax({

		url:"ajax/notificaciones.ajax.php",
		method: "POST",
		data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    success:function(respuesta){


	    }

	})


});





