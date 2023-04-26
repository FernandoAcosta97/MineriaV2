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
	ACTIVAR TABLA DETALLES CAMPAÑA RECURRENTE
	=============================================*/ 

	public function mostrarTabla(){

		date_default_timezone_set('America/Bogota');

		$ruta = ControladorGeneral::ctrRuta();

		$campana = ControladorCampanas::ctrMostrarCampanas("id", $_GET["id"]);

		$listaRecurrencia = json_decode($campana["nombre"], true);


		if(count($listaRecurrencia) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($listaRecurrencia as $key => $value) {
			
			$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$value["inversiones"].'",
					"$ '.number_format($value["retorno"]).'"

			],';


		}


		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;
	}

}

/*=============================================
ACTIVAR TABLA DETALLE CAMPAÑA RECURRENTE
=============================================*/ 

$activar = new TablaPagos();
$activar -> mostrarTabla();


