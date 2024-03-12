

/*=============================================
Invertir seleccionar transferencia y valor disponible
=============================================*/
$("#billeteras").on("change",function () {
	var seleccionado = $(this).val();

	var saldo_cop = $("#saldo_cop").val();

	if(seleccionado==1){

	$(".invertir_transferencia").html('<div class="form-group"><h3>Disponible - $'+saldo_cop+'</h3></h2></div>');

	}else if(seleccionado==3 && seleccionado!=""){

	$(".invertir_transferencia").html('<div class="form-group"><input id="registrarFotoComprobante" type="file" class="form-control-file border registrarFotoComprobante" name="registrarFotoComprobante" required><img id="previsualizarRegistrar" src="" class="img-thumbnail previsualizarRegistrar" width="100px"></div>');

	}else{
	  $(".invertir_transferencia").html("");
	}

	// if(seleccionado==4){
	// 	$("#registrarValor").css("display","none");
		
	// }
	

  
  })
  
/*=============================================
TABLA CAMPAÑAS
=============================================*/
var doc_usuario = $("#doc_usuario").val();

$("#tablaCampanas").DataTable({
	"ajax":"ajax/tabla-campanas.ajax.php?doc_usuario="+doc_usuario,
 	"deferRender": true,
  	"retrieve": true,
  	"processing": true,
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }

});




/*=============================================
TABLA CAMPAÑAS BONOS EXTRAS
=============================================*/
var doc_usuario = $("#doc_usuario").val();

$("#tablaCampanasBonosExtras").DataTable({
	"ajax":"ajax/tabla-campanas-bonos-extras.ajax.php?doc_usuario="+doc_usuario,
 	"deferRender": true,
  	"retrieve": true,
  	"processing": true,
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }

});



/*=============================================
TABLA CAMPAÑAS BONOS APALANCAMIENTO
=============================================*/

$("#tablaCampanasBonosApalancamiento").DataTable({
	"ajax":"ajax/tabla-campanas-bonos-apalancamiento.ajax.php?doc_usuario="+doc_usuario,
 	"deferRender": true,
  	"retrieve": true,
  	"processing": true,
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }

});


/*=============================================
TABLA CAMPAÑAS PUBLICIDAD
=============================================*/
var doc_usuario = $("#doc_usuario").val();

$("#tablaCampanasPublicidad").DataTable({
	"ajax":"ajax/tabla-campanas-publicidad.ajax.php?doc_usuario="+doc_usuario,
 	"deferRender": true,
  	"retrieve": true,
  	"processing": true,
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }

});



/*=============================================
TABLA CAMPAÑAS BONOS RECURRENCIA
=============================================*/

$("#tablaCampanasBonosRecurrencia").DataTable({
	"ajax":"ajax/tabla-campanas-bonos-recurrencia.ajax.php?doc_usuario="+doc_usuario,
 	"deferRender": true,
  	"retrieve": true,
  	"processing": true,
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }

});




/*=============================================
TABLA CAMPAÑAS BONOS AFILIADOS RECURRENCIA
=============================================*/

$("#tablaCampanasBonosAfiliados").DataTable({
	"ajax":"ajax/tabla-campanas-bonos-afiliados.ajax.php?doc_usuario="+doc_usuario,
 	"deferRender": true,
  	"retrieve": true,
  	"processing": true,
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }

});



/*=============================================
TABLA CAMPAÑAS BONOS Bienvenida
=============================================*/

$("#tablaCampanasBonosBienvenida").DataTable({
	"ajax":"ajax/tabla-campanas-bonos-bienvenida.ajax.php?doc_usuario="+doc_usuario,
 	"deferRender": true,
  	"retrieve": true,
  	"processing": true,
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }

});




