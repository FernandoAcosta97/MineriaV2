<?php

/*=============================================
HISTÓRICO DE COMISIONES
=============================================*/

$pagos = ControladorPagos::ctrMostrarPagosComisionesxEstadoAll("id_usuario", $usuario["id_usuario"], "estado", 1);

$pagosInversiones = ControladorPagos::ctrMostrarPagosInversionesxUsuario("doc_usuario", $usuario["doc_usuario"], "estado", 1);

$pagosPublicidad = ControladorPagos::ctrMostrarPagosPublicidadxUsuario("id_usuario", $usuario["id_usuario"], "estado", 1);

$pagosExtras = ControladorPagos::ctrMostrarPagosExtrasxEstadoAll("id_usuario", $usuario["id_usuario"], "estado", 1);


$comisionesApagar = ControladorPagos::ctrMostrarPagosComisionesxEstadoAll("id_usuario", $usuario["id_usuario"], "estado", 0);

$inversionesApagar = ControladorPagos::ctrMostrarPagosInversionesxUsuario("doc_usuario", $usuario["doc_usuario"], "estado", 0);

$publicidadApagar = ControladorPagos::ctrMostrarPagosPublicidadxUsuario("id_usuario", $usuario["id_usuario"], "estado", 0);

$bonosApagar = ControladorPagos::ctrMostrarPagosExtrasxEstadoAll("id_usuario", $usuario["id_usuario"], "estado", 0);



/*=============================================
TOTAL USUARIOS
=============================================*/
$totalUsuarios = 0;
$totalUsuarios = ControladorUsuarios::ctrTotalUsuarios();

/*=============================================
TOTAL COMISIONES LIQUIDADAS
=============================================*/

$totalComisiones = 0;

foreach ($pagos as $key => $value) {

	$totalComisiones += $value["valor"];
}


/*=============================================
TOTAL COMISIONES SIN LIQUIDAR
=============================================*/

$totalComisionesApagar = 0;

foreach ($comisionesApagar as $key => $value) {

	$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $value["id"]);


	foreach ($comisiones as $key2 => $value2) {
		$total = 0;
		$porcentaje = 0;
		$ganancia = 0;
		if ($value2["nivel"] == 1) {
			$porcentaje = 5;
		}
		if ($value2["nivel"] == 2) {
			$porcentaje = 4;
		}
		if ($value2["nivel"] == 3) {
			$porcentaje = 3;
		}
		if ($value2["nivel"] == 4) {
			$porcentaje = 2;
		}
		if ($value2["nivel"] == 5) {
			$porcentaje = 1;
		}
		$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value2["id_comprobante"]);

		$ganancia = ($comprobante[0]["valor"] * $porcentaje) / 100;
		$total = $total + $ganancia;

		$totalComisionesApagar += $total;
	}
}

/*=============================================
TOTAL INVERSIONES
=============================================*/

$totalInversiones = 0;

foreach ($pagosInversiones as $key => $value) {

	$campana = ControladorCampanas::ctrMostrarCampanas("id", $value["campana"]);
	$ganancia = ($value["valor"] * $campana["retorno"]) / 100;
	$totalInversiones += $value["valor"] + $ganancia;
}



/*=============================================
TOTAL INVERSIONES SIN LIQUIDAR
=============================================*/

$totalInversionesApagar = 0;

foreach ($inversionesApagar as $key => $value) {

	$campana = ControladorCampanas::ctrMostrarCampanas("id", $value["campana"]);
	$ganancia = ($value["valor"] * $campana["retorno"]) / 100;
	$totalInversionesApagar += $value["valor"] + $ganancia;
}


/*=============================================
TOTAL PUBLICIDAD SIN LIQUIDAR
=============================================*/

$totalPublicidadApagar = 0;

foreach ($publicidadApagar as $key => $value) {

	$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

	$campana = ControladorCampanas::ctrMostrarCampanas("id", $comprobante[0]["campana"]);

	$totalPublicidadApagar += $campana["retorno"];
}



