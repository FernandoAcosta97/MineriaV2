<?php


$total_a_pagar = 0;
$total_pagos = 0;
$pagos = ControladorPagos::ctrMostrarPagos(null,null);

foreach ($pagos as $key => $value) {

	$usu=ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["id_usuario"]);

	if(is_array($usu)){

	$comprobante=ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);

	$campana=ControladorCampanas::ctrMostrarCampanas("id",$comprobante[0]["campana"]);

	$campana_apalancamiento=ControladorCampanas::ctrMostrarCampanasxEstado("tipo", 4, "estado", 1);

	$retorno_apalancamiento=0;
	$ganancia_apalancamiento=0;

	if($campana_apalancamiento!=""){
		$retorno_apalancamiento=$campana_apalancamiento["retorno"];
		$ganancia_apalancamiento=($comprobante[0]['valor']*$campana_apalancamiento['retorno'])/100;
	}

	$valor_mas_apalancamiento=$comprobante[0]['valor']+$ganancia_apalancamiento;

	$ganancia = ($valor_mas_apalancamiento*$campana['retorno'])/100;

	$retorno_total = $valor_mas_apalancamiento+$ganancia;

	if($value["estado"]==0){
		$total_a_pagar+=$retorno_total;
	}else{
		$total_pagos+=$retorno_total;
	}
	}


}



?>

<div class="row">

	<div class="m-6 rounded-xl border-solid border w-full sm:w-[21%] min-w-[300px] border-primario bg-primario text-white hover:scale-105 transition inner-shadow">
        <div class="flex justify-end">
            <div class="bg-white p-5 rounded-full flex h-[20px] w-[20px] justify-center items-center mx-3 mt-3 mb-6">
                <p class="font-bold text-6xl">$</p>
            </div>
        </div>
        <a data-toggle="modal" data-target="#modalRetirar" href="#">
            <div class="flex justify-between p-4 bg-white rounded-b-lg">
                <div class="flex flex-col justify-around font-bold text-xl">
                    <p>Inversiones por pagar</p>
                    <p>$<?php echo number_format($total_a_pagar); ?></p>
                </div>
                <div class="flex justify-center items-center">
                    <div class=" h-[122px]">
						<img src="vistas/img/cajero-automatico.png" alt="retiro de dinero">
					</div>
                </div>
            </div>
        </a>
    </div>

	<div class="m-6 rounded-xl border-solid border w-full sm:w-[21%] min-w-[300px] border-primario bg-[#694ED9] hover:scale-105 transition inner-shadow">
        <div class="flex justify-end">
            <div class="bg-white p-5 rounded-full flex h-[20px] w-[20px] justify-center items-center mx-3 mt-3 mb-6">
                <p class="font-bold text-6xl">$</p>
            </div>
        </div>
        <a href="ingresos-uninivel">
            <div class="flex justify-between p-4 bg-white rounded-b-lg">
                <div class="flex flex-col justify-around font-bold text-xl">
                    <p>Inversiones pagadas</p>
                    <p>$<?php echo number_format($total_pagos); ?></p>
                </div>
                <div class="flex justify-center items-center">
                    <div class=" h-[122px]">
						<img src="vistas/img/transferencia-de-dinero.png" alt="transferencia de dinero">
					</div>
                </div>
            </div>
        </a>
    </div>

	<!-- <div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-info">

			<div class="inner">

				<h3>$ <span><?php echo number_format($total_a_pagar); ?></span></h3>

				<p class="text-uppercase">Inversiones por pagar</p>

			</div>

			<div class="icon">

				<i class="fas fa-dollar-sign"></i>

			</div>

			<a href="pagos-inversiones" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <span><?php echo number_format($total_pagos); ?></span></h3>

				<p class="text-uppercase">Inversiones pagadas</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="inversiones-pagadas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>

	</div> -->



</div>

