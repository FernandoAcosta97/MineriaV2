<?php

class ControladorMultinivel{

	/*=============================================
	REGISTRO UNINIVEL
	=============================================*/
	
	static public function ctrRegistroUninivel($datos){

		$tabla = "red_uninivel";

		$respuesta = ModeloMultinivel::mdlRegistroUninivel($tabla, $datos);

		$usu = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $datos["patrocinador_red"]);

		$notificacion = ControladorNotificaciones::ctrRegistroNotificaciones("red", $usu["id_usuario"], $datos["usuario_red"]);

		//notificaciones = "tipo:red", "id_user_not:$datos["patrocinador_red"]"

		return $respuesta;

	}


	/*=============================================
	MOSTRAR RED CON INNER JOIN
	=============================================*/

	static public function ctrMostrarRed($tabla1, $tabla2, $item, $valor){

		$respuesta = ModeloMultinivel::mdlMostrarRed($tabla1, $tabla2, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR RED BINARIA
	=============================================*/

	static public function ctrMostrarBinaria($item, $valor){

		$tabla = "red_binaria";

		$respuesta = ModeloMultinivel::mdlMostrarBinaria($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR RED BINARIA POR DERRAME
	=============================================*/

	static public function ctrMostrarBinariaxDerrame($item, $valor){

		$tabla = "red_binaria";

		$respuesta = ModeloMultinivel::mdlMostrarBinariaxDerrame($tabla, $item, $valor);

		return $respuesta;

	}


	static public function generarLineasDescendientes($ordenBinaria,$n,$niveles, $patrocinador_antiguo, $nuevo_patrocinador)
{

	$pago_patrocinador_antiguo = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $patrocinador_antiguo, "estado", 0);

	if($pago_patrocinador_antiguo!=""){

	if($n<=$niveles){

    $respuesta = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "derrame_binaria", $ordenBinaria);

    $derrame = 0;

		/*=============================================
			CUANDO SI HAY LÍNEA DESCENDIENTE
			=============================================*/

			foreach ($respuesta as $key => $value) {

				// TRAEMOS LOS DATOS DEL USUARIO

				$afiliado = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["usuario_red"]);

					$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);
					foreach($comisiones as $key2 => $value2){
						$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value2["id_comprobante"]);
						$usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

						if($afiliado["id_usuario"]==$usu["id_usuario"]){

							$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $nuevo_patrocinador, "estado",0);

							if($existe_pago!=""){
					
								$comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$comprobante[0]["id"],$value2["nivel"]);
								
					
							}else{
					
								$pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($nuevo_patrocinador);
						
								$comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$value2["nivel"]);
							}

							$comisionEliminar = ControladorPagos::ctrEliminarComisiones($pago_patrocinador_antiguo["id"],$comprobante[0]["id"]);

							$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);

							if(count($comisiones)==0){

								$pago_comision_eliminar = ControladorPagos::ctrEliminarPagosComisiones($pago_patrocinador_antiguo["id"]);
				
							}

						}
					}
				


				// AUMENTAMOS EL DERRAME

				$derrame++;

		
		  $n=$n+1;
	      ControladorMultinivel::generarLineasDescendientes($value["orden_binaria"], $n,$niveles, $patrocinador_antiguo, $nuevo_patrocinador);

			}
		


}

	}


}




	/*=============================================
	Eliminar Usuario Red
	=============================================*/

	static public function ctrEliminarUsuarioRed($tabla, $id){

		$respuesta = ModeloMultinivel::mdlEliminarUsuarioRed($tabla, $id);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR RED SIN INNER JOIN
	=============================================*/
	static public function ctrMostrarRedUninivel($tabla, $item, $valor){

		$respuesta = ModeloMultinivel::mdlMostrarRedUninivel($tabla, $item, $valor);

		return $respuesta;

	}

	
	/*=============================================
	MOSTRAR TOTAL OPERANDO RED CON INNER JOIN
	=============================================*/

	static public function ctrMostrarRedOperandoTotal($tabla1, $tabla2, $item, $valor, $item2, $valor2){

		$respuesta = ModeloMultinivel::mdlMostrarRedOperandoTotal($tabla1, $tabla2, $item, $valor, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR USUARIO RED
	=============================================*/

	static public function ctrMostrarUsuarioRed($tabla, $item, $valor){

		$respuesta = ModeloMultinivel::mdlMostrarUsuarioRed($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	REGISTRO BINARIA
	=============================================*/
	
	static public function ctrRegistroBinaria($datos){
		
		/*=============================================
		VARIABLES
		=============================================*/	

		$ordenBinaria = null;
		$derrameBinaria = null;	

		/*=============================================
		ASIGNAR EL ORDEN EN LA RED
		=============================================*/	

		$red = ModeloMultinivel::mdlMostrarUsuarioRed("red_binaria", null, null);

		foreach ($red as $key => $value) {

			$ordenBinaria = $value["orden_binaria"] + 1;
			
									
		}

		/*=============================================
		TRAEMOS EL ID DEL PATROCINADOR Y ASIGNAMOS POSICIÓN Y PATROCINADOR
		=============================================*/	

		$patrocinador = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $datos["patrocinador_red"]);

		$idPatrocinador	= $patrocinador["id_usuario"];

		$derrame = ModeloMultinivel::mdlMostrarUsuarioRed("red_binaria", "usuario_red", $idPatrocinador);

		foreach($derrame as $key => $value){
			$derrameBinaria = $value["orden_binaria"];	
		}


		/*=============================================
		EJECUTAMOS FUNCIÓN PARA DAR POSICIÓN EN LA RED
		=============================================*/	

		// $derrameB = ControladorMultinivel::derrameBinaria($derrameBinaria, $datos["patrocinador_red"]);
		
		/*=============================================
		GENERAR LA POSICIÓN CORRESPONDIENTE
		=============================================*/	

		// if ($respuesta["posicionLetra"] == "" || $respuesta["posicionLetra"] == "B"){

		// 	$posicionLetra = "A";

		// }

		// if ($respuesta["posicionLetra"] == "A"){				

		// 	$posicionLetra = "B";
			
		// }

		/*=============================================
		GUARDAMOS NUEVO USUARIO EN LA RED
		=============================================*/

		$datosBinaria = array("usuario_red" => $datos["usuario_red"],
							  "orden_binaria" => $ordenBinaria,
							  "derrame_binaria" => $derrameBinaria,
							  "patrocinador_red" => $datos["patrocinador_red"]);

		$tabla = "red_binaria";

		$respuesta = ModeloMultinivel::mdlRegistroBinaria($tabla, $datosBinaria);

		return $respuesta;

	}

	/*=============================================
	DERRAME BINARIA
	=============================================*/	

	static public function derrameBinaria($derrameBinaria, $patrocinadorRed){

		$lineaDescendiente = ModeloMultinivel::mdlMostrarUsuarioRed("red_binaria","derrame_binaria", $derrameBinaria);

		/*=============================================
		CUANDO NO HAY LÍNEA DESCENDIENTE
		=============================================*/

		if(!$lineaDescendiente){

			$datos = array("derrameBinaria"=>$derrameBinaria);

			return $datos;			

		}

		/*=============================================
		CUANDO SOLO HAY UNA LÍNEA DESCENDIENTE
		=============================================*/

		else if(count($lineaDescendiente) == 1){

			$datos = array("derrameBinaria"=>$derrameBinaria);

			return $datos;			

		}else{

			/*=============================================
			CUANDO EL DERRAME VIENE DIRECTAMENTE DE LA EMPRESA
			=============================================*/

			$patrocinador = ControladorGeneral::ctrPatrocinador();

			if($patrocinadorRed == $patrocinador){	

				$datos = ControladorMultinivel::derrameBinaria($derrameBinaria+1, $patrocinadorRed);

				return $datos;

			}else{

				$datos = ControladorMultinivel::derrameBinariaPatrocinador($lineaDescendiente[0]["orden_binaria"]);

				return $datos;

			}

		}

	}

	/*=============================================
	DERRAME BINARIA PATROCINADOR
	=============================================*/	

	static public function derrameBinariaPatrocinador($derrameBinaria){

		$lineaDescendiente = ModeloMultinivel::mdlMostrarUsuarioRed("red_binaria","derrame_binaria", $derrameBinaria);

		/*=============================================
		CUANDO NO HAY LÍNEA DESCENDIENTE
		=============================================*/

		if(!$lineaDescendiente){

			$datos = array("posicionLetra"=>"",
				       	   "derrameBinaria"=>$derrameBinaria);

			return $datos;			

		}

		/*=============================================
		CUANDO SOLO HAY UNA LÍNEA DESCENDIENTE
		=============================================*/

		else if(count($lineaDescendiente) == 1){

			$datos = array("posicionLetra"=>"A",
				       	   "derrameBinaria"=>$derrameBinaria);

			return $datos;		

		}else{

			$datos = ControladorMultinivel::derrameBinariaPatrocinador($derrameBinaria+1);

			return $datos;
			
		}

	}

	/*=============================================
	ACTUALIZAR BINARIA
	=============================================*/
	
	static public function ctrActualizarBinaria($item, $valor, $derrame, $patrocinador){

		$tabla = "red_binaria";

		$respuesta = ModeloMultinivel::mdlActualizarBinaria($tabla, $item, $valor, $derrame, $patrocinador);

		return $respuesta;

	}


	/*=============================================
	ACTUALIZAR UNINIVEL
	=============================================*/
	
	static public function ctrActualizarUninivel($item, $valor, $patrocinador){

		$tabla = "red_uninivel";

		$respuesta = ModeloMultinivel::mdlActualizarUninivel($tabla, $item, $valor, $patrocinador);

		return $respuesta;

	}

	/*=============================================
	REGISTRO MATRIZ
	=============================================*/
	
	static public function ctrRegistroMatriz($datos){
		
		/*=============================================
		VARIABLES
		=============================================*/	

		$ordenMatriz = null;
		$derrameMatriz = null;	

		/*=============================================
		ASIGNAR EL ORDEN EN LA RED
		=============================================*/	

		$red = ModeloMultinivel::mdlMostrarUsuarioRed("red_matriz", null, null);

		foreach ($red as $key => $value) {

			$ordenMatriz = $value["orden_matriz"] + 1;
			
									
		}

		/*=============================================
		TRAEMOS EL ID DEL PATROCINADOR Y ASIGNAMOS POSICIÓN Y PATROCINADOR
		=============================================*/	

		$patrocinador = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $datos["patrocinador_red"]);

		$idPatrocinador	= $patrocinador["id_usuario"];

		$derrame = ModeloMultinivel::mdlMostrarUsuarioRed("red_matriz", "usuario_red", $idPatrocinador);

		foreach ($derrame as $key => $value) {
				
			$derrameMatriz = $value["orden_matriz"];	
			
		}

		/*=============================================
		EJECUTAMOS FUNCIÓN PARA DAR POSICIÓN EN LA RED
		=============================================*/	

		$respuesta = ControladorMultinivel::derrameMatriz($derrameMatriz, $datos["patrocinador_red"]);
		
		/*=============================================
		GENERAR LA POSICIÓN CORRESPONDIENTE
		=============================================*/	

		if ($respuesta["posicionLetra"] == "" || $respuesta["posicionLetra"] == "D"){

			$posicionLetra = "A";

		}

		if ($respuesta["posicionLetra"] == "A"){				

			$posicionLetra = "B";
			
		}

		if ($respuesta["posicionLetra"] == "B"){				

			$posicionLetra = "C";
			
		}

		if ($respuesta["posicionLetra"] == "C"){				

			$posicionLetra = "D";
			
		}

		/*=============================================
		GUARDAMOS NUEVO USUARIO EN LA RED
		=============================================*/

		$datosMatriz = array("usuario_red" => $datos["usuario_red"],
							  "orden_matriz" => $ordenMatriz,
							  "derrame_matriz" => $respuesta["derrameMatriz"],				   
							  "posicion_matriz" => $posicionLetra,
							  "patrocinador_red" => $datos["patrocinador_red"]);

		$tabla = "red_matriz";

		$respuesta = ModeloMultinivel::mdlRegistroMatriz($tabla, $datosMatriz);

		return $respuesta;

	}

	/*=============================================
	DERRAME MATRIZ
	=============================================*/	

	static public function derrameMatriz($derrameMatriz, $patrocinadorRed){

		$lineaDescendiente = ModeloMultinivel::mdlMostrarUsuarioRed("red_matriz","derrame_matriz", $derrameMatriz);

		/*=============================================
		CUANDO NO HAY LÍNEA DESCENDIENTE
		=============================================*/

		if(!$lineaDescendiente){

			$datos = array("posicionLetra"=>"",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;			

		}

		/*=============================================
		CUANDO SOLO HAY UNA LÍNEA DESCENDIENTE
		=============================================*/

		else if(count($lineaDescendiente) == 1){

			$datos = array("posicionLetra"=>"A",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;			

		}

		/*=============================================
		CUANDO SOLO HAY DOS LÍNEAS DESCENDIENTES
		=============================================*/

		else if(count($lineaDescendiente) == 2){

			$datos = array("posicionLetra"=>"B",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;		

		}

		/*=============================================
		CUANDO SOLO HAY DOS LÍNEAS DESCENDIENTES
		=============================================*/

		else if(count($lineaDescendiente) == 3){

			$datos = array("posicionLetra"=>"C",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;		

		}else{

			/*=============================================
			CUANDO EL DERRAME VIENE DIRECTAMENTE DE LA EMPRESA
			=============================================*/

			$patrocinador = ControladorGeneral::ctrPatrocinador();

			if($patrocinadorRed == $patrocinador){	

				$datos = ControladorMultinivel::derrameMatriz($derrameMatriz+1, $patrocinadorRed);

				return $datos;

			}else{

				$datos = ControladorMultinivel::derrameMatrizPatrocinador($lineaDescendiente[0]["orden_matriz"]);

				return $datos;

			}

		}

	}

	/*=============================================
	DERRAME MATRIZ PATROCINADOR
	=============================================*/	

	static public function derrameMatrizPatrocinador($derrameMatriz){

		$lineaDescendiente = ModeloMultinivel::mdlMostrarUsuarioRed("red_matriz","derrame_matriz", $derrameMatriz);

		/*=============================================
		CUANDO NO HAY LÍNEA DESCENDIENTE
		=============================================*/

		if(!$lineaDescendiente){

			$datos = array("posicionLetra"=>"",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;			

		}

		/*=============================================
		CUANDO SOLO HAY UNA LÍNEA DESCENDIENTE
		=============================================*/

		else if(count($lineaDescendiente) == 1){

			$datos = array("posicionLetra"=>"A",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;			

		}

		/*=============================================
		CUANDO SOLO HAY DOS LÍNEAS DESCENDIENTES
		=============================================*/

		else if(count($lineaDescendiente) == 2){

			$datos = array("posicionLetra"=>"B",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;		

		}

		/*=============================================
		CUANDO SOLO HAY DOS LÍNEAS DESCENDIENTES
		=============================================*/

		else if(count($lineaDescendiente) == 3){

			$datos = array("posicionLetra"=>"C",
				       	   "derrameMatriz"=>$derrameMatriz);

			return $datos;		

		}else{

			$datos = ControladorMultinivel::derrameMatrizPatrocinador($derrameMatriz+1);

			return $datos;
			
		}

	}

	/*=============================================
	ACTUALIZAR MATRIZ
	=============================================*/
	
	static public function ctrActualizarMatriz($datos){

		$tabla = "red_matriz";

		$respuesta = ModeloMultinivel::mdlActualizarVentasComisiones($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PAGOS RED
	=============================================*/

	static public function ctrMostrarPagosRed($tabla, $item, $valor){

		$respuesta = ModeloMultinivel::mdlMostrarPagosRed($tabla, $item, $valor);

		return $respuesta;

	}

}