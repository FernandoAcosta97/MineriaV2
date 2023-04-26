<?php

$regresar = false;

if (isset($_GET["id"])) {

    $valor = $_GET["id"];
    $usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $valor);
    $regresar = true;

} else {

    $valor = $usuario["id_usuario"];
}

$red = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "usuario_red", $valor);

$ordenBinaria = $red[0]["orden_binaria"];
//  print_r($red);

?>

<input type="hidden" value="<?php echo $usuario["id_usuario"] ?>" id="id_usuario">

<div class="card card-primary card-outline preloadRed">

	<div class="card-header">

	<?php if ($red[0]["patrocinador_red"] != ""): ?>


		<h5 class="float-left">Patrocinador:
			<span class="badge badge-secondary"><?php echo $red[0]["patrocinador_red"]; ?></span>
		</h5>

		<?php endif?>



		<!--=====================================
		TABLA GANANCIAS
		======================================-->

		<?php if ($regresar): ?>

			<a href="javascript:history.back()" class="btn btn-default btn-sm text-secondary float-right"><i class="fas fa-chevron-left"></i> Regresar</a>

		<?php else: ?>

		<div class="habilitarGananciasBinarias" verGanancias="ok"></div>

		<button type="button" class="btn btn-info btn-sm text-white float-right verGanancias">
			<i class="fas fa-sitemap"></i>
		</button>

		<div class="tablaGanancias">

			<table class="table table-striped table-bordered table-light text-center">

				<thead class="bg-info">
					<tr>
						<th><i class="fas fa-table"></i></th>
						<th>Izquierdo</th>
						<th>Derecho</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>Directos</td>
						<td><span class="directoIzq">0</span></td>
						<td><span class="directoDer">0</span></td>
					</tr>

					<tr>
						<td>Derrame</td>
						<td><span class="derrameIzq">0</span></td>
						<td><span class="derrameDer">0</span></td>
					</tr>

					<tr>
						<td><b>Puntos</b></td>
						<td><b><span class="totalLadoIzq">0</span> Puntos</b></td>
						<td><b><span class="totalLadoDer">0</span> Puntos</b></td>
					</tr>
				</tbody>
			</table>

		</div>

		<?php endif?>

	</div>

	<div class="card-body">

	<div style="width:100%; height:700px;" id="arbol"></div>

		</div>

	</div>

</div>


<?php


$respuesta = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "derrame_binaria", $ordenBinaria);
print_r($respuesta);

echo '<script>

var nodes = [];

var chart = new OrgChart(document.getElementById("arbol"), {
	lazyLoading: true,
	mouseScrool: OrgChart.action.xScroll,
	// scaleInitial: OrgChart.match.height,
	nodeBinding: {
		field_0: "name",
		img_0: "photo"
	},
	nodes: [
		{ id: 1, name: "Amber McKenzie", photo:"https://cdn.balkan.app/shared/1.jpg" },
		{ id: 2, pid: 1, name: "Ava Field" },
		{ id: 3, pid: 1, name: "Peter Stevens" }  
	]
});
		
</script>';

?>