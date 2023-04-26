<?php

require_once "../controladores/multinivel.controlador.php";
require_once "../modelos/multinivel.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUninivel{

	public function mostrarTabla(){

		if(isset($_GET["enlace_afiliado"])){

			$red = ControladorMultinivel::ctrMostrarRed("usuarios", "red_uninivel", "patrocinador_red",	$_GET["enlace_afiliado"]);

			/*=============================================
			Limpinado el array de tipo Objeto de valores repetidos
			=============================================*/

			$resultado = array();

			foreach ($red as $value) {
				
				$resultado[$value["id_usuario"]]= $value;
				
			}

			$red = array_values($resultado);

			if(count($red)== 0){

	 			$datosJson = '{"data": []}';

				echo $datosJson;

				return;

 			}

 			$datosJson = '{

		 	"data": [ ';

			foreach ($red as $key => $value) {

				if($value["perfil"]!="admin"){


				/*=============================================
				FOTO
				=============================================*/	

				if($value["foto"] != ""){

					$foto = "<img src='".$value["foto"]."' class='img-fluid' width='30px'>";

				}else{

					$foto = "<img src='vistas/img/usuarios/default/default.png' class='img-fluid' width='30px'>";
				}

				/*=============================================
				SUSCRIPCIÓN
				=============================================*/	

				if($value["operando"] != 0){	

					$estado = "<h5><span class='badge badge-success'>Operando</span></h5>";

				}else{

					$estado = "<h5><span class='badge badge-danger'>Sin Operar</span></h5>";
				}
			


				$datosJson	 .= '[
						
					"'.($key+1).'",
					"'.$foto.'",
					"'.$value["nombre"].'",
					"'.$value["pais"].'",
					"'.$value["fecha_contrato"].'",
					"'.$estado.'"

				],';	
				
			}else{
				$datosJson = '{"data": []}';

				echo $datosJson;

				return;
			}
				
			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson.=  ']

			}';

			echo $datosJson;

		}

	}

}

/*=============================================
ACTIVAR TABLA UNINIVEL
=============================================*/ 

$activar = new TablaUninivel();
$activar -> mostrarTabla();
