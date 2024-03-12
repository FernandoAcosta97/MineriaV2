<!-- <?php

$pagos = ControladorPagos::ctrMostrarPagosAll("id_usuario",$usuario["id_usuario"]);
$total_a_pagar=0;
$total_pagos=0;

$solicitudesRetiro=ControladorPagos::ctrMostrarSolicitudesRetiro("usuario", $usuario["id_usuario"], null,null);

$comprobantes=ControladorComprobantes::ctrMostrarComprobantes("doc_usuario",$usuario["doc_usuario"]);

$egresos=0;
$ingresos=0;

foreach ($solicitudesRetiro as $key => $value) {

	if($value["billetera"]==2){
	if($value["tipo"]==1){
		$ingresos=$ingresos+$value["valor"];
	}else{
		$egresos=$egresos+$value["valor"];
	}
}
      
}


// var_dump($pagos);

$saldo_cop=0;
$saldo_crypto=0;
$inversiones=0;
// var_dump($comprobantes);
foreach ($comprobantes as $key => $value) {

if($value["estado"]!=0 && $value["billetera"]==2){
	$inversiones=$inversiones+$value["valor"];
}

}

foreach ($pagos as $key => $value) {
	$total=0;

	$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

	if($comprobante){
	
	$campana = ControladorCampanas::ctrMostrarCampanas("id",$comprobante[0]["campana"]);

	$ganancia = ($comprobante[0]['valor']*$campana['retorno'])/100;

	$total=$comprobante[0]['valor']+$ganancia;

	if($comprobante["0"]["billetera"]==2){
	if($value["estado"]==0){
		$total_a_pagar+=$total;
	}else{
		
		$saldo_crypto=$saldo_crypto+$total;
		
		$total_pagos+=$total;
	}
}
}

}
// var_dump($saldo_crypto-$egresos);
$ingresos=$ingresos+$total_pagos;

?> -->

<!--=====================================
ANOTE LAS ETIQUETAS PHP PORQUE IMPRIMIAN UN int(0) EN LA UI
======================================-->

<div class="row">

	<!-- <div class="col-12 col-sm-6 col-lg-3">
	
		<div class="small-box bg-info">

			<div class="inner">

				<h3>$ <span></span><?php echo number_format($ingresos-$egresos-$inversiones) ?></h3>

				<p class="text-uppercase">Retirar</p>

			</div>

			<div class="icon">

				<i class="fas fa-dollar-sign"></i>

			</div>

			<a href="#" data-toggle="modal" data-target="#modalRetirar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div> -->
	<div class="m-6 rounded-xl border-solid border w-full sm:w-[21%] min-w-[300px] border-primario bg-primario text-white hover:scale-105 transition inner-shadow">
        <div class="flex justify-end">
            <div class="bg-white p-5 rounded-full flex h-[20px] w-[20px] justify-center items-center mx-3 mt-3 mb-6">
                <p class="font-bold text-6xl">$</p>
            </div>
        </div>
        <a data-toggle="modal" data-target="#modalRetirar" href="#">
            <div class="flex justify-between p-4 bg-white rounded-b-lg">
                <div class="flex flex-col justify-around font-bold text-xl">
                    <p>Retirar</p>
                    <p>$<?php echo number_format($ingresos-$egresos-$inversiones) ?></p>
                </div>
                <div class="flex justify-center items-center">
                    <div class=" h-[122px]">
						<img src="vistas/img/cajero-automatico.png" alt="retiro de dinero">
					</div>
                </div>
            </div>
        </a>
    </div>

	<!-- <div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <span><?php echo number_format($ingresos) ?></span></h3>

				<p class="text-uppercase">Ingresos</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>

	</div> -->

	<div class="m-6 rounded-xl border-solid border w-full sm:w-[21%] min-w-[300px] border-primario bg-[#694ED9] hover:scale-105 transition inner-shadow">
        <div class="flex justify-end">
            <div class="bg-white p-5 rounded-full flex h-[20px] w-[20px] justify-center items-center mx-3 mt-3 mb-6">
                <p class="font-bold text-6xl">$</p>
            </div>
        </div>
        <a href="ingresos-uninivel">
            <div class="flex justify-between p-4 bg-white rounded-b-lg">
                <div class="flex flex-col justify-around font-bold text-xl">
                    <p>Ingresos</p>
                    <p>$<?php echo number_format($ingresos) ?></p>
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

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <span><?php echo number_format($egresos) ?></span></h3>

				<p class="text-uppercase">Egresos</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>
	</div> -->

	<div class="m-6 rounded-xl border-solid border w-full sm:w-[21%] min-w-[300px] border-primario bg-[#B52AF6] hover:scale-105 transition inner-shadow">
        <div class="flex justify-end">
            <div class="bg-white p-5 rounded-full flex h-[20px] w-[20px] justify-center items-center mx-3 mt-3 mb-6">
                <p class="font-bold text-6xl">$</p>
            </div>
        </div>
        <a href="ingresos-uninivel">
            <div class="flex justify-between p-4 bg-white rounded-b-lg">
                <div class="flex flex-col justify-around font-bold text-xl">
                    <p>Egresos</p>
                    <p>$<?php echo number_format($egresos) ?></p>
                </div>
                <div class="flex justify-center items-center">
                    <div class=" h-[122px]">
						<img src="vistas/img/retiro-de-dinero.png" alt="retiro de dinero">
					</div>
                </div>
            </div>
        </a>
    </div>

	<!-- <div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <span>-</span></h3>

				<p class="text-uppercase">Reinvertir</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="campanas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>
	</div> -->

	<div class="m-6 rounded-xl border-solid border w-full sm:w-[21%] min-w-[300px] border-primario bg-[#F22AF6] hover:scale-105 transition inner-shadow">
        <div class="flex justify-end">
            <div class="bg-white p-5 rounded-full flex h-[20px] w-[20px] justify-center items-center mx-3 mt-3 mb-6">
                <p class="font-bold text-6xl">$</p>
            </div>
        </div>
        <a data-toggle="modal" data-target="#modalReinvertir" href="campanas">
            <div class="flex justify-between p-4 bg-white rounded-b-lg">
                <div class="flex flex-col justify-around font-bold text-xl">
                    <p>Reinvertir</p>
                    <p>$-</p>
                </div>
                <div class="flex justify-center items-center">
                    <div class=" h-[122px]">
						<img src="vistas/img/ingresos.png" alt="reinversion">
					</div>
                </div>
            </div>
        </a>
    </div>