/*=============================================
TOTAL PUBLICIDAD SIN LIQUIDAR
=============================================*/

$totalPagosPublicidad = 0;

foreach ($pagosPublicidad as $key => $value) {

	$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

	$totalPagosPublicidad += $value["valor"];
}


/*=============================================
TOTAL BONOS EXTRAS
=============================================*/

// $totalBonos = 0;

// foreach ($pagosExtras as $key => $value) {

//         $totalBonos += $value["valor"];

// }


/*=============================================
TOTAL BONOS EXTRAS LIQUIDADOS Y SIN LIQUIDAR
=============================================*/

$pagos = ControladorPagos::ctrMostrarPagosExtrasAll("id_usuario", $usuario["id_usuario"]);
$totalBonosApagar = 0;
$totalBonos = 0;


foreach ($pagos as $key => $value) {
	$total = 0;
	$bonos = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra", $value["id"]);

	foreach ($bonos as $key2 => $value2) {

		$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value2["id_comprobante"]);
		$campana = ControladorCampanas::ctrMostrarCampanas("id", $value2["id_campana"]);
		$total = $total + $campana["retorno"];
	}

	if ($value["estado"] == 0) {
		$totalBonosApagar += $total;
	} else {
		$totalBonos += $total;
	}
}
/*=============================================
CANTIDAD DE PERSONAS EN LA RED
=============================================*/

$totalUsuariosSinOperar = 0;
$totalUsuariosOperando = 0;
$totalSinContrato = 0;

if ($usuario["estado"] != 0 && $usuario["fecha_contrato"] != "") {

	$red = ControladorMultinivel::ctrMostrarRed("usuarios", "red_uninivel", "patrocinador_red", $usuario["enlace_afiliado"]);

	/*=============================================
    Limpiando el array de tipo Objeto de valores repetidos
    =============================================*/

	$resultado = array();

	foreach ($red as $value) {
		if ($value["perfil"] != "admin") {
			$resultado[$value["id_usuario"]] = $value;
		}
	}

	$red = array_values($resultado);

	/*=============================================
    TOTAL USUARIOS SIN OPERAR Y OPERANDO
    =============================================*/

	if ($usuario["perfil"] != "admin") {

		foreach ($red as $value) {
			if ($value["fecha_contrato"] == null) {
				++$totalSinContrato;
			}
			if ($value["operando"] == 0) {
				++$totalUsuariosSinOperar;
			} else {
				++$totalUsuariosOperando;
			}
		}
		// $totalUsuariosSinOperar = ControladorMultinivel::ctrMostrarRedOperandoTotal("usuarios", "red_uninivel", "patrocinador_red", $usuario["enlace_afiliado"], "operando", 0);

	} else {

		$res = ControladorUsuarios::ctrTotalUsuariosXfiltro("operando", "0");
		$totalUsuariosSinOperar = $res[0];

		$res2 = ControladorUsuarios::ctrTotalUsuariosXfiltro("operando", "1");
		$totalUsuariosOperando = $res2[0];

		$res3 = ControladorUsuarios::ctrTotalUsuariosXfiltro("firma", null);
		$totalSinContrato = $res3[0];
	}
} else {

	$red = array();
}

$totalRed = 0;
if ($usuario["fecha_contrato"] != null) {
	$totalRed = count($red);
}

?>

