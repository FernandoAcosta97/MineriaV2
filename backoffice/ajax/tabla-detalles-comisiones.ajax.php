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

		$pagos = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $_GET["pago"]);

		$periodo_comision = 0;
		$periodo_venta = 0;
		$totalAfiliadosActivos=0;

		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';
		

		foreach ($pagos as $key => $value) {
			
			$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);
	

			$total = 0;
           
			$porcentaje=0;
			$ganancia=0;
			if($value["nivel"]==1){
					$porcentaje=5;
			}
			if($value["nivel"]==2){
					$porcentaje=4;
			}
			if($value["nivel"]==3){
					$porcentaje=3;
			}
			if($value["nivel"]==4){
					$porcentaje=2;
			}
			if($value["nivel"]==5){
					$porcentaje=1;
			}

			$ganancia = ($comprobante[0]["valor"]*$porcentaje)/100;
			$total=$total+$ganancia;


			$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$usuario["doc_usuario"].'",
					"'.$usuario["nombre"].'",
					"'.$usuario["pais"].'",
					"'.$usuario["telefono_movil"].'",
					"$ '.number_format($total).'",
					"'.$value["nivel"].'"

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


