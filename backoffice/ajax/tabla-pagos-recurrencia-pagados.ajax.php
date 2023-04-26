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

		$pagos = ControladorPagos::ctrMostrarPagosRecurrenciaAll("estado", "1");


		if(count($pagos) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($pagos as $key => $value) {

			$campana=ControladorCampanas::ctrMostrarCampanas("id",$value["id_campana"]);

  			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["id_usuario"]);

			$cuentaBancaria = ControladorCuentas::ctrMostrarCuentasxEstado("id",$value["id_cuenta"],"estado",1);
	
			
            $total = $value["valor"];

			if($cuentaBancaria==""){
                $numero_cuenta = "X";
				$entidad_cuenta = "X";
				$tipo_cuenta = "X";
            }else{
				$numero_cuenta = $cuentaBancaria["numero"];
				$entidad_cuenta = $cuentaBancaria["entidad"];
				$tipo_cuenta = $cuentaBancaria["tipo"];
			}

			$acciones = "<h5><span class='badge badge-success'>Pago $".number_format($value["valor"])."</span></h5>";

			$detalle="<div><button type='button' class='btn btn-success btn-xs btnVerRecurrencia' data-toggle='modal' data-target='#modalVerRecurrencia' idCampana='".$value["id_campana"]."'><i class='fa fa-eye'></i></button></div>";


			$datosJson	 .= '[
				    "'.($key+1).'",
				    "'.$acciones.'",
					"'.$detalle.'",
					"'.$value["id"].'",
					"'.$usuario["doc_usuario"].'",
					"'.$usuario["nombre"].'",
					"'.$usuario["pais"].'",
					"'.$usuario["telefono_movil"].'",
					"'.$entidad_cuenta.'",
					"'.$numero_cuenta.'",
					"'.$tipo_cuenta.'",
					"'.$value["inversiones"].'",
					"'.$value["fecha"].'"
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


