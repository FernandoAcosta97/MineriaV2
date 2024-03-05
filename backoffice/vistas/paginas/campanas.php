<?php

$pagos = ControladorPagos::ctrMostrarPagosAll("id_usuario",$usuario["id_usuario"]);
$total_a_pagar=0;
$total_pagos=0;

$solicitudesRetiro=ControladorPagos::ctrMostrarSolicitudesRetiro("usuario", $usuario["id_usuario"], null,null);

$egresos=0;
$ingresos=0;

foreach ($solicitudesRetiro as $key => $value) {

	if($value["tipo"]==1){
		$ingresos=$ingresos+$value["valor"];
	}else{
		$egresos=$egresos+$value["valor"];
	}
      
}


// var_dump($pagos);
$saldo_cop=0;
$saldo_crypto=0;

foreach ($pagos as $key => $value) {
	$total=0;

	$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

	if($comprobante){
	
	$campana = ControladorCampanas::ctrMostrarCampanas("id",$comprobante[0]["campana"]);

	$ganancia = ($comprobante[0]['valor']*$campana['retorno'])/100;

	$total=$comprobante[0]['valor']+$ganancia;

	if($value["estado"]==0){
		$total_a_pagar+=$total;
	}else{
    if($comprobante["0"]["billetera"]==1 || $comprobante["0"]["billetera"]==3){
			$saldo_cop=$saldo_cop+$total;
		}else if($comprobante["0"]["billetera"]==2){
			$saldo_crypto=$saldo_crypto+$total;
		}
		$total_pagos+=$total;
	}
}

}

$ingresos=$ingresos+$total_pagos;
// var_dump($saldo_cop-$egresos);
// var_dump($saldo_crypto);


?>
<div class="content-wrapper" style="min-height: 1058.31px;">
<!-- <section class="content-header">

</section> -->
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Planes de minado</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Planes de minado</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

    <?php 

    $campanas = ControladorCampanas::ctrMostrarCampanasLimitActivas();
    
    ?>

    <div class="flex flex-wrap w-full bg-white planesMinado">
					<div class="flex flex-wrap p-4 w-full sm:w-1/3">
						<div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-primario hover:scale-105 transition inner-shadow">
							<div class="flex justify-between">
								<div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
									30%
								</div>
								<img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
							</div>
							<div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
								<ul class="list-none">
									<li><?php echo $campanas[0]["nombre"] ?></li>
									<li>finaliza el dia:</li>
									<li><?php echo $campanas[0]["fecha_fin"] ?></li>
									<li>paga el dia:</li>
									<li><?php echo $campanas[0]["fecha_retorno"] ?></li>
								</ul>
								<button class="btn px-10 mx-auto mb-8 bg-primario text-white hover:border hover:text-blue-900 btnInvertir" idCampana="<?php echo $campanas[0]["id"] ?>" data-toggle='modal' data-target='#modalRegistrarComprobante'>
									Minar
								</button>
							</div>
						</div>
					</div>

					<div class="flex flex-wrap p-4 w-full sm:w-1/3">
						<div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-blue-700 hover:scale-105 transition inner-shadow">
							<div class="flex justify-between">
								<div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
									50%
								</div>
								<img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
							</div>
							<div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
								<ul class="list-none">
                <li><?php echo $campanas[1]["nombre"] ?></li>
									<li>finaliza el dia:</li>
									<li><?php echo $campanas[1]["fecha_fin"] ?></li>
									<li>paga el dia:</li>
									<li><?php echo $campanas[1]["fecha_retorno"] ?></li>
								</ul>
								<button class="btn px-10 mx-auto mb-8 bg-blue-700 text-white hover:border hover:text-blue-900 btnInvertir" idCampana="<?php echo $campanas[1]["id"] ?>" data-toggle='modal' data-target='#modalRegistrarComprobante'>
									Minar
								</button>
							</div>
						</div>
					</div>

					<div class="flex flex-wrap p-4 w-full sm:w-1/3">
						<div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-purple-500 hover:scale-105 transition inner-shadow">
							<div class="flex justify-between">
								<div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
									70%
								</div>
								<img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
							</div>
							<div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
								<ul class="list-none">
                <li><?php echo $campanas[2]["nombre"] ?></li>
									<li>finaliza el dia:</li>
									<li><?php echo $campanas[2]["fecha_fin"] ?></li>
									<li>paga el dia:</li>
									<li><?php echo $campanas[2]["fecha_retorno"] ?></li>
								</ul>
								<button class="btn px-10 mx-auto mb-8 bg-purple-500 text-white hover:border hover:text-blue-900 btnInvertir" idCampana="<?php echo $campanas[2]["id"] ?>" data-toggle='modal' data-target='#modalRegistrarComprobante'>
									Minar
								</button>
							</div>
						</div>
					</div>
				</div>

  </section>

  <?php if($usuario["perfil"]=="admin"): ?>
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <h3 class="card-title">Invierta en uno de estos planes para empezar a minar</h3>

        <?php if ($usuario["perfil"] == "admin"): ?>

        <div style="margin:1em auto auto auto">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarCampana">Registrar Campaña</button>

        </div>

        <?php endif ?>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        </div>

      </div>

      <div class="card-body">


        <table id="tablaCampanas" class="table table-striped table-bordered dt-responsive tablaCampanas" width="100%">

          <thead>
            <tr>
              <th>Acciones</th>
              <th>Nombre</th>
              <th>Retorno</th>
              <th>Estado</th>
              <th>Cupos Disponibles</th>
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
  <?php endif ?>

