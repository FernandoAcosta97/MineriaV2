<?php

$pagos = ControladorPagos::ctrMostrarPagosExtrasAll("id_usuario",$usuario["id_usuario"]);
$total_a_pagar=0;
$total_pagos=0;


foreach ($pagos as $key => $value) {
	$total=0;
	$bonos = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra",$value["id"]);

		foreach($bonos as $key2 => $value2){

			$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value2["id_comprobante"]);
			$campana = ControladorCampanas::ctrMostrarCampanas("id", $value2["id_campana"]);
			$total=$total+$campana["retorno"];
			}

	if($value["estado"]==0){
		$total_a_pagar+=$total;
	}else{
		$total_pagos+=$value["valor"];
	}

}

?>


<div class="row">

	<!-- <div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-info">

			<div class="inner">

				<h3>$ <span></span><?php echo number_format($total_a_pagar); ?></h3>

				<p class="text-uppercase">Bonos sin liquidar</p>

			</div>

			<div class="icon">

				<i class="fas fa-dollar-sign"></i>

			</div>

			<a href="extras-sin-liquidar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <span><?php echo number_format($total_pagos); ?></span></h3>

				<p class="text-uppercase">Bonos liquidadas</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="ingresos-extras" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>

	</div> -->

	<div class="m-6 rounded-xl border-solid border w-full sm:w-[21%] min-w-[300px] border-primario bg-primario text-white hover:scale-105 transition inner-shadow">
        <div class="flex justify-end">
            <div class="bg-white p-5 rounded-full flex h-[20px] w-[20px] justify-center items-center mx-3 mt-3 mb-6">
                <p class="font-bold text-6xl">$</p>
            </div>
        </div>
        <a href="inversiones-sin-liquidar">
            <div class="flex justify-between p-4 bg-white rounded-b-lg">
                <div class="flex flex-col justify-around font-bold text-xl">
                    <p>Bonos sin liquidar</p>
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
                    <p>Bonos liquidados</p>
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



</div>

