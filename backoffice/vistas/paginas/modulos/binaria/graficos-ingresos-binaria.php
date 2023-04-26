<?php

$pagos = ControladorPagos::ctrMostrarPagosComisionesxEstadoAll("id_usuario", $usuario["id_usuario"],"estado",1);
$total_pagos=0;

if($pagos!=""){

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

	$total_pagos+=$total;
	

}
}

?>

<div class="card card-primary card-outline">
	
	<div class="card-header">	

		<h3 class="pl-3 pt-3">
			
			<i class="fas fa-chart-pie mr-1"></i>

			Comisiones históricas: COP$ <?php echo number_format($total_pagos); ?>

		</h3>

		<h6 class="pl-3">Total comisiones históricas: US$ <?php echo number_format($total_pagos, 2, ",", "."); ?></h6>

	</div>

	<div class="card-body">	
	
		<div class="tab-content p-0">
			
			<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>

			<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>

		</div>

	</div>


</div>

<script>
	

var area = new Morris.Area({
element   : 'revenue-chart',
resize    : true,
data      : [

<?php

	foreach ($pagos as $key => $value) {

	    echo "{y: '".substr($value["fecha"],0,-9)."', item1: ".$value["valor"]."},";		
		
	}

  ?>


],
xkey      : 'y',
ykeys     : ['item1'],
labels    : ['Total'],
lineColors: ['#17a2b8', '#727cb6'],
hideHover : 'auto'

})


</script>