<div class="row">
	<div class="col-sm-8">
		<!-- Jerson Arnual -->
		<div class="col col-sm-6 col-lg-12">
			<div class="card bg-light d-flex flex-fill">
				<div class="card-header text-muted border-bottom-0">
					
				</div>
				<div class="card-body pt-0">
					<div class="row">
						<div class="col-5 text-center">
							<?php if ($usuario["foto"] == "") : ?>
								<img class="profile-user-img img-fluid img-circle" src="vistas/img/usuarios/default/empre.jpg">
							<?php else : ?>
								<!-- <img class="profile-user-img img-fluid img-circle" src="<?php echo $usuario["foto"] ?>"> -->
							<?php endif ?>
						</div>
						<div class="col-7">
							<div class="input-group-prepend" style="width: 9vh; display: flex; align-items: center; margin-bottom: 10px;">
    								<img class="profile-user-img img-fluid img-circle" src="vistas/img/inicio/diamante.png" style="margin-right: 10px;">
    								<h1 class="lead" style="margin: 0 auto;">Diamante</h1>
							</div>
							<h1 class="lead"><b>Nombre: <?php echo $usuario["nombre"] ?></b></h1>
							<p class="text-muted"><b>Correo: </b> <?php echo $usuario["email"] ?> </p>
							<p class="text-muted"><b>Documento: </b> <?php echo $usuario["doc_usuario"] ?> </p>
							<p class="text-muted"><b>Usuario: </b> <?php echo $usuario["usuario"] ?> </p>
							<span class="fa-li"></span> Telefono: <?php echo $usuario["telefono_movil"] ?>

							<div class="input-group profile-username input-link span-item-group">
								<input type="text" class="form-control" id="linkAfiliado" value="<?php echo $ruta . $usuario["enlace_afiliado"]; ?>" readonly>
								<div class="input-group-prepend bg-info" style="width: 3vh;">
									<span class=" rounded-center  fa fa-link copiarLink" style="cursor:pointer;margin-top: 40%; margin-left: 15%;"></span>
								</div>
							</div>

							</ul>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="text-right">
						<?php if ($usuario["perfil"] != "admin") : ?>
							<button class="btn btn-primary btn-sm" data-toggle="modal" id="actualizarDatos" data-target="#modalActualizarDatos" idUsuario="<?php echo $usuario["id_usuario"] ?>">Actualizar datos</button>
						<?php endif ?>
						<button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#cambiarPassword">Cambiar contraseña</button>
					</div>
				</div>
			</div>
		</div>

<div class="row justify-content-between">
	<div class="col content-button">
		<a href="ingresos-uninivel" class="btn btn-app bg-cajas-menu card">
			<div class="card-body">
				<img src="vistas/img/inicio/hucha.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 20%;" />
				<br>			
				<h2>Pagos</h2>
			</div>
		</a>
	</div>
	<div class="col content-button">
		<a href="inversiones" class="btn btn-app bg-cajas-menu card">
			<div class="card-body">
			    <img src="vistas/img/inicio/factura.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 20%;" />
				<br>
				<h2>Historial</h2>
			</div>
		</a>
	</div>
