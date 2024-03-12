
/*=============================================
TABLA CUENTAS
=============================================*/

var id_usuario = $("#id_usuario").val();

$(".tablaCuentas").DataTable({
	"ajax":"ajax/tabla-cuentas.ajax.php?id="+id_usuario,
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

$(".tablaCuentasDetalles").DataTable({
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



$(".tablaCuentas tbody").on("click", "button.btnSoporte", function () {
  
	window.location = "soporte";
  });



/*=============================================
APROBADO O RECHAZADO CUENTA
=============================================*/
$(".tablaCuentas tbody").on("change","select.selectAprobado",function(){

	var idCuenta = $(this).attr("idCuenta");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("aprobadoIdCuenta", idCuenta);
    datos.append("aprobadoCuenta", seleccionado);

  	$.ajax({

	  url:"ajax/cuentas.ajax.php",
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
APROBADO O RECHAZADO CUENTA
=============================================*/
$(".tablaCuentasDetalles tbody").on("change","select.selectAprobado",function(){

	var idCuenta = $(this).attr("idCuenta");
	var seleccionado = $(this).val();

	var datos = new FormData();
 	datos.append("aprobadoIdCuenta", idCuenta);
    datos.append("aprobadoCuenta", seleccionado);

  	$.ajax({

	  url:"ajax/cuentas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})


})


//EDITAR CUENTA
$(".tablaCuentas").on("click","button.btnEditarCuenta",function(){

	var idCuenta = $(this).attr("idCuenta");

	var entidades = ["davivienda", "bancolombia", "bbva", "banco de bogota", "banco agrario", "banco popular", "efecty"];
  
	var datos = new FormData();
	datos.append("idCuentaEditar",idCuenta);
  
	$.ajax({
  
	 url:"ajax/cuentas.ajax.php",
	 method:"POST",
	 data:datos,
	 cache:false,
	 contentType:false,
	 processData:false,
	 dataType:"json",
	 success:function(respuesta){

	const found = entidades.find(element => element==respuesta["entidad"]);

		if(found!=undefined){
			$('#editarEntidad').val(respuesta["entidad"]).trigger('change.select2');
			
		}else{
			$('#editarEntidad').val("0").trigger('change.select2');

			var seleccionado = 0;
			if(seleccionado==0){
				$(".divCuentaCampoEditar").html('<input type="text" class="form-control" id="entidad_campo" placeholder="Entidad bancaria" required name="editarEntidadCuentaCampo">');
				}else{
				  $(".divCuentaCampoEditar").html("");
				}

			$('#entidad_campo').val(respuesta["entidad"]);
		}

	  $("#idCuenta").val(idCuenta);
      $("#editarNumero").val(respuesta["numero"]);
	  $("#nCuentaActual").val(respuesta["numero"]);
	  $("#editarDocumentoTitular").val(respuesta["titular"]);
	  $("#editarNombreTitular").val(respuesta["nombre_titular"]);
	  $('#editarTipoCuenta option[value="'+respuesta["tipo"]+'"]').attr('selected', 'selected');
	  $('#editarTipoDocumento option[value="'+respuesta["tipo_documento"]+'"]').attr('selected', 'selected');
	  
	}
  
  });
  
  })



  //EDITAR CUENTA
$(".tablaCuentasDetalles").on("click","button.btnEditarCuenta",function(){

	var idCuenta = $(this).attr("idCuenta");

	var entidades = ["davivienda", "bancolombia", "bbva", "banco de bogota", "banco agrario", "banco popular", "efecty"];
  
	var datos = new FormData();
	datos.append("idCuentaEditar",idCuenta);
  
	$.ajax({
  
	 url:"ajax/cuentas.ajax.php",
	 method:"POST",
	 data:datos,
	 cache:false,
	 contentType:false,
	 processData:false,
	 dataType:"json",
	 success:function(respuesta){

		const found = entidades.find(element => element==respuesta["entidad"]);

		if(found!=undefined){
			$('#editarEntidad').val(respuesta["entidad"]).trigger('change.select2');
			
		}else{
			$('#editarEntidad').val("0").trigger('change.select2');

			var seleccionado = 0;
			if(seleccionado==0){
				$(".divCuentaCampoEditar").html('<input type="text" class="form-control" id="entidad_campo" placeholder="Entidad bancaria" required name="editarEntidadCuentaCampo">');
				}else{
				  $(".divCuentaCampoEditar").html("");
				}

			$('#entidad_campo').val(respuesta["entidad"]);
		}


		$("#idCuenta").val(idCuenta);
		$("#editarNumero").val(respuesta["numero"]);
		$("#nCuentaActual").val(respuesta["numero"]);
		$("#editarDocumentoTitular").val(respuesta["titular"]);
		$("#editarNombreTitular").val(respuesta["nombre_titular"]);
		$('#editarTipoCuenta option[value="'+respuesta["tipo"]+'"]').attr('selected', 'selected');
		$('#editarTipoDocumento option[value="'+respuesta["tipo_documento"]+'"]').attr('selected', 'selected');
	  
	}
  
  });
  
  })



/*=============================================
OTRA ENTIDAD CUENTA
=============================================*/
$("#entidad").on("change",function () {
	var seleccionado = $(this).val();
  
	if(seleccionado==0 && seleccionado!=""){
	$(".divCuentaCampo").html('<input type="text" class="form-control" id="entidad_campo" placeholder="Entidad bancaria" required name="registrarEntidadCuentaCampo">');
	}else{
	  $(".divCuentaCampo").html("");
	}
	
	if(seleccionado=="efecty"){
	  $(".labelNumero").html("Número de documento:");
	}else{
	  $(".labelNumero").html("Número cuenta bancaria:");
	}
  
  })
  



/*=============================================
OTRA ENTIDAD CUENTA EDITAR
=============================================*/
$("#editarEntidad").on("change",function () {
	var seleccionado = $(this).val();
  
	if(seleccionado==0 && seleccionado!=""){
	$(".divCuentaCampoEditar").html('<input type="text" class="form-control" id="entidad_campo" placeholder="Entidad bancaria" required name="editarEntidadCuentaCampo">');
	}else{
	  $(".divCuentaCampoEditar").html("");
	}
	
	if(seleccionado=="efecty"){
	  $(".labelNumeroEditar").html("Número de documento:");
	}else{
	  $(".labelNumeroEditar").html("Número cuenta bancaria:");
	}
  
  })





//ELIMINAR CUENTA BANCARIA
$(".tablaCuentasDetalles tbody").on("click", "button.btnEliminarCuenta", function () {
	var idCuenta = $(this).attr("idCuenta");
	var datos = new FormData();
	datos.append("idCuentaEliminar", idCuenta);
  
	swal.fire({
	  title: "¿Está seguro de borrar la ceunta bancaria?",
	  text: "¡Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  cancelButtonText: "Cancelar",
	  confirmButtonText: "Si, borrar cuenta!",
	}).then((result) => {
	  if (result.value) {
		$.ajax({
		  url: "ajax/cuentas.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  success: function (respuesta) {
			if (respuesta == 1) {

				swal.fire({
					icon: "warning",
					title: "¡ADVERTENCIA!",
					text: "¡La cuenta bancaria no se puede eliminar porque tiene pagos registrados!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
				  }).then(function (result) {
					if (result.value) {
					//   window.location = "campanas";s
					}
				  });

			}else if(respuesta != "error"){

				swal.fire({
					icon: "success",
					title: "¡OK!",
					text: "¡La cuenta bancaria se ha eliminado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
				  }).then(function (result) {
					if (result.value) {
					  window.location = "index.php?pagina=usuario&id="+respuesta;
					}
				  });

			}
		  },
		});
	  }
	});
  });



  //ELIMINAR CUENTA BANCARIA
$(".tablaCuentas tbody").on("click", "button.btnEliminarCuenta", function () {
	var idCuenta = $(this).attr("idCuenta");
	var datos = new FormData();
	datos.append("idCuentaEliminar", idCuenta);
  
	swal.fire({
	  title: "¿Está seguro de borrar la ceunta bancaria?",
	  text: "¡Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  cancelButtonText: "Cancelar",
	  confirmButtonText: "Si, borrar cuenta!",
	}).then((result) => {
	  if (result.value) {
		$.ajax({
		  url: "ajax/cuentas.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  success: function (respuesta) {
			if (respuesta == 1) {

				swal.fire({
					icon: "warning",
					title: "¡ADVERTENCIA!",
					text: "¡La cuenta bancaria no se puede eliminar porque tiene pagos registrados!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
				  }).then(function (result) {
					if (result.value) {
					//   window.location = "campanas";s
					}
				  });

			}else if(respuesta != "error"){

				swal.fire({
					icon: "success",
					title: "¡OK!",
					text: "¡La cuenta bancaria se ha eliminado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
				  }).then(function (result) {
					if (result.value) {
					  window.location = "index.php?pagina=usuario&id="+respuesta;
					}
				  });

			}
		  },
		});
	  }
	});
  });



  