</div>



</div>





<!--=====================================
RETIRAR
======================================-->

<!-- The Modal -->
<div class="modal" id="modalRetirar">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post">

	      <!-- Modal Header -->
<div class="modal-header bg-primario text-white">	        <h4 class="modal-title">Solicitud de retiro</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

              <div class="form-group">

                  <label for="inputMovil" class="control-label">Teléfono</label>

				  <div class="input-group"> 

				  <?php 
					   $t = explode(" ", $usuario["telefono_movil"]);
					   $indicativo = $t[0];
					   $telefono = $t[1]."".$t[2]; 
				?>

			   		   <div class="input-group-prepend">
                        <span class="p-2 bg-info rounded-left dialCode"><?php echo $indicativo ?></span>
						<input id="indicativo" type="hidden" name="indicativo">
                       </div>

					   <input type="text" class="form-control" id="inputMovil" name="telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required readonly value="<?php echo $telefono ?>">

                </div>

              </div>


			  <div class="form-group">

				<label for="registrarValor" class="control-label">Disponible</label>

				<div>

				<input type="number" class="form-control" id="disponible" placeholder="$ <?php echo number_format($saldo_cop-$egresos) ?>" readonly>

				</div>

			</div>

              <div class="form-group">

                <label for="valor" class="control-label">Valor</label>

                <div>

                <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" required>

                </div>

              </div>


	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>

	        	<button type="submit" class="btn bg-primario text-white">Generar OTP</button>
	        </div>

	      </div>

		<?php

			$solicitudRetiro = new ControladorPagos();
			$solicitudRetiro->ctrSolicitudRetiro($usuario["id_usuario"], 2, $ingresos-$egresos);

		?>

      </form>

    </div>
  </div>
</div>


<!-- The Modal 2 -->
<div class="modal" id="modalReinvertir">
	<div class="flex justify-center items-center h-full bg-transparent">
		<div class="w-3/4"> <!-- Aquí es donde se cambia el ancho -->
		<div class="modal-content bg-transparent">

			<!-- Modal Header -->
			<div class="mt-[50vh] sm:mt-0 modal-header flex items-center bg-primario text-white">
				<h4 class="modal-title mx-auto text-center">Reinvertir</h4>
				<button type="button" class="close m-0" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="w-full">

				<div class="flex flex-wrap w-full bg-white">
					<div class="flex flex-wrap p-4 w-full sm:w-1/3">
						<div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-[#694ED9] hover:scale-105 transition inner-shadow">
							<div class="flex justify-between">
								<div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
									30%
								</div>
								<img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
							</div>
							<div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
								<ul class="list-none">
									<li>Campaña minado 1</li>
									<li>finaliza el dia:</li>
									<li>dd/mm/aa</li>
									<li>paga el dia:</li>
									<li>dd/mm/aa</li>
								</ul>
								<button class="btn px-10 mx-auto mb-8 bg-[#694ED9] text-white hover:border hover:text-blue-900">
									Minar
								</button>
							</div>
						</div>
					</div>

					<div class="flex flex-wrap p-4 w-full sm:w-1/3">
						<div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-[#B52AF6] hover:scale-105 transition inner-shadow">
							<div class="flex justify-between">
								<div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
									50%
								</div>
								<img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
							</div>
							<div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
								<ul class="list-none">
									<li>Campaña minado 2</li>
									<li>finaliza el dia:</li>
									<li>dd/mm/aa</li>
									<li>paga el dia:</li>
									<li>dd/mm/aa</li>
								</ul>
								<button class="btn px-10 mx-auto mb-8 bg-[#B52AF6] text-white hover:border hover:text-blue-900">
									Minar
								</button>
							</div>
						</div>
					</div>

					<div class="flex flex-wrap p-4 w-full sm:w-1/3">
						<div class="rounded-xl border-solid border w-full min-w-[200px] border-primario bg-[#F22AF6] hover:scale-105 transition inner-shadow">
							<div class="flex justify-between">
								<div class="bg-white p-3 rounded-full h-20 w-20 flex items-center font-bold ml-10 my-1 text-3xl justify-center">
									70%
								</div>
								<img class="h-20 mr-10 my-1" src="vistas/img/servidor-de-datos.png" alt="">
							</div>
							<div class="flex flex-col justify-start gap-0 bg-white rounded-b-lg">
								<ul class="list-none">
									<li>Campaña minado 3</li>
									<li>finaliza el dia:</li>
									<li>dd/mm/aa</li>
									<li>paga el dia:</li>
									<li>dd/mm/aa</li>
								</ul>
								<button class="btn px-10 mx-auto mb-8 bg-[#F22AF6] text-white hover:border hover:text-blue-900">
									Minar
								</button>
							</div>
						</div>
					</div>
				</div>


			</div>

		</div>
	</div>
	</div>
</div>