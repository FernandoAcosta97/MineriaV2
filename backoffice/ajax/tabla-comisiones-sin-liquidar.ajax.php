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

		$pagos = ControladorPagos::ctrMostrarPagosComisionesxEstadoAll("id_usuario",$_GET["usuario"],"estado","0");

		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($pagos as $key => $value) {
			
  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value ["id_usuario"]);

			$cuentaBancaria = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

			$red = ControladorMultinivel::ctrMostrarRedUninivel("red_uninivel", "patrocinador_red", $usuario["enlace_afiliado"]);

			$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision",$value["id"]);

			$total = 0;
			foreach($comisiones as $key2 => $value2){
           
				$porcentaje=0;
				$ganancia=0;
				if($value2["nivel"]==1){
					$porcentaje=5;
				}
				if($value2["nivel"]==2){
					$porcentaje=4;
				}
				if($value2["nivel"]==3){
					$porcentaje=3;
				}
				if($value2["nivel"]==4){
					$porcentaje=2;
				}
				if($value2["nivel"]==5){
					$porcentaje=1;
				}
				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value2["id_comprobante"]);

				$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

				$ganancia = ($comprobante[0]["valor"]*$porcentaje)/100;
				$total=$total+$ganancia;

				$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$value2["id"].'",
					"'.$usuario["doc_usuario"].'",
					"'.$usuario["nombre"].'",
					"'.$usuario["pais"].'",
					"'.$value2["nivel"].'",
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


