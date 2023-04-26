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

		$pagos = ControladorPagos::ctrMostrarPagosExtrasxEstadoAll("id_usuario",$_GET["usuario"],"estado","0");

		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($pagos as $key => $value) {
			
  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value ["id_usuario"]);

			$bonos = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra",$value["id"]);

			$total = 0;
			foreach($bonos as $key2 => $value2){
           
				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value2["id_comprobante"]);

				$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

				$campana = ControladorCampanas::ctrMostrarCampanas("id", $value2["id_campana"]);
				$total=$total+$campana["retorno"];

				$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$value2["id"].'",
					"'.$usuario["doc_usuario"].'",
					"'.$usuario["nombre"].'",
					"'.$usuario["pais"].'",
					"Ganancia extra",
					"$ '.number_format($total).'"
			],';

			$total=0;

			}
			

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


