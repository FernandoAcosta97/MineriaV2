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
		<!-- <div class="col col-sm-6 col-lg-11">
			<div class="card card-info card-outline">
				<div class="card-body box-profile">
					<div class="row justify-content-around">
						<div class="col-sm-4 align-self-center">
							<?php if ($usuario["foto"] == "") : ?>
								<img class="profile-user-img img-fluid img-circle" src="vistas/img/usuarios/default/default.png">
							<?php else : ?>
								<img class="profile-user-img img-fluid img-circle" src="<?php echo $usuario["foto"] ?>">
							<?php endif ?>
						</div>
						<div class="col-sm-8">
							<h3 class="profile-username text-center">
								<strong><?php echo $usuario["nombre"] ?></strong>
							</h3>
							<p class="profile-username  text-center">
								<?php echo $usuario["email"] ?>
							</p>
							<h3 class="profile-username text-center">
								<?php echo $usuario["doc_usuario"] ?>
							</h3>
							<h3 class="profile-username text-center">
								<?php echo $usuario["usuario"] ?>
							</h3>
							<div class="input-group profile-username text-center">
								<div class="input-group-prepend">
									<span class="bg-info rounded-left copiarLink" style="cursor:pointer">Copiar</span>
								</div>
								<input type="text" class="form-control" id="linkAfiliado" value="<?php echo $ruta . $usuario["enlace_afiliado"]; ?>" readonly>
							</div>
							<div class="text-center">
								<?php if ($usuario["perfil"] != "admin") : ?>
									<button class="btn btn-primary btn-sm" data-toggle="modal" id="actualizarDatos" data-target="#modalActualizarDatos" idUsuario="<?php echo $usuario["id_usuario"] ?>">Actualizar datos</button>
								<?php endif ?>
								<button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#cambiarPassword">Cambiar contraseña</button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div> -->
		<!-- Jerson Arnual -->
		<div class="col col-sm-6 col-lg-12">
			<div class="card bg-light d-flex flex-fill">
				<div class="card-header text-muted border-bottom-0">
					Digital Strategist
				</div>
				<div class="card-body pt-0">
					<div class="row">
						<div class="col-5 text-center">
							<?php if ($usuario["foto"] == "") : ?>
								<img class="profile-user-img img-fluid img-circle" src="vistas/img/usuarios/default/default.png">
							<?php else : ?>
								<img class="profile-user-img img-fluid img-circle" src="<?php echo $usuario["foto"] ?>">
							<?php endif ?>
						</div>
						<div class="col-7">
							<h1 class="lead"><b>Nicole Pearsons</b></h1>
							<p class="text-muted"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
							<ul class="ml-4 mb-0 fa-ul text-muted">
								<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
								<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
							</ul>
						</div>

					</div>
				</div>
				<div class="card-footer">
					<div class="text-right">
						<a href="#" class="btn btn-sm bg-teal">
							<i class="fas fa-comments"></i>
						</a>
						<a href="#" class="btn btn-sm btn-primary">
							<i class="fas fa-user"></i> View Profile
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row justify-content-between">
			<div class="content-button">
				<a class="btn btn-app bg-info">
					<i class="fas fa-heart"></i>
					<h2>Pagos</h2>
				</a>
			</div>
			<div class="content-button">
				<a class="btn btn-app bg-info">
					<i class="fas fa-heart"></i>
					<h2>Historial</h2>
				</a>
			</div>
		</div>

	</div>
	<div class="col-sm-4 align-self-start">
		<div class="col-12 col-sm-12 col-lg-12 ">
			<div class="card custom-bg">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<h2 class="card-text">$100.000.00</h2>
							<h2 class="card-text">$100.000.00</h2>
							<br>
							<button class="btn btn-menu-mineria d-flex align-items-center">
								<span class="text-center">Billetera</span>
							</button>
						</div>
						<div class="col-5 align-self-end">
							<img src="../../../img/Inicio/billetera.png" class="card-img-top w-1000" alt="Fissure in Sandstone" />
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-lg-12 ">
			<div class="card custom-bg">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<h2 class="card-text">$20.000.00</h2>
							<br>
							<br>
							<button class="btn btn-menu-mineria d-flex align-items-center">
								<span class="text-center">Minar</span>
							</button>
						</div>
						<div class="col-5">
							<img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top w-1000" alt="Fissure in Sandstone" />
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