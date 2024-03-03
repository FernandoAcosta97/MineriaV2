
$(".tabla-pagar-comisiones").DataTable({
    "ajax":"ajax/tabla-pagos-comisiones.ajax.php",
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



$(".tabla-pagar-comisiones tbody").on("click", "button.btnVerComisiones", function () {

    var idPago = $(this).attr("idPagoComision");

    tabla = $(".tabla-detalles-comisiones");
    tbody = $(".tabla-detalles-comisiones tbody");
    tbody.empty();
    tabla = tabla.dataTable().fnDestroy();

    tabla = $(".tabla-detalles-comisiones").DataTable({
      "ajax":"ajax/tabla-detalles-comisiones.ajax.php?pago="+idPago,
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



  $(".tabla-comisiones-pagadas tbody").on("click", "button.btnVerComisiones", function () {

    var idPago = $(this).attr("idPagoComision");

    tabla = $(".tabla-detalles-comisiones");
    tbody = $(".tabla-detalles-comisiones tbody");
    tbody.empty();
    tabla = tabla.dataTable().fnDestroy();

    tabla = $(".tabla-detalles-comisiones").DataTable({
      "ajax":"ajax/tabla-detalles-comisiones.ajax.php?pago="+idPago,
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


  $(".tabla-pagar-extras tbody").on("click", "button.btnVerBonos", function () {

    var idPago = $(this).attr("idPagoBono");

    tabla = $(".tabla-detalles-bonos");
    tbody = $(".tabla-detalles-bonos tbody");
    tbody.empty();
    tabla = tabla.dataTable().fnDestroy();

    tabla = $(".tabla-detalles-bonos").DataTable({
      "ajax":"ajax/tabla-detalles-bonos.ajax.php?pago="+idPago,
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



  $(".tabla-comisiones-pagadas").DataTable({
    "ajax":"ajax/tabla-pagos-comisiones-pagadas.ajax.php",
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

  var id_usuario = $("#id_usuario").val();

  $(".tabla-comisiones-sin-liquidar").DataTable({
    "ajax":"ajax/tabla-comisiones-sin-liquidar.ajax.php?usuario="+id_usuario,
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


  $(".tabla-pagar-retiros").DataTable({
    "ajax":"ajax/tabla-pagos-retiros.ajax.php",
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


  $(".tabla-pagar-inversiones").DataTable({
    "ajax":"ajax/tabla-pagos-inversiones.ajax.php",
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


  $(".tabla-inversiones-sin-liquidar").DataTable({
    "ajax":"ajax/tabla-inversiones-sin-liquidar.ajax.php?usuario="+id_usuario,
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


  $(".tabla-pagar-recurrencia").DataTable({
    "ajax":"ajax/tabla-pagos-recurrencia.ajax.php",
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


  $(".tabla-pagar-afiliados").DataTable({
    "ajax":"ajax/tabla-pagos-afiliados.ajax.php",
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



  $(".tabla-afiliados-pagado").DataTable({
    "ajax":"ajax/tabla-pagos-afiliados-pagados.ajax.php",
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



  $(".tabla-pagar-bienvenida").DataTable({
    "ajax":"ajax/tabla-pagos-bienvenida.ajax.php",
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



  $(".tabla-bienvenida-pagados").DataTable({
    "ajax":"ajax/tabla-pagos-bienvenida-pagados.ajax.php",
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


  $(".tabla-publicidad-sin-liquidar").DataTable({
    "ajax":"ajax/tabla-publicidad-sin-liquidar.ajax.php?usuario="+id_usuario,
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


  $(".tabla-pagar-publicidad").DataTable({
    "ajax":"ajax/tabla-pagos-publicidad.ajax.php",
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


  $(".tabla-publicidad-sin-liquidar").DataTable({
    "ajax":"ajax/tabla-publicidad-sin-liquidar.ajax.php?usuario="+id_usuario,
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


  $(".tabla-extras-sin-liquidar").DataTable({
    "ajax":"ajax/tabla-extras-sin-liquidar.ajax.php?usuario="+id_usuario,
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


  $(".tabla-pagar-extras").DataTable({
    "ajax":"ajax/tabla-pagos-extras.ajax.php",
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


  $(".tabla-inversiones-pagadas").DataTable({
    "ajax":"ajax/tabla-pagos-inversiones-pagadas.ajax.php",
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


  $(".tabla-recurrencia-pagada").DataTable({
    "ajax":"ajax/tabla-pagos-recurrencia-pagados.ajax.php",
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


  $(".tabla-publicidad-pagada").DataTable({
    "ajax":"ajax/tabla-pagos-publicidad-pagada.ajax.php",
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


  $(".tabla-extras-pagados").DataTable({
    "ajax":"ajax/tabla-pagos-extras-pagados.ajax.php",
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


  
 $(".tabla-pagar-inversiones tbody").on("click", "button.btnPagarInversion", function () {

	var idPagoInversion= $(this).attr("idPagoInversion");

	var datos = new FormData();
	datos.append("idPagoInversion", idPagoInversion);

  	$.ajax({

	  url:"ajax/pagos.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){

        if (respuesta == "ok") {

          alerta("success", "¡El pago se ha realizado correctamente!", null, "pagos-inversiones", false);
		  
        }else if(respuesta == "pagado"){

          alerta("info", "¡Información!", "¡El pago ya se ha realizado!", "pagos-inversiones", false);

        }else{

          alerta("error", "¡Ha ocurrido un error!", "¡Contacte con el administrador o vuelve a intentarlo mas tarde!", null, true);

        }

      }

  	})
  
    });



    $(".tabla-pagar-retiros tbody").on("click", "button.btnPagarRetiro", function () {

      var idPagoRetiro= $(this).attr("idPagoRetiro");
    
      var datos = new FormData();
      datos.append("idPagoRetiro", idPagoRetiro);
    
        $.ajax({
    
        url:"ajax/pagos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
    
            if (respuesta.trim() == "ok") {
    
              alerta("success", "¡El pago se ha realizado correctamente!", null, "pagos-retiros", false);
          
            }else if(respuesta.trim() == "pagado"){
    
              alerta("info", "¡Información!", "¡El pago ya se ha realizado!", "pagos-retiros", false);
    
            }else{
    
              alerta("error", "¡Ha ocurrido un error!", "¡Contacte con el administrador o vuelve a intentarlo mas tarde!", null, true);
    
            }
    
          }
    
        })
      
        });


    $(".tabla-pagar-recurrencia tbody").on("click", "button.btnPagarRecurrencia", function () {

      var idPagoRecurrencia= $(this).attr("idPagoRecurrencia");
    
      var datos = new FormData();
      datos.append("idPagoRecurrencia", idPagoRecurrencia);
    
        $.ajax({
    
        url:"ajax/pagos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
    
            if (respuesta.trim() == "ok") {
    
              alerta("success", "¡El pago se ha realizado correctamente!", null, "pagos-recurrencia", false);
          
            }else if(respuesta.trim() == "pagado"){
    
              alerta("info", "¡Información!", "¡El pago ya se ha realizado!", "pagos-recurrencia", false);
    
            }else{
    
              alerta("error", "¡Ha ocurrido un error!", "¡Contacte con el administrador o vuelve a intentarlo mas tarde!", null, true);
    
            }
    
          }
    
        })
      
        });



    $(".tabla-pagar-publicidad tbody").on("click", "button.btnPagarPublicidad", function () {

      var idPagoPublicidad= $(this).attr("idPagoPublicidad");
    
      var datos = new FormData();
      datos.append("idPagoPublicidad", idPagoPublicidad);
    
        $.ajax({
    
        url:"ajax/pagos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
    
            if (respuesta.trim() == "ok") {
    
              alerta("success", "¡El pago se ha realizado correctamente!", null, "pagos-publicidad", false);
          
            }else if(respuesta.trim() == "pagado"){
    
              alerta("info", "¡Información!", "¡El pago ya se ha realizado!", "pagos-publicidad", false);
    
            }else{
    
              alerta("error", "¡Ha ocurrido un error!", "¡Contacte con el administrador o vuelve a intentarlo mas tarde!", null, true);
    
            }
    
          }
    
        })
      
        });


    $(".tabla-pagar-comisiones tbody").on("click", "button.btnPagarComision", function () {

      var idPagoComision= $(this).attr("idPagoComision");
    
      var datos = new FormData();
      datos.append("idPagoComision", idPagoComision);
    
        $.ajax({
    
        url:"ajax/pagos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

          if (respuesta.trim() == "ok") {

            alerta("success", "¡El pago se ha realizado correctamente!", null, "pagos-comisiones", false);
        
          }else if(respuesta.trim() == "pagado"){
  
            alerta("info", "¡Información!", "¡El pago ya se ha realizado!", "pagos-comisiones", false);
  
          }else{
  
            alerta("error", "¡Ha ocurrido un error!", "¡Contacte con el administrador o vuelve a intentarlo mas tarde!", null, true);
  
          }
    
          }
    
        })
      
    });



$(".btnPagos").click(function () {

      var idsPagos= $(this).attr("idPagos");
      var tipoPago= $(this).attr("tipoPago");
      var direccion = "";

      if(tipoPago == "comisiones"){
        direccion="pagos-comisiones";
      }
      if(tipoPago == "inversiones"){
        direccion="pagos-inversiones";
      }
      if(tipoPago == "bonos"){
        direccion="pagos-extras";
      }
      if(tipoPago == "publicidad"){
        direccion="pagos-publicidad";
      }
      if(tipoPago == "retiros"){
        direccion="pagos-retiros";
      }

      if(idsPagos!=""){

        var datos = new FormData();
        datos.append("idsPagos", idsPagos);
        datos.append("tipoPago", tipoPago);
      
        $.ajax({
      
          url:"ajax/pagos.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta){
  
          var conjunto = new Set(respuesta.split(""));
          var arreglo = Array.from(conjunto);
          var res = arreglo.join("");
      
              if (res.trim() == "ok") {
            
                swal({
                  type: "success",
                  title: "¡Los pagos de "+tipoPago+" seleccionados se han realizado correctamente!",
                  allowOutsideClick: false,
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                }).then(function (result) {
                  if (result.value) {
                    window.location = direccion;
                  }
                });
            
              }else{
      
                swal({
                  type: "error",
                  title: "¡Ha ocurrido un error!",
                  text: "¡Contacte con el administrador o vuelve a intentarlo mas tarde!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                }).then(function (result) {
                  if (result.value) {
                    // window.location = "pagos-inversiones";
                    
                  }
                });
            
      
              }
      
            }
      
          })


      }else{

        swal({
          type: "warning",
          title: "¡Advertencia!",
          text: "¡No ha seleccionado ningún pago!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            // window.location = "pagos-inversiones";
            
          }
        });

      }
    
      
    });



    $(".tabla-pagar-extras tbody").on("click", "button.btnPagarExtra", function () {

      var idPagoExtra= $(this).attr("idPagoExtra");
    
      var datos = new FormData();
      datos.append("idPagoExtra", idPagoExtra);
    
        $.ajax({
    
        url:"ajax/pagos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

          if (respuesta.trim() == "ok") {

            alerta("success", "¡El pago se ha realizado correctamente!", null, "pagos-extras", false);
        
          }else if(respuesta.trim() == "pagado"){
  
            alerta("info", "¡Información!", "¡El pago ya se ha realizado!", "pagos-extras", false);

          }else if(respuesta == "cuenta-bancaria-inactiva"){

            alerta("warning", "¡Advertencia!", "¡No se puede realizar el pago porque el usuario no tiene una cuenta activa!", "pagos-extras", false);
  
          }else{
  
            alerta("error", "¡Ha ocurrido un error!", "¡Contacte con el administrador o vuelve a intentarlo mas tarde!", null, true);
  
          }

    
          }
    
        })
      
        });


/*=============================================
PLUGIN ICHECK
=============================================*/

$(".tabla-pagar-comisiones").on("draw.dt", function(){

	$(".seleccionarPagos input[type='checkbox']").iCheck({
		checkboxClass: "icheckbox_flat-blue",
		radioClass: "iradio_flat-blue"
	});
  


	/*=============================================
	PAGOS
	=============================================*/

	var pagoCheckbox = $(".seleccionarPago");

	var idPagos = [];

	for(var i = 0; i < pagoCheckbox.length; i++){

    	/*=============================================
    	Checkear para realizar pago
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifChecked", function(event){

    		idPagos.push($(this).attr("idPago"));

    		if($(".btnPagos").attr("idPagos") != ""){

    			pagos = $(".btnPagos").attr("idPagos").split(",");

    			pagos.push($(this).attr("idPago"));

    			$(".btnPagos").attr("idPagos", pagos.toString());

    		}else{

    			$(".btnPagos").attr("idPagos", idPagos.toString());

    		}

    	})

    	/*=============================================
    	Quitar el Check para enviar a la papelera
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifUnchecked", function(event){

    		var quitarPagos = $(".btnPagos").attr("idPagos").split(",");

    		for(var f = 0; f < quitarPagos.length; f++){

    			if(quitarPagos[f] == $(this).attr("idPago")){

    				quitarPagos.splice(f, 1);

    				idPagos.splice(f, 1);

    				$(".btnPagos").attr("idPagos", quitarPagos.toString());

    			}

    		}

    	})
		

	}


})

    

$(".checkbox-toggle2").click(function(){

	var clicks = $(this).data('clicks');

	if(clicks){

		$(".seleccionarPagos input[type='checkbox']").iCheck("uncheck");
		$(".far", this).removeClass("fa-check-square").addClass("fa-square");

	}else{

		$(".seleccionarPagos input[type='checkbox']").iCheck("check");
		$(".far", this).removeClass("fa-square").addClass("fa-check-square");

	}

	$(this).data("clicks", !clicks);

})



/*=============================================
PLUGIN ICHECK
=============================================*/

$(".tabla-pagar-inversiones").on("draw.dt", function(){

	$(".seleccionarPagos input[type='checkbox']").iCheck({
		checkboxClass: "icheckbox_flat-blue",
		radioClass: "iradio_flat-blue"
	});

  

	/*=============================================
	ENVIAR TICKETS DE FORMA MASIVA A LA PAPELERA
	=============================================*/

	var pagoCheckbox = $(".seleccionarPago");

	var idPagos = [];

	for(var i = 0; i < pagoCheckbox.length; i++){

    	/*=============================================
    	Checkear para realizar pago
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifChecked", function(event){

    		idPagos.push($(this).attr("idPago"));

    		if($(".btnPagos").attr("idPagos") != ""){

    			pagos = $(".btnPagos").attr("idPagos").split(",");

    			pagos.push($(this).attr("idPago"));

    			$(".btnPagos").attr("idPagos", pagos.toString());

    		}else{

    			$(".btnPagos").attr("idPagos", idPagos.toString());

    		}

    	})

    	/*=============================================
    	Quitar el Check para enviar a la papelera
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifUnchecked", function(event){

    		var quitarPagos = $(".btnPagos").attr("idPagos").split(",");

    		for(var f = 0; f < quitarPagos.length; f++){

    			if(quitarPagos[f] == $(this).attr("idPago")){

    				quitarPagos.splice(f, 1);

    				idPagos.splice(f, 1);

    				$(".btnPagos").attr("idPagos", quitarPagos.toString());

    			}

    		}

    	})
		

	}


})




$(".checkbox-toggle3").click(function(){

	var clicks = $(this).data('clicks');

	if(clicks){

		$(".seleccionarPagos input[type='checkbox']").iCheck("uncheck");
		$(".far", this).removeClass("fa-check-square").addClass("fa-square");

	}else{

		$(".seleccionarPagos input[type='checkbox']").iCheck("check");
		$(".far", this).removeClass("fa-square").addClass("fa-check-square");

	}

	$(this).data("clicks", !clicks);

})




/*=============================================
PLUGIN ICHECK
=============================================*/

$(".tabla-pagar-extras").on("draw.dt", function(){

	$(".seleccionarPagos input[type='checkbox']").iCheck({
		checkboxClass: "icheckbox_flat-blue",
		radioClass: "iradio_flat-blue"
	});

	/*=============================================
	ENVIAR TICKETS DE FORMA MASIVA A LA PAPELERA
	=============================================*/

	var pagoCheckbox = $(".seleccionarPago");

	var idPagos = [];

	for(var i = 0; i < pagoCheckbox.length; i++){

    	/*=============================================
    	Checkear para realizar pago
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifChecked", function(event){

    		idPagos.push($(this).attr("idPago"));

    		if($(".btnPagos").attr("idPagos") != ""){

    			pagos = $(".btnPagos").attr("idPagos").split(",");

    			pagos.push($(this).attr("idPago"));

    			$(".btnPagos").attr("idPagos", pagos.toString());

    		}else{

    			$(".btnPagos").attr("idPagos", idPagos.toString());

    		}

    	})

    	/*=============================================
    	Quitar el Check para enviar a la papelera
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifUnchecked", function(event){

    		var quitarPagos = $(".btnPagos").attr("idPagos").split(",");

    		for(var f = 0; f < quitarPagos.length; f++){

    			if(quitarPagos[f] == $(this).attr("idPago")){

    				quitarPagos.splice(f, 1);

    				idPagos.splice(f, 1);

    				$(".btnPagos").attr("idPagos", quitarPagos.toString());

    			}

    		}

    	})
		

	}


})





$(".checkbox-toggle4").click(function(){

	var clicks = $(this).data('clicks');

	if(clicks){

		$(".seleccionarPagos input[type='checkbox']").iCheck("uncheck");
		$(".far", this).removeClass("fa-check-square").addClass("fa-square");

	}else{

		$(".seleccionarPagos input[type='checkbox']").iCheck("check");
		$(".far", this).removeClass("fa-square").addClass("fa-check-square");

	}

	$(this).data("clicks", !clicks);

})



/*=============================================
PLUGIN ICHECK
=============================================*/

$(".tabla-pagar-publicidad").on("draw.dt", function(){

	$(".seleccionarPagos input[type='checkbox']").iCheck({
		checkboxClass: "icheckbox_flat-blue",
		radioClass: "iradio_flat-blue"
	});

  

	/*=============================================
	ENVIAR TICKETS DE FORMA MASIVA A LA PAPELERA
	=============================================*/

	var pagoCheckbox = $(".seleccionarPago");

	var idPagos = [];

	for(var i = 0; i < pagoCheckbox.length; i++){

    	/*=============================================
    	Checkear para realizar pago
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifChecked", function(event){

    		idPagos.push($(this).attr("idPago"));

    		if($(".btnPagos").attr("idPagos") != ""){

    			pagos = $(".btnPagos").attr("idPagos").split(",");

    			pagos.push($(this).attr("idPago"));

    			$(".btnPagos").attr("idPagos", pagos.toString());

    		}else{

    			$(".btnPagos").attr("idPagos", idPagos.toString());

    		}

    	})

    	/*=============================================
    	Quitar el Check para enviar a la papelera
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifUnchecked", function(event){

    		var quitarPagos = $(".btnPagos").attr("idPagos").split(",");

    		for(var f = 0; f < quitarPagos.length; f++){

    			if(quitarPagos[f] == $(this).attr("idPago")){

    				quitarPagos.splice(f, 1);

    				idPagos.splice(f, 1);

    				$(".btnPagos").attr("idPagos", quitarPagos.toString());

    			}

    		}

    	})
		

	}


})



$(".checkbox-toggle5").click(function(){

	var clicks = $(this).data('clicks');

	if(clicks){

		$(".seleccionarPagos input[type='checkbox']").iCheck("uncheck");
		$(".far", this).removeClass("fa-check-square").addClass("fa-square");

	}else{

		$(".seleccionarPagos input[type='checkbox']").iCheck("check");
		$(".far", this).removeClass("fa-square").addClass("fa-check-square");

	}

	$(this).data("clicks", !clicks);

})




/*=============================================
PLUGIN ICHECK
=============================================*/

$(".tabla-pagar-retiros").on("draw.dt", function(){

	$(".seleccionarPagos input[type='checkbox']").iCheck({
		checkboxClass: "icheckbox_flat-blue",
		radioClass: "iradio_flat-blue"
	});

  

	/*=============================================
	ENVIAR TICKETS DE FORMA MASIVA A LA PAPELERA
	=============================================*/

	var pagoCheckbox = $(".seleccionarPago");

	var idPagos = [];

	for(var i = 0; i < pagoCheckbox.length; i++){

    	/*=============================================
    	Checkear para realizar pago
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifChecked", function(event){

    		idPagos.push($(this).attr("idPago"));

    		if($(".btnPagos").attr("idPagos") != ""){

    			pagos = $(".btnPagos").attr("idPagos").split(",");

    			pagos.push($(this).attr("idPago"));

    			$(".btnPagos").attr("idPagos", pagos.toString());

    		}else{

    			$(".btnPagos").attr("idPagos", idPagos.toString());

    		}

    	})

    	/*=============================================
    	Quitar el Check para enviar a la papelera
    	=============================================*/

    	$(pagoCheckbox[i]).on("ifUnchecked", function(event){

    		var quitarPagos = $(".btnPagos").attr("idPagos").split(",");

    		for(var f = 0; f < quitarPagos.length; f++){

    			if(quitarPagos[f] == $(this).attr("idPago")){

    				quitarPagos.splice(f, 1);

    				idPagos.splice(f, 1);

    				$(".btnPagos").attr("idPagos", quitarPagos.toString());

    			}

    		}

    	})
		

	}


})


$(".checkbox-toggle6").click(function(){

	var clicks = $(this).data('clicks');

	if(clicks){

		$(".seleccionarPagos input[type='checkbox']").iCheck("uncheck");
		$(".far", this).removeClass("fa-check-square").addClass("fa-square");

	}else{

		$(".seleccionarPagos input[type='checkbox']").iCheck("check");
		$(".far", this).removeClass("fa-square").addClass("fa-check-square");

	}

	$(this).data("clicks", !clicks);

})



function alerta(tipo, titulo, mensaje, redireccion, cerrarClick){

  if(mensaje!=null){

  swal({
    type: tipo,
    title: titulo,
    text: mensaje,
    showConfirmButton: true,
    allowOutsideClick: cerrarClick,
    confirmButtonText: "Cerrar",
  }).then(function (result) {
    if (result.value) {
      if(redireccion!=null) window.location = redireccion;
    }
  });

}else{

  swal({
    type: tipo,
    title: titulo,
    showConfirmButton: true,
    allowOutsideClick: cerrarClick,
    confirmButtonText: "Cerrar",
  }).then(function (result) {
    if (result.value) {
      if(redireccion!=null) window.location = redireccion;
    }
  });

}

}