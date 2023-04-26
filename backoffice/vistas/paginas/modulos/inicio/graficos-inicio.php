<?php

$pagos = ControladorPagos::ctrMostrarPagosInversionesxUsuario("doc_usuario", $usuario["doc_usuario"], "estado", 1);
$total = 0;

if ($pagos != "") {

	foreach ($pagos as $key => $value) {

		$campana = ControladorCampanas::ctrMostrarCampanas("id", $value["campana"]);
		$ganancia = ($value["valor"] * $campana["retorno"]) / 100;
		$total = $total + $value["valor"] + $ganancia;
	}
}

?>

<div class="card card-primary card-outline">

	<div class="card-header">

		<h3 class="pl-3 pt-3">

			<i class="fas fa-chart-pie mr-1"></i>

			Inversiones históricas: COP$ <?php echo number_format($total); ?>

		</h3>

		<h6 class="pl-3">Total inversiones históricas: US$ <?php echo number_format($total, 2, ",", "."); ?></h6>

	</div>

	<div class="card-body">

		<div class="tab-content p-0">

			<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>

		</div>


	</div>

</div>


<div class="card card-primary card-outline">

	<div class="card-header">

		<h3 class="pl-3 pt-3">

			<i class="fas fa-chart-pie mr-1"></i>

			Total rendimientos históricos: COP$ <?php echo number_format($total); ?>

		</h3>

		<h6 class="pl-3">Total rendimientos históricos: US$ <?php echo number_format($total, 2, ",", "."); ?></h6>

	</div>

	<div class="card-body">

		<div class="tab-content p-0">


			<canvas id="myChart" style="width:100%;max-height:400px"></canvas>


		</div>


	</div>

</div>



<script>
	var area = new Morris.Line({
		element: 'revenue-chart',
		resize: true,
		data: [

			<?php
			$total_inversiones = 0;
			foreach ($pagos as $key => $value) {

				$campana = ControladorCampanas::ctrMostrarCampanas("id", $value["campana"]);

				$ganancia = ($value["valor"] * $campana["retorno"]) / 100;

				$total_inversiones += $value["valor"] + $ganancia;

				echo "{y: '" . substr($value["fecha_pago"], 0, -9) . "', item1: " . $value["valor"] . ", item2: " . $ganancia . "},";
			}

			$comisiones = ControladorPagos::ctrMostrarPagosComisionesxEstadoAll("id_usuario", $usuario["id_usuario"], "estado", 1);

			$total_comisiones = 0;
			foreach ($comisiones as $key2 => $value2) {

				$total_comisiones += $value2["valor"];
			}


			$bonos = ControladorPagos::ctrMostrarPagosExtrasxEstadoAll("id_usuario", $usuario["id_usuario"], "estado", 1);


			$total_bonos = 0;
			foreach ($bonos as $key3 => $value3) {

				$total_bonos += $value3["valor"];
			}


			?>


		],
		xkey: 'y',
		ykeys: ['item1', 'item2'],
		labels: ['Inversión', 'Ganancia'],
		lineColors: ['#17a2b8', '#727cb6'],
		hideHover: 'auto'

	})

	var yValues = [
		<?php echo $total_inversiones . "," . $total_comisiones . "," . $total_bonos; ?>
	];
	var xValues = ["Inversiones", "Comisiones", "Bonos Extras"];
	var barColors = [
		"#36a2eb",
		"#ff6384",
		"#ffcd56",
		"#ff9f40",
		"#4bc0c0"
	];

	new Chart("myChart", {
		type: "pie",
		data: {
			labels: xValues,
			datasets: [{
				backgroundColor: barColors,
				data: yValues
			}]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: "Rendimientos"
			}
		}
	});
</script>