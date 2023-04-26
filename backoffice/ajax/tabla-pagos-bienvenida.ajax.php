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

		$pagos = ControladorPagos::ctrMostrarPagosBienvenidaAll("estado","0");

		$totalAfiliadosActivos=0;
		$totalAfiliadosObtenidos=0;

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

			$cuentaBancaria = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

			// $bonos_extras = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra",$value["id"]);

			// $campana=ControladorCampanas::ctrMostrarCampanas("id",$bonos_extras[0]["id_campana"]);

            // $total = count($bonos_extras)*$campana["retorno"];
			// $totalAfiliadosObtenidos=count($bonos_extras);
			$total=0;

			if($cuentaBancaria==""){
				$numero_cuenta = "X";
				$entidad_cuenta = "X";
				$tipo_cuenta = "X";
	
				$acciones = "<div class='btn-group'><button class='btn btn-info' disabled>PAGAR</button><button type='button' class='btn btn-success btn-xs btnVerBonos' data-toggle='modal' data-target='#modalVerBonos' idPagoBono='".$value["id"]."'><i class='fa fa-eye'></i></button></div>";
				$seleccionar = "";
			}else{
				$numero_cuenta = $cuentaBancaria["numero"];
				$entidad_cuenta = $cuentaBancaria["entidad"];
				$tipo_cuenta = $cuentaBancaria["tipo"];
	
				$acciones = "<div class='btn-group'><button class='btn btn-info btnPagarExtra' idPagoExtra='".$value["id"]."'>PAGAR</button><button type='button' class='btn btn-success btn-xs btnVerBonos' data-toggle='modal' data-target='#modalVerBonos' idPagoBono='".$value["id"]."'><i class='fa fa-eye'></i></button></div>";

				
			$seleccionar = "<center><input type='checkbox' class='seleccionarPago' idPago='".$value["id"]."'></input></center>";
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
					"'.$totalAfiliadosObtenidos.'",
					"'.$entidad_cuenta.'",
					"'.$numero_cuenta.'",
					"'.$tipo_cuenta.'",
					"$ '.number_format($total).'"

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


