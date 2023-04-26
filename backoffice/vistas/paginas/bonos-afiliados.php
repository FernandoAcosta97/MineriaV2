
<?php

if ($usuario["perfil"] != "admin") {

    echo '<script>

  window.location = "campanas";

  </script>';

    return;
}

?>
<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Campañas Bonos Afiliados</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Campañas / Bonos afiliados</li>
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

        <h3 class="card-title">Bonos de afiliados registrados</h3>

        <?php if ($usuario["perfil"] == "admin"): ?>

        <div style="margin:1em auto auto auto">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarCampana">Registrar Bono Afiliados</button>

        </div>

        <?php endif?>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        </div>

      </div>

      <div class="card-body">


        <table id="tablaCampanasBonosAfiliados" class="table table-striped table-bordered dt-responsive tablaCampanasBonosAfiliados" width="100%">

          <thead>
            <tr>
              <th>Acciones</th>
              <th>Estado</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th>Fecha Retorno</th>
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
EDITAR CAMPAÑA
======================================-->

<!-- The Modal -->
<div class="modal" id="modalEditarCampana">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="formularioCrearRecurrenciaAfiliadosEditar" method="post">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Editar campaña</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

          <input type="hidden" name="tipoCampanaEditar" value="6"></input>

	      	<input type="hidden" id="idCampana" name="idCampanaEditar">

          <div class="form-group">

        <label for="registroRetorno" class="control-label">Recurrencia</label>

        <div>

        <button type="button" class="btn btn-primary" id="crearRecurrenciaAfiliadosEditar">Crear</button>

        <!-- <input type="number" class="form-control" id="registroRetorno" name="registroRetorno" placeholder="ej: 20%" required> -->

        <div class="form-group row">

        <div class="row" style="padding:20px 15px">

          <div class="col-xs-3" style="padding-left:40px">

          <label class="control-label">N° AFILIADOS</label>

          </div>

          <div class="col-xs-3" style="padding-left:90px">

          <label class="control-label">RETORNO</label>

          </div>

        </div>

      </div>

      <div class="form-group row nuevaRecurrenciaEditar">

        
      </div>

      <input type="hidden" id="listaRecurrenciasEditar" name="listaRecurrenciasEditar">

      </div>

      </div>

            <div class="form-group">

              <label for="editarFechaInicio" class="control-label">Fecha Inicio</label>

            <div class="input-group">

                <input type="datetime-local" name="editarFechaInicio" class="form-control" id="editarFechaInicio" required>

            </div>

            </div>


        <div class="form-group">

          <label for="editarFechaFinal" class="control-label">Fecha Final</label>

        <div class="input-group">

            <input type="datetime-local" name="editarFechaFinal" class="form-control" id="editarFechaFinal" required>

        </div>

        </div>

        <div class="form-group">

          <label for="editarFechaRetorno" class="control-label">Fecha Retorno</label>

          <div class="input-group">

            <input type="date" name="editarFechaRetorno" class="form-control" id="editarFechaRetorno" required>

          </div>

        </div>

	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>

	        	<button type="submit" class="btn btn-primary">Enviar</button>

	        </div>

	      </div>

		<?php

        $editarCampana = new ControladorCampanas();
        $editarCampana->ctrEditarCampana();

?>


      </form>

    </div>
  </div>
</div>





<!--=====================================
REGISTRAR CAMPAÑA
======================================-->

<!-- The Modal -->
<div class="modal" id="modalRegistrarCampana">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="formularioCrearRecurrenciaAfiliados" method="post">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Registrar Bono afiliados</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

        <input type="hidden" name="tipoCampana" value="6"></input>

            <div class="form-group">

              <label for="registroRetorno" class="control-label">Afiliados</label>

              <div>

              <button type="button" class="btn btn-primary" id="crearRecurrenciaAfiliados">Crear</button>

              <!-- <input type="number" class="form-control" id="registroRetorno" name="registroRetorno" placeholder="ej: 20%" required> -->

              <div class="form-group row">

                <div class="row" style="padding:20px 15px">

                    <div class="col-xs-3" style="padding-left:40px">

                    <label class="control-label">N° AFILIADOS</label>

                    </div>

                    <div class="col-xs-3" style="padding-left:90px">

                    <label class="control-label">RETORNO</label>

                    </div>

                </div>

              </div>

              <div class="form-group row nuevaRecurrenciaAfiliados">

                
              </div>

              <input type="hidden" id="listaRecurrencias" name="listaRecurrencias">

              </div>

            </div>

              <div class="form-group">

                  <label for="registroFechaInicio" class="control-label">Fecha Inicio</label>

                <div class="input-group">

                    <input type="datetime-local" name="registroFechaInicio" class="form-control" id="registroFechaInicio" required>

                </div>

              </div>



              <div class="form-group">

                  <label for="registroFechaFinal" class="control-label">Fecha Final</label>

                <div class="input-group">

                    <input type="datetime-local" name="registroFechaFinal" class="form-control" id="registroFechaFinal" required>

                </div>

              </div>

              <div class="form-group">

                <label for="registroFechaRetorno" class="control-label">Fecha Retorno</label>

                <div class="input-group">

                  <input type="date" name="registroFechaRetorno" class="form-control" id="registroFechaRetorno" required>

                </div>

              </div>


	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>

	        	<button type="submit" class="btn btn-primary">Enviar</button>

	        </div>

	      </div>

		<?php

      $registrarCampanas = new ControladorCampanas();
      $registrarCampanas->ctrRegistroCampana();

?>


      </form>

    </div>
  </div>
</div>





<!--=====================================
VER DETALLES CAMPAÑA RECURRENCIA
======================================-->

<!-- The Modal -->
<div class="modal" id="modalVerRecurrencia">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Detalles Recurrencia</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">


		  <table class="table table-bordered table-striped dt-responsive tabla-detalles-recurrencia" width="100%">
			
			<thead>

				<tr>

					<th style="width:10px">#</th> 
					<th>Número inversiones</th>
					<th>Total retorno</th>

				</tr>   

			</thead>

			<tbody>

			</tbody>

		</table>




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
