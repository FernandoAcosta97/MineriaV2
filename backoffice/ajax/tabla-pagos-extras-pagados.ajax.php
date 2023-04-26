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

		$pagos = ControladorPagos::ctrMostrarPagosExtrasAll("estado","1");

		$periodo_comision = 0;
		$periodo_venta = 0;
		$totalAfiliadosActivos=0;

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
			

		foreach ($pagos as $key => $value) {

  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["id_usuario"]);

			$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("id",$value["id_cuenta"],"estado",1);
			
			$bonos_extras = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra",$value["id"]);

			$campana=ControladorCampanas::ctrMostrarCampanas("id",$bonos_extras[0]["id_campana"]);

			$acciones = "<h5><span class='badge badge-success'>Pago $".number_format($value["valor"])."</span></h5>";

			$datosJson	 .= '[
				    "'.($key+1).'",
				    "'.$acciones.'",
					"'.$value["id"].'",
					"'.$usuario["doc_usuario"].'",
					"'.$usuario["nombre"].'",
					"'.$usuario["pais"].'",
					"'.$usuario["telefono_movil"].'",
					"'.$value["referidos_obtenidos"].'",
					"'.$cuenta["entidad"].'",
					"'.$cuenta["numero"].'",
					"'.$cuenta["tipo"].'",
					"'.$value["fecha"].'",
					"$ '.number_format($value["valor"]).'"

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


