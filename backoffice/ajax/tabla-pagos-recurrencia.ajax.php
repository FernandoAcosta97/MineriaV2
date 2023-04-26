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

		$pagos = ControladorPagos::ctrMostrarPagosRecurrenciaAll("estado", "0");


		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($pagos as $key => $value) {

			$campana=ControladorCampanas::ctrMostrarCampanas("id",$value["id_campana"]);

  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["id_usuario"]);

			$cuentaBancaria = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);
	
			
            $total = 0;

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

				$acciones = "<button class='btn btn-info btnPagarRecurrencia' idPagoRecurrencia='".$value["id"]."'>PAGAR</button>";

				$seleccionar = "<center><input type='checkbox' class='seleccionarPago' idPago='".$value["id"]."'></input></center>";
			}


			$listaRecurrencia = json_decode($campana["nombre"], true);

			foreach ($listaRecurrencia as $key2 => $value2) {
				if($value["inversiones"]==$value2["inversiones"]){
				 $total=$total+$value2["retorno"];
				 break;
				}
			}



			$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$seleccionar.'",
				    "'.$acciones.'",
					"'.$value["id"].'",
					"'.$usuario["doc_usuario"].'",
					"'.$usuario["nombre"].'",
					"'.$usuario["pais"].'",
					"'.$usuario["telefono_movil"].'",
					"'.$entidad_cuenta.'",
					"'.$numero_cuenta.'",
					"'.$tipo_cuenta.'",
					"'.$value["inversiones"].'",
					"'.$campana["fecha_retorno"].'",
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


