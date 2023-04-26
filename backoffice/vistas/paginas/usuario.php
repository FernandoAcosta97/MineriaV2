<?php

if ($usuario["perfil"] != "admin") {

    echo '<script>

  window.location = "inicio";

  </script>';

    return;
}

if(!isset($_GET["id"])){

  echo '<script>
  
  window.location = "usuarios";
  
  </script>';
  
    return;
  
  }

  $id=$_GET["id"];
  
  $usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario",$id);


?>
<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detalles de Usuario</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Detalles</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">
        
        <?php

          include "modulos/detalles-usuario/info-usuario.php";

          include "modulos/detalles-usuario/tabla-cuentas-detalles.php";

          //  include "modulos/perfil/formulario-suscripcion.php";

           // include "modulos/perfil/material-promocion.php";

         ?>

     </div>

    </div>

  </section>
  <!-- /.content -->

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

      $ruta_pagina = "index.php?pagina=usuario&id=".$id;
      $registrarCuenta = new ControladorCuentas();
      $registrarCuenta->ctrRegistrarCuentaBancaria($ruta_pagina);

		?>


      </form>

    </div>
  </div>
</div>