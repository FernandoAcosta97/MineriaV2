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
	ACTIVAR TABLA COMISIONES
	=============================================*/ 

	public function mostrarTabla(){

		date_default_timezone_set('America/Bogota');

		$ruta = ControladorGeneral::ctrRuta();
		$patrocinador = ControladorGeneral::ctrPatrocinador();

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario",$_GET["usuario"]);

		$retiros = ControladorPagos::ctrMostrarSolicitudesRetiro("usuario", $_GET["usuario"],null,null);


		if($retiros=="" || count($retiros) < 1){

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

		foreach ($retiros as $key => $value) {
			
  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value ["usuario"]);

			$cuentaBancaria = ControladorCuentas::ctrMostrarCuentas("usuario",$usuario["id_usuario"]);
	
			/*=============================================
			NOTAS
			=============================================*/

			// if($_GET["enlace_afiliado"] != $patrocinador){			

			// 	$notas = "<h5><span class='badge badge-success'>Pagada</span></h5>";

			// }else{

			// 	$notas = "<h5><span class='badge badge-success'>Pagada $".number_format($value["periodo_comision"])."</span></h5>";
			// }	
			$total=0;


			if($cuentaBancaria==""){
                $numero_cuenta = "X";
				$entidad_cuenta = "X";
				$tipo_cuenta = "X";

            }else{
				$numero_cuenta = $cuentaBancaria["numero"];
				$entidad_cuenta = $cuentaBancaria["entidad"];
				$tipo_cuenta = $cuentaBancaria["tipo"];
			}

			if($value["tipo"]==1){
				$acciones = "<small class='text-success mr-1'><i class='fas fa-arrow-up'></i></small>$ ".number_format($value["valor"])."";
			}else{
				$acciones = "<small class='text-danger mr-1'><i class='fas fa-arrow-down'></i></small>$ ".number_format($value["valor"])."";

			}




			$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$value["id"].'",
					"'.$acciones.'",
					"'.$entidad_cuenta.'",
					"'.$numero_cuenta.'",
					"'.$tipo_cuenta.'",
					"'.$value["fecha"].'"

			],';

			$totalAfiliadosActivos=0;

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


