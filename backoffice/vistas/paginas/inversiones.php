
<!-- if($usuario["perfil"] != "admin"){

  echo '<script>

  window.location = "'.$ruta.'backoffice/inicio";

  </script>';

  return;
}

$item = null;
$valor = null;
$comprobantes = ControladorComprobantes::ctrMostrarComprobantes($item, $valor); -->


<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Suscripciones</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Historial</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

          <div class="flex flex-wrap">
            <div class="flex flex-wrap p-4 w-full sm:w-1/3">
              <div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-[#694ED9] hover:scale-105 transition inner-shadow">
                <div class="flex justify-between">
                  <div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
                    30%
                  </div>
                  <img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
                </div>
                <div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
                  <ul class="list-none">
                    <li>Campaña minado 1</li>
                    <li>finaliza el dia:</li>
                    <li>dd/mm/aa</li>
                    <li>paga el dia:</li>
                    <li>dd/mm/aa</li>
                  </ul>
                  <button class="btn px-10 mx-auto mb-8 bg-[#694ED9] text-white hover:border hover:text-blue-900">
                    Minar
                  </button>
                </div>
              </div>
            </div>

            <div class="flex flex-wrap p-4 w-full sm:w-1/3">
              <div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-[#B52AF6] hover:scale-105 transition inner-shadow">
                <div class="flex justify-between">
                  <div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
                    50%
                  </div>
                  <img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
                </div>
                <div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
                  <ul class="list-none">
                    <li>Campaña minado 2</li>
                    <li>finaliza el dia:</li>
                    <li>dd/mm/aa</li>
                    <li>paga el dia:</li>
                    <li>dd/mm/aa</li>
                  </ul>
                  <button class="btn px-10 mx-auto mb-8 bg-[#B52AF6] text-white hover:border hover:text-blue-900">
                    Minar
                  </button>
                </div>
              </div>
            </div>

            <div class="flex flex-wrap p-4 w-full sm:w-1/3">
              <div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-[#F22AF6] hover:scale-105 transition inner-shadow">
                <div class="flex justify-between">
                  <div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
                    70%
                  </div>
                  <img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
                </div>
                <div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
                  <ul class="list-none">
                    <li>Campaña minado 3</li>
                    <li>finaliza el dia:</li>
                    <li>dd/mm/aa</li>
                    <li>paga el dia:</li>
                    <li>dd/mm/aa</li>
                  </ul>
                  <button class="btn px-10 mx-auto mb-8 bg-[#F22AF6] text-white hover:border hover:text-blue-900">
                    Minar
                  </button>
                </div>
              </div>
            </div>
          </div>

  </section>

  <!-- Main content -->
  <section class="content">



    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <h3 class="card-title">Historico de suscripciones</h3>

        <hr/>

        <?php if($usuario["perfil"]=="admin"): ?>

        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarComprobante">Registrar Comprobante</button> -->

        <?php endif  ?>



<div class="input-group">


<button type="button" style="margin:auto 1%" class="btn btn-default" id="daterange-btn">
 
  <span>
    <i class="fa fa-calendar"></i> 

    <?php

      // if(isset($_GET["fechaInicial"])){

      //   echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
      
      // }else{
       
      //   echo 'Rango de fecha';

      // }

    ?>
  </span>

  <i class="fa fa-caret-down"></i>

</button>




</div>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        </div>

      </div>

      <div class="card-body">

        <table id="tablaComprobantesAprobados" class="table table-striped table-bordered dt-responsive tablaComprobantesAprobados" width="100%">

          <thead>
            <tr>
              <th>Acciones</th>
              <th>Foto</th>
              <th>Estado</th>
              <th>Valor Inversión</th>
              <th>Valor más apalancamiento</th>
              <th>Fecha</th>
              <th>Porcentaje Campaña</th>
              <th>Ganancia Inversión</th>
              <th>Retorno Total</th>
              <th>Fecha Retorno</th>
              <th>Campaña</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>

        <input type="hidden" value="<?php echo $usuario["doc_usuario"]; ?>" id="doc_usuario">

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        
      </div>
        <!-- /.card-footer-->

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

</div>



<!--=====================================
EDITAR COMPROBANTE
======================================-->

<!-- The Modal -->
<div class="modal" id="modalEditarComprobante">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post" enctype="multipart/form-data">

	      <!-- Modal Header -->
<div class="modal-header bg-primario text-white">	        <h4 class="modal-title">Editar comprobante</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

	      	<input type="hidden" id="editarComprobante" name="editarComprobante">

          <input type="hidden" id="docUsuario" name="doc_usuario">

              <div class="form-group">

                  <label for="editarValor" class="control-label">Valor</label>

                <div>

                  <input type="number" class="form-control" id="editarValor" name="editarValor" required>

                </div>

              </div>


              <!-- <div class="form-group">

                <label for="editarPerfil" class="control-label">Perfil</label>

                <div>
                  <select class="form-control" id="editarPerfil" name="editarPerfil" readonly>

                      <option value="usuario">Usuario</option>

                  </select>

                </div>

              </div> -->

      <!-- ENTRADA PARA LA FOTO DEL COMPROBANTE -->
      <div class="form-group">

				<input id="editarFotoComprobante" type="file" class="form-control-file border editarFotoComprobante" name="editarFotoComprobante">

        <img id="previsualizarEditar" src="" class="img-thumbnail previsualizarEditar" width="100px">

        <input type="hidden" id="fotoActualComprobante" name="fotoActualComprobante">

			</div>


	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>

	        	<button type="submit" class="btn bg-primario text-white">Enviar</button>
	        </div>

	      </div>

		<?php

    $editarComprobantes = new ControladorComprobantes();
    $editarComprobantes->ctrEditarComprobantes();

    ?>


      </form>

    </div>
  </div>
</div>





<!--=====================================
REGISTRAR COMPROBANTE
======================================-->

<!-- The Modal -->
<div class="modal" id="modalRegistrarComprobante">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post" enctype="multipart/form-data">

	      <!-- Modal Header -->
<div class="modal-header bg-primario text-white">	        <h4 class="modal-title">Registrar comprobante</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">


              <!-- ENTRADA PARA EL CODIGO -->
              <div class="form-group">

                <label for="registrarCodigo" class="control-label">Código</label>

                <div>

                  <input type="text" class="form-control" id="registrarCodigo" name="registrarCodigo" placeholder="Código comprobante" required>

                  <input type="hidden" value="<?php echo $usuario["doc_usuario"]; ?>" name="doc_usuario">

                </div>

              </div>

              <div class="form-group">

                  <label for="registrarValor" class="control-label">Valor</label>

                <div>

                  <input type="number" class="form-control" id="registrarValor" name="registrarValor" placeholder="Valor comprobante" required>

                </div>

              </div>

              <div class="form-group">

                  <label for="registrarFecha" class="control-label">Fecha</label>

                <div class="input-group">

                    <input type="date" name="registrarFecha" class="form-control" id="registrarFecha" required>

                </div>

              </div>

              <div class="form-group">

                <label for="registrarEstado" class="control-label">Estado</label>

                <div>
                  <select class="form-control" id="registrarEstado" name="registrarEstado" readonly>

                      <option value="2">Pendiente</option>
                      <option value="1">Aprobado</option>
                      <option value="0">Rechazado</option>

                  </select>

                </div>

              </div>

      <!-- ENTRADA PARA LA FOTO DEL COMPROBANTE -->
      <div class="form-group">

				<input id="registrarFotoComprobante" type="file" class="form-control-file border registrarFotoComprobante" name="registrarFotoComprobante">

        <img id="previsualizarRegistrar" src="vistas/img/comprobantes/default/default.jpg" class="img-thumbnail previsualizarRegistrar" width="100px">


			</div>


	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>

	        	<button type="submit" class="btn bg-primario text-white">Enviar</button>
	        </div>

	      </div>

		<?php

    $registrarComprobantes = new ControladorComprobantes();
    $registrarComprobantes -> ctrRegistrarComprobantes();

    ?>


      </form>

    </div>
  </div>
</div>





<!--=====================================
EDITAR COMPROBANTE
======================================-->

<!-- The Modal -->
<div class="modal" id="modalVerFotoComprobante">
  <div class="modal-dialog">
    <div class="modal-content">

	      <!-- Modal Header -->
<div class="modal-header bg-primario text-white">	        <h4 class="modal-title">Comprobante</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

      <!-- ENTRADA PARA LA FOTO DEL COMPROBANTE -->
      <div class="form-group">

        <img src="vistas/img/comprobantes/default/default.jpg" class="previsualizarFotoComprobante" width="100%">

			</div>


	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

	      </div>

    </div>
  </div>
</div>