/*=============================================
 CAMBIAR ESTADO CAMPAÑA
=============================================*/
$(".tablaCampanas tbody").on("change","select.selectActiva",function(){

	var idCampana = $(this).attr("idCampana");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("activarIdCampana", idCampana);
    datos.append("activarCampana", seleccionado);

  	$.ajax({

	  url:"ajax/campanas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		if(respuesta=="error"){

			swal.fire({

				icon: "warning",
				title: "¡ADVERTENCIA!",
				text: "El número de campañas activas debe ser mínimo 1 y máximo 3",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function(result){

				if(result.value){

					window.location="campanas";

				}


			});

		}

      }

  	})


})



/*=============================================
 CAMBIAR ESTADO CAMPAÑA
=============================================*/
$(".tablaCampanasBonosBienvenida tbody").on("change","select.selectActiva",function(){

	var idCampana = $(this).attr("idCampana");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("activarIdCampana", idCampana);
    datos.append("activarCampana", seleccionado);

  	$.ajax({

	  url:"ajax/campanas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})


})



/*=============================================
 CAMBIAR ESTADO CAMPAÑA PUBLICIDAD
=============================================*/
$(".tablaCampanasPublicidad tbody").on("change","select.selectActiva",function(){

	var idCampana = $(this).attr("idCampana");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("activarIdCampana", idCampana);
    datos.append("activarCampana", seleccionado);

  	$.ajax({

	  url:"ajax/campanas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})


})


/*=============================================
 CAMBIAR ESTADO CAMPAÑA BONOS EXTRAS
=============================================*/
$(".tablaCampanasBonosExtras tbody").on("change","select.selectActiva",function(){

	var idCampana = $(this).attr("idCampana");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("activarIdCampana", idCampana);
    datos.append("activarCampana", seleccionado);

  	$.ajax({

	  url:"ajax/campanas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})


})


/*=============================================
 CAMBIAR ESTADO CAMPAÑA BONOS APALANCAMIENTO
=============================================*/
$(".tablaCampanasBonosApalancamiento tbody").on("change","select.selectActiva",function(){

	var idCampana = $(this).attr("idCampana");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("activarIdCampana", idCampana);
    datos.append("activarCampana", seleccionado);

  	$.ajax({

	  url:"ajax/campanas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})


})



/*=============================================
 CAMBIAR ESTADO CAMPAÑA BONOS RECURRENCIA
=============================================*/
$(".tablaCampanasBonosRecurrencia tbody").on("change","select.selectActiva",function(){

	var idCampana = $(this).attr("idCampana");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("activarIdCampana", idCampana);
    datos.append("activarCampana", seleccionado);

  	$.ajax({

	  url:"ajax/campanas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})


})



/*=============================================
 CAMBIAR ESTADO CAMPAÑA BONOS AFILIADOS
=============================================*/
$(".tablaCampanasBonosAfiliados tbody").on("change","select.selectActiva",function(){

	var idCampana = $(this).attr("idCampana");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("activarIdCampana", idCampana);
    datos.append("activarCampana", seleccionado);

  	$.ajax({

	  url:"ajax/campanas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})


})


//Ver detalle de campaña recurrencia
$(".tablaCampanasBonosRecurrencia tbody").on("click", "button.btnVerRecurrencia", function () {

    var id = $(this).attr("idCampana");

    tabla = $(".tabla-detalles-recurrencia");
    tbody = $(".tabla-detalles-recurrencia tbody");
    tbody.empty();
    tabla = tabla.dataTable().fnDestroy();

    tabla = $(".tabla-detalles-recurrencia").DataTable({
      "ajax":"ajax/tabla-detalles-recurrencia.ajax.php?id="+id,
      "deferRender": true,
      "retrieve": true,
      "processing": true,
      "language": {
    
         "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    
       }
    
    });

  });



  //Ver detalle de campaña recurrencia pagados
$(".tabla-recurrencia-pagada tbody").on("click", "button.btnVerRecurrencia", function () {

    var id = $(this).attr("idCampana");

    tabla = $(".tabla-detalles-recurrencia");
    tbody = $(".tabla-detalles-recurrencia tbody");
    tbody.empty();
    tabla = tabla.dataTable().fnDestroy();

    tabla = $(".tabla-detalles-recurrencia").DataTable({
      "ajax":"ajax/tabla-detalles-recurrencia.ajax.php?id="+id,
      "deferRender": true,
      "retrieve": true,
      "processing": true,
      "language": {
    
         "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    
       }
    
    });

  });


  //Invertir en una campaña

$(".tablaCampanas").on("click","button.btnInvertir",function(){

	 var idCampana = $(this).attr("idCampana");
	 $("#id_campana").val(idCampana);

});


$(".planesMinado").on("click","button.btnInvertir",function(){

	var idCampana = $(this).attr("idCampana");
	$("#id_campana").val(idCampana);

});


$(".tablaCampanasPublicidad").on("click","button.btnInvertir",function(){

	var idCampana = $(this).attr("idCampana");
	$("#id_campana").val(idCampana);

});


$(".tablaCampanas").on("click","button.btnVerCampana",function(){

	var id_campana=$(this).attr("idCampana");
	window.location = "index.php?pagina=comprobantes-campana&campana="+id_campana;

});

$(".tablaCampanas").on("click","button.btnExcelCampana",function(){

	var id_campana=$(this).attr("idCampana");
	window.location = "index.php?pagina=reporte-campana&campana="+id_campana;

});



//EDITAR CAMPAÑA
$(".tablaCampanas").on("click","button.btnEditarCampana",function(){

	var idCampana = $(this).attr("idCampana");
  
	var datos = new FormData();
	datos.append("idCampanaEditar",idCampana);
  
	$.ajax({
  
	 url:"ajax/campanas.ajax.php",
	 method:"POST",
	 data:datos,
	 cache:false,
	 contentType:false,
	 processData:false,
	 dataType:"json",
	 success:function(respuesta){

	  $("#idCampana").val(idCampana);
      $("#editarNombre").val(respuesta["nombre"]);
	  if(respuesta["estado"]==2){
		$("#editarRetorno").attr("readonly", "readonly");
	  }else{
		$("#editarRetorno").removeAttr("readonly");
	  }
	  $("#editarRetorno").val(respuesta["retorno"]);
	  $("#editarCupos").val(respuesta["cupos"]);
	  $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
	  $("#editarFechaFinal").val(respuesta["fecha_fin"]);
	  $("#editarFechaRetorno").val(respuesta["fecha_retorno"]);
	  
	}
  
  });
  
  })



  //EDITAR CAMPAÑA RECURRENTE
$(".tablaCampanasBonosRecurrencia").on("click","button.btnEditarCampana",function(){

	var idCampana = $(this).attr("idCampana");
  
	var datos = new FormData();
	datos.append("idCampanaEditar",idCampana);
  
	$.ajax({
  
	 url:"ajax/campanas.ajax.php",
	 method:"POST",
	 data:datos,
	 cache:false,
	 contentType:false,
	 processData:false,
	 dataType:"json",
	 success:function(respuesta){

		limpiarCamposRecurrenciaEditar();
		$l=JSON.parse(respuesta["nombre"]); 

		for(const [key, value] of Object.entries($l)){
            crearCamposRecurrenciaEditar(value);
			// console.log(value["retorno"]);
		}


	  $("#idCampana").val(idCampana);
    //   $("#editarNombre").val(respuesta["nombre"]);
	  $("#listaRecurrenciasEditar").val(respuesta["nombre"]);
	  $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
	  $("#editarFechaFinal").val(respuesta["fecha_fin"]);
	  $("#editarFechaRetorno").val(respuesta["fecha_retorno"]);
	  
	}
  
  });
  
  })



  //EDITAR CAMPAÑA RECURRENTE AFILIADOS
  $(".tablaCampanasBonosAfiliados").on("click","button.btnEditarCampana",function(){

	var idCampana = $(this).attr("idCampana");
  
	var datos = new FormData();
	datos.append("idCampanaEditar",idCampana);
  
	$.ajax({
  
	 url:"ajax/campanas.ajax.php",
	 method:"POST",
	 data:datos,
	 cache:false,
	 contentType:false,
	 processData:false,
	 dataType:"json",
	 success:function(respuesta){

		limpiarCamposRecurrenciaAfiliadosEditar();
		$l=JSON.parse(respuesta["nombre"]); 

		for(const [key, value] of Object.entries($l)){
            crearCamposRecurrenciaAfiliadosEditar(value);
			// console.log(value["retorno"]);
		}


	  $("#idCampana").val(idCampana);
    //   $("#editarNombre").val(respuesta["nombre"]);
	  $("#listaRecurrenciasEditar").val(respuesta["nombre"]);
	  $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
	  $("#editarFechaFinal").val(respuesta["fecha_fin"]);
	  $("#editarFechaRetorno").val(respuesta["fecha_retorno"]);

	  listarRecurrenciasAfiliadosEditar();
	  
	}
  
  });
  
  })


  
//EDITAR CAMPAÑA PUBLICIDAD
$(".tablaCampanasPublicidad").on("click","button.btnEditarCampana",function(){

	var idCampana = $(this).attr("idCampana");
  
	var datos = new FormData();
	datos.append("idCampanaEditar",idCampana);
  
	$.ajax({
  
	 url:"ajax/campanas.ajax.php",
	 method:"POST",
	 data:datos,
	 cache:false,
	 contentType:false,
	 processData:false,
	 dataType:"json",
	 success:function(respuesta){

	  $("#idCampana").val(idCampana);
      $("#editarNombre").val(respuesta["nombre"]);
	  if(respuesta["estado"]==2){
		$("#editarRetorno").attr("readonly", "readonly");
	  }else{
		$("#editarRetorno").removeAttr("readonly");
	  }
	  $("#editarRetorno").val(respuesta["retorno"]);
	  $("#editarCupos").val(respuesta["cupos"]);
	  $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
	  $("#editarFechaFinal").val(respuesta["fecha_fin"]);
	  $("#editarFechaRetorno").val(respuesta["fecha_retorno"]);
	  
	}
  
  });
  
  })


  //EDITAR CAMPAÑA BONO EXTRA
$(".tablaCampanasBonosExtras").on("click","button.btnEditarCampana",function(){

	var idCampana = $(this).attr("idCampana");
  
	var datos = new FormData();
	datos.append("idCampanaEditar",idCampana);
  
	$.ajax({
  
	 url:"ajax/campanas.ajax.php",
	 method:"POST",
	 data:datos,
	 cache:false,
	 contentType:false,
	 processData:false,
	 dataType:"json",
	 success:function(respuesta){

	  $("#idCampana").val(idCampana);
	  $("#editarRetorno").val(respuesta["retorno"]);
	  $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
	  $("#editarFechaFinal").val(respuesta["fecha_fin"]);
	  $("#editarFechaRetorno").val(respuesta["fecha_retorno"]);
	  
	}
  
  });
  
  })


//ELIMINAR CAMPAÑA INVERSION
 $("#tablaCampanas tbody").on("click", "button.btnEliminarCampana", function () {
	var idCampana = $(this).attr("idCampana");
	var datos = new FormData();
	datos.append("idCampanaEliminar", idCampana);
  
	swal.fire({
	  title: "¿Está seguro de borrar la campaña?",
	  text: "¡Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  cancelButtonText: "Cancelar",
	  confirmButtonText: "Si, borrar campaña!",
	}).then((result) => {
	  if (result.value) {
		$.ajax({
		  url: "ajax/campanas.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  success: function (respuesta) {
			if (respuesta == "ok") {

			  swal.fire({
				icon: "success",
				title: "¡OK!",
				text: "¡La campaña se ha eliminado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
			  }).then(function (result) {
				if (result.value) {
				  window.location = "campanas";
				}
			  });

			}else if(respuesta != "0"){

				swal.fire({
					icon: "warning",
					title: "¡ADVERTENCIA!",
					text: "¡La campaña no se puede eliminar porque tiene "+respuesta+" inversiones activas!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
				  }).then(function (result) {
					if (result.value) {
					//   window.location = "campanas";s
					}
				  });

			}
		  },
		});
	  }
	});
  });



  //ELIMINAR CAMPAÑA PUBLICIDAD
 $(".tablaCampanasPublicidad tbody").on("click", "button.btnEliminarCampana", function () {
	var idCampana = $(this).attr("idCampana");
	var datos = new FormData();
	datos.append("idCampanaEliminarPublicidad", idCampana);
  
	swal.fire({
	  title: "¿Está seguro de borrar la campaña?",
	  text: "¡Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  cancelButtonText: "Cancelar",
	  confirmButtonText: "Si, borrar campaña!",
	}).then((result) => {
	  if (result.value) {
		$.ajax({
		  url: "ajax/campanas.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  success: function (respuesta) {
			if (respuesta == "ok") {

			  swal.fire({
				icon: "success",
				title: "¡OK!",
				text: "¡La campaña se ha eliminado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
			  }).then(function (result) {
				if (result.value) {
				  window.location = "campanas-publicidad";
				}
			  });

			}else if(respuesta != "0"){

				swal.fire({
					icon: "warning",
					title: "¡ADVERTENCIA!",
					text: "¡La campaña no se puede eliminar porque tiene "+respuesta+" registros de publicidad activos!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
				  }).then(function (result) {
					if (result.value) {
					//   window.location = "campanas";s
					}
				  });

			}
		  },
		});
	  }
	});
  });


  //ELIMINAR CAMPAÑA BONO EXTRA
 $("#tablaCampanasBonosExtras tbody").on("click", "button.btnEliminarCampana", function () {
	var idCampana = $(this).attr("idCampana");
	var datos = new FormData();
	datos.append("idCampanaEliminarBono", idCampana);
  
	swal.fire({
	  title: "¿Está seguro de borrar la campaña?",
	  text: "¡Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  cancelButtonText: "Cancelar",
	  confirmButtonText: "Si, borrar campaña!",
	}).then((result) => {
	  if (result.value) {
		$.ajax({
		  url: "ajax/campanas.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  success: function (respuesta) {
			if (respuesta == "ok") {

			  swal.fire({
				icon: "success",
				title: "¡OK!",
				text: "¡La campaña se ha eliminado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
			  }).then(function (result) {
				if (result.value) {
				  window.location = "bonos-extras";
				}
			  });

			}else if(respuesta != "0"){

				swal.fire({
					icon: "warning",
					title: "¡ADVERTENCIA!",
					text: "¡La campaña no se puede eliminar porque tiene "+respuesta+" pagos por bono extra registrados!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
				  }).then(function (result) {
					if (result.value) {
					//   window.location = "campanas";s
					}
				  });

			}
		  },
		});
	  }
	});
  });



$("#crearRecurrencia").click(function(){

	$(".nuevaRecurrencia").append(

		'<div class="row" style="padding:5px 15px">'+
	
		'<!-- Descripción del producto -->'+
		
		'<div class="col-xs-6" style="padding-right:0px">'+
		
		  '<div class="input-group">'+
			
			'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRecurrencia" idProducto="1"><i class="fa fa-times"></i></button></span>'+
	
		  '</div>'+
	
		'</div>'+
	
		'<!-- Cantidad de inversiones -->'+
	
		'<div class="col-xs-3">'+
		  
		   '<input type="number" class="form-control nuevaCantidadInversiones" name="nuevaCantidadInversiones" min="1" value="1" required>'+
	
		'</div>' +
	
		'<!-- Retorno -->'+
	
		'<div class="col-xs-3" style="padding-left:0px">'+
	
		  '<div class="input-group">'+
	
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			   
			'<input type="text" class="form-control nuevoValorRetorno" retornoReal="0" name="nuevoValorRetorno" value="0" required>'+
	
		  '</div>'+
		   
		'</div>'+
	
	  '</div>') 

	  $(".nuevoValorRetorno").number(true, 0);

})


/*=============================================
LISTAR TODOS LAS RECURRENCIAS
=============================================*/

function listarRecurrencias(){

	var listaRecurrencias = [];

	var inversiones = $(".nuevaCantidadInversiones");

	$(".nuevoValorRetorno").number(false);
	var retorno = $(".nuevoValorRetorno")

	for(var i = 0; i < inversiones.length; i++){

		listaRecurrencias.push({
			"inversiones" : $(inversiones[i]).val(),
			"retorno" : $(retorno[i]).val()
		})

	}

	$("#listaRecurrencias").val(JSON.stringify(listaRecurrencias)); 

}


$(".formularioCrearRecurrencia").on("click", "button.quitarRecurrencia", function(){

	$(this).parent().parent().parent().parent().remove();

	listarRecurrencias();

})



/*=============================================
MODIFICAR LA CANTIDAD DE INVERSIONES
=============================================*/

$(".formularioCrearRecurrencia").on("change", "input.nuevaCantidadInversiones", function(){

	listarRecurrencias();

})


/*=============================================
MODIFICAR EL RETORNO
=============================================*/

$(".formularioCrearRecurrencia").on("change", "input.nuevoValorRetorno", function(){

	listarRecurrencias();

})





$("#crearRecurrenciaEditar").click(function(){

	$(".nuevaRecurrenciaEditar").append(

		'<div class="row" style="padding:5px 15px">'+

		
		'<div class="col-xs-6" style="padding-right:0px">'+
		
		  '<div class="input-group">'+
			
			'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRecurrenciaEditar"><i class="fa fa-times"></i></button></span>'+
	
		  '</div>'+
	
		'</div>'+
	
		'<!-- Cantidad de inversiones -->'+
	
		'<div class="col-xs-3">'+
		  
		   '<input type="number" class="form-control nuevaCantidadInversionesEditar" name="nuevaCantidadInversionesEditar" min="1" value="1" required>'+
	
		'</div>' +
	
		'<!-- Retorno -->'+
	
		'<div class="col-xs-3" style="padding-left:0px">'+
	
		  '<div class="input-group">'+
	
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			   
			'<input type="text" class="form-control nuevoValorRetornoEditar" retornoReal="0" name="nuevoValorRetornoEditar" value="0" required>'+
	
		  '</div>'+
		   
		'</div>'+
	
	  '</div>') 

	  $(".nuevoValorRetornoEditar").number(true, 0);

})


/*=============================================
LISTAR TODOS LAS RECURRENCIAS
=============================================*/

function listarRecurrenciasEditar(){

	var listaRecurrencias = [];

	var inversiones = $(".nuevaCantidadInversionesEditar");

	$(".nuevoValorRetornoEditar").number(false);
	var retorno = $(".nuevoValorRetornoEditar")

	for(var i = 0; i < inversiones.length; i++){

		listaRecurrencias.push({
			"inversiones" : $(inversiones[i]).val(),
			"retorno" : $(retorno[i]).val()
		})

	}

	$("#listaRecurrenciasEditar").val(JSON.stringify(listaRecurrencias)); 

}


$(".formularioCrearRecurrenciaEditar").on("click", "button.quitarRecurrenciaEditar", function(){

	$(this).parent().parent().parent().parent().remove();

	listarRecurrenciasEditar();

})



/*=============================================
MODIFICAR LA CANTIDAD DE INVERSIONES
=============================================*/

$(".formularioCrearRecurrenciaEditar").on("change", "input.nuevaCantidadInversionesEditar", function(){

	listarRecurrenciasEditar();

})


/*=============================================
MODIFICAR EL RETORNO
=============================================*/

$(".formularioCrearRecurrenciaEditar").on("change", "input.nuevoValorRetornoEditar", function(){

	listarRecurrenciasEditar();

})


function crearCamposRecurrenciaEditar(value){
	$(".nuevaRecurrenciaEditar").append(

		'<div class="row" style="padding:5px 15px">'+

		
		'<div class="col-xs-6" style="padding-right:0px">'+
		
		  '<div class="input-group">'+
			
			'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRecurrenciaEditar"><i class="fa fa-times"></i></button></span>'+
	
		  '</div>'+
	
		'</div>'+
	
		'<!-- Cantidad de inversiones -->'+
	
		'<div class="col-xs-3">'+
		  
		   '<input type="number" class="form-control nuevaCantidadInversionesEditar" min="1" value="'+value["inversiones"]+'" required>'+
	
		'</div>' +
	
		'<!-- Retorno -->'+
	
		'<div class="col-xs-3" style="padding-left:0px">'+
	
		  '<div class="input-group">'+
	
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			   
			'<input type="text" class="form-control nuevoValorRetornoEditar" retornoReal="0" value="'+value["retorno"]+'" required>'+
	
		  '</div>'+
		   
		'</div>'+
	
	  '</div>') 

	  $(".nuevoValorRetornoEditar").number(true, 0);
}


function limpiarCamposRecurrenciaEditar(){
	$(".nuevaRecurrenciaEditar").html("");
}








$("#crearRecurrenciaAfiliados").click(function(){

	$(".nuevaRecurrenciaAfiliados").append(

		'<div class="row" style="padding:5px 15px">'+
	
		'<!-- Descripción del producto -->'+
		
		'<div class="col-xs-6" style="padding-right:0px">'+
		
		  '<div class="input-group">'+
			
			'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRecurrencia" idProducto="1"><i class="fa fa-times"></i></button></span>'+
	
		  '</div>'+
	
		'</div>'+
	
		'<!-- Cantidad de afiliados -->'+
	
		'<div class="col-xs-3">'+
		  
		   '<input type="number" class="form-control nuevaCantidadAfiliados" min="1" value="1" required>'+
	
		'</div>' +
	
		'<!-- Retorno -->'+
	
		'<div class="col-xs-3" style="padding-left:0px">'+
	
		  '<div class="input-group">'+
	
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			   
			'<input type="text" class="form-control nuevoValorRetorno" retornoReal="0" value="0" required>'+
	
		  '</div>'+
		   
		'</div>'+
	
	  '</div>') 

	  $(".nuevoValorRetorno").number(true, 0);

})


/*=============================================
LISTAR TODOS LAS RECURRENCIAS
=============================================*/

function listarRecurrenciasAfiliados(){

	var listaRecurrencias = [];

	var afiliados = $(".nuevaCantidadAfiliados");

	$(".nuevoValorRetorno").number(false);
	var retorno = $(".nuevoValorRetorno")

	for(var i = 0; i < afiliados.length; i++){

		listaRecurrencias.push({
			"afiliados" : $(afiliados[i]).val(),
			"retorno" : $(retorno[i]).val()
		})

	}

	$("#listaRecurrencias").val(JSON.stringify(listaRecurrencias)); 

}


$(".formularioCrearRecurrenciaAfiliados").on("click", "button.quitarRecurrencia", function(){

	$(this).parent().parent().parent().parent().remove();

	listarRecurrenciasAfiliados();

})



/*=============================================
MODIFICAR LA CANTIDAD DE AFILIADOS
=============================================*/

$(".formularioCrearRecurrenciaAfiliados").on("change", "input.nuevaCantidadAfiliados", function(){

	listarRecurrenciasAfiliados();

})


/*=============================================
MODIFICAR EL RETORNO
=============================================*/

$(".formularioCrearRecurrenciaAfiliados").on("change", "input.nuevoValorRetorno", function(){

	listarRecurrenciasAfiliados();

})










$("#crearRecurrenciaAfiliadosEditar").click(function(){

	$(".nuevaRecurrenciaEditar").append(

		'<div class="row" style="padding:5px 15px">'+

		
		'<div class="col-xs-6" style="padding-right:0px">'+
		
		  '<div class="input-group">'+
			
			'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRecurrenciaEditar"><i class="fa fa-times"></i></button></span>'+
	
		  '</div>'+
	
		'</div>'+
	
		'<!-- Cantidad de afiliados -->'+
	
		'<div class="col-xs-3">'+
		  
		   '<input type="number" class="form-control nuevaCantidadAfiliadosEditar" min="1" value="1" required>'+
	
		'</div>' +
	
		'<!-- Retorno -->'+
	
		'<div class="col-xs-3" style="padding-left:0px">'+
	
		  '<div class="input-group">'+
	
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			   
			'<input type="text" class="form-control nuevoValorRetornoEditar" retornoReal="0" value="0" required>'+
	
		  '</div>'+
		   
		'</div>'+
	
	  '</div>') 

	  $(".nuevoValorRetornoEditar").number(true, 0);

})


/*=============================================
LISTAR TODOS LAS RECURRENCIAS
=============================================*/

function listarRecurrenciasAfiliadosEditar(){

	var listaRecurrencias = [];

	var afiliados = $(".nuevaCantidadAfiliadosEditar");

	$(".nuevoValorRetornoEditar").number(false);
	var retorno = $(".nuevoValorRetornoEditar")

	for(var i = 0; i < afiliados.length; i++){

		listaRecurrencias.push({
			"afiliados" : $(afiliados[i]).val(),
			"retorno" : $(retorno[i]).val()
		})

	}

	$("#listaRecurrenciasEditar").val(JSON.stringify(listaRecurrencias)); 

}


$(".formularioCrearRecurrenciaAfiliadosEditar").on("click", "button.quitarRecurrenciaEditar", function(){

	$(this).parent().parent().parent().parent().remove();

	listarRecurrenciasAfiliadosEditar();

})



/*=============================================
MODIFICAR LA CANTIDAD DE INVERSIONES
=============================================*/

$(".formularioCrearRecurrenciaAfiliadosEditar").on("change", "input.nuevaCantidadInversionesEditar", function(){

	listarRecurrenciasAfiliadosEditar();

})


/*=============================================
MODIFICAR EL RETORNO
=============================================*/

$(".formularioCrearRecurrenciaAfiliadosEditar").on("change", "input.nuevoValorRetornoEditar", function(){

	listarRecurrenciasAfiliadosEditar();

})


function crearCamposRecurrenciaAfiliadosEditar(value){

	$(".nuevaRecurrenciaEditar").append(

		'<div class="row" style="padding:5px 15px">'+

		
		'<div class="col-xs-6" style="padding-right:0px">'+
		
		  '<div class="input-group">'+
			
			'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarRecurrenciaEditar"><i class="fa fa-times"></i></button></span>'+
	
		  '</div>'+
	
		'</div>'+
	
		'<!-- Cantidad de afiliados -->'+
	
		'<div class="col-xs-3">'+
		  
		   '<input type="number" class="form-control nuevaCantidadInversionesEditar" min="1" value="'+value["afiliados"]+'" required>'+
	
		'</div>' +
	
		'<!-- Retorno -->'+
	
		'<div class="col-xs-3" style="padding-left:0px">'+
	
		  '<div class="input-group">'+
	
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			   
			'<input type="text" class="form-control nuevoValorRetornoEditar" retornoReal="0" value="'+value["retorno"]+'" required>'+
	
		  '</div>'+
		   
		'</div>'+
	
	  '</div>') 

	  $(".nuevoValorRetornoEditar").number(true, 0);
}


function limpiarCamposRecurrenciaAfiliadosEditar(){
	$(".nuevaRecurrenciaEditar").html("");
}


$(".formularioCrearRecurrenciaAfiliadosEditar").on("click", "button.quitarRecurrenciaEditar", function(){

	$(this).parent().parent().parent().parent().remove();

	listarRecurrenciasAfiliadosEditar();

})