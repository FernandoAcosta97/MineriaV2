<?php

$pagos = ControladorPagos::ctrMostrarPagosAll("id_usuario",$usuario["id_usuario"]);
$total_a_pagar=0;
$total_pagos=0;

// var_dump($pagos);

if($pagos){

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
		$total_pagos+=$total;
	}
}

}
}

?>


<div class="row">

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-info">

			<div class="inner">

				<h3><span></span>0</h3>

				<p class="text-uppercase">Salidas</p>

			</div>

			<div class="icon">

				<i class="fas fa-dollar-sign"></i>

			</div>

			<a href="inversiones-sin-liquidar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

<?php 
// $estimado_binance=ControladorUsuarios::binance();
$estimado_binance=0;
 ?>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>BTC <span><?php echo number_format($estimado_binance,1) ?></span></h3>

				<p class="text-uppercase">Entradas</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>

	</div>

    <div class="col-12 col-sm-6 col-lg-3">

<div class="small-box bg-purple">

    <div class="inner">

        <h3>$ <span>0</span></h3>

        <p class="text-uppercase">Envia</p>

    </div>

    <div class="icon">

        <i class="fas fa-wallet"></i>

    </div>

    <a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
    
</div>
</div>

<div class="col-12 col-sm-6 col-lg-3">

<div class="small-box bg-purple">

    <div class="inner">

        <h3>$ <span>0</span></h3>

        <p class="text-uppercase">Retira</p>

    </div>

    <div class="icon">

        <i class="fas fa-wallet"></i>

    </div>

    <a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
    
</div>
</div>

</div>



</div>

