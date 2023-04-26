<?php

$pagos = ControladorPagos::ctrMostrarPagosPublicidadxUsuario("id_usuario", $usuario["id_usuario"],"estado",1);
$total_pagos=0;

foreach ($pagos as $key => $value) { 
	
	$total = $value["valor"];	

	$total_pagos+=$total;

}

?>

<div class="card card-primary card-outline">
	
	<div class="card-header">	

		<h3 class="pl-3 pt-3">
			
			<i class="fas fa-chart-pie mr-1"></i>

			Ganacias históricas: COP $ <?php echo number_format($total_pagos); ?>

		</h3>

		<h6 class="pl-3">Total publicidad histórica: COP $ <?php echo number_format($total_pagos, 2, ",", "."); ?></h6>

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
labels    : ['Ganancia'],
lineColors: ['#17a2b8', '#727cb6'],
hideHover : 'auto'

})


</script>