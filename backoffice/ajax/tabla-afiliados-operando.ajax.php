<?php

require_once "../controladores/general.controlador.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class TablaAfiliadosOperantes{
	
	/*=============================================
	ACTIVAR TABLA DETALLES CAMPAÑA RECURRENTE
	=============================================*/ 

	public function mostrarTabla(){

		date_default_timezone_set('America/Bogota');

		$ruta = ControladorGeneral::ctrRuta();

		$user = ControladorUsuarios::ctrMostrarUsuariosxPatrocinadorxEstado("enlace_afiliado", $_GET["id"],"patrocinador","","operando",1);

		$listaROperantes = json_decode($user, true);


		if(count($listaROperantes) < 1 ){

			echo '{ "data":[]}';

			return;

		}

 		$datosJson = '{

	 	"data": [ ';

		foreach ($listaROperantes as $key => $value) {
			
			$datosJson	 .= '[
				    "'.($key+1).'",
					"'.$value["doc_usuario"].'",
					"'($value["nombre"]).'",
                    "'($value["telefono_movil"]).'"

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
