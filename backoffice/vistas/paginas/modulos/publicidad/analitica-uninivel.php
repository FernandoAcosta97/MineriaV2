<?php

$pagos = ControladorPagos::ctrMostrarPagosComisionesAll("id_usuario", $usuario["id_usuario"]);
$total_a_pagar=0;
$total_pagos=0;


foreach ($pagos as $key => $value) {
	$total=0;
	$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision",$value["id"]);

		foreach($comisiones as $key2 => $value2){
           
				$porcentaje=0;
				if($value2["nivel"]==1){
					$porcentaje=5;
				}
				if($value2["nivel"]==2){
					$porcentaje=4;
				}
				if($value2["nivel"]==3){
					$porcentaje=3;
				}
				if($value2["nivel"]==4){
					$porcentaje=2;
				}
				if($value2["nivel"]==5){
					$porcentaje=1;
				}
				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value2["id_comprobante"]);
				$ganancia = ($comprobante[0]["valor"]*$porcentaje)/100;
				$total=$total+$ganancia;
			}

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

			<div class="inner">

				<h3>$ <?php echo number_format($total_a_pagar); ?></h3>

				<p class="text-uppercase">Comisiones de este período</p>

			</div>

			<div class="icon">

				<i class="fas fa-dollar-sign"></i>

			</div>

			<a href="" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <?php echo number_format($total_pagos); ?></h3>

				<p class="text-uppercase">Comisiones recibidas</p>
				
			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>

	</div>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-primary">

			<div class="inner">

				<h3>0</h3>

				<p class="text-uppercase">Mis tickets</p>

			</div>

			<div class="icon">

				<i class="fas fa-comments"></i>

			</div>

			<a href="" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-dark">

		<?php if ($usuario["enlace_afiliado"] != $patrocinador): ?>

			<div class="inner">

				<h3 class="text-secondary"><?php echo $usuario["vencimiento"]; ?></h3>

				<p class="text-uppercase">Próximo pago de comisión</p>

			</div>

			<div class="icon">

				<i class="fas fa-user-plus"></i>

			</div>

			<a href="" class="small-box-footer">Cancelar Suscripción <i class="fa fa-arrow-circle-right"></i></a>

		<?php else: ?>

			<div class="inner">

				<h3 class="text-secondary">0</h3>

				<p class="text-uppercase">Perfil Administrador</p>

			</div>

			<div class="icon">

				<i class="fas fa-user-plus"></i>

			</div>
		
			<a href="" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>

		<?php endif ?>

		</div>
		
	</div>



</div>

