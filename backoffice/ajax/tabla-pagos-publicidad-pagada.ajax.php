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

		$ruta = ControladorGeneral::ctrRuta();
		$patrocinador = ControladorGeneral::ctrPatrocinador();

		$red = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", null, null);

		$pagos = ControladorPagos::ctrMostrarPagosPublicidadAll("estado","1");

		$periodo_comision = 0;
		$periodo_venta = 0;

		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

	 	// if(count($red) != 0){

 	
		// 	$periodo_venta =0; 
		
		// 	$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", "43");

			

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

		foreach ($pagos as $key => $value) {

			$periodo_comision = 0;
			$periodo_venta = 0;
			
			$comprobante=ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);

			$campana=ControladorCampanas::ctrMostrarCampanas("id",$comprobante[0]["campana"]);

  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0] ["doc_usuario"]);

			$cuenta = ControladorCuentas::ctrMostrarCuentas("id",$value["id_cuenta"]);
	
            $total = $value["valor"];

			$acciones = "<h5><span class='badge badge-success'>Pago $".number_format($total)."</span></h5>";

			$datosJson	 .= '[
				    "'.($key+1).'",
				    "'.$acciones.'",
					"'.$value["id"].'",
					"'.$usuario["doc_usuario"].'",
					"'.$usuario["nombre"].'",
					"'.$usuario["telefono_movil"].'",
					"'.$cuenta["entidad"].'",
					"'.$cuenta["numero"].'",
					"'.$cuenta["tipo"].'",
					"'.$campana["nombre"].'",
					"'.$comprobante[0]["fecha"].'",
					"'.$value["fecha"].'",
					"$ '.number_format($total).'"

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


