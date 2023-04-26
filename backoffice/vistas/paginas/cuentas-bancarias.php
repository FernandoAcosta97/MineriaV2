<?php

$item = "usuario";
$valor = $usuario["id_usuario"];
$cuentas = ControladorCuentas::ctrMostrarCuentasAll($item, $valor);

?>
<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cuentas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Cuentas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

    <?php
    if(count($cuentas)==0 && $usuario["perfil"]!="admin"){
    echo '<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
    Recuerda que para recibir tu rendimiento necesitas tener registrada una cuenta bancaria, porfavor registre una en el boton registrar cuenta.
    </div>';
    }
    ?>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <h3 class="card-title">Cuentas bancarias registradas</h3>

        <?php if($usuario["perfil"]!="admin" && !$cuentas):?>

        <div style="margin:1em auto auto auto">

            <button class="btn btn-primary" data-toggle="modal" data-target="#registrarCuenta">Registrar Cuenta</button>

        </div>

        <?php endif ?>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>

      </div>

      <div class="card-body">

        <table class="table table-striped table-bordered dt-responsive tablaCuentas" width="100%">

          <thead>
            <tr>
              <th>Acciones</th>
              <th>Número</th>
              <th>Usuario</th>
              <th>C.C.</th>
              <th>Titular</th>
              <th>Estado</th>
              <th>Entidad</th>
              <th>Tipo</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>


          </tbody>
        </table>

        <input type="hidden" value="<?php echo $usuario["id_usuario"]; ?>" id="id_usuario">

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
EDITAR CUENTA
======================================-->

<!-- The Modal -->
<div class="modal" id="modalEditarCuenta">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Editar cuenta</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

        <input type="hidden" id="idCuenta" name="idCuenta">

        <div class="form-group">

            <label for="entidad">Entidad:</label>

            <div>

            <select id="editarEntidad" name="editarEntidad" class="form-control py4 select2" style="width:100%" required>
              <option value="">Seleccione una entidad bancaria</option>
              <option value="davivienda">Davivienda</option>
              <option value="bancolombia">Bancolombia</option>
              <option value="bbva">BBVA</option>
              <option value="banco de bogota">Banco de Bogotá</option>
              <option value="banco agrario">Banco agrario</option>
              <option value="banco popular">Banco popular</option>
              <option value="efecty">Efecty</option>
              <option value="0">Otra entidad</option>
            </select>

            <div class="divCuentaCampoEditar"></div>
              </div>

          </div>

          <div class="form-group">

      <label class="labelNumeroEditar" for="editarNumero">Número cuenta bancaria:</label>

				<input type="number" id="editarNumero" class="form-control" placeholder="Número cuenta" name="editarNumero" required>
        
        <input type="hidden" id="nCuentaActual" name="nCuentaActual">

			</div>

      <div class="form-group">

        <label for="nombreTitular">Nombre Titular:</label>

          <input type="text" class="form-control" id="editarNombreTitular" placeholder="Nombre titular" name="editarNombreTitular" required>

        </div>

        <div class="form-group">

        <label for="tipoDocumento">Tipo de Documento Titular:</label>

        <select class="form-control" id="editarTipoDocumento" name="editarTipoDocumento" required>

          <option value="">Seleccione tipo de documento</option>
          <option value="cedula de ciudadania">Cédula de ciudadanía</option>
          <option value="cedula de extranjeria">Cédula de extranjería</option>
          <option value="pasaporte">Pasaporte</option>

        </select>

        </div>

				<div class="form-group">

				<label for="titular">Documento Titular:</label>

				<input type="number" class="form-control" id="editarDocumentoTitular" placeholder="Número documento titular" name="editarDocumentoTitular" required>

			</div>

			<div class="form-group">

				<label for="tipoCuenta">Tipo de Cuenta:</label>

				<select class="form-control" id="editarTipoCuenta" name="editarTipoCuenta" required>

					<option value="">Seleccione tipo de cuenta</option>
					<option value="ahorros">Ahorros</option>
					<option value="corriente">Corriente</option>
					<option value="otro">Otro</option>

				</select>

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

      $ruta_pagina = "cuentas-bancarias";
      $editarCuenta = new ControladorCuentas();
      $editarCuenta->ctrEditarCuenta($ruta_pagina);

		?>


      </form>

    </div>
  </div>
</div>





<!--=====================================
Registar Cuenta
======================================-->

<!-- The Modal -->
<div class="modal" id="registrarCuenta">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Registrar cuenta</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

	      	<input type="hidden" name="idUsuarioCuentaRegistrar" value="<?php echo $usuario["id_usuario"] ?>">


          <div class="form-group">

            <label for="entidad">Entidad:</label>

            <div>

            <select id="entidad" name="registrarEntidadCuenta" class="form-control py4 select2" style="width:100%" required>
              <option value="">Seleccione una entidad bancaria</option>
              <option value="davivienda">Davivienda</option>
              <option value="bancolombia">Bancolombia</option>
              <option value="bbva">BBVA</option>
              <option value="banco de bogota">Banco de Bogotá</option>
              <option value="banco agrario">Banco agrario</option>
              <option value="banco popular">Banco popular</option>
              <option value="efecty">Efecty</option>
              <option value="0">Otra entidad</option>
            </select>

            <div class="divCuentaCampo"></div>
            </div>

          </div>


			<div class="form-group">

      <label class="labelNumero" for="numero">Número cuenta bancaria:</label>

				<input type="number" id="numero" class="form-control" placeholder="Número cuenta" name="registrarNumeroCuenta" required>

			</div>

      <div class="form-group">

        <label for="nombreTitular">Nombre Titular:</label>

          <input type="text" class="form-control" id="nombreTitular" placeholder="Nombre titular" name="registrarNombreTitular" required>

        </div>

        <div class="form-group">

        <label for="tipoDocumento">Tipo de Documento Titular:</label>

        <select class="form-control" id="tipoDocumento" name="registrarTipoDocumento" required>

          <option value="">Seleccione tipo de documento</option>
          <option value="cedula de ciudadania">Cédula de ciudadanía</option>
          <option value="cedula de extranjeria">Cédula de extranjería</option>
          <option value="pasaporte">Pasaporte</option>

        </select>

        </div>

				<div class="form-group">

				<label for="titular">Documento Titular:</label>

				<input type="number" class="form-control" id="titular" placeholder="Número documento titular" name="registrarNumeroTitular" required>

			</div>

			<div class="form-group">

				<label for="tipoCuenta">Tipo de Cuenta:</label>

				<select class="form-control" id="tipoCuenta" name="registrarTipoCuenta" required>

					<option value="">Seleccione tipo de cuenta</option>
					<option value="ahorros">Ahorros</option>
					<option value="corriente">Corriente</option>
					<option value="otro">Otro</option>

				</select>

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

      $ruta_pagina = "cuentas-bancarias";
			$registrarCuenta = new ControladorCuentas();
			$registrarCuenta->ctrRegistrarCuentaBancaria($ruta_pagina);

		?>


      </form>

    </div>
  </div>
</div>