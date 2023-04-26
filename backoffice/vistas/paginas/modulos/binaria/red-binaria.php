<?php

$regresar = false;

$usu = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $usuario["id_usuario"]);

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

		<div id="summary" class="tree_main" patrocinador="<?php echo $usuario["enlace_afiliado"]; ?>">

		<?php

		$usuAdmin = false;

		if($usu["perfil"]=="admin") $usuAdmin = true;

	generarArbol($ordenBinaria, $usuario["id_usuario"], $usuario["nombre"], $usuario["foto"], $usuario["enlace_afiliado"], $usuAdmin);

function generarArbol($ordenBinaria, $usuarioRed, $nombre, $foto, $patrocinador, $usuAdmin)
{

	$usuario=ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $usuarioRed);
	
    $lado = "";

    if ($foto == "") {

        $foto = 'vistas/img/usuarios/default/default.png';
    }
      
    /*=============================================
    TRAEMOS LA PRIMERA LÍNEA DESCENDIENTE
    =============================================*/
    $respuesta = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "derrame_binaria", $ordenBinaria);

    // print_r($respuesta);
    echo '<ul id="tree_view" style="display:none">
			       <li>
				   <span data-toggle="tooltip" data-placement="top" title="' . $nombre . '">
				   <img class="tree_icon rounded-circle" src="' . $foto . '">
					<p class="demo_name_style bg-info">' . $nombre . '</p></span>' ;


	if($usuario["perfil"]!="admin"){

		echo generarLineasDescendientes($ordenBinaria, $lado,0,6,$usuAdmin);

	}else{

		echo generarLineasDescendientesAdmin($ordenBinaria, $lado);

	}


    echo '</li>
			</ul>';	

} //FIN FUNCION generarArbol

function generarLineasDescendientes($ordenBinaria, $lado,$n,$niveles,$usuAdmin)
{

	$arbol="";

	if($n<=$niveles){

    $respuesta = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "derrame_binaria", $ordenBinaria);

    $derrame = 0;
    $arbol .= '<ul>';

		/*=============================================
			CUANDO SI HAY LÍNEA DESCENDIENTE
			=============================================*/

			foreach ($respuesta as $key => $value) {

				// TRAEMOS LOS DATOS DEL USUARIO

				$afiliado = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["usuario_red"]);
				// print_r($afiliado);

				// VALIDAMOS LA FOTO

				if($afiliado["foto"] == ""){

					$foto = 'vistas/img/usuarios/default/default.png'; 
				
				}else{

					$foto = $afiliado["foto"];

				}

				// AUMENTAMOS EL DERRAME

				$derrame++;


				$arbol .= '<li>
				<span data-toggle="tooltip" data-placement="top" title="' . $afiliado["nombre"] . '">';
				if($usuAdmin){
				$arbol .= '<a href="index.php?pagina=binaria&id='.$afiliado["id_usuario"].'">';
				}
				$arbol .= '<img class="tree_icon rounded-circle" src="'.$foto.'" patrocinador="'.$afiliado["patrocinador"].'">';
				
				if($afiliado["operando"] == 1){

					$arbol .= '<p class="demo_name_style bg-success">'.$afiliado["nombre"].'</p></a></span>';

				}else{

					$arbol .= '<p class="demo_name_style bg-danger">'.$afiliado["nombre"].'</p></a></span>';
				}
		
		  $n=$n+1;
	      $arbol .= generarLineasDescendientes($value["orden_binaria"], $lado,$n,$niveles,$usuAdmin).'</li>';

			}

$arbol .= '</ul>';
}
return $arbol;	


}



function generarLineasDescendientesAdmin($ordenBinaria, $lado)
{

    $respuesta = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "derrame_binaria", $ordenBinaria);

    $derrame = 0;
    $arbol = '<ul>';

    
		/*=============================================
			CUANDO SI HAY LÍNEA DESCENDIENTE
			=============================================*/

			foreach ($respuesta as $key => $value) {

				// TRAEMOS LOS DATOS DEL USUARIO

				$afiliado = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["usuario_red"]);
				// print_r($afiliado);

				// VALIDAMOS LA FOTO
				if(is_array($afiliado)){

				if($afiliado["foto"] == ""){

					$foto = 'vistas/img/usuarios/default/default.png'; 
				
				}else{

					$foto = $afiliado["foto"];

				}
			

				// AUMENTAMOS EL DERRAME

				$derrame++;


				$arbol .= '<li>
				<span data-toggle="tooltip" data-placement="top" title="' . $afiliado["nombre"] . '">
				<a href="index.php?pagina=binaria&id='.$afiliado["id_usuario"].'">
				<img class="tree_icon rounded-circle" src="'.$foto.'" patrocinador="'.$afiliado["patrocinador"].'">';
				
				if($afiliado["operando"] == 1){

					$arbol .= '<p class="demo_name_style bg-success">'.$afiliado["nombre"].'</p></a></span>';
					
				}else{

					$arbol .= '<p class="demo_name_style bg-danger">'.$afiliado["nombre"].'</p></a></span>';
				}
			}

	      $arbol .= generarLineasDescendientesAdmin($value["orden_binaria"], $lado).'</li>';

			}

		$arbol .= '</ul>';

return $arbol;	


}

?>

			<!-- <ul id="tree_view" style="display:none">

				<li>

					<img class="tree_icon rounded-circle" src="vistas/img/usuarios/4/701.jpg">

					<p class="demo_name_style">Academy of Life</p>

					<ul>

						<li>

							<img class="tree_icon rounded-circle lineaDescendienteIzq" src="vistas/img/usuarios/9/828.png">
							<p class="demo_name_style">Monica Murillo</p>

							<ul>

								<li>

									<img class="tree_icon rounded-circle lineaDescendienteIzq" src="vistas/img/usuarios/9/828.png">
									<p class="demo_name_style">Monica Murillo</p>

									<ul>

										<li>

											<img class="tree_icon rounded-circle lineaDescendienteIzq" src="vistas/img/usuarios/9/828.png">
											<p class="demo_name_style">Monica Murillo</p>



										</li>

										<li>

											<img class="tree_icon rounded-circle lineaDescendienteDer" src="vistas/img/usuarios/4/701.jpg">
											<p class="demo_name_style">Alexander Pierce</p>

										</li>

									</ul>

								</li>

								<li>

									<img class="tree_icon rounded-circle lineaDescendienteDer" src="vistas/img/usuarios/4/701.jpg">
									<p class="demo_name_style">Alexander Pierce</p>

								</li>

							</ul>

						</li>

						<li>

							<img class="tree_icon rounded-circle lineaDescendienteDer" src="vistas/img/usuarios/4/701.jpg">
							<p class="demo_name_style">Alexander Pierce</p>

							<ul>

								<li>

									<img class="tree_icon rounded-circle lineaDescendienteIzq" src="vistas/img/usuarios/9/828.png">
									<p class="demo_name_style">Monica Murillo</p>

								</li>

								<li>

									<img class="tree_icon rounded-circle lineaDescendienteDer" src="vistas/img/usuarios/4/701.jpg">
									<p class="demo_name_style">Alexander Pierce</p>

								</li>

							</ul>

						</li>

					</ul>

				</li>

			</ul> -->

			<div id="tree" class="orgChart"></div>

		</div>

	</div>

</div>