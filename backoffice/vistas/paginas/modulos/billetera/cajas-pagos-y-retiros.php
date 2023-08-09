<?php

$pagos = ControladorPagos::ctrMostrarPagosAll("id_usuario",$usuario["id_usuario"]);
$total_a_pagar=0;
$total_pagos=0;


foreach ($pagos as $key => $value) {
	$total=0;

	$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
	
	$campana = ControladorCampanas::ctrMostrarCampanas("id",$comprobante[0]["campana"]);

	$ganancia = ($comprobante[0]['valor']*$campana['retorno'])/100;

	$total=$comprobante[0]['valor']+$ganancia;

	if($value["estado"]==0){
		$total_a_pagar+=$total;
	}else{
		$total_pagos+=$total;
	}

}

?>


<div class="row">


	<div class="col-12 col-sm-6 col-lg-3">
  <div class="small-box bg-info">
     <div class="top-section d-flex justify-content-end">
      <h3>$ <span><?php echo number_format($total_a_pagar); ?>
					</span></h3>
	 </div>
			<div class="d-flex justify-content-center white-section align-items-center">
				<div class="d-flex flex-column align-items-center">
					<label class="text-uppercase">Retirar</label>
					<label style="font-size: 25px;">$ 0,00</label>
				</div>
				<div class="d-flex flex-column align-items-center">
					<a href="billeteras" class="d-flex flex-column align-items-center">
						<img class="profile-user-img img-fluid" src="vistas/img/Inicio/reti.png">
					</a>
				</div>
			</div>
		</div>
	</div>




	<div class="col-12 col-sm-6 col-lg-3">
  <div class="small-box bg-purple">
     <div class="top-section d-flex justify-content-end">
      <h3>$ <span><?php echo number_format($total_a_pagar); ?>
					</span></h3>
	 </div>
			<div class="d-flex justify-content-center white-section align-items-center">
				<div class="d-flex flex-column align-items-center">
					<label class="text-uppercase">Ingresos</label>
					<label style="font-size: 25px;">$ 0,00</label>
				</div>
				<div class="d-flex flex-column align-items-center">
					<a href="billeteras" class="d-flex flex-column align-items-center">
						<img class="profile-user-img img-fluid" src="vistas/img/Inicio/ingresos.png">
					</a>
				</div>
			</div>
		</div>
	</div>


	<div class="col-12 col-sm-6 col-lg-3">
  <div class="small-box bg-purpleclar">
     <div class="top-section d-flex justify-content-end">
      <h3>$ <span><?php echo number_format($total_a_pagar); ?>
					</span></h3>
	 </div>
			<div class="d-flex justify-content-center white-section align-items-center">
				<div class="d-flex flex-column align-items-center">
					<label class="text-uppercase">Egresos</label>
					<label style="font-size: 25px;">$ 0,00</label>
				</div>
				<div class="d-flex flex-column align-items-center">
					<a href="billeteras" class="d-flex flex-column align-items-center">
						<img class="profile-user-img img-fluid" src="vistas/img/Inicio/egresos.png">
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-6 col-lg-3">
  <div class="small-box bg-rosa">
     <div class=" d-flex justify-content-end">
      <h3>$ <span><?php echo number_format($total_a_pagar); ?>
					</span></h3>
	 </div>
			<div class="d-flex justify-content-center white-section align-items-center">
				<div class="d-flex flex-column align-items-center">
					<label class="text-uppercase">Reinvertir</label>
					<label style="font-size: 25px;">$ 0,00</label>
				</div>
				<div class="d-flex flex-column align-items-center">
					<a href="billeteras" class="d-flex flex-column align-items-center">
						<img class="profile-user-img img-fluid" src="vistas/img/Inicio/reinver.png">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

