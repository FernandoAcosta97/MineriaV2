<?php


Class ControladorCuentas{


	/*=============================================
	registrar cuenta bancaria
	=============================================*/

	public function ctrRegistrarCuentaBancaria($pagina){

		$tabla = "cuentas_bancarias";

		if(isset($_POST["idUsuarioCuentaRegistrar"])){

			$cuenta_existe = ModeloCuentas::mdlMostrarCuentas($tabla, "numero", $_POST["registrarNumeroCuenta"]);

			if($cuenta_existe==""){

			$campo_entidad="";
			if(isset($_POST["registrarEntidadCuentaCampo"]) && $_POST["registrarEntidadCuentaCampo"]!=""){
				$campo_entidad=$_POST["registrarEntidadCuentaCampo"];
			}else{
				$campo_entidad=$_POST["registrarEntidadCuenta"];
			}

			if(preg_match('/^[0-9]+$/', $_POST["registrarNumeroCuenta"])&&
			preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registrarNombreTitular"])
			 && preg_match('/^[0-9]+$/', $_POST["registrarNumeroTitular"]) &&
			preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $campo_entidad) ){

				$datos = array(	"titular" => $_POST["registrarNumeroTitular"],
				"tipoDocumento" => $_POST["registrarTipoDocumento"],
				"nombreTitular" => $_POST["registrarNombreTitular"],
				"usuario" => $_POST["idUsuarioCuentaRegistrar"],
				"estado" => 1,
				"tipo" => $_POST["registrarTipoCuenta"],
				"entidad" => $campo_entidad,
				"numero" => $_POST["registrarNumeroCuenta"]);

				
		$cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario",$_POST["idUsuarioCuentaRegistrar"]);

		foreach($cuentas as $key => $value){
			if($value["estado"]==1){
				$actualizar_cuentas = ControladorCuentas::ctrActualizarCuenta( $value["id"] ,"estado", 0);
			}
		}

		$respuesta = ModeloCuentas::mdlRegistrarCuentaBancaria($tabla, $datos);

		if($respuesta == "ok"){
			echo "<script>

							swal.fire({
								type:'success',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">REGISTRO EXITOSO</h2></div><p class=\"text-primario text-2xl\">¡SU CUENTA BANCARIA HA SIDO CREADA CORRECTAMENTE!</p></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-primario border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									window.location = \"'.$pagina.'\";

								}


							});	

						</script>";
		}

				}
			}
			}



	}



	
	/*=============================================
	Mostrar Cuentas
	=============================================*/

	static public function ctrMostrarCuentas($item, $valor){
	
		$tabla = "cuentas_bancarias";

		$respuesta = ModeloCuentas::mdlMostrarCuentas($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	Mostrar Cuentas x estado
	=============================================*/

	static public function ctrMostrarCuentasxEstado($item, $valor,$item2, $valor2){
	
		$tabla = "cuentas_bancarias";

		$respuesta = ModeloCuentas::mdlMostrarCuentasxEstado($tabla, $item, $valor, $item2, $valor2);

		return $respuesta;

	}


	/*=============================================
	Mostrar Cuentas All
	=============================================*/

	static public function ctrMostrarCuentasAll($item, $valor){
	
		$tabla = "cuentas_bancarias";

		$respuesta = ModeloCuentas::mdlMostrarCuentasAll($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	Actualizar Cuenta
	=============================================*/

	static public function ctrActualizarCuenta($id, $item, $valor){

		$tabla = "cuentas_bancarias";

		$respuesta = ModeloCuentas::mdlActualizarCuenta($tabla, $id, $item, $valor);

		return $respuesta;

	}




	/*=============================================
	editar cuenta bancaria
	=============================================*/

	public function ctrEditarCuenta($pagina){

		$tabla = "cuentas_bancarias";

		if(isset($_POST["editarNumero"])){

			$cuenta_existe = "";

			if($_POST["editarNumero"]!=$_POST["nCuentaActual"]){

			$cuenta_existe = ModeloCuentas::mdlMostrarCuentas($tabla, "numero", $_POST["editarNumero"]);

			}

			if($cuenta_existe==""){

			$campo_entidad="";
			if(isset($_POST["editarEntidadCuentaCampo"]) && $_POST["editarEntidadCuentaCampo"]!=""){
				$campo_entidad=$_POST["editarEntidadCuentaCampo"];
			}else{
				$campo_entidad=$_POST["editarEntidad"];
			}

			if(preg_match('/^[0-9]+$/', $_POST["editarDocumentoTitular"]) && preg_match('/^[0-9]+$/', $_POST["editarNumero"]) &&
			preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreTitular"]) ){

				$datos = array(	"numero" => $_POST["editarNumero"],
				"nombre_titular" => $_POST["editarNombreTitular"],
				"entidad" => $campo_entidad,
				"tipo" => $_POST["editarTipoCuenta"],
				"tipo_documento" => $_POST["editarTipoDocumento"],
				"titular" => $_POST["editarDocumentoTitular"],
				"id" => $_POST["idCuenta"]);

				
		$respuesta = ModeloCuentas::mdlEditarCuenta($tabla, $datos);

		if($respuesta == "ok"){
			echo "<script>

							swal.fire({
								type:'success',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">ACTUALIZACIÓN EXITOSA</h2></div><p class=\"text-primario text-2xl\">¡LA CUENTA BANCARIA HA SIDO ACTUALIZADA CORRECTAMENTE!</p></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-primario border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									window.location = \"'.$pagina.'\";

								}


							});	

						</script>";
		}

				}
			}
			}



	}



	/*=============================================
	Eliminar Cuenta bancaria
	=============================================*/

	static public function ctrEliminarCuenta($id){

		$tabla = "cuentas_bancarias";

		$tabla2 = "pagos_inversiones";
		$tabla3 = "pagos_comisiones";
		$tabla4 = "pagos_extras";

		$cuenta = ModeloCuentas::mdlMostrarCuentas($tabla, "id", $id);

		$pagosInversiones = ModeloCuentas::mdlMostrarPagosCuentas($tabla, $tabla2, $id);

		$pagosComisiones = ModeloCuentas::mdlMostrarPagosCuentas($tabla, $tabla3, $id);

		$pagosExtras = ModeloCuentas::mdlMostrarPagosCuentas($tabla, $tabla4, $id);

		if($pagosInversiones!="" || $pagosComisiones!="" || $pagosExtras!="") return 1;

		$respuesta = ModeloCuentas::mdlEliminarCuenta($tabla, $id);

		if($respuesta=="ok"){

			return $cuenta["usuario"];

		}else{

			return "error";

		}



	}


	


}

