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

		$pagos = ControladorPagos::ctrMostrarPagosComisionesAll("estado","0");

		$periodo_comision = 0;
		$periodo_venta = 0;
		// $totalAfiliadosActivos=0;
		$totalReferidosComisiones = 0;

		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($pagos as $key => $value) {
			
  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value ["id_usuario"]);

			$cuentaBancaria = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

			$comisionesPorReferidos = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $value["id"]);
			$totalReferidosComisiones = count($comisionesPorReferidos);

			// $red = ControladorMultinivel::ctrMostrarRedUninivel("red_uninivel", "patrocinador_red", $usuario["enlace_afiliado"]);

			// print_r($red);

			// if(count($red)>0){
			// 	foreach ($red as $key2 => $value2){
			// 		$usuarioRedOperando = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value2["usuario_red"]);
	
			// 		if($usuarioRedOperando["operando"]==1){
			// 			++$totalAfiliadosActivos;
			// 		}
	
			// 	}
			// }

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

				$ganancia = ($comprobante[0]["valor"]*$porcentaje)/100;
				$total=$total+$ganancia;
			}
			

			if($cuentaBancaria==""){
                $numero_cuenta = "X";
				$entidad_cuenta = "X";
				$tipo_cuenta = "X";

				$acciones = "<div class='btn-group'><button class='btn btn-info' disabled>PAGAR</button><button type='button' class='btn btn-success btn-xs btnVerComisiones' data-toggle='modal' data-target='#modalVerComisiones' idPagoComision='".$value["id"]."'><i class='fa fa-eye'></i></button></div>";

				$seleccionar = "";
            }else{
				$numero_cuenta = $cuentaBancaria["numero"];
				$entidad_cuenta = $cuentaBancaria["entidad"];
				$tipo_cuenta = $cuentaBancaria["tipo"];

				$acciones = "<div class='btn-group'><button class='btn btn-info btnPagarComision' idPagoComision='".$value["id"]."'>PAGAR</button><button type='button' class='btn btn-success btn-xs btnVerComisiones' data-toggle='modal' data-target='#modalVerComisiones' idPagoComision='".$value["id"]."'><i class='fa fa-eye'></i></button></div>";
				
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
					"'.$totalReferidosComisiones.'",
					"'.$entidad_cuenta.'",
					"'.$numero_cuenta.'",
					"'.$tipo_cuenta.'",
					"$ '.number_format($total).'",
					"'.$value["fecha"].'"

			],';

			// $totalAfiliadosActivos=0;
			$totalReferidosComisiones = 0;

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