</div>

	</div>
	<div class="col-sm-4 align-self-start">
		<div class="col-12 col-sm-12 col-lg-12 ">
			<div class="card custom-bg">
				<div class="card-body">
					<div class="row">
						<div class="col-8">
							<div class="input-group profile-username input-link span-item-group">
								<div class="input-group-prepend" style="width: 9vh;">
								<img class="profile-user-img img-fluid img-circle" src="vistas/img/inicio/peso.png">
								</div>
								<h2 class="card-text coin-text">$100</h2>
							</div>
							<div class="input-group profile-username input-link span-item-group">
								<div class="input-group-prepend" style="width: 9vh;">
								<img class="profile-user-img img-fluid img-circle" src="vistas/img/inicio/bitcoin.png">
								</div>
								<h2 class="card-text coin-text">$0.05</h2>
							</div>
							<br>
							<!-- <a href="billeteras" class="nav-link"> -->
							<a class="nav-link">
							<button class="btn btn-menu-mineria d-flex align-items-center" data-toggle="modal" id="BilleterasMias" data-target="#modalBilleteras">
								<span class="text-center">Billetera</span>
							</button>
							</a>
						</div>
						<div class="col-4 align-self-end">
							<img src="vistas/img/inicio/billetera.png" class="card-img-top w-1000" alt="billetera" />
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-lg-12 ">
			<div class="card custom-bg">
				<div class="card-body">
					<div class="row">
						<div class="col-8">
							<div class="input-group profile-username input-link span-item-group">
								<div class="input-group-prepend" style="width: 9vh;">
									<img class="profile-user-img img-fluid img-circle" src="vistas/img/inicio/peso.png">
								</div>
								<h2 class="card-text coin-text">$100.000</h2>
							</div>
							<br>
							<br>
							<a href="campanas" class="nav-link">
							<button class="btn btn-menu-mineria d-flex align-items-center">
								<span class="text-center">Minar</span>
							</button>
							</a>
						</div>
						<div class="col-4">
							<img src="vistas/img/inicio/ahorra-dinero.png" class="card-img-top w-1000" alt="Fissure in Sandstone" />
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>



	<!-- Jerson Moreno -->
	<!-- <?php if ($usuario["perfil"] == "admin") { ?>

		<div class="col-12 col-sm-6 col-lg-3">

			<div class="small-box bg-info">
				<div class="inner">
					<h3><?php echo number_format($totalUsuarios[0], 0, ",", "."); ?></h3>

					<p>Usuarios</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="usuarios" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-success">
				<div class="inner">
					<h3><?php echo $totalUsuariosOperando; ?></h3>

					<p>Operando</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="index.php?pagina=usuarios&filtro=operando" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-lg-3">

			<div class="small-box bg-danger">
				<div class="inner">
					<h3><?php echo $totalUsuariosSinOperar; ?></h3>

					<p>Sin Operar</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="index.php?pagina=usuarios&filtro=sin-operar" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	<?php } ?> -->


	<!-- <div class="col-12 col-sm-6 col-lg-3"> -->

	<!-- small box -->
	<!-- <div class="small-box bg-warning">
	<div class="inner">
		<h3><?php echo $totalSinContrato; ?></h3>

		<p>Sin Contrato</p>
	</div>
	<div class="icon">
		<i class="fas fa-users"></i>
	</div>
	<a href="uninivel" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>


</div>
</div> -->
	<?php
	$comprobantes = ControladorComprobantes::ctrMostrarComprobantesxEstado("doc_usuario", $usuario["doc_usuario"], "estado", "1");

	$ticketRecibidos = ControladorSoporte::ctrMostrarTickets("receptor", $usuario["id_usuario"]);
	?>
	<!-- Jerson Moreno -->
	<!-- <?php if ($usuario["perfil"] != "admin") :
				if ($usuario["operando"] == 1) : ?>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="small-box bg-success">
					<div class="inner">
						<h3>OPERANDO</h3>
						<p>------------------------</p>
					</div>
					<div class="icon">
						<i class="fas fa-user"></i>
					</div>
					<a href="campanas" class="small-box-footer">CAMPAÑAS <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		<?php else : ?>
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="small-box bg-red">
					<div class="inner">
						<h3>SIN OPERAR</h3>
						<p>------------------------</p>
					</div>
					<div class="icon">
						<i class="fas fa-user"></i>
					</div>
					<a href="campanas" class="small-box-footer">INVERTIR <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		<?php endif ?>
	<?php endif ?> -->
	<!-- Jerson Moreno -->
	<!-- <div class="col-12 col-sm-6 col-lg-3">
		<div class="small-box bg-purple">
			<div class="inner">
				<h3><?php echo $totalRed; ?></h3>

				<p>Red</p>
			</div>
			<div class="icon">
				<i class="fas fa-sitemap"></i>
			</div>
			<a href="uninivel" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div> -->

	<!-- Jerson Moreno -->
	<!-- <div class="col-12 col-sm-6 col-lg-3">
		<div class="small-box bg-primary">
			<div class="inner">
				<h3><?php echo count($ticketRecibidos); ?></h3>
				<p>Mis tickets</p>
			</div>
			<div class="icon">
				<i class="fas fa-comments"></i>
			</div>
			<a href="soporte" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div> -->
	<!-- ./col -->
	<!-- Jerson Moreno -->
	<!-- <?php if ($usuario["perfil"] != "admin") : ?>
		<div class="col-12 col-sm-6 col-lg-3">
		</div>
		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>$ <?php echo number_format($totalComisiones); ?></h3>
					<p>COMISIONES LIQUIDADAS</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="ingresos-binaria" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>$ <?php echo number_format($totalInversiones); ?></h3>
					<p>INVERSIONES LIQUIDADAS</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>$ <?php echo number_format($totalBonos); ?></h3>
					<p>BONOS LIQUIDADOS</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="ingresos-extras" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>$ <?php echo number_format($totalPagosPublicidad); ?></h3>
					<p>PUBLICIDAD LIQUIDADA</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="ingresos-publicidad" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3>$ <?php echo number_format($totalComisionesApagar); ?></h3>
					<p>COMISIONES SIN LIQUIDAR</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="comisiones-sin-liquidar" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3>$ <?php echo number_format($totalInversionesApagar); ?></h3>
					<p>INVERSIONES SIN LIQUIDAR</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="inversiones-sin-liquidar" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3>$ <?php echo number_format($totalBonosApagar); ?></h3>
					<p>BONOS SIN LIQUIDAR</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="extras-sin-liquidar" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-lg-3">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3>$ <?php echo number_format($totalPublicidadApagar); ?></h3>
					<p>PUBLICIDAD SIN LIQUIDAR</p>
				</div>
				<div class="icon">
					<i class="fas fa-dollar-sign"></i>
				</div>
				<a href="publicidad-sin-liquidar" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col ->

	<?php endif ?> -->
