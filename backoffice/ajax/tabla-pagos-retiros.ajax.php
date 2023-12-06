<?php

require_once "../controladores/general.controlador.php";

require_once "../controladores/multinivel.controlador.php";
require_once "../modelos/multinivel.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";

require_once "../controladores/comprobantes.controlador.php";
require_once "../modelos/comprobantes.modelo.php";

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";

require_once "../controladores/campanas.controlador.php";
require_once "../modelos/campanas.modelo.php";

class TablaPagos{

	/*=============================================
	ACTIVAR TABLA PAGOS
	=============================================*/ 

	public function mostrarTabla(){

		date_default_timezone_set('America/Bogota');

		$pagos = ControladorPagos::ctrMostrarSolicitudesRetiro(null, null, "estado", "2");

		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';	

		// 		$fechaPago = date('Y-m-d');
			

		// 	/*=============================================
		// 	NOTAS
		// 	=============================================*/			

		// 	$notas = "<h5><a href='".$ruta."backoffice/binaria' class='btn btn-purple btn-sm'>Actualizar</a></h5>";		

		// 	$datosJson	 .= '[
						
		// 			"1",
		// 			"En proceso...",
		// 			"En proceso...",
		// 			"En proceso...",
		// 			"'.$periodo_comision.'",
		// 			"$ '.number_format($periodo_comision, 2, ",", ".").'",
		// 			"$ '.number_format($periodo_venta, 2, ",", ".").'",
		// 			"'.$fechaPago.'",
		// 			"'.$notas.'"

		// 	],';

		// }

		$documento="xxx";
		$nombre="Usuario Eliminado";
		$pais="xxx";
		$telefono="xxx";
		$cuentaBancaria="";

		// var_dump($pagos);

		foreach ($pagos as $key => $value) {

  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["usuario"]);

			if(is_array($usuario)){

				$documento=$usuario["doc_usuario"];
				$nombre=$usuario["nombre"];
				$pais=$usuario["pais"];
				$telefono=$usuario["telefono_movil"];

				$cuentaBancaria = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

			}

            $retorno_total = $value["valor"];

			if($cuentaBancaria==""){
                $numero_cuenta = "X";
				$entidad_cuenta = "X";
				$tipo_cuenta = "X";

				$acciones = "<button class='btn btn-info' disabled>PAGAR</button>";
				$seleccionar = "";
            }else{
				$numero_cuenta = $cuentaBancaria["numero"];
				$entidad_cuenta = $cuentaBancaria["entidad"];
				$tipo_cuenta = $cuentaBancaria["tipo"];

				$acciones = "<button class='btn btn-info btnPagarRetiro' idPagoRetiro='".$value["id"]."'>PAGAR</button>";

				$seleccionar = "<center><input type='checkbox' class='seleccionarPago' idPago='".$value["id"]."'></input></center>";
			}



			$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$seleccionar.'",
				    "'.$acciones.'",
					"'.$value["id"].'",
					"$ '.number_format($retorno_total).'",
					"'.$documento.'",
					"'.$nombre.'",
					"'.$pais.'",
					"'.$telefono.'",
					"'.$entidad_cuenta.'",
					"'.$numero_cuenta.'",
					"'.$tipo_cuenta.'",
					"'.$value["fecha"].'"

			],';

		}


		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;
	}

}

/*=============================================
ACTIVAR TABLA PAGOS
=============================================*/ 

$activar = new TablaPagos();
$activar -> mostrarTabla();


