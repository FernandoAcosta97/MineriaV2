
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
          <h1>Comprobantes</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Comprobantes</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <h3 class="card-title">Comprobantes registrados</h3>

        <hr/>

        <?php if($usuario["perfil"]=="admin"): ?>

        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarComprobante">Registrar Comprobante</button> -->

        <?php endif  ?>



<div class="input-group">


<!-- <button type="button" style="margin:auto 1%" class="btn btn-default" id="daterange-btn">
 
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

</button> -->

<label for="selectFiltro" class="control-label" style="margin:auto 2%">FILTRO</label>

<div>
  <select class="form-control form-select" id="selectFiltro">

      <option selected value="3">TODOS</option>
      <option value="1">APROBADOS</option>
      <option value="2">PENDIENTES</option>
      <option value="0">RECHAZADOS</option>

  </select>

</div>

</div>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        </div>

      </div>

      <div class="card-body">

        <table id="tablaComprobantes" class="table table-striped table-bordered dt-responsive tablaComprobantes" width="100%">

          <thead>
            <tr>

              <th>Acciones</th>
              <th>Foto</th>
              <th>Estado</th>
              <th>Valor</th>
              <?php if($usuario["perfil"]=="admin"): ?>
              <th>C.C.</th>
              <th>Nombre</th>
              <?php endif ?>
              <th>Fecha</th>
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
    $registrarComprobantes -> ctrRegistrarComprobantes(0,0);

    ?>


      </form>

    </div>
  </div>
</div>





<!--=====================================
VER FOTO COMPROBANTE
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