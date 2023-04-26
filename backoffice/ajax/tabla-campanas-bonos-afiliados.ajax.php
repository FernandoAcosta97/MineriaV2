<?php 

require_once "../controladores/general.controlador.php";
require_once "../controladores/campanas.controlador.php";
require_once "../modelos/campanas.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaCampanas{

	public function mostrarTabla(){

		$ruta = ControladorGeneral::ctrRuta();

		$item = "tipo";
		$valor = 6;
		$campanas = ControladorCampanas::ctrMostrarCampanasAll($item, $valor);
		$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$_GET["doc_usuario"]);


		if(count($campanas) < 1 ){

			echo '{ "data":[]}';

			return;

		}

		$datosJson = '{"data":[';

		foreach ($campanas as $key => $value) {

			/*=============================================
			ESTADO
			=============================================*/	

			if ( $value["estado"] == 1 ) {

				$estado = "<select class='form-control selectActiva' estadoCampana=0 idCampana='".$value["id"]."'><option value='1' selected>Activa</option><option value='0'>Inactiva</option><option value='2'>Finalizada</option></select>";

			} else if($value["estado"] == 0){

				$estado = "<select class='form-control selectActiva' estadoCampana=1 idCampana='".$value["id"]."'><option value='1'>Activa</option><option value='0' selected>Inactiva</option><option value='2'>Finalizada</option></select>";

			}else if($value["estado"] == 2){

				$estado = "<select class='form-control selectActiva' estadoCampana=2 idCampana='".$value["id"]."'><option value='1'>Activa</option><option value='0'>Inactiva</option><option value='2' selected>Finalizada</option></select>";

			}

				$acciones = "<div class='btn-group'><button class='btn btn-warning btn-xs btnEditarCampana' idCampana='".$value["id"]."' data-toggle='modal' data-target='#modalEditarCampana'><i class='fa fa-pen' style='color:white'></i></button><button class='btn btn-danger btn-xs btnEliminarCampana' idCampana='".$value["id"]."'><i class='fa fa-times' style='color:white'></i></button><button type='button' class='btn btn-info btn-xs btnVerRecurrencia' data-toggle='modal' data-target='#modalVerRecurrencia' idCampana='".$value["id"]."'><i class='fa fa-eye'></i></button></div>";


				$datosJson .= '[
					"'.$acciones.'",
					"'.$estado.'",  
					"'.$value["fecha_inicio"].'",
					"'.$value["fecha_fin"].'",
					"'.$value["fecha_retorno"].'"
			 ],';
			

			

			

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']}';

		echo $datosJson;

	}
	// cierre metodo


}
// cierre clase

$activarTabla = new TablaCampanas();
$activarTabla -> mostrarTabla();