</div>



<!--=====================================
EDITAR CAMPAÑA
======================================-->

<!-- The Modal -->
<div class="modal" id="modalEditarCampana">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Editar campaña</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

        <input type="hidden" name="tipoCampanaEditar" value="1"></input>

	      	<input type="hidden" id="idCampana" name="idCampanaEditar">

          <!-- ENTRADA PARA EL NOMBRE-->
          <div class="form-group">

          <label for="editarNombre" class="control-label">Nombre</label>

          <div>

            <input type="text" class="form-control" id="editarNombre" name="editarNombre" required>

          </div>

          </div>

          
          <div class="form-group">

          <label for="editarRetorno" class="control-label">Retorno</label>

          <div>

          <input type="number" class="form-control" id="editarRetorno" name="editarRetorno" required>

          </div>

          </div>

          <div class="form-group">

            <label for="editarCupos" class="control-label">Cupos</label>

          <div>

            <input type="number" class="form-control" id="editarCupos" name="editarCupos" placeholder="Cupos campaña" required>

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

    	<form method="post">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Registrar Campaña</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

        <div class="form-group">

        <input type="hidden" name="tipoCampana" value="1"></input>

              <!-- ENTRADA PARA EL NOMBRE-->
              <div class="form-group">

                <label for="registroNombreCampana" class="control-label">Nombre</label>

                <div>

                  <input type="text" class="form-control" id="registroNombreCampana" name="registroNombreCampana" placeholder="Nombre Campaña" required>

                </div>

              </div>


            <div class="form-group">

              <label for="registroRetorno" class="control-label">Retorno</label>

              <div>

              <input type="number" class="form-control" id="registroRetorno" name="registroRetorno" placeholder="Retorno campaña ej: 20%" required>

              </div>

            </div>

              <div class="form-group">

                  <label for="registroCupos" class="control-label">Cupos</label>

                <div>

                  <input type="number" class="form-control" id="registroCupos" name="registroCupos" placeholder="Cupos campaña ej: 1000" required>

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
	      <div class="modal-header">
	        <h4 class="modal-title">Realizar Inversión</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

        <input type="hidden" value="<?php echo $usuario["doc_usuario"]; ?>" name="doc_usuario">
        
        <input type="hidden" value="<?php echo ($ingresos-$egresos); ?>" id="saldo_cop">

        <input type="hidden" id="id_campana" name="id_campana">

              <div class="form-group">

                  <label for="billeteras" class="control-label">Billetera</label>

               <div>

                <select class="form-control" id="billeteras" name="billeteras" required>

                  <option value="">SELECCIONAR</option>
                  <option value="1">COP</option>
                  <option value="2">CRYPTO</option>
                  <option value="3">TRANSFERENCIA</option>
                  <option value="4">TRANSFERENCIA CRYPTO BINANCE</option>

                </select>

                </div>

              </div>

              <div class="form-group">

                <label for="registrarValor" class="control-label">Valor</label>

                <div>

                <input type="number" class="form-control" id="registrarValor" name="registrarValor" placeholder="Valor" required>

                </div>

              </div>

              <div class="form-group">

                <label for="registrarEstado" class="control-label">Estado</label>

                <div>
                  <select class="form-control" id="registrarEstado" name="registrarEstado" readonly>

                      <option value="2">Pendiente</option>

                  </select>

                </div>

              </div>

            <div class="invertir_transferencia"></div>

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

     $registrarComprobantes = new ControladorComprobantes();
      $registrarComprobantes->ctrRegistrarComprobantes($saldo_cop,$saldo_crypto);
?>
      </form>

    </div>
  </div>
</div>