</div>


<!--=====================================
Cambiar Contraseña
======================================-->

<!-- The Modal -->
<div class="modal" id="cambiarPassword">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<h4 class="modal-title">Cambiar contraseña</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idUsuarioPassword" value="<?php echo $usuario["id_usuario"] ?>">
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Nueva contraseña" name="editarPassword" required>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<!-- <div>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div> -->
					<div>
						<button type="submit" class="btn btn-primary">Enviar</button>
					</div>
				</div>
				<?php
				$cambiarPassword = new ControladorUsuarios();
				$cambiarPassword->ctrCambiarPassword();
				?>
			</form>
		</div>
	</div>
</div>

<!--=====================================
Actualizar Datos nombre y telefono
======================================-->

<!-- The Modal -->
<div class="modal" id="modalActualizarDatos">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<h4 class="modal-title" style ="text-align: center;">Actualizar mis datos</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idUsuario" value="<?php echo $usuario["id_usuario"] ?>">
					<div class="form-group">
						<label for="editarNombre">Nombre Completo:</label>
						<input type="text" class="form-control" id="editarNombre" name="editarNombre" required>
					</div>
					<div class="form-group">
						<label for="editarMovil" class="control-label">Teléfono Móvil</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="p-2 bg-info rounded-left dialCode"></span>
								<input id="indicativo" type="hidden" name="indicativo">
							</div>
							<input type="text" name="editarMovil" class="form-control" required id="editarMovil" data-inputmask="'mask':'(999) 999-9999'" data-mask>
						</div>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<!-- <div>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div> -->
					<div>
						<button type="submit" class="btn btn-modallFer">Enviar</button>
					</div>
				</div>
				<?php
				$actualizarDatos = new ControladorUsuarios();
				$actualizarDatos->ctrActualizarDatos();
				?>
			</form>
		</div>
	</div>
</div>


<!--=====================================
SELECCIONAR BILLETERAS
======================================-->

<!-- The Modal -->
<div class="modal" id="modalBilleteras">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<h4 class="modal-title" style="text-align: center;">Seleccione la Billetera</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="d-flex justify-content-between">
						<div class="text-center">
							<div class="d-flex flex-column align-items-center">
							<a href="billeteras" class="d-flex flex-column align-items-center">
								<img class="profile-user-img img-fluid img-circle" src="vistas/img/inicio/cripto.png">
								<label>CRIPTOMONEDA</label>
							</a>
							</div>
						</div>
						<div class="text-center">
							<div class="d-flex flex-column align-items-center">
							<a href="billcop" class="d-flex flex-column align-items-center">
								<img class="profile-user-img img-fluid img-circle" src="vistas/img/inicio/cop.png">
								<label>PESOS</label>
						    </a>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<div>
						<button type="submit" class="btn btn-modallFer">SALIR</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

