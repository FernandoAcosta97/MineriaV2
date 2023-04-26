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

		$pagos = ControladorPagos::ctrMostrarPagosPublicidadxEstadoAll("id_usuario",$_GET["usuario"],"estado","0");

		if(count($pagos) == 0){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($pagos as $key => $value) {
			$total=0;
  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value ["id_usuario"]);

			$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

			$campana = ControladorCampanas::ctrMostrarCampanas("id",$comprobante[0]["campana"]);
		
			$total=$campana['retorno'];

			$datosJson	 .= '[
				"'.($key+1).'",
				"'.$value["id"].'",
				"$ '.number_format($total).'",
				"'.$campana['fecha_retorno'].'"
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


