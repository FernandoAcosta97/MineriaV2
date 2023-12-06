<?php


$total_a_pagar = 0;
$total_pagos = 0;
$pagos = ControladorPagos::ctrMostrarSolicitudesRetiro(null,null,null,null);

foreach ($pagos as $key => $value) {

	$usu=ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["usuario"]);

	if(is_array($usu)){

	if($value["estado"]==2){
		$total_a_pagar+=$value["valor"];
	}else{
		$total_pagos+=$value["valor"];
	}
	}


}



?>

<div class="row">

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-info">

			<div class="inner">

				<h3>$ <span><?php echo number_format($total_a_pagar); ?></span></h3>

				<p class="text-uppercase">Retiros por pagar</p>

			</div>

			<div class="icon">

				<i class="fas fa-dollar-sign"></i>

			</div>

			<a href="pagos-retiros" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <span><?php echo number_format($total_pagos); ?></span></h3>

				<p class="text-uppercase">Retiros pagados</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="retiros-pagados" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>

	</div>



</